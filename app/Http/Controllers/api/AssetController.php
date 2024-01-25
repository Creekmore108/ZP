<?php

namespace App\Http\Controllers;


use App\Http\Resources\AssetResource;
use App\Models\Asset;
use App\Models\Reservation;
use App\Models\User;
// use App\Models\Validators\OfficeValidator;
// use App\Notifications\OfficePendingApproval;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class AssetController extends Controller
{
    public function index()
    {
        $assets = Asset::query()
            ->where('approval_status', Asset::APPROVAL_APPROVED)->where('hidden', false);
            // ->when(request('user_id') && auth()->user() && request('user_id') == auth()->id(),
            //     fn($builder) => $builder,
            //     fn($builder) => $builder->where('approval_status', Asset::APPROVAL_APPROVED)->where('hidden', false)
            // )
            // ->when(request('user_id'), fn($builder) => $builder->whereUserId(request('user_id')))
            // ->when(request('visitor_id'),
            //     fn($builder) => $builder->whereRelation('reservations', 'user_id', '=', request('visitor_id'))
            // )
            // ->when(request('tags'),
            //     fn($builder) => $builder->whereHas(
            //         'tags',
            //         fn ($builder) => $builder->whereIn('id', request('tags')),
            //         '=',
            //         count(request('tags'))
            //     )
            // )
            // ->with(['images', 'tags', 'user']);
            // ->withCount(['reservations' => fn($builder) => $builder->whereStatus(Reservation::STATUS_ACTIVE)])
            // ->paginate(5);


        // return $assets;

        return AssetResource::collection(
            $assets
        );
    }
}
