<?php

namespace Biplove\OopsUi;

use Illuminate\Http\Response;

class OopsUi
{
    protected ErrorRenderer $renderer;
    protected ConfigurationResolver $configResolver;
    protected TemplateSelector $templateSelector;

    public function __construct(
        ErrorRenderer $renderer,
        ConfigurationResolver $configResolver,
        TemplateSelector $templateSelector
    ) {
        $this->renderer       = $renderer;
        $this->configResolver = $configResolver;
        $this->templateSelector = $templateSelector;
    }

    /**
     * Render a full-page error Response (for controllers / routes).
     *
     *   return OopsUi::render(404);
     *   return OopsUi::render(500, ['template' => 'neon']);
     */
    public function render(int $statusCode, array $overrides = []): Response
    {
        $config   = $this->resolveConfig($statusCode, $overrides);
        $template = $this->resolveTemplate($config, $statusCode);
        $viewData = $this->prepareViewData($statusCode, $config);

        return new Response(view($template, $viewData)->render(), $statusCode);
    }

    // -------------------------------------------------------------------------

    private function resolveConfig(int $statusCode, array $overrides): array
    {
        $config = $this->configResolver->resolve($statusCode);
        return !empty($overrides) ? array_merge($config, $overrides) : $config;
    }

    private function resolveTemplate(array $config, int $statusCode): string
    {
        $default = config('oops-ui.settings.default_template', 'layout');
        return $this->templateSelector->select($config, $statusCode, $default);
    }

    private function prepareViewData(int $statusCode, array $config): array
    {
        return array_merge($config, [
            'statusCode'  => $statusCode,
            'settings'    => config('oops-ui.settings', []),
            'showDebug'   => config('oops-ui.show_debug', false),
            'exception'   => null,
            'contentOnly' => false,
        ]);
    }
}
