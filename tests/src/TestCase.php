<?php

namespace PodPoint\FormComponents\Tests;

use Illuminate\Container\Container as Container;
use Illuminate\Events\Dispatcher;
use Illuminate\Filesystem\Filesystem as Filesystem;
use Illuminate\Support\Arr;
use Illuminate\Support\ViewErrorBag;
use Illuminate\View\Compilers\BladeCompiler;
use Illuminate\View\Engines\CompilerEngine;
use Illuminate\View\Engines\EngineResolver;
use Illuminate\View\Factory;
use Illuminate\View\FileViewFinder;
use Illuminate\View\View as View;
use PHPUnit\Framework\TestCase as PHPUnitTestCase;

abstract class TestCase extends PHPUnitTestCase
{
    /**
     * The directory where the form components are stored.
     */
    const COMPONENTS_DIR = __DIR__ . '/../../views/_components';

    /**
     * The directory where test views are stored.
     */
    const VIEWS_DIR = __DIR__ . '/../../storage/views';

    /**
     * The Blade file extension.
     */
    const BLADE_EXT = '.blade.php';

    /**
     * Render a Blade view with the data passed to it.
     *
     * @param  string  $component
     * @param  array   $data
     * @return string
     */
    protected function renderBladeView(string $component, $data = []) {

        $data = Arr::add($data, 'errors', new ViewErrorBag());

        $viewPaths = [
            self::COMPONENTS_DIR . '/' . $component . self::BLADE_EXT,
            self::COMPONENTS_DIR,
        ];

        $fileViewFinder = new FileViewFinder(
            new Filesystem,
            $viewPaths
        );
        $fileViewFinder->addNamespace('form', self::COMPONENTS_DIR . '/..');

        $compiler = new BladeCompiler(new Filesystem(), self::VIEWS_DIR);
        $bladeEngine = new CompilerEngine($compiler);

        $dispatcher = new Dispatcher(new Container);

        $engineResolver = new EngineResolver();
        $engineResolver->register('blade', function () use ($bladeEngine) {
            return $bladeEngine;
        });

        $factory = new Factory(
            $engineResolver,
            $fileViewFinder,
            $dispatcher
        );

        $viewObject = new View(
            $factory,
            $bladeEngine,
            '',
            $viewPaths[0],
            $data
        );

        return $viewObject->render();
    }
}
