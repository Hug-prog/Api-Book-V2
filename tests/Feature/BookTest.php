<?php

namespace Tests\Feature;

use App\Models\Author;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic unit test example.
     */
    protected function test_book_creation(): void
    {
        $user = User::factory()->create();

        $author = Author::factory()->create();

        $response = $this->actingAs($user)->postJson("/api/book", [
            "libelle" => fake()->name,
            "description" => fake()->text(),
            "author_id" => $author->id,
        ]);

        $response->assertStatus(201);
    }

    function test_guests_cannot_add_books()
    {
        $this->postJson("/api/book")->assertUnauthorized();
    }
}
