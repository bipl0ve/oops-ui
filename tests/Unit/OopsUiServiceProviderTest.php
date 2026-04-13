<?php

namespace Biplove\OopsUi\Tests\Unit;

use Biplove\OopsUi\ConfigurationResolver;
use Biplove\OopsUi\ErrorRenderer;
use Biplove\OopsUi\OopsUiServiceProvider;
use Biplove\OopsUi\TemplateSelector;
use Illuminate\Foundation\Application;
use PHPUnit\Framework\TestCase;

class OopsUiServiceProviderTest extends TestCase
{
    private OopsUiServiceProvider $provider;
    private Application $app;

    protected function setUp(): void
    {
        parent::setUp();
        
        $this->app = $this->createMock(Application::class);
        $this->provider = new OopsUiServiceProvider($this->app);
    }

    /** @test */
    public function it_binds_configuration_resolver_to_container()
    {
        $this->app->expects($this->atLeastOnce())
            ->method('singleton')
            ->with(ConfigurationResolver::class);

        $this->provider->register();
    }

    /** @test */
    public function it_binds_template_selector_to_container()
    {
        $this->app->expects($this->atLeastOnce())
            ->method('singleton')
            ->with(TemplateSelector::class);

        $this->provider->register();
    }

    /** @test */
    public function it_binds_error_renderer_to_container()
    {
        $this->app->expects($this->atLeastOnce())
            ->method('singleton')
            ->with(ErrorRenderer::class);

        $this->provider->register();
    }
}
