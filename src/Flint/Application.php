<?php

namespace Flint;

use Flint\Provider\ConfigServiceProvider;
use Flint\Provider\FlintServiceProvider;
use Flint\Provider\RoutingServiceProvider;
use Silex\Provider\TwigServiceProvider;

/**
 * @package Flint
 */
class Application extends \Silex\Application
{
    /**
     * Assigns rootDir and debug to the pimple container. Also replaces the
     * normal resolver with a ApplicationAware Resolver.
     *
     * @param string $rootDir
     * @param boolean $debug
     */
    public function __construct($rootDir, $debug = false)
    {
        parent::__construct(array(
            'root_dir' => $rootDir,
            'debug' => $debug,
        ));

        $this->register(new ConfigServiceProvider);
        $this->register(new RoutingServiceProvider);
        $this->register(new TwigServiceProvider);
        $this->register(new FlintServiceProvider);
    }

    /**
     * @param array $parameters
     */
    public function inject(array $parameters)
    {
        foreach ($parameters as $k => $v) {
            $this[$k] = $v;
        }
    }
}
