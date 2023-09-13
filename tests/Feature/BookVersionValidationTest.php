<?php

use App\Models\Edition;
use App\Models\Publisher;
use App\Models\User;

it("validates book version ", function ($wrongBookId) {
    $this->actingAs(User::factory()->create())
        ->postJson("/api/book", [
            "book_id" => $wrongBookId,
            "edition_id" => Edition::factory()->create()->id,
            "publisher_id" => Publisher::factory()->create()->id,
        ])
        ->assertStatus(404);
})->with([123]);

it("validates book version if wrong ", function (
    $wrongBookId,
    $wrongEditionId,
    $wrongPublisherId
) {
    $this->actingAs(User::factory()->create())
        ->postJson("/api/book", [
            "book_id" => $wrongBookId,
            "edition_id" => $wrongEditionId,
            "publisher_id" => $wrongPublisherId,
        ])
        ->assertStatus(404);
})->with(
    [123, true, "IZIZ?A/$*@#"],
    [true, 123, "IZIZ?A$*@#"],
    ["IZIZ?A$*@#", 123, true],
    [-1, -2, -3]
);
