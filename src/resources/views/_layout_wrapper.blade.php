@php
    $contentOnly = $contentOnly ?? false;
    $appLayout = $appLayout ?? null;
    $appLayoutSection = $appLayoutSection ?? null;
    $template = $template ?? 'layout';
    
    // Ensure template is not empty - fallback to layout
    if (empty($template) || !is_string($template)) {
        $template = 'layout';
    }
    
    // Debug: Log the template being used
    if (function_exists('logger')) {
        logger()->debug('OopsUI Layout Wrapper: Rendering template', [
            'template' => $template,
            'contentOnly' => $contentOnly,
        ]);
    }
@endphp

@if(!$contentOnly)
{{-- Render full HTML structure with error template --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Error' }}</title>
    @include('oops-ui::_base_styles')
</head>
<body>
    @include('oops-ui::errors.templates.' . $template)
</body>
</html>
@else
{{-- Render with app layout - create a temporary view that extends the layout --}}
@php
    try {
        // Create a temporary Blade view content that extends the user's layout
        $tempViewContent = <<<BLADE
@extends('{$appLayout}')

@section('{$appLayoutSection}')
@include('oops-ui::_base_styles', ['skipBodyStyles' => true])
<div class="oops-ui-app-layout-container" style="width: 100%; margin: 0; padding: 0;">
@include('oops-ui::errors.templates.{$template}')
</div>
@endsection
BLADE;

        // Create a temporary view file
        $tempViewPath = storage_path('framework/views/oops-ui-temp-' . md5($appLayout . $appLayoutSection . $template) . '.blade.php');
        
        // Ensure directory exists
        if (!file_exists(dirname($tempViewPath))) {
            mkdir(dirname($tempViewPath), 0755, true);
        }
        
        // Write the temporary view
        file_put_contents($tempViewPath, $tempViewContent);
        
        // Render the temporary view with all variables
        $html = view()->file($tempViewPath, get_defined_vars())->render();
        echo $html;
        
        // Clean up the temporary file
        if (file_exists($tempViewPath)) {
            @unlink($tempViewPath);
        }
    } catch (\Throwable $e) {
        // If app layout rendering fails, fall back to full HTML error page
        // Clean up temp file if it exists
        if (isset($tempViewPath) && file_exists($tempViewPath)) {
            @unlink($tempViewPath);
        }
        
        // Log the error
        if (function_exists('logger')) {
            logger()->error('OopsUI: Failed to render with app layout, falling back to full HTML', [
                'error' => $e->getMessage(),
                'layout' => $appLayout,
                'section' => $appLayoutSection,
            ]);
        }
        
        // Render full HTML error page as fallback
        echo '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>' . e($title ?? 'Error') . '</title>';
        echo view('oops-ui::_base_styles')->render();
        echo '</head>
<body>';
        echo view('oops-ui::errors.templates.' . $template, get_defined_vars())->render();
        echo '</body>
</html>';
    }
@endphp
@endif
