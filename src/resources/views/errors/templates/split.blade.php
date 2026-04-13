@php $isDark = ($settings['theme'] ?? 'light') === 'dark'; @endphp
@php $isAppLayout = $isAppLayout ?? false; @endphp
<style>
    /* Split Template Specific Styles */
    @if(!$isAppLayout)
    body {
        display: flex !important;
        padding: 0 !important;
        min-height: 100vh;
    }
    @endif
    
    .oops-split-container {
        display: flex;
        width: 100%;
        @if(!$isAppLayout)
        min-height: 100vh;
        @endif
    }
    
    .oops-split-left {
        flex: 1;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 40px;
        position: relative;
        overflow: hidden;
        @if(!$isAppLayout)
        position: sticky;
        top: 0;
        height: 100vh;
        @endif
    }
    
    .oops-split-left::before {
        content: '';
        position: absolute;
        width: 300px; 
        height: 300px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        top: -100px; 
        right: -100px;
    }
    
    .oops-split-left::after {
        content: '';
        position: absolute;
        width: 200px; 
        height: 200px;
        background: rgba(255, 255, 255, 0.08);
        border-radius: 50%;
        bottom: -50px; 
        left: -50px;
    }
    
    .oops-split-code {
        font-size: 180px;
        font-weight: 900;
        color: white;
        line-height: 1;
        text-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
        position: relative;
        z-index: 1;
    }
    
    .oops-split-right {
        flex: 1;
        background: {{ $isDark ? '#1e293b' : '#ffffff' }};
        display: flex;
        align-items: flex-start;
        justify-content: center;
        padding: 60px;
        color: {{ $isDark ? '#f1f5f9' : '#0f172a' }};
        @if(!$isAppLayout)
        overflow-y: auto;
        min-height: 100vh;
        @else
        width: 100%;
        @endif
    }
    
    .oops-split-content { 
        max-width: 500px; 
        width: 100%;
        padding: 40px 0;
    }
    
    .oops-split-badge {
        display: inline-block;
        padding: 8px 16px;
        background: {{ $isDark ? '#134e4a' : '#ccfbf1' }};
        color: {{ $isDark ? '#14b8a6' : '#0f766e' }};
        border-radius: 20px;
        font-size: 14px;
        font-weight: 600;
        margin-bottom: 24px;
        text-transform: uppercase;
        letter-spacing: 1px;
    }
    
    .oops-split-title {
        font-size: 42px;
        font-weight: 800;
        margin: 0 0 16px;
        line-height: 1.2;
        color: {{ $isDark ? '#f1f5f9' : '#0f172a' }};
    }
    
    .oops-split-divider {
        width: 60px; 
        height: 4px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        margin-bottom: 32px;
        border-radius: 2px;
    }
    
    .oops-split-message {
        font-size: 18px;
        color: {{ $isDark ? '#cbd5e1' : '#475569' }};
        margin: 0 0 32px;
        line-height: 1.7;
    }
    
    .oops-split-actions { 
        display: flex; 
        gap: 12px; 
        flex-wrap: wrap; 
    }
    
    .oops-split-btn {
        padding: 16px 32px;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 600;
        font-size: 16px;
        transition: all 0.3s;
        display: inline-block;
    }
    
    .oops-split-btn-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
    }
    
    .oops-split-btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(102, 126, 234, 0.4);
    }
    
    .oops-split-btn-secondary {
        background: {{ $isDark ? '#1e293b' : '#ffffff' }};
        color: {{ $isDark ? '#f1f5f9' : '#0f172a' }};
        border: 2px solid {{ $isDark ? '#334155' : '#e2e8f0' }};
    }
    
    .oops-split-btn-secondary:hover {
        background: {{ $isDark ? '#134e4a' : '#ccfbf1' }};
        transform: translateY(-2px);
    }
    
    @media (max-width: 968px) {
        .oops-split-container { 
            flex-direction: column; 
        }
        .oops-split-left { 
            min-height: 40vh;
            height: auto;
            position: relative;
            padding: 40px 20px; 
        }
        .oops-split-code { 
            font-size: 120px; 
        }
        .oops-split-right { 
            padding: 40px 20px;
            min-height: auto;
        }
        .oops-split-content {
            padding: 20px 0;
        }
        .oops-split-title { 
            font-size: 32px; 
        }
        .oops-split-message { 
            font-size: 16px; 
        }
        .oops-split-actions { 
            flex-direction: column; 
        }
        .oops-split-btn { 
            width: 100%; 
            text-align: center; 
        }
    }
    
    @media (max-width: 640px) {
        .oops-split-code { 
            font-size: 80px; 
        }
        .oops-split-title { 
            font-size: 28px; 
        }
    }
    
    /* Footer Styles */
    .oops-split-footer {
        margin-top: 60px;
        padding-top: 40px;
        border-top: 2px solid {{ $isDark ? '#334155' : '#e2e8f0' }};
    }
    .oops-split-footer-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 32px;
        margin-bottom: 24px;
        text-align: left;
    }
    .oops-split-footer-section { }
    .oops-split-footer-title {
        font-size: 16px;
        font-weight: 700;
        color: {{ $isDark ? '#f1f5f9' : '#0f172a' }};
        margin: 0 0 12px;
        text-transform: uppercase;
        letter-spacing: 1px;
    }
    .oops-split-footer-menu {
        list-style: none;
        padding: 0;
        margin: 0;
        display: flex;
        flex-wrap: wrap;
        gap: 8px 16px;
    }
    .oops-split-footer-menu-item { }
    .oops-split-footer-link {
        color: {{ $isDark ? '#cbd5e1' : '#475569' }};
        text-decoration: none;
        font-size: 15px;
        font-weight: 500;
        transition: color 0.2s;
    }
    .oops-split-footer-link:hover { color: #667eea; }
    .oops-split-footer-contact { }
    .oops-split-footer-contact-item { margin-bottom: 8px; }
    .oops-split-footer-contact-label {
        font-weight: 700;
        color: {{ $isDark ? '#f1f5f9' : '#0f172a' }};
        font-size: 14px;
        display: block;
        margin-bottom: 4px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .oops-split-footer-contact-link {
        color: #667eea;
        text-decoration: none;
        font-size: 15px;
        font-weight: 500;
    }
    .oops-split-footer-contact-link:hover { text-decoration: underline; }
    .oops-split-footer-contact-value {
        color: {{ $isDark ? '#cbd5e1' : '#475569' }};
        font-size: 15px;
    }
    .oops-split-footer-social {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
    }
    .oops-split-footer-social-link {
        width: 44px;
        height: 44px;
        border-radius: 8px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        font-weight: 700;
        font-size: 16px;
        transition: all 0.3s;
    }
    .oops-split-footer-social-link:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 25px rgba(102, 126, 234, 0.4);
    }
    .oops-split-footer-custom {
        color: {{ $isDark ? '#cbd5e1' : '#475569' }};
        font-size: 15px;
        line-height: 1.6;
    }
    .oops-split-footer-copyright {
        padding-top: 24px;
        border-top: 2px solid {{ $isDark ? '#334155' : '#e2e8f0' }};
        text-align: center;
    }
    .oops-split-footer-copyright-text {
        color: {{ $isDark ? '#cbd5e1' : '#475569' }};
        font-size: 14px;
        margin: 0;
        font-weight: 500;
    }
    @media (max-width: 640px) {
        .oops-split-footer-grid { grid-template-columns: 1fr; gap: 24px; }
    }
</style>

<div class="oops-split-container">
    <div class="oops-split-left">
        <div class="oops-split-code">{{ $statusCode ?? 500 }}</div>
    </div>
    <div class="oops-split-right">
        <div class="oops-split-content">
            <div class="oops-split-badge">Error {{ $statusCode ?? 500 }}</div>
            <h1 class="oops-split-title">{{ $title ?? 'Something went wrong' }}</h1>
            <div class="oops-split-divider"></div>
            <p class="oops-split-message">{{ $message ?? 'We encountered an unexpected error. Our team has been notified.' }}</p>
            @if(isset($buttons) && count($buttons) > 0)
            <div class="oops-split-actions">
                @foreach($buttons as $button)
                @php
                    $url = $button['url'] ?? '/';
                    if ($url === 'current' || $url === 'retry') $url = url()->current();
                    elseif ($url === 'back') $url = url()->previous();
                    $cls = ($button['style'] ?? 'primary') === 'secondary' ? 'oops-split-btn oops-split-btn-secondary' : 'oops-split-btn oops-split-btn-primary';
                @endphp
                <a class="{{ $cls }}" href="{{ $url }}">{{ $button['text'] ?? 'Go Back' }}</a>
                @endforeach
            </div>
            @else
            <div class="oops-split-actions">
                <a class="oops-split-btn oops-split-btn-primary" href="{{ url('/') }}">Back to home</a>
                <a class="oops-split-btn oops-split-btn-secondary" href="{{ url()->current() }}">Retry</a>
            </div>
            @endif
            
            @include('oops-ui::partials.footer')
        </div>
    </div>
</div>
