@php $isDark = ($settings['theme'] ?? 'light') === 'dark'; @endphp
<style>
    /* Glass Template Specific Styles */
    .oops-glass-wrap {
        width: 100%;
        text-align: center;
    }
    
    .oops-glass-card {
        background: {{ $isDark ? 'rgba(30, 41, 59, 0.4)' : 'rgba(255, 255, 255, 0.1)' }};
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border-radius: 24px;
        border: 1px solid {{ $isDark ? 'rgba(255, 255, 255, 0.1)' : 'rgba(255, 255, 255, 0.2)' }};
        padding: 60px 40px;
        box-shadow: 0 8px 32px {{ $isDark ? 'rgba(0, 0, 0, 0.3)' : 'rgba(0, 0, 0, 0.1)' }};
    }
    
    .oops-glass-code {
        font-size: 120px;
        font-weight: 900;
        line-height: 1;
        color: {{ $isDark ? '#f1f5f9' : '#0f172a' }};
        margin: 0 0 20px;
        text-shadow: 0 4px 20px {{ $isDark ? 'rgba(255, 255, 255, 0.1)' : 'rgba(0, 0, 0, 0.1)' }};
    }
    
    .oops-glass-title {
        font-size: 32px;
        font-weight: 700;
        margin: 0 0 16px;
        color: {{ $isDark ? '#f1f5f9' : '#0f172a' }};
    }
    
    .oops-glass-message {
        font-size: 18px;
        color: {{ $isDark ? '#cbd5e1' : '#475569' }};
        margin: 0 0 32px;
        line-height: 1.6;
    }
    
    .oops-glass-actions {
        display: flex;
        gap: 12px;
        justify-content: center;
        flex-wrap: wrap;
    }
    
    .oops-glass-btn {
        padding: 14px 32px;
        border-radius: 12px;
        text-decoration: none;
        font-weight: 600;
        font-size: 16px;
        transition: all 0.3s;
        display: inline-block;
        backdrop-filter: blur(10px);
    }
    
    .oops-glass-btn-primary {
        background: {{ $isDark ? 'rgba(20, 184, 166, 0.2)' : 'rgba(15, 118, 110, 0.2)' }};
        color: {{ $isDark ? '#14b8a6' : '#0f766e' }};
        border: 1px solid {{ $isDark ? '#14b8a6' : '#0f766e' }};
    }
    
    .oops-glass-btn-primary:hover {
        background: {{ $isDark ? '#14b8a6' : '#0f766e' }};
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 8px 20px {{ $isDark ? 'rgba(20, 184, 166, 0.3)' : 'rgba(15, 118, 110, 0.3)' }};
    }
    
    .oops-glass-btn-secondary {
        background: {{ $isDark ? 'rgba(51, 65, 85, 0.3)' : 'rgba(255, 255, 255, 0.1)' }};
        color: {{ $isDark ? '#f1f5f9' : '#0f172a' }};
        border: 1px solid {{ $isDark ? '#334155' : '#e2e8f0' }};
    }
    
    .oops-glass-btn-secondary:hover {
        background: {{ $isDark ? 'rgba(51, 65, 85, 0.5)' : 'rgba(255, 255, 255, 0.2)' }};
    }
    
    @media (max-width: 640px) {
        .oops-glass-card { padding: 40px 24px; }
        .oops-glass-code { font-size: 80px; }
        .oops-glass-title { font-size: 24px; }
        .oops-glass-message { font-size: 16px; }
        .oops-glass-actions { flex-direction: column; }
        .oops-glass-btn { width: 100%; }
    }
    
    /* Footer Styles */
    .oops-glass-footer {
        margin-top: 48px;
        padding-top: 32px;
        border-top: 1px solid {{ $isDark ? 'rgba(255, 255, 255, 0.1)' : 'rgba(255, 255, 255, 0.2)' }};
        backdrop-filter: blur(10px);
    }
    .oops-glass-footer-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 32px;
        margin-bottom: 24px;
    }
    .oops-glass-footer-section { }
    .oops-glass-footer-title {
        font-size: 16px;
        font-weight: 700;
        color: {{ $isDark ? '#f1f5f9' : '#0f172a' }};
        margin: 0 0 12px;
    }
    .oops-glass-footer-menu {
        list-style: none;
        padding: 0;
        margin: 0;
        display: flex;
        flex-wrap: wrap;
        gap: 8px 16px;
    }
    .oops-glass-footer-menu-item { }
    .oops-glass-footer-link {
        color: {{ $isDark ? '#cbd5e1' : '#475569' }};
        text-decoration: none;
        font-size: 15px;
        transition: color 0.2s;
    }
    .oops-glass-footer-link:hover { color: {{ $isDark ? '#14b8a6' : '#0f766e' }}; }
    .oops-glass-footer-contact { }
    .oops-glass-footer-contact-item { margin-bottom: 8px; }
    .oops-glass-footer-contact-label {
        font-weight: 600;
        color: {{ $isDark ? '#f1f5f9' : '#0f172a' }};
        font-size: 14px;
        display: block;
        margin-bottom: 4px;
    }
    .oops-glass-footer-contact-link {
        color: {{ $isDark ? '#14b8a6' : '#0f766e' }};
        text-decoration: none;
        font-size: 15px;
    }
    .oops-glass-footer-contact-link:hover { text-decoration: underline; }
    .oops-glass-footer-contact-value {
        color: {{ $isDark ? '#cbd5e1' : '#475569' }};
        font-size: 15px;
    }
    .oops-glass-footer-social {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
    }
    .oops-glass-footer-social-link {
        width: 44px;
        height: 44px;
        border-radius: 50%;
        background: {{ $isDark ? 'rgba(20, 184, 166, 0.2)' : 'rgba(15, 118, 110, 0.2)' }};
        color: {{ $isDark ? '#14b8a6' : '#0f766e' }};
        border: 1px solid {{ $isDark ? '#14b8a6' : '#0f766e' }};
        display: flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        font-weight: 600;
        font-size: 16px;
        transition: all 0.3s;
        backdrop-filter: blur(10px);
    }
    .oops-glass-footer-social-link:hover {
        background: {{ $isDark ? '#14b8a6' : '#0f766e' }};
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 8px 20px {{ $isDark ? 'rgba(20, 184, 166, 0.3)' : 'rgba(15, 118, 110, 0.3)' }};
    }
    .oops-glass-footer-custom {
        color: {{ $isDark ? '#cbd5e1' : '#475569' }};
        font-size: 15px;
        line-height: 1.6;
    }
    .oops-glass-footer-copyright {
        padding-top: 24px;
        border-top: 1px solid {{ $isDark ? 'rgba(255, 255, 255, 0.1)' : 'rgba(255, 255, 255, 0.2)' }};
        text-align: center;
    }
    .oops-glass-footer-copyright-text {
        color: {{ $isDark ? '#cbd5e1' : '#475569' }};
        font-size: 14px;
        margin: 0;
    }
    @media (max-width: 640px) {
        .oops-glass-footer-grid { grid-template-columns: 1fr; gap: 24px; }
    }
