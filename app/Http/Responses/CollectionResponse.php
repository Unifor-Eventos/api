<?php

declare(strict_types=1);

namespace App\Http\Responses;

use App\Http\Responses\Concerns\HasResponse;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use JustSteveKing\Tools\Http\Enums\Status;

final readonly class CollectionResponse implements Responsable
{
    use HasResponse;

    public function __construct(
        protected AnonymousResourceCollection $data,
        protected Status $status = Status::OK,
    ) {
    }
}
