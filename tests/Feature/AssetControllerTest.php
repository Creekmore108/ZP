<?php

namespace Tests\Feature;

use App\Models\Asset;
use App\Models\Reservation;
use App\Models\Tag;
use App\Models\User;
use App\Notifications\AssetPendingApproval;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class AssetControllerTest extends TestCase
{
    //   use LazilyRefreshDatabase;

    /**
     * @test
     */
    public function ListAllAssetsInPaginatedFormat(): void
    {
        $user = User::factory()->create();
        $tags = Tag::factory(2)->create();
        $tags2 = Tag::factory(2)->create();

        Asset::factory(2)->create();

        Asset::factory()->for($user)->hasAttached($tags)->create();
        Asset::factory()->hasAttached($tags2)->create();

        $response = $this->get('/api/assets');

        // dd($response->json());

        $response->assertOk()
            ->assertJsonStructure(['data', 'meta', 'links'])
            ->assertJsonCount(4, 'data')
            ->assertJsonStructure(['data' => ['*' => ['id', 'title']]]);
    }

   /**
     * @test
     */
    public function ShowsTheAsset()
    {
        $user = User::factory()->create();

        $tag = Tag::factory()->create();

        $asset = Asset::factory()->for($user)->create();

        $asset->tags()->attach($tag);
        $asset->images()->create(['path' => 'image.jpg']);

        $asset = Asset::factory()->for($user)->hasTags(1)->hasImages(1)->create();

        Reservation::factory()->for($asset)->create(['status' => Reservation::STATUS_ACTIVE]);
        // Reservation::factory()->for($asset)->cancelled()->create();

        $asset = Asset::factory()->create();

        $response = $this->get('/api/assets/'.$asset->id);

        $response->dump();
        // dd($user);


        $response->assertOk()
            ->assertJsonPath('data.reservations_count', 0)
            ->assertJsonCount(0, 'data.tags')
            ->assertJsonCount(0, 'data.images');
            // ->assertJsonPath('data.user.id', $user->id);

    }
}