</style>

<div class="oops-glass-wrap">
    <div class="oops-glass-card">
        <div class="oops-glass-code">{{ $statusCode ?? 500 }}</div>
        <h1 class="oops-glass-title">{{ $title ?? 'Something went wrong' }}</h1>
        <p class="oops-glass-message">{{ $message ?? 'Please try again later.' }}</p>
        @if(isset($buttons) && count($buttons) > 0)
        <div class="oops-glass-actions">
            @foreach($buttons as $button)
            @php
                $url = $button['url'] ?? '/';
                if ($url === 'current' || $url === 'retry') $url = url()->current();
                elseif ($url === 'back') $url = url()->previous();
                $cls = ($button['style'] ?? 'primary') === 'secondary' ? 'oops-glass-btn oops-glass-btn-secondary' : 'oops-glass-btn oops-glass-btn-primary';
            @endphp
            <a class="{{ $cls }}" href="{{ $url }}">{{ $button['text'] ?? 'Go Back' }}</a>
            @endforeach
        </div>
        @else
        <div class="oops-glass-actions">
            <a class="oops-glass-btn oops-glass-btn-primary" href="{{ url('/') }}">Back to home</a>
            <a class="oops-glass-btn oops-glass-btn-secondary" href="{{ url()->current() }}">Retry</a>
        </div>
        @endif
        
        @include('oops-ui::partials.footer')
    </div>
</div>
