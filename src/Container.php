<?php

namespace LaravelZero\Framework;

use Illuminate\Container\Container as BaseContainer;
use LaravelZero\Framework\Exceptions\NotImplementedException;
use Illuminate\Contracts\Foundation\Application as LaravelApplication;

/**
 * This is the Laravel Zero Framework container class.
 *
 * @author Nuno Maduro <enunomaduro@gmail.com>
 */
class Container extends BaseContainer implements LaravelApplication
{
    /**
     * {@inheritdoc}
     */
    public function version()
    {
        return config('app.name');
    }

    /**
     * Get the base path of the Laravel installation.
     *
     * @param  string  $path
     * @return string
     */
    public function basePath($path = '')
    {
        return BASE_PATH.($path ? "/$path" : $path);
    }

    /**
     * Get the path to the application configuration files.
     *
     * @param  string  $path
     * @return string
     */
    public function configPath($path = '')
    {
        return BASE_PATH.'/config'.($path ? "/$path" : $path);
    }

    /**
     * Get the path to the database directory.
     *
     * @param  string  $path
     * @return string
     */
    public function databasePath($path = '')
    {
        return config('database.path') ?: (BASE_PATH.'/database'.($path ? "/$path" : $path));
    }

    /**
     * Get the path to the language files.
     *
     * @return string
     */
    public function langPath()
    {
        return $this->resourcePath('lang');
    }

    /**
     * Get the path to the resources directory.
     *
     * @param  string  $path
     * @return string
     */
    public function resourcePath($path = '')
    {
        return BASE_PATH.'/resources'.($path ? "/$path" : $path);
    }

    /**
     * Get the path to the storage directory.
     *
     * @return string
     */
    public function storagePath()
    {
        return BASE_PATH.'/storage';
    }

    /**
     * {@inheritdoc}
     */
    public function environment()
    {
        return config('app.production') ? 'production' : 'development';
    }

    /**
     * {@inheritdoc}
     */
    public function runningInConsole()
    {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function getNamespace()
    {
        return 'App';
    }

    /**
     * {@inheritdoc}
     */
    public function isDownForMaintenance()
    {
        return false;
    }

    /**
     * {@inheritdoc}
     */
    public function registerConfiguredProviders()
    {
        throw new NotImplementedException;
    }

    /**
     * {@inheritdoc}
     */
    public function register($provider, $options = [], $force = false)
    {
        throw new NotImplementedException;
    }

    /**
     * {@inheritdoc}
     */
    public function registerDeferredProvider($provider, $service = null)
    {
        throw new NotImplementedException;
    }

    /**
     * {@inheritdoc}
     */
    public function boot()
    {
        throw new NotImplementedException;
    }

    /**
     * {@inheritdoc}
     */
    public function booting($callback)
    {
        throw new NotImplementedException;
    }

    /**
     * {@inheritdoc}
     */
    public function booted($callback)
    {
        throw new NotImplementedException;
    }

    /**
     * {@inheritdoc}
     */
    public function getCachedServicesPath()
    {
        throw new NotImplementedException;
    }

    /**
     * {@inheritdoc}
     */
    public function getCachedPackagesPath()
    {
        throw new NotImplementedException;
    }
}
