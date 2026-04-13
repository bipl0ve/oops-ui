<?php

namespace Biplove\OopsUi;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\View\Factory as ViewFactory;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Throwable;

class ErrorRenderer
{
    protected ConfigurationResolver $configResolver;
    protected TemplateSelector $templateSelector;
    protected ViewFactory $viewFactory;

    public function __construct(
        ConfigurationResolver $configResolver,
        TemplateSelector $templateSelector,
        ViewFactory $viewFactory
    ) {
        $this->configResolver = $configResolver;
        $this->templateSelector = $templateSelector;
        $this->viewFactory = $viewFactory;
    }

    /**
     * Main entry point for exception handling.
     */
    public function render(Throwable $exception, Request $request): ?Response
    {
        try {
            $statusCode = $this->extractStatusCode($exception);

            // Only handle HTTP error codes (400-599)
            if (!$this->shouldHandle($statusCode)) {
                Log::debug('OopsUI: Not handling status code', ['status' => $statusCode]);
                return null;
            }

            // Check if this is an API request
            $isApi = $this->isApiRequest($request);
            
            Log::debug('OopsUI: Rendering decision', [
                'status_code' => $statusCode,
                'is_api' => $isApi,
                'will_render' => $isApi ? 'JSON' : 'HTML',
            ]);
            
            if ($isApi) {
                return $this->renderJsonResponse($exception, $statusCode, $request);
            }

            // Render HTML for web requests
            $config = $this->configResolver->resolve($statusCode);
            $defaultTemplate = config('oops-ui.settings.default_template', 'layout');
            $template = $this->templateSelector->select($config, $statusCode, $defaultTemplate);
            
            Log::debug('OopsUI: Template selection', [
                'status_code' => $statusCode,
                'default_template' => $defaultTemplate,
                'selected_template' => $template,
                'config_has_template' => isset($config['template']),
            ]);
            
            // If template is 'default', skip package rendering and use Laravel's default
            if ($template === 'default') {
                Log::debug('OopsUI: Using Laravel default template');
                return null;
            }
            
            // Template is now either:
            // - A package template name (e.g., 'modern', 'layout')
            // - A custom template path (e.g., 'errors.404')
            // The layout wrapper will handle the rendering
            
            $viewData = $this->prepareViewData($statusCode, $config, $exception);

            // Check if user wants to wrap error in their app layout
            // Both app_layout AND app_layout_section must be set (not null) and valid
            $appLayout = config('oops-ui.settings.app_layout');
            $appLayoutSection = config('oops-ui.settings.app_layout_section');
            
            $useAppLayout = false;
            
            // Only use app layout if BOTH are set (not null, not empty) AND layout is valid
            if ($appLayout !== null && $appLayout !== '' && 
                $appLayoutSection !== null && $appLayoutSection !== '') {
                // Both are set, now validate the layout file exists and is not empty
                if ($this->isLayoutValid($appLayout)) {
                    // Also check if the section exists in the layout
                    if ($this->isSectionValidInLayout($appLayout, $appLayoutSection)) {
                        $useAppLayout = true;
                        Log::debug('OopsUI: Using app layout', [
                            'layout' => $appLayout,
                            'section' => $appLayoutSection,
                        ]);
                    } else {
                        // Section doesn't exist in layout, use full HTML error page
                        Log::debug('OopsUI: Section not found in layout, using full HTML error page', [
                            'layout' => $appLayout,
                            'section' => $appLayoutSection,
                        ]);
                        $appLayout = null;
                        $appLayoutSection = null;
                    }
                } else {
                    // Layout is invalid, reset to null to use default package error page
                    Log::debug('OopsUI: App layout invalid, using full HTML error page', [
                        'layout' => $appLayout,
                    ]);
                    $appLayout = null;
                    $appLayoutSection = null;
                }
            } else {
                // One or both are null/empty, reset both to null to use default package error page
                Log::debug('OopsUI: App layout not configured, using full HTML error page', [
                    'app_layout' => $appLayout,
                    'app_layout_section' => $appLayoutSection,
                ]);
                $appLayout = null;
                $appLayoutSection = null;
            }

            // Use layout wrapper to manage HTML structure and template rendering
            $html = $this->viewFactory->make('oops-ui::_layout_wrapper', array_merge($viewData, [
                'contentOnly' => $useAppLayout,
                'appLayout' => $appLayout,
                'appLayoutSection' => $appLayoutSection,
                'template' => $template,
            ]))->render();

            return new Response($html, $statusCode);
        } catch (Throwable $e) {
            Log::error('OopsUI: Failed to render error page', [
                'original_exception' => $exception->getMessage(),
                'render_exception' => $e->getMessage(),
                'status_code' => $statusCode ?? 500,
            ]);

            // Return null to let Laravel handle it
            return null;
        }
    }

