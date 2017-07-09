<?php

/**
 * This file is part of Zero Framework.
 *
 * (c) Nuno Maduro <enunomaduro@gmail.com>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace NunoMaduro\ZeroFramework;

use ArrayAccess;
use BadMethodCallException;
use Illuminate\Config\Repository;
use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container;
use Illuminate\Events\EventServiceProvider;
use Symfony\Component\Console\Input\InputInterface;
use Illuminate\Console\Application as BaseApplication;
use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Contracts\Container\Container as ContainerContract;
use NunoMaduro\LaravelDesktopNotifier\LaravelDesktopNotifierServiceProvider;

/**
 * The is the Zero Framework application class.
 *
 * @author Nuno Maduro <enunomaduro@gmail.com>
 */
class Application extends BaseApplication implements ArrayAccess
{
    /**
     * The application version.
     */
    const VERSION = '3.00';

    /**
     * The application container.
     *
     * @var \Illuminate\Contracts\Container\Container
     */
    protected $container;

    /**
     * The event dispatcher.
     *
     * @var \Illuminate\Contracts\Events\Dispatcher
     */
    protected $dispatcher;

    /**
     * All of the registered service providers.
     *
     * @var array
     */
    protected $serviceProviders = [
        EventServiceProvider::class,
        LaravelDesktopNotifierServiceProvider::class,
    ];

    /**
     * All the container aliases.
     *
     * @var array
     */
    protected $aliases = [
        'app' => [\Illuminate\Contracts\Container\Container::class],
        'events' => [\Illuminate\Events\Dispatcher::class, \Illuminate\Contracts\Events\Dispatcher::class],
        'config' => [\Illuminate\Config\Repository::class, \Illuminate\Contracts\Config\Repository::class],
    ];

    /**
     * Create a new application.
     *
     * @param \Illuminate\Contracts\Container\Container|null $container
     * @param \Illuminate\Contracts\Events\Dispatcher|null $dispatcher
     */
    public function __construct(ContainerContract $container = null, DispatcherContract $dispatcher = null)
    {
        $this->container = $container ?: new Container;
        $this->dispatcher = $dispatcher ?: new Dispatcher($this->container);

        parent::__construct($this->container, $this->dispatcher, self::VERSION);

        $this->setCatchExceptions(true);

        $this->registerBindings()
            ->registerServiceProviders()
            ->registerContainerAliases()
            ->registerCommands();
    }

    /**
     * Sets the application container.
     *
     * @param \Illuminate\Contracts\Container\Container $container
     *
     * @return $this
     */
    public function setContainer(ContainerContract $container): Application
    {
        $this->container = $container;

        return $this;
    }

    /**
     * Proxies calls into the container.
     *
     * @param string $method
     * @param array $parameters
     *
     * @throws \BadMethodCallException
     *
     * @return mixed
     */
    public function __call(string $method, array $parameters)
    {
        if (is_callable([$this->container, $method])) {
            return call_user_func_array([$this->container, $method], $parameters);
        }

        throw new BadMethodCallException("Method [{$method}] does not exist.");
    }

    /**
     * Determine if a given offset exists.
     *
     * @param string $key
     *
     * @return bool
     */
    public function offsetExists($key): bool
    {
        return isset($this->container[$key]);
    }

    /**
     * Get the value at a given offset.
     *
     * @param string $key
     *
     * @return mixed
     */
    public function offsetGet($key)
    {
        return $this->container[$key];
    }

    /**
     * Set the value at a given offset.
     *
     * @param string $key
     * @param mixed $value
     *
     * @return void
     */
    public function offsetSet($key, $value): void
    {
        $this->container[$key] = $value;
    }

    /**
     * Unset the value at a given offset.
     *
     * @param string $key
     *
     * @return void
     */
    public function offsetUnset($key): void
    {
        unset($this->container[$key]);
    }

    /**
     * Dynamically access container services.
     *
     * @param string $key
     *
     * @return mixed
     */
    public function __get($key)
    {
        return $this->container->{$key};
    }

    /**
     * Dynamically set container services.
     *
     * @param string $key
     * @param mixed $value
     *
     * @return void
     */
    public function __set($key, $value): void
    {
        $this->container->{$key} = $value;
    }

    /**
     * Gets the name of the command based on input.
     *
     * @param \Symfony\Component\Console\Input\InputInterface $input The input interface
     *
     * @return string The command name
     */
    protected function getCommandName(InputInterface $input): string
    {
        $name = parent::getCommandName($input);

        $command = $this->container->make('config')->get('app.default-command');

        $command = $this->container->make($command);

        return $name ?: $command->getName();
    }

    /**
     * Register the basic commands into the app.
     *
     * @return $this
     */
    protected function registerCommands(): Application
    {
        $commands = array_merge(
            [$this->container->make('config')->get('app.default-command')],
            $this->getCommands()
        );

        array_walk(
            $commands,
            function ($command) {
                $this->add($this->container->make($command));
            }
        );

        return $this;
    }

    protected function getCommands()
    {
        return $this->container
            ->make('config')
            ->get('app.commands');
    }

    /**
     * Register the basic bindings into the container.
     *
     * @return $this
     */
    protected function registerBindings(): Application
    {
        Container::setInstance($this->container);

        $this->container->instance('app', $this->container);

        $this->container->instance(Container::class, $this->container);

        $this->container->instance(
            'config',
            new Repository(
                require BASE_PATH.'/'.'config/config.php'
            )
        );

        return $this;
    }

    /**
     * Register the services into the container.
     *
     * @return $this
     */
    protected function registerServiceProviders(): Application
    {
        array_walk(
            $this->serviceProviders,
            function ($serviceProvider) {
                $instance = (new $serviceProvider($this))->register();

                if (method_exists($instance, 'boot')) {
                    $instance->boot();
                }
            }
        );

        return $this;
    }

    /**
     * Register the class aliases in the container.
     *
     * @return $this
     */
    protected function registerContainerAliases(): Application
    {
        foreach ($this->aliases as $key => $aliases) {
            foreach ($aliases as $alias) {
                $this->container->alias($key, $alias);
            }
        }

        return $this;
    }
}
