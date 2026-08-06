<?php

teste ('User created', function () {
    $this->assertDatabaseCount('users', 0);

    // chamada principal

    $this->assertDatabaseHas('users');
})