<?php

namespace Biplove\OopsUi;

use Illuminate\Support\ServiceProvider;

class OopsUiServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/oops-ui.php', 'oops-ui');

        $this->app->singleton(ConfigurationResolver::class, function ($app) {
            return new ConfigurationResolver($app['config']);
        });

        $this->app->singleton(TemplateSelector::class, function ($app) {
            return new TemplateSelector($app['view']);
        });

        $this->app->singleton(ErrorRenderer::class, function ($app) {
            return new ErrorRenderer(
                $app->make(ConfigurationResolver::class),
                $app->make(TemplateSelector::class),
                $app['view']
            );
        });

        $this->app->singleton(\Biplove\OopsUi\OopsUi::class, function ($app) {
            return new \Biplove\OopsUi\OopsUi(
                $app->make(ErrorRenderer::class),
                $app->make(ConfigurationResolver::class),
                $app->make(TemplateSelector::class)
            );
        });

        $this->app->alias(\Biplove\OopsUi\OopsUi::class, 'oops-ui');
    }

    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/resources/views', 'oops-ui');

        $this->publishes([
            __DIR__.'/../config/oops-ui.php' => config_path('oops-ui.php'),
        ], 'oops-ui-config');

        // Register @oopsError Blade directive
        $this->registerBladeDirectives();

        if ($this->app->runningInConsole()) {
            $this->commands([Console\InstallCommand::class]);
        }

        if (!$this->app->runningInConsole()) {
            $this->registerExceptionHandler();
        }
    }

    private function registerBladeDirectives(): void
    {
        // Register @oopsError directive for rendering error content in user layouts
        \Illuminate\Support\Facades\Blade::directive('oopsError', function ($expression) {
            return "<?php echo \$__env->yieldContent({$expression}); ?>";
        });
    }

    private function registerExceptionHandler(): void
    {
        $this->app->booted(function () {
            try {
                $handler = $this->app->make(\Illuminate\Contracts\Debug\ExceptionHandler::class);
                if (method_exists($handler, 'renderable')) {
                    $handler->renderable(function (\Throwable $e, $request) {
                        try {
                            return app(ErrorRenderer::class)->render($e, $request);
                        } catch (\Throwable $ex) {
                            if (function_exists('logger')) {
                                logger()->error('OopsUI: Failed to render error page', ['error' => $ex->getMessage()]);
                            }
                            return null;
                        }
                    });
                }
            } catch (\Throwable $e) {
                if (function_exists('logger')) {
                    logger()->error('OopsUI: Failed to register exception handler', ['error' => $e->getMessage()]);
                }
            }
        });
    }
}