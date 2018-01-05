<?php

namespace LaravelZero\Framework\Contracts\Providers;

use Symfony\Component\Console\Output\OutputInterface;
use NunoMaduro\Collision\Contracts\Provider as ProviderContract;

/**
 * This is the Laravel Zero Framework error handler contract.
 *
 * @author Nuno Maduro <enunomaduro@gmail.com>
 */
interface ErrorHandler
{
    /**
     * Registers the error handler.
     */
    public function register(): void;

    /**
     * Sets the output of the error handler.
     *
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     */
    public function setOutput(OutputInterface $output): void;

    /**
     * Returns the provider.
     *
     * @return \NunoMaduro\Collision\Contracts\Provider
     */
    public function getProvider(): ProviderContract;
}
