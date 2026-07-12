<?php

use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('the courses page is accessible', function () {
    $response = $this->get('/courses');

    $response->assertOk()
        ->assertSee('COURSES');
});
