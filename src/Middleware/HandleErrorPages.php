<?php

namespace Biplove\OopsUi\Middleware;

use Biplove\OopsUi\ErrorRenderer;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

class HandleErrorPages
{
    protected ErrorRenderer $renderer;

    public function __construct(ErrorRenderer $renderer)
    {
        $this->renderer = $renderer;
    }

    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        // Only handle error responses
        if ($response->isSuccessful() || $response->isRedirection()) {
            return $response;
        }

        $statusCode = $response->getStatusCode();

        // Only handle 4xx and 5xx errors
        if ($statusCode < 400 || $statusCode >= 600) {
            return $response;
        }

        // Don't override if debug mode is on
        if (config('app.debug', false)) {
            return $response;
        }

        // Create a mock exception for the renderer
        $exception = new \Symfony\Component\HttpKernel\Exception\HttpException(
            $statusCode,
            $response->getContent()
        );

        // Try to render custom error page
        try {
            $customResponse = $this->renderer->render($exception, $request);
            return $customResponse ?? $response;
        } catch (\Throwable $e) {
            // If rendering fails, return original response
            return $response;
        }
    }
}
