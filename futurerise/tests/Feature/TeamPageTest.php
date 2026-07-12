<?php

use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('the team page is accessible', function () {
    $response = $this->get('/team');

    $response->assertOk()
        ->assertSee('OUR TEAM');
});
