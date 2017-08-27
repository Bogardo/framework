<?php

/**
 * This file is part of Zero Framework.
 *
 * (c) Nuno Maduro <enunomaduro@gmail.com>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace NunoMaduro\ZeroFramework\Contracts\Commands\Component;

use NunoMaduro\ZeroFramework\Commands\Component\Installer as InstallCommand;

/**
 * The is the Zero Framework component install contract.
 *
 * @author Nuno Maduro <enunomaduro@gmail.com>
 */
interface Installer
{
    /**
     * Installs the component and returns the result
     * of the installation.
     *
     * @param \NunoMaduro\ZeroFramework\Commands\Component\Installer $command
     *
     * @return bool
     */
    public function install(InstallCommand $command): bool;
}