    /**
     * Determine if the request is an API request.
     */
    private function isApiRequest(Request $request): bool
    {
        // Check configuration setting
        $apiErrorMode = config('oops-ui.api_error_mode', 'auto');
        
        // If mode is 'html', never return JSON (always HTML)
        if ($apiErrorMode === 'html') {
            return false;
        }
        
        // Get API base path from config
        $apiBasePath = config('oops-ui.api_base_path', null);
        
        // If api_base_path is null, use Laravel's default 'api' prefix
        if ($apiBasePath === null) {
            $apiBasePath = 'api';
        }
        
        // If api_base_path is empty string, match all routes
        if ($apiBasePath === '') {
            $isApiRoute = true;
        } else {
            // Check if request matches API base path
            $isApiRoute = $request->is($apiBasePath . '/*') || $request->is($apiBasePath);
        }
        
        // If not an API route, always return HTML
        if (!$isApiRoute) {
            return false;
        }
        
        // For API routes (both 'auto' and 'json' modes), check if request wants JSON
        // Check multiple indicators that this is a JSON API request
        $wantsJson = $request->expectsJson() 
            || $request->wantsJson()
            || $request->header('Accept') === 'application/json'
            || str_contains($request->header('Accept', ''), 'application/json')
            || $request->header('Content-Type') === 'application/json'
            || str_contains($request->header('Content-Type', ''), 'application/json');
        
        // DEBUG: Log for troubleshooting
        Log::debug('OopsUI API Detection', [
            'path' => $request->path(),
            'api_error_mode' => $apiErrorMode,
            'api_base_path' => $apiBasePath,
            'is_api_route' => $isApiRoute,
            'accept_header' => $request->header('Accept'),
            'content_type_header' => $request->header('Content-Type'),
            'expects_json' => $request->expectsJson(),
            'wants_json' => $request->wantsJson(),
            'wants_json_result' => $wantsJson,
            'will_return_json' => $wantsJson,
        ]);
        
        return $wantsJson;
    }

    /**
     * Render JSON response for API requests.
     */
    private function renderJsonResponse(Throwable $exception, int $statusCode, Request $request): Response
    {
        $config = $this->configResolver->resolve($statusCode);
        $showDebug = config('oops-ui.show_debug', false);

        $data = [
            'error' => true,
            'status' => $statusCode,
            'title' => $config['title'] ?? 'Error',
            'message' => $config['message'] ?? 'An error occurred.',
        ];

        // Add validation errors for 422 responses
        if ($statusCode === 422 && method_exists($exception, 'errors')) {
            $data['errors'] = $exception->errors();
        } elseif ($statusCode === 422 && $request->session()->has('errors')) {
            $data['errors'] = $request->session()->get('errors')->toArray();
        }

        // Add debug information if enabled
        if ($showDebug && $exception) {
            $data['debug'] = [
                'exception' => get_class($exception),
                'message' => $exception->getMessage(),
                'file' => $exception->getFile(),
                'line' => $exception->getLine(),
                'trace' => explode("\n", $exception->getTraceAsString()),
            ];
        }

        // Return as Response with JSON content
        return new Response(json_encode($data), $statusCode, [
            'Content-Type' => 'application/json',
        ]);
    }

    /**
     * Extract HTTP status code from exception.
     */
    private function extractStatusCode(Throwable $exception): int
    {
        if ($exception instanceof HttpExceptionInterface) {
            return $exception->getStatusCode();
        }

        return 500;
    }

    /**
     * Determine if status code should be handled.
     */
    private function shouldHandle(int $statusCode): bool
    {
        return $statusCode >= 400 && $statusCode < 600;
    }

    /**
     * Merge configuration, settings, and runtime data.
     */
    private function prepareViewData(int $statusCode, array $config, Throwable $exception): array
    {
        $showDebug = config('oops-ui.show_debug', false);
        $theme = config('oops-ui.settings.theme', 'light');
        $isDark = $theme === 'dark';

        return array_merge($config, [
            'statusCode' => $statusCode,
            'settings' => config('oops-ui.settings', []),
            'showDebug' => $showDebug,
            'exception' => $showDebug ? $exception : null,
            'isDark' => $isDark,
        ]);
    }

    /**
     * Check if layout file exists and is not empty.
     */
    private function isLayoutValid(string $layout): bool
    {
        try {
            // Check if view exists
            if (!$this->viewFactory->exists($layout)) {
                return false;
            }
            
            // Get the view path and check if file is not empty
            $viewPath = $this->viewFactory->getFinder()->find($layout);
            $content = file_get_contents($viewPath);
            
            return !empty(trim($content));
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * Check if the section exists in the layout file.
     */
    private function isSectionValidInLayout(string $layout, string $section): bool
    {
        try {
            // Get the layout file path
            $viewPath = $this->viewFactory->getFinder()->find($layout);
            $content = file_get_contents($viewPath);
            
            // Check if the layout contains @oopsError directive with the section name
            // or @yield directive with the section name
            $patterns = [
                "/@oopsError\s*\(\s*['\"]" . preg_quote($section, '/') . "['\"]\s*\)/",
                "/@yield\s*\(\s*['\"]" . preg_quote($section, '/') . "['\"]\s*\)/",
            ];
            
            foreach ($patterns as $pattern) {
                if (preg_match($pattern, $content)) {
                    return true;
                }
            }
            
            return false;
        } catch (\Exception $e) {
            return false;
        }
    }
}
