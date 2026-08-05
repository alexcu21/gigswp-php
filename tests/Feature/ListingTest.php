<?php

namespace Tests\Feature;

use App\Models\Listing;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ListingTest extends TestCase
{
    use RefreshDatabase;

    public function test_home_page_shows_listings(): void
    {
        $response = $this->get('/');

        $response->assertOk();
        $response->assertSee('GIGSWP');
        $response->assertSee('Find Your Dream Job');
    }

    public function test_guest_is_redirected_from_create(): void
    {
        $response = $this->get(route('listings.create'));

        $response->assertRedirect(route('login'));
    }

    public function test_authenticated_user_can_create_listing(): void
    {
        $user = User::factory()->create([
            'city' => 'Austin',
            'state' => 'TX',
        ]);

        $response = $this->actingAs($user)->post(route('listings.store'), [
            'title' => 'Laravel Developer',
            'description' => 'Build cool apps',
            'salary' => '120000',
            'requirements' => 'PHP',
            'benefits' => 'Remote',
            'tags' => 'php,laravel',
            'company' => 'Acme',
            'address' => '1 Main St',
            'city' => 'Austin',
            'state' => 'TX',
            'phone' => '555-0100',
            'email' => 'jobs@acme.test',
        ]);

        $listing = Listing::query()->where('title', 'Laravel Developer')->first();

        $this->assertNotNull($listing);
        $this->assertSame($user->id, $listing->user_id);
        $response->assertRedirect(route('listings.show', $listing));
    }
}
