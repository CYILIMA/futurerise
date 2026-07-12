<?php

test('the site footer exposes a social links area', function () {
    $response = $this->get('/');

    $response->assertOk()
        ->assertSee('Follow us');
});
