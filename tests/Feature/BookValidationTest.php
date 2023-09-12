<?php

use App\Models\Author;
use App\Models\User;

test("libelle and description are required", function () {
    $this->actingAs(User::factory()->create())
        ->postJson("/api/book", [
            "author_id" => Author::factory()->create()->id,
        ])
        ->assertStatus(404);
});

it("validates book ", function ($wrongLibelle, $wrongDesc) {
    $this->actingAs(User::factory()->create())
        ->postJson("/api/book", [
            "libelle" => $wrongLibelle,
            "description" => $wrongDesc,
            "author_id" => Author::factory()->create()->id,
        ])
        ->assertStatus(404);
})->with([123, true], [true, 123]);
// ->skip();
