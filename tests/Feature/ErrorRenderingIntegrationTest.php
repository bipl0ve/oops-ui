<?php

namespace Biplove\OopsUi\Tests\Feature;

use Biplove\OopsUi\ErrorRenderer;
use Illuminate\Http\Request;
use Orchestra\Testbench\TestCase;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\HttpException;

class ErrorRenderingIntegrationTest extends TestCase
{
    /** @test */
    public function it_renders_404_error_with_custom_configuration()
    {
        config(['oops-ui.errors.404.title' => 'Custom 404 Title']);
        
        $renderer = $this->app->make(ErrorRenderer::class);
        $exception = new NotFoundHttpException();
        $request = Request::create('/test');
        
        $response = $renderer->render($exception, $request);
        
        $this->assertEquals(404, $response->getStatusCode());
        $this->assertStringContainsString('Custom 404 Title', $response->getContent());
    }

    /** @test */
    public function it_renders_500_error_with_custom_configuration()
    {
        config(['oops-ui.errors.500.title' => 'Custom Server Error']);
        
        $renderer = $this->app->make(ErrorRenderer::class);
        $exception = new \Exception('Test error');
        $request = Request::create('/test');
        
        $response = $renderer->render($exception, $request);
        
        $this->assertEquals(500, $response->getStatusCode());
        $this->assertStringContainsString('Custom Server Error', $response->getContent());
    }

    /** @test */
    public function it_shows_debug_information_when_enabled()
    {
        config(['oops-ui.show_debug' => true]);
        
        $renderer = $this->app->make(ErrorRenderer::class);
        $exception = new \Exception('Debug test error');
        $request = Request::create('/test');
        
        $response = $renderer->render($exception, $request);
        
        $this->assertStringContainsString('Debug Information', $response->getContent());
        $this->assertStringContainsString('Debug test error', $response->getContent());
    }

    /** @test */
    public function it_hides_debug_information_when_disabled()
    {
        config(['oops-ui.show_debug' => false]);
        
        $renderer = $this->app->make(ErrorRenderer::class);
        $exception = new \Exception('Hidden error');
        $request = Request::create('/test');
        
        $response = $renderer->render($exception, $request);
        
        $this->assertStringNotContainsString('Debug Information', $response->getContent());
        $this->assertStringNotContainsString('Hidden error', $response->getContent());
    }

    /** @test */
    public function it_uses_fallback_for_unconfigured_error_codes()
    {
        $renderer = $this->app->make(ErrorRenderer::class);
        $exception = new HttpException(418, "I'm a teapot");
        $request = Request::create('/test');
        
        $response = $renderer->render($exception, $request);
        
        $this->assertEquals(418, $response->getStatusCode());
        $this->assertNotNull($response->getContent());
    }

    /** @test */
    public function it_renders_buttons_from_configuration()
    {
        config(['oops-ui.errors.404.buttons' => [
            ['text' => 'Custom Button', 'url' => '/custom', 'style' => 'primary']
        ]]);
        
        $renderer = $this->app->make(ErrorRenderer::class);
        $exception = new NotFoundHttpException();
        $request = Request::create('/test');
        
        $response = $renderer->render($exception, $request);
        
        $this->assertStringContainsString('Custom Button', $response->getContent());
        $this->assertStringContainsString('/custom', $response->getContent());
    }

    protected function getPackageProviders($app)
    {
        return [\Biplove\OopsUi\OopsUiServiceProvider::class];
    }
}
