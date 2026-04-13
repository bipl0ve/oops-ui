<?php

namespace Biplove\OopsUi;

use Illuminate\Contracts\Config\Repository;

class ConfigurationResolver
{
    protected Repository $config;

    public function __construct(Repository $config)
    {
        $this->config = $config;
    }

    /**
     * Resolve error configuration with three-tier fallback strategy.
     */
    public function resolve(int $statusCode): array
    {
        // Get built-in default for this error code
        $builtInDefault = $this->getBuiltInDefault($statusCode);
        
        // If no built-in default, try built-in range default
        if ($builtInDefault === null) {
            $builtInDefault = $this->getBuiltInRangeDefault($statusCode);
        }
        
        // If still no default, use generic config
        if ($builtInDefault === null) {
            $builtInDefault = $this->getGenericConfig();
        }
        
        // Try to get user's custom configuration
        $userConfig = $this->getSpecificConfig($statusCode);
        
        // If no user config for specific code, try range config
        if ($userConfig === null) {
            $userConfig = $this->getRangeConfig($statusCode);
        }
        
        // Merge user config with built-in defaults (user config takes precedence)
        $finalConfig = $this->mergeConfigs($builtInDefault, $userConfig ?? []);
        
        return $this->resolveTranslations($finalConfig);
    }
    
    /**
     * Merge user configuration with built-in defaults.
     * User values override defaults, but missing fields use defaults.
     */
    private function mergeConfigs(array $defaults, array $userConfig): array
    {
        // Start with defaults
        $merged = $defaults;
        
        // Override with user values
        foreach ($userConfig as $key => $value) {
            if (is_array($value) && isset($merged[$key]) && is_array($merged[$key])) {
                // For arrays (like buttons, image), if user provides it, use it completely
                // Don't merge array contents, replace entirely
                $merged[$key] = $value;
            } else {
                // For scalar values, just override
                $merged[$key] = $value;
            }
        }
        
        return $merged;
    }

    /**
     * Get configuration for specific error code.
     */
    private function getSpecificConfig(int $statusCode): ?array
    {
        $config = $this->config->get("oops-ui.errors.{$statusCode}");
        
        return is_array($config) ? $config : null;
    }

    /**
     * Get configuration for error code range (4xx or 5xx).
     */
    private function getRangeConfig(int $statusCode): ?array
    {
        $range = (int) floor($statusCode / 100);
        $config = $this->config->get("oops-ui.errors.{$range}xx");
        
        return is_array($config) ? $config : null;
    }

    /**
     * Get generic fallback configuration.
     */
    private function getGenericConfig(): array
    {
        return [
            'title' => 'Error Occurred',
            'message' => 'An unexpected error occurred.',
            'buttons' => [
                [
                    'text' => 'Back to Home',
                    'url' => '/',
                    'style' => 'primary',
                ],
            ],
        ];
    }

    /**
     * Get built-in default configuration for specific error codes.
     */
    private function getBuiltInDefault(int $statusCode): ?array
    {
        $defaults = [
            404 => [
                'title' => 'Page Not Found',
                'message' => 'The page you are looking for does not exist or has been moved.',
                'buttons' => [
                    ['text' => 'Back to Home', 'url' => '/', 'style' => 'primary'],
                    ['text' => 'Retry', 'url' => 'retry', 'style' => 'secondary'],
                ],
            ],
            500 => [
                'title' => 'Server Error',
                'message' => 'Something went wrong on our end. Please try again later.',
                'buttons' => [
                    ['text' => 'Retry', 'url' => 'retry', 'style' => 'primary'],
                    ['text' => 'Back to Home', 'url' => '/', 'style' => 'secondary'],
                ],
            ],
            401 => [
                'title' => 'Unauthorized',
                'message' => 'You need to be authenticated to access this resource.',
                'buttons' => [
                    ['text' => 'Login', 'url' => '/login', 'style' => 'primary'],
                ],
            ],
            403 => [
                'title' => 'Forbidden',
                'message' => 'You do not have permission to access this resource.',
                'buttons' => [
                    ['text' => 'Back to Home', 'url' => '/', 'style' => 'primary'],
                ],
            ],
            419 => [
                'title' => 'Page Expired',
                'message' => 'Your session has expired. Please refresh the page and try again.',
                'buttons' => [
                    ['text' => 'Refresh Page', 'url' => 'retry', 'style' => 'primary'],
                ],
            ],
            422 => [
                'title' => 'Unprocessable Entity',
                'message' => 'The request was well-formed but contains invalid data.',
                'buttons' => [
                    ['text' => 'Go Back', 'url' => 'back', 'style' => 'primary'],
                ],
            ],
            429 => [
                'title' => 'Too Many Requests',
                'message' => 'You have made too many requests. Please slow down and try again later.',
                'buttons' => [
                    ['text' => 'Back to Home', 'url' => '/', 'style' => 'primary'],
                ],
            ],
            503 => [
                'title' => 'Service Unavailable',
                'message' => 'The service is temporarily unavailable. Please try again later.',
                'buttons' => [
                    ['text' => 'Retry', 'url' => 'retry', 'style' => 'primary'],
                ],
            ],
        ];

        return $defaults[$statusCode] ?? null;
    }

    /**
     * Get built-in range-based default configuration.
     */
    private function getBuiltInRangeDefault(int $statusCode): ?array
    {
        $range = (int) floor($statusCode / 100);
        
        $defaults = [
            4 => [
                'title' => 'Request Error',
                'message' => 'There was a problem with your request.',
                'buttons' => [
                    ['text' => 'Back to Home', 'url' => '/', 'style' => 'primary'],
                ],
            ],
            5 => [
                'title' => 'Server Error',
                'message' => 'An unexpected error occurred. Please try again later.',
                'buttons' => [
                    ['text' => 'Retry', 'url' => 'retry', 'style' => 'primary'],
                    ['text' => 'Back to Home', 'url' => '/', 'style' => 'secondary'],
                ],
            ],
        ];

        return $defaults[$range] ?? null;
    }

    /**
     * Resolve Laravel translation keys in configuration.
     */
    private function resolveTranslations(array $config): array
    {
        if (isset($config['title']) && is_string($config['title'])) {
            $config['title'] = trans($config['title']);
        }

        if (isset($config['message']) && is_string($config['message'])) {
            $config['message'] = trans($config['message']);
        }

        return $config;
    }
}
