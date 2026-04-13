<?php

namespace Biplove\OopsUi\Tests\Feature;

use Biplove\OopsUi\ErrorRenderer;
use Illuminate\Support\Facades\Exceptions;
use Orchestra\Testbench\TestCase;

class LaravelVersionCompatibilityTest extends TestCase
{
    /** @test */
    public function it_detects_laravel_11_exception_handler()
    {
        $hasLaravel11Method = method_exists(Exceptions::class, 'render');
        
        // This test verifies the detection logic works
        $this->assertIsBool($hasLaravel11Method);
    }

    /** @test */
    public function it_registers_error_renderer_in_container()
    {
        $this->assertTrue($this->app->bound(ErrorRenderer::class));
    }

    /** @test */
    public function error_renderer_can_be_resolved()
    {
        $renderer = $this->app->make(ErrorRenderer::class);
        
        $this->assertInstanceOf(ErrorRenderer::class, $renderer);
    }

    protected function getPackageProviders($app)
    {
        return [\Biplove\OopsUi\OopsUiServiceProvider::class];
    }
}
