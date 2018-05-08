<?php

/**
 * This file is part of Laravel Zero.
 *
 * (c) Nuno Maduro <enunomaduro@gmail.com>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace LaravelZero\Framework\Components\ConsoleDusk;

use LaravelZero\Framework\Components\AbstractInstaller;

/**
 * This is the Laravel Zero Framework Console Dusk Component Installer Implementation.
 */
class Installer extends AbstractInstaller
{
    /**
     * {@inheritdoc}
     */
    protected $name = 'install:console-dusk';

    /**
     * {@inheritdoc}
     */
    protected $description = 'Installs nunomaduro/laravel-console-dusk';

    /**
     * {@inheritdoc}
     */
    public function install(): void
    {
        $this->require('nunomaduro/laravel-console-dusk');

        $this->info('Usage:');
        $this->comment(
            '
class VisitLaravelZeroCommand extends Command
{
    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $this->browse(function ($browser) {
            $browser->visit("http://laravel-zero.com")
                ->assertSee("Collision");
        });
    }
}
'
        );
    }
}
