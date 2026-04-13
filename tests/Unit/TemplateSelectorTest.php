<?php

namespace Biplove\OopsUi\Tests\Unit;

use Biplove\OopsUi\TemplateSelector;
use Illuminate\View\Factory as ViewFactory;
use Illuminate\View\ViewFinderInterface;
use Orchestra\Testbench\TestCase;

class TemplateSelectorTest extends TestCase
{
    private TemplateSelector $selector;
    private ViewFactory $viewFactory;
    private ViewFinderInterface $viewFinder;

    protected function setUp(): void
    {
        parent::setUp();
        
        $this->viewFactory = $this->createMock(ViewFactory::class);
        $this->viewFinder = $this->createMock(ViewFinderInterface::class);
        
        $this->viewFactory->method('getFinder')
            ->willReturn($this->viewFinder);
        
        $this->selector = new TemplateSelector($this->viewFactory);
        
        // Set default config for tests
        config(['oops-ui.settings.default_template' => 'layout']);
        config(['oops-ui.error_pages' => []]);
    }

    /** @test */
    public function it_uses_custom_error_page_from_error_pages_config()
    {
        config(['oops-ui.error_pages' => [
            404 => 'errors.my-custom-404'
        ]]);

        $this->viewFactory->method('exists')
            ->willReturnCallback(fn($template) => $template === 'errors.my-custom-404');
        
        $this->viewFinder->method('find')
            ->willReturn(__DIR__ . '/../Feature/fixtures/non-empty.blade.php');

        $result = $this->selector->select([], 404, 'layout');

        $this->assertEquals('errors.my-custom-404', $result);
    }

    /** @test */
    public function it_returns_default_when_laravel_error_view_does_not_exist()
    {
        config(['oops-ui.error_pages' => [
            404 => 'default'
        ]]);

        $this->viewFactory->method('exists')
            ->willReturn(false);

        $result = $this->selector->select([], 404, 'layout');

        $this->assertEquals('default', $result);
    }

    /** @test */
    public function it_falls_back_to_package_template_when_laravel_error_view_is_empty()
    {
        config(['oops-ui.error_pages' => [
            404 => 'default'
        ]]);

        $this->viewFactory->method('exists')
            ->willReturnCallback(fn($template) => in_array($template, [
                'errors.404',
                'oops-ui::errors.templates.layout'
            ]));
        
        $this->viewFinder->method('find')
            ->willReturnCallback(function($template) {
                if ($template === 'errors.404') {
                    return __DIR__ . '/../Feature/fixtures/empty.blade.php';
                }
                return __DIR__ . '/../Feature/fixtures/non-empty.blade.php';
            });

        $result = $this->selector->select([], 404, 'layout');

        $this->assertEquals('layout', $result);
    }

    /** @test */
    public function it_uses_laravel_error_view_when_default_is_set_and_file_exists()
    {
        config(['oops-ui.error_pages' => [
            404 => 'default'
        ]]);

        $this->viewFactory->method('exists')
            ->willReturnCallback(fn($template) => $template === 'errors.404');
        
        $this->viewFinder->method('find')
            ->willReturn(__DIR__ . '/../Feature/fixtures/non-empty.blade.php');

        $result = $this->selector->select([], 404, 'layout');

        $this->assertEquals('errors.404', $result);
    }

    /** @test */
    public function it_falls_back_to_package_template_when_custom_page_not_found()
    {
        config(['oops-ui.error_pages' => [
            404 => 'errors.nonexistent'
        ]]);

        $this->viewFactory->method('exists')
            ->willReturnCallback(fn($template) => $template === 'oops-ui::errors.templates.layout');

        $result = $this->selector->select([], 404, 'layout');

        $this->assertEquals('layout', $result);
    }

    /** @test */
    public function it_falls_back_when_custom_page_is_empty()
    {
        config(['oops-ui.error_pages' => [
            404 => 'errors.empty-custom'
        ]]);

        $this->viewFactory->method('exists')
            ->willReturnCallback(fn($template) => in_array($template, [
                'errors.empty-custom',
                'oops-ui::errors.templates.layout'
            ]));
        
        $this->viewFinder->method('find')
            ->willReturnCallback(function($template) {
                if ($template === 'errors.empty-custom') {
                    return __DIR__ . '/../Feature/fixtures/empty.blade.php';
                }
                return __DIR__ . '/../Feature/fixtures/non-empty.blade.php';
            });

        $result = $this->selector->select([], 404, 'layout');

        $this->assertEquals('layout', $result);
    }

    /** @test */
    public function it_uses_default_template_from_parameter()
    {
        $this->viewFactory->method('exists')
            ->willReturnCallback(fn($template) => $template === 'oops-ui::errors.templates.minimal');

        $result = $this->selector->select([], 404, 'minimal');

        $this->assertEquals('minimal', $result);
    }

    /** @test */
    public function it_uses_default_template_from_config()
    {
        config(['oops-ui.settings.default_template' => 'modern']);

        $this->viewFactory->method('exists')
            ->willReturnCallback(fn($template) => $template === 'oops-ui::errors.templates.modern');

        $result = $this->selector->select([], 404, null);

        $this->assertEquals('modern', $result);
    }

    /** @test */
    public function it_falls_back_to_layout_when_default_template_invalid()
    {
        $this->viewFactory->method('exists')
            ->willReturnCallback(fn($template) => $template === 'oops-ui::errors.templates.layout');

        $result = $this->selector->select([], 404, 'nonexistent');

        $this->assertEquals('layout', $result);
    }

    /** @test */
    public function it_prioritizes_error_pages_over_default_template()
    {
        config(['oops-ui.error_pages' => [
            404 => 'errors.custom-404'
        ]]);

        $this->viewFactory->method('exists')
            ->willReturnCallback(fn($template) => in_array($template, [
                'errors.custom-404',
                'oops-ui::errors.templates.modern'
            ]));
        
        $this->viewFinder->method('find')
            ->willReturn(__DIR__ . '/../Feature/fixtures/non-empty.blade.php');

        $result = $this->selector->select([], 404, 'modern');

        $this->assertEquals('errors.custom-404', $result);
    }
}
