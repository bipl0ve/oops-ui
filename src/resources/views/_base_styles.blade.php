@php
    $theme = $settings['theme'] ?? 'light';
    $isDark = $theme === 'dark';
    $template = $template ?? 'layout';
    $skipBodyStyles = $skipBodyStyles ?? false; // Skip body styles when using app_layout
    
    // Define scoped CSS class for template-specific variables
    $scopedClass = '.oops-' . $template . '-wrap, .oops-' . $template . '-card, .oops-' . $template . '-page, .oops-' . $template . '-container';
@endphp
<style>
    @if(!$skipBodyStyles)
    * {
        box-sizing: border-box;
    }
    
    body {
        margin: 0;
        min-height: 100vh;
        display: grid;
        place-items: center;
        padding: 28px;
        font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
        color: @if($isDark) #f1f5f9 @else #0f172a @endif;
        background: @if($isDark) radial-gradient(circle at 20% 10%, #1e293b 0%, #0f172a 45%) @else radial-gradient(circle at 20% 10%, #dbeafe 0%, #f8fafc 45%) @endif;
    }
    
    @if($template === 'glass')
    /* Glass Template Body Effects */
    body::before {
        content: '';
        position: fixed;
        width: 400px;
        height: 400px;
        background: rgba(102, 126, 234, 0.2);
        border-radius: 50%;
        top: -200px;
        right: -200px;
        filter: blur(80px);
        z-index: -1;
    }
    
    body::after {
        content: '';
        position: fixed;
        width: 300px;
        height: 300px;
        background: rgba(118, 75, 162, 0.15);
        border-radius: 50%;
        bottom: -150px;
        left: -150px;
        filter: blur(80px);
        z-index: -1;
    }
    @endif
    @endif
    
    /* Scoped CSS Variables for Template Area Only */
    {{ $scopedClass }} {
        --bg: @if($isDark) #0f172a @else #f8fafc @endif;
        --card: @if($isDark) #1e293b @else #ffffff @endif;
        --text: @if($isDark) #f1f5f9 @else #0f172a @endif;
        --muted: @if($isDark) #cbd5e1 @else #475569 @endif;
        --line: @if($isDark) #334155 @else #e2e8f0 @endif;
        --accent: @if($isDark) #14b8a6 @else #0f766e @endif;
        --accent-soft: @if($isDark) #134e4a @else #ccfbf1 @endif;
    }
    
    /* App Layout Container - Ensures content stays within bounds */
    .oops-ui-app-layout-container {
        width: 100%;
        max-width: 100%;
        margin: 0;
        padding: 0;
        overflow: hidden;
        box-sizing: border-box;
    }
    
    .oops-ui-app-layout-container * {
        box-sizing: border-box;
    }
</style>
