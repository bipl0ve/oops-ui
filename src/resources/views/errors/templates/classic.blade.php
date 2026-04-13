@php $isDark = ($settings['theme'] ?? 'light') === 'dark'; @endphp
@php $isAppLayout = $isAppLayout ?? false; @endphp
<style>
    .oops-classic-card {
        {{ $isAppLayout ? 'width: 100%;' : 'max-width: 600px; width: 100%;' }}
        margin: 0 auto;
        background: {{ $isDark ? '#2d2d2d' : '#ffffff' }};
        border: 1px solid {{ $isDark ? '#404040' : '#e5e7eb' }};
        border-radius: 8px;
        padding: 60px 50px;
        box-shadow: {{ $isDark ? '0 1px 3px rgba(0,0,0,0.3)' : '0 1px 3px rgba(0,0,0,0.1)' }};
        font-family: Georgia, 'Times New Roman', serif;
    }
    .oops-classic-header {
        border-bottom: 2px solid {{ $isDark ? '#404040' : '#e5e7eb' }};
        padding-bottom: 20px;
        margin-bottom: 30px;
    }
    .oops-classic-code {
        font-size: 18px;
        font-weight: 600;
        color: {{ $isDark ? '#f87171' : '#dc2626' }};
        margin: 0 0 8px;
        text-transform: uppercase;
        letter-spacing: 1px;
    }
    .oops-classic-title {
        font-size: 32px;
        font-weight: 600;
        color: {{ $isDark ? '#f5f5f5' : '#111827' }};
        line-height: 1.3;
        margin: 0;
    }
    .oops-classic-message {
        font-size: 17px;
        line-height: 1.8;
        color: {{ $isDark ? '#c0c0c0' : '#6b7280' }};
        margin: 0 0 36px;
    }
    .oops-classic-actions { display: flex; gap: 12px; flex-wrap: wrap; }
    .oops-classic-btn {
        padding: 12px 28px;
        border-radius: 6px;
        text-decoration: none;
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
        font-weight: 500;
        font-size: 15px;
        transition: all 0.2s;
        display: inline-block;
        border: 1px solid transparent;
    }
    .oops-classic-btn-primary {
        background: {{ $isDark ? '#3b82f6' : '#2563eb' }};
        color: white;
    }
    .oops-classic-btn-primary:hover { background: {{ $isDark ? '#2563eb' : '#1d4ed8' }}; }
    .oops-classic-btn-secondary {
        background: {{ $isDark ? '#404040' : '#f3f4f6' }};
        color: {{ $isDark ? '#f5f5f5' : '#374151' }};
        border-color: {{ $isDark ? '#505050' : '#d1d5db' }};
    }
    .oops-classic-btn-secondary:hover { background: {{ $isDark ? '#505050' : '#e5e7eb' }}; }
    @media (max-width: 640px) {
        .oops-classic-card { padding: 40px 30px; }
        .oops-classic-title { font-size: 26px; }
        .oops-classic-message { font-size: 16px; }
        .oops-classic-actions { flex-direction: column; }
        .oops-classic-btn { width: 100%; text-align: center; }
    }
    
    /* Footer Styles */
    .oops-classic-footer {
        margin-top: 48px;
        padding-top: 32px;
        border-top: 2px solid {{ $isDark ? '#404040' : '#e5e7eb' }};
        font-family: Georgia, 'Times New Roman', serif;
    }
    .oops-classic-footer-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 32px;
        margin-bottom: 24px;
    }
    .oops-classic-footer-section { }
    .oops-classic-footer-title {
        font-size: 16px;
        font-weight: 600;
        color: {{ $isDark ? '#f5f5f5' : '#111827' }};
        margin: 0 0 12px;
        text-transform: uppercase;
        letter-spacing: 1px;
    }
    .oops-classic-footer-menu {
        list-style: none;
        padding: 0;
        margin: 0;
        display: flex;
        flex-wrap: wrap;
        gap: 8px 16px;
    }
    .oops-classic-footer-menu-item { }
    .oops-classic-footer-link {
        color: {{ $isDark ? '#c0c0c0' : '#6b7280' }};
        text-decoration: none;
        font-size: 15px;
        transition: color 0.2s;
    }
    .oops-classic-footer-link:hover { color: {{ $isDark ? '#3b82f6' : '#2563eb' }}; }
    .oops-classic-footer-contact { }
    .oops-classic-footer-contact-item { margin-bottom: 8px; }
    .oops-classic-footer-contact-label {
        font-weight: 600;
        color: {{ $isDark ? '#f5f5f5' : '#374151' }};
        font-size: 14px;
        display: block;
        margin-bottom: 4px;
    }
    .oops-classic-footer-contact-link {
        color: {{ $isDark ? '#3b82f6' : '#2563eb' }};
        text-decoration: none;
        font-size: 15px;
    }
    .oops-classic-footer-contact-link:hover { text-decoration: underline; }
    .oops-classic-footer-contact-value {
        color: {{ $isDark ? '#c0c0c0' : '#6b7280' }};
        font-size: 15px;
    }
    .oops-classic-footer-social {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
    }
    .oops-classic-footer-social-link {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: {{ $isDark ? '#404040' : '#f3f4f6' }};
        color: {{ $isDark ? '#f5f5f5' : '#374151' }};
        display: flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        font-weight: 600;
        font-size: 14px;
        transition: all 0.2s;
        border: 1px solid {{ $isDark ? '#505050' : '#d1d5db' }};
    }
    .oops-classic-footer-social-link:hover {
        background: {{ $isDark ? '#3b82f6' : '#2563eb' }};
        color: white;
        border-color: {{ $isDark ? '#3b82f6' : '#2563eb' }};
    }
    .oops-classic-footer-custom {
        color: {{ $isDark ? '#c0c0c0' : '#6b7280' }};
        font-size: 15px;
        line-height: 1.6;
    }
    .oops-classic-footer-copyright {
        padding-top: 24px;
        border-top: 1px solid {{ $isDark ? '#404040' : '#e5e7eb' }};
        text-align: center;
    }
    .oops-classic-footer-copyright-text {
        color: {{ $isDark ? '#c0c0c0' : '#6b7280' }};
        font-size: 14px;
        margin: 0;
    }
    @media (max-width: 640px) {
        .oops-classic-footer-grid { grid-template-columns: 1fr; gap: 24px; }
    }
