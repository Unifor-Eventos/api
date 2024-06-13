<?php

namespace App\Http\Controllers\Event;

use App\Http\Controllers\Controller;
use App\Http\Requests\Event\AcceptEnrollRequest;
use App\Http\Requests\Event\EnrollRequest;
use App\Http\Requests\Event\RejectEnrollRequest;
use App\Http\Resources\Event\EventParticipantResource;
use App\Http\Responses\CollectionResponse;
use App\Http\Responses\MessageResponse;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use JustSteveKing\Tools\Http\Enums\Status;

class EnrollController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $id, Request $request)
    {
        $event = Event::findOrFail($id);
        $perPage = $request->input('per_page', 10);
        $participants = $event->participants()->paginate($perPage);

        return new CollectionResponse(
            data: EventParticipantResource::collection($participants),
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $event = Event::findOrFail($id);

        if ($event->banner_url) {
            Storage::disk('public')->delete($event->banner_url);
        }

        $event->delete();
        return response()->json(null, Status::NO_CONTENT);
    }

    public function store(EnrollRequest $request, string $eventId)
    {
        $user = auth()->user();
        $event = Event::findOrFail($eventId);

        if ($event->participants()->where('id', $user->id)->exists()) {
            return new MessageResponse(
                ["message" => "Você já está inscrito neste evento!"],
                status: Status::BAD_REQUEST
            );
        }

        $event->participants()->attach($user, [
            'resume' => $request->input('resume'),
            'resume_url' => $request->file('resume_file')->store('resumes', 'public')
        ]);

        return new MessageResponse(
            ["message" => "Inscrição realizada com sucesso!"],
            status: Status::OK
        );
    }

    public function accept(AcceptEnrollRequest $request, string $eventId)
    {
        $event = Event::findOrFail($eventId);
        $userId = $request->input('user_id');
        $event->participants()->updateExistingPivot($userId, ['status' => 'accepted', 'approved_at' => now()]);

        return new MessageResponse(
            ["message" => "Participante aceito com sucesso!"],
            status: Status::OK
        );
    }

    public function reject(RejectEnrollRequest $request, string $eventId)
    {
        $event = Event::findOrFail($eventId);
        $userId = $request->input('user_id');
        $event->participants()->updateExistingPivot($userId, ['status' => 'rejected']);

        return new MessageResponse(
            ["message" => "Participante rejeitado com sucesso!"],
            status: Status::OK
        );
    }
}
