@php $isDark = ($settings['theme'] ?? 'light') === 'dark'; @endphp
@php $isAppLayout = $isAppLayout ?? false; @endphp
<style>
    .oops-minimal-card {
        {{ $isAppLayout ? 'width: 100%;' : 'max-width: 500px; width: 100%;' }}
        margin: 0 auto;
        background: {{ $isDark ? '#1a1a1a' : '#ffffff' }};
        border: 2px solid {{ $isDark ? '#404040' : '#e0e0e0' }};
        padding: 40px;
        font-family: 'Courier New', monospace;
    }
    .oops-minimal-code {
        font-size: 24px;
        font-weight: bold;
        margin: 0 0 20px;
        color: {{ $isDark ? '#ff6b6b' : '#e74c3c' }};
    }
    .oops-minimal-title {
        font-size: 28px;
        font-weight: bold;
        margin: 0 0 12px;
        text-transform: uppercase;
        letter-spacing: 2px;
        color: {{ $isDark ? '#f5f5f5' : '#1a1a1a' }};
    }
    .oops-minimal-message {
        font-size: 14px;
        line-height: 1.8;
        margin: 0 0 30px;
        color: {{ $isDark ? '#b0b0b0' : '#666666' }};
    }
    .oops-minimal-actions { 
        display: flex; 
        gap: 10px; 
        flex-wrap: wrap; 
    }
    .oops-minimal-btn {
        padding: 12px 24px;
        border: 2px solid {{ $isDark ? '#f5f5f5' : '#333333' }};
        background: transparent;
        color: {{ $isDark ? '#f5f5f5' : '#333333' }};
        text-decoration: none;
        font-weight: bold;
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: 1px;
        transition: all 0.3s;
        display: inline-block;
    }
    .oops-minimal-btn:hover {
        background: {{ $isDark ? '#f5f5f5' : '#333333' }};
        color: {{ $isDark ? '#1a1a1a' : '#fafafa' }};
    }
    @media (max-width: 640px) {
        .oops-minimal-card { padding: 30px 20px; }
        .oops-minimal-title { font-size: 22px; }
        .oops-minimal-actions { flex-direction: column; }
        .oops-minimal-btn { width: 100%; text-align: center; }
    }
    
    /* Footer Styles */
    .oops-minimal-footer {
        margin-top: 40px;
        padding-top: 30px;
        border-top: 2px solid {{ $isDark ? '#404040' : '#e0e0e0' }};
    }
    
    .oops-minimal-footer-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
        gap: 24px;
        margin-bottom: 24px;
    }
    
    .oops-minimal-footer-section {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }
    
    .oops-minimal-footer-title {
        font-weight: bold;
        font-size: 12px;
        letter-spacing: 2px;
        text-transform: uppercase;
        margin: 0 0 8px 0;
        color: {{ $isDark ? '#f5f5f5' : '#1a1a1a' }};
    }
    
    .oops-minimal-footer-menu {
        list-style: none;
        padding: 0;
        margin: 0;
        display: flex;
        flex-wrap: wrap;
        gap: 12px 18px;
    }
    
    .oops-minimal-footer-menu-item {
        margin: 0;
    }
    
    .oops-minimal-footer-link {
        color: {{ $isDark ? '#b0b0b0' : '#666666' }};
        text-decoration: none;
        font-size: 12px;
        transition: all 0.3s ease;
        text-transform: uppercase;
        letter-spacing: 1px;
    }
    
    .oops-minimal-footer-link:hover {
        color: {{ $isDark ? '#f5f5f5' : '#333333' }};
        text-decoration: underline;
    }
    
    .oops-minimal-footer-social {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
    }
    
    .oops-minimal-footer-social-link {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 32px;
        height: 32px;
        border: 2px solid {{ $isDark ? '#f5f5f5' : '#333333' }};
        background: transparent;
        color: {{ $isDark ? '#f5f5f5' : '#333333' }};
        text-decoration: none;
        font-size: 11px;
        font-weight: bold;
        transition: all 0.3s ease;
    }
    
    .oops-minimal-footer-social-link:hover {
        background: {{ $isDark ? '#f5f5f5' : '#333333' }};
        color: {{ $isDark ? '#1a1a1a' : '#fafafa' }};
    }
    
    .oops-minimal-footer-contact {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }
    
    .oops-minimal-footer-contact-item {
        display: flex;
        flex-direction: column;
        gap: 3px;
        font-size: 12px;
    }
    
    .oops-minimal-footer-contact-label {
        font-weight: bold;
        font-size: 10px;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: {{ $isDark ? '#f5f5f5' : '#1a1a1a' }};
    }
    
    .oops-minimal-footer-contact-value {
        color: {{ $isDark ? '#b0b0b0' : '#666666' }};
    }
    
    .oops-minimal-footer-contact-link {
        color: {{ $isDark ? '#b0b0b0' : '#666666' }};
        text-decoration: none;
        transition: all 0.3s ease;
    }
    
    .oops-minimal-footer-contact-link:hover {
        color: {{ $isDark ? '#f5f5f5' : '#333333' }};
        text-decoration: underline;
    }
    
    .oops-minimal-footer-custom {
        color: {{ $isDark ? '#b0b0b0' : '#666666' }};
        font-size: 12px;
        line-height: 1.8;
    }
    
    .oops-minimal-footer-copyright {
        padding-top: 20px;
        border-top: 1px solid {{ $isDark ? '#404040' : '#e0e0e0' }};
        text-align: center;
    }
    
    .oops-minimal-footer-copyright-text {
        margin: 0;
        color: {{ $isDark ? '#909090' : '#999999' }};
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: 1px;
    }
    
    @media (max-width: 640px) {
        .oops-minimal-footer {
            margin-top: 30px;
            padding-top: 20px;
        }
        
        .oops-minimal-footer-grid {
            grid-template-columns: 1fr;
            gap: 20px;
        }
    }
</style>

<div class="oops-minimal-card">
    <div class="oops-minimal-code">ERROR {{ $statusCode ?? 500 }}</div>
    <h1 class="oops-minimal-title">{{ $title ?? 'Error' }}</h1>
    <p class="oops-minimal-message">{{ $message ?? 'An error occurred.' }}</p>
    
    @if(isset($buttons) && count($buttons) > 0)
    <div class="oops-minimal-actions">
        @foreach($buttons as $button)
        @php
            $url = $button['url'] ?? '/';
            if ($url === 'current' || $url === 'retry') $url = url()->current();
            elseif ($url === 'back') $url = url()->previous();
        @endphp
        <a class="oops-minimal-btn" href="{{ $url }}">{{ $button['text'] ?? 'Go Back' }}</a>
        @endforeach
    </div>
    @else
    <div class="oops-minimal-actions">
        <a class="oops-minimal-btn" href="{{ url('/') }}">Back to home</a>
        <a class="oops-minimal-btn" href="{{ url()->current() }}">Retry</a>
    </div>
    @endif
    
    @include('oops-ui::partials.footer')
</div>