</style>

<div class="oops-classic-card">
    <div class="oops-classic-header">
        <div class="oops-classic-code">Error {{ $statusCode ?? 500 }}</div>
        <h1 class="oops-classic-title">{{ $title ?? 'An Error Occurred' }}</h1>
    </div>
    <p class="oops-classic-message">{{ $message ?? 'We apologize for the inconvenience. Please try again later.' }}</p>
    
    @if(isset($buttons) && count($buttons) > 0)
    <div class="oops-classic-actions">
        @foreach($buttons as $button)
        @php
            $url = $button['url'] ?? '/';
            if ($url === 'current' || $url === 'retry') $url = url()->current();
            elseif ($url === 'back') $url = url()->previous();
            $cls = ($button['style'] ?? 'primary') === 'secondary' ? 'oops-classic-btn oops-classic-btn-secondary' : 'oops-classic-btn oops-classic-btn-primary';
        @endphp
        <a class="{{ $cls }}" href="{{ $url }}">{{ $button['text'] ?? 'Go Back' }}</a>
        @endforeach
    </div>
    @else
    <div class="oops-classic-actions">
        <a class="oops-classic-btn oops-classic-btn-primary" href="{{ url('/') }}">Back to home</a>
        <a class="oops-classic-btn oops-classic-btn-secondary" href="{{ url()->current() }}">Retry</a>
    </div>
    @endif
    
    @include('oops-ui::partials.footer')
</div>
