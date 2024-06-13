<?php

namespace App\Http\Controllers\Event;

use App\Http\Controllers\Controller;
use App\Http\Requests\Event\CreateEventRequest;
use App\Http\Requests\Event\UpdateEventRequest; // Assumindo que você criou este request para validar atualizações
use App\Http\Resources\Event\EventResource;
use App\Http\Responses\CollectionResponse;
use App\Http\Responses\ModelResponse;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use JustSteveKing\Tools\Http\Enums\Status;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10);
        $events = Event::query()->paginate($perPage);

        return new CollectionResponse(
            data: EventResource::collection($events),
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateEventRequest $request)
    {
        $data = $request->validated();
        $data['slug'] = Str::slug($data['title']);

        if ($request->hasFile('banner')) {
            $bannerPath = $request->file('banner')->store('banners', 'public');
            $data['banner_url'] = $bannerPath;
        }

        /* @var \App\Models\User $user */
        $user = auth()->user();
        $event = $user->events()->create($data);

        return new ModelResponse(
            data: EventResource::make($event),
            status: Status::CREATED
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $event = Event::findOrFail($id);

        return new ModelResponse(
            data: EventResource::make($event),
            status: Status::OK
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEventRequest $request, string $id)
    {
        $event = Event::findOrFail($id);

        $data = $request->validated();

        if (isset($data['title'])) {
            $data['slug'] = Str::slug($data['title']);
        }

        if ($request->hasFile('banner')) {
            if ($event->banner_url) {
                Storage::disk('public')->delete($event->banner_url);
            }

            $bannerPath = $request->file('banner')->store('banners', 'public');
            $data['banner_url'] = $bannerPath;
        }

        $event->update($data);

        return new ModelResponse(
            data: EventResource::make($event),
            status: Status::OK
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
}
