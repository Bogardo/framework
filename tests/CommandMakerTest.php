<?php

namespace Tests;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Artisan;

class CommandMakerTest extends TestCase
{
    public function tearDown()
    {
        File::delete(app_path('Commands'.DIRECTORY_SEPARATOR.'FooCommand.php'));
    }

    /** @test */
    public function it_creates_commands(): void
    {
        Artisan::call('make:command', ['name' => 'FooCommand']);

        $file = app_path('Commands'.DIRECTORY_SEPARATOR.'FooCommand.php');

        $this->assertTrue(File::exists($file));
        $this->assertContains('class FooCommand extends Command', File::get($file));
    }
}
