<?php

namespace Biplove\OopsUi\Tests\Unit;

use Biplove\OopsUi\ConfigurationResolver;
use Biplove\OopsUi\ErrorRenderer;
use Biplove\OopsUi\TemplateSelector;
use Illuminate\Http\Request;
use Illuminate\View\Factory as ViewFactory;
use Illuminate\View\View;
use Orchestra\Testbench\TestCase;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\HttpException;

class ErrorRendererTest extends TestCase
{
    private ErrorRenderer $renderer;
    private ConfigurationResolver $configResolver;
    private TemplateSelector $templateSelector;
    private ViewFactory $viewFactory;

    protected function setUp(): void
    {
        parent::setUp();

        $this->configResolver = $this->createMock(ConfigurationResolver::class);
        $this->templateSelector = $this->createMock(TemplateSelector::class);
        $this->viewFactory = $this->createMock(ViewFactory::class);

        $this->renderer = new ErrorRenderer(
            $this->configResolver,
            $this->templateSelector,
            $this->viewFactory
        );
        
        // Set default config for tests
        config(['oops-ui.api_error_mode' => 'auto']);
        config(['oops-ui.api_base_path' => null]);  // Uses Laravel's default 'api'
    }

    /** @test */
    public function it_extracts_status_code_from_http_exception()
    {
        $exception = new NotFoundHttpException();
        $request = Request::create('/test');

        $this->configResolver->method('resolve')->willReturn(['title' => 'Not Found']);
        $this->templateSelector->method('select')->willReturn('oops-ui::errors.404');
        
        $view = $this->createMock(View::class);
        $view->method('render')->willReturn('<html>404</html>');
        $this->viewFactory->method('make')->willReturn($view);

        $response = $this->renderer->render($exception, $request);

        $this->assertEquals(404, $response->getStatusCode());
    }

    /** @test */
    public function it_defaults_to_500_for_non_http_exceptions()
    {
        $exception = new \Exception('Something went wrong');
        $request = Request::create('/test');

        $this->configResolver->method('resolve')->willReturn(['title' => 'Server Error']);
        $this->templateSelector->method('select')->willReturn('oops-ui::errors.500');
        
        $view = $this->createMock(View::class);
        $view->method('render')->willReturn('<html>500</html>');
        $this->viewFactory->method('make')->willReturn($view);

        $response = $this->renderer->render($exception, $request);

        $this->assertEquals(500, $response->getStatusCode());
    }

    /** @test */
    public function it_only_handles_http_error_codes()
    {
        $exception = new HttpException(200, 'OK');
        $request = Request::create('/test');

        $response = $this->renderer->render($exception, $request);

        $this->assertNull($response);
    }

    /** @test */
    public function it_handles_600_status_code()
    {
        $exception = new HttpException(600, 'Invalid');
        $request = Request::create('/test');

        $response = $this->renderer->render($exception, $request);

        $this->assertNull($response);
    }

    /** @test */
    public function it_returns_null_on_rendering_failure()
    {
        $exception = new NotFoundHttpException();
        $request = Request::create('/test');

        $this->configResolver->method('resolve')->willThrowException(new \Exception('Config error'));

        $response = $this->renderer->render($exception, $request);

        $this->assertNull($response);
    }
}
