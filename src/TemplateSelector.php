<?php

namespace Biplove\OopsUi;

use Illuminate\View\Factory as ViewFactory;

class TemplateSelector
{
    protected ViewFactory $viewFactory;

    public function __construct(ViewFactory $viewFactory)
    {
        $this->viewFactory = $viewFactory;
    }

    /**
     * Select template from configuration with validation.
     * Returns template name for package templates (e.g., 'modern', 'layout')
     * or full path for custom templates (e.g., 'errors.404', 'default')
     */
    public function select(array $config, int $statusCode, ?string $defaultTemplate = null): string
    {
        // PRIORITY 1: Check if user specified a custom page path in 'error_pages' array
        $errorPages = config('oops-ui.error_pages', []);
        
        if (array_key_exists($statusCode, $errorPages)) {
            $customPage = $errorPages[$statusCode];
            
            // If page is 'default', check for Laravel's default error views
            if ($customPage === 'default') {
                // Check if user has errors/{statusCode}.blade.php in their app
                $laravelErrorView = "errors.{$statusCode}";
                
                if ($this->validateTemplate($laravelErrorView)) {
                    // File exists, check if it's not empty
                    if ($this->isTemplateNotEmpty($laravelErrorView)) {
                        // File exists and has content, use it (return full path for custom template)
                        return $laravelErrorView;
                    }
                    // File exists but is empty, fall through to package templates
                } else {
                    // File doesn't exist, return 'default' to use Laravel's built-in error page
                    return 'default';
                }
            }
            
            // Try to use the custom path (e.g., 'errors.my-custom-404')
            // Return full path for custom templates
            if ($this->validateTemplate($customPage) && $this->isTemplateNotEmpty($customPage)) {
                return $customPage;
            }
            // If custom path is invalid or empty, continue to package templates
        }

        // PRIORITY 2: Check for 'template' in per-error config
        if (isset($config['template'])) {
            $templateName = $this->extractTemplateName($config['template']);
            if ($this->validatePackageTemplate($templateName)) {
                return $templateName; // Return just the name (e.g., 'modern')
            }
        }

        // PRIORITY 3: Try default template from parameter or config
        if ($defaultTemplate === null) {
            $defaultTemplate = config('oops-ui.settings.default_template', 'layout');
        }
        
        $templateName = $this->extractTemplateName($defaultTemplate);
        if ($this->validatePackageTemplate($templateName)) {
            return $templateName; // Return just the name (e.g., 'layout')
        }

        // PRIORITY 4: Final fallback to layout
        return 'layout';
    }

    /**
     * Extract template name from full path or return as is.
     * 'oops-ui::errors.templates.modern' -> 'modern'
     * 'modern' -> 'modern'
     */
    private function extractTemplateName(string $template): string
    {
        // If it's a full package path, extract the template name
        if (str_contains($template, '::')) {
            return last(explode('.', $template));
        }

        // Already a short name
        return $template;
    }

    /**
     * Validate that a package template exists.
     */
    private function validatePackageTemplate(string $templateName): bool
    {
        $fullPath = "oops-ui::errors.templates.{$templateName}";
        return $this->viewFactory->exists($fullPath);
    }

    /**
     * Verify template exists in package views.
     */
    private function validateTemplate(string $template): bool
    {
        return $this->viewFactory->exists($template);
    }

    /**
     * Check if template file is not empty.
     */
    private function isTemplateNotEmpty(string $template): bool
    {
        try {
            // Get the view path
            $viewPath = $this->viewFactory->getFinder()->find($template);
            
            // Read file content and check if it's not empty (ignoring whitespace)
            $content = file_get_contents($viewPath);
            
            return !empty(trim($content));
        } catch (\Exception $e) {
            // If we can't read the file, consider it empty
            return false;
        }
    }
}
