<?php

it('can render', function () {
    $contents = $this->view('login', [
        //
    ]);

    $contents->assertSee('');
});
