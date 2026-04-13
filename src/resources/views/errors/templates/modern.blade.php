@php $isDark = ($settings['theme'] ?? 'light') === 'dark'; @endphp
@php $isAppLayout = $isAppLayout ?? false; @endphp
<style>
    .oops-modern-wrap {
        {{ $isAppLayout ? 'width: 100%;' : 'max-width: 600px; width: 100%;' }}
        margin: 0 auto;
        text-align: center;
        background: {{ $isDark ? '#1a1a1a' : 'transparent' }};
        padding: {{ $isDark ? '40px 30px' : '0' }};
        border-radius: {{ $isDark ? '12px' : '0' }};
    }
    .oops-modern-code {
        font-size: 120px;
        font-weight: 900;
        line-height: 1;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin: 0 0 20px;
    }
    .oops-modern-title {
        font-size: 32px;
        font-weight: 700;
        margin: 0 0 16px;
        color: {{ $isDark ? '#f5f5f5' : '#1a1a1a' }};
    }
    .oops-modern-message {
        font-size: 18px;
        color: {{ $isDark ? '#b0b0b0' : '#666666' }};
        margin: 0 0 32px;
        line-height: 1.6;
    }
    .oops-modern-actions {
        display: flex;
        gap: 12px;
        justify-content: center;
        flex-wrap: wrap;
    }
    .oops-modern-btn {
        padding: 14px 32px;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 600;
        font-size: 16px;
        transition: all 0.3s;
        display: inline-block;
    }
    .oops-modern-btn-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
    }
    .oops-modern-btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(102,126,234,0.4);
    }
    .oops-modern-btn-secondary {
        background: {{ $isDark ? '#2a2a2a' : '#f5f5f5' }};
        color: {{ $isDark ? '#f5f5f5' : '#000000' }};
    }
    .oops-modern-btn-secondary:hover { 
        background: {{ $isDark ? '#3a3a3a' : '#e5e5e5' }}; 
    }
    @media (max-width: 640px) {
        .oops-modern-code { font-size: 80px; }
        .oops-modern-title { font-size: 24px; }
        .oops-modern-message { font-size: 16px; }
        .oops-modern-actions { flex-direction: column; }
        .oops-modern-btn { width: 100%; }
    }
    
    /* Footer Styles */
    .oops-modern-footer {
        margin-top: 48px;
        padding-top: 32px;
        border-top: 2px solid {{ $isDark ? '#3a3a3a' : '#e0e0e0' }};
    }
    
    .oops-modern-footer-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 28px;
        margin-bottom: 28px;
        text-align: left;
    }
    
    .oops-modern-footer-section {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }
    
    .oops-modern-footer-title {
        font-weight: 700;
        font-size: 14px;
        letter-spacing: 0.05em;
        text-transform: uppercase;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin: 0 0 8px 0;
    }
    
    .oops-modern-footer-menu {
        list-style: none;
        padding: 0;
        margin: 0;
        display: flex;
        flex-wrap: wrap;
        gap: 12px 20px;
    }
    
    .oops-modern-footer-menu-item {
        margin: 0;
    }
    
    .oops-modern-footer-link {
        color: {{ $isDark ? '#b0b0b0' : '#666666' }};
        text-decoration: none;
        font-size: 14px;
        transition: all 0.3s ease;
        position: relative;
    }
    
    .oops-modern-footer-link:hover {
        color: #667eea;
    }
    
    .oops-modern-footer-social {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }
    
    .oops-modern-footer-social-link {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        text-decoration: none;
        font-size: 13px;
        font-weight: 700;
        transition: all 0.3s ease;
    }
    
    .oops-modern-footer-social-link:hover {
        transform: translateY(-3px) scale(1.1);
        box-shadow: 0 8px 20px rgba(102,126,234,0.4);
    }
    
    .oops-modern-footer-contact {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }
    
    .oops-modern-footer-contact-item {
        display: flex;
        flex-direction: column;
        gap: 4px;
        font-size: 14px;
    }
    
    .oops-modern-footer-contact-label {
        font-weight: 700;
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: #667eea;
    }
    
    .oops-modern-footer-contact-value {
        color: {{ $isDark ? '#b0b0b0' : '#666666' }};
    }
    
    .oops-modern-footer-contact-link {
        color: #667eea;
        text-decoration: none;
        transition: all 0.3s ease;
    }
    
    .oops-modern-footer-contact-link:hover {
        color: #764ba2;
    }
    
    .oops-modern-footer-custom {
        color: {{ $isDark ? '#b0b0b0' : '#666666' }};
        font-size: 14px;
        line-height: 1.6;
    }
    
    .oops-modern-footer-copyright {
        padding-top: 24px;
        border-top: 1px solid {{ $isDark ? '#3a3a3a' : '#e0e0e0' }};
        text-align: center;
    }
    
    .oops-modern-footer-copyright-text {
        margin: 0;
        color: {{ $isDark ? '#909090' : '#999999' }};
        font-size: 13px;
    }
    
    @media (max-width: 768px) {
        .oops-modern-footer {
            margin-top: 36px;
            padding-top: 24px;
        }
        
        .oops-modern-footer-grid {
            grid-template-columns: 1fr;
            gap: 20px;
        }
    }
</style>

<div class="oops-modern-wrap">
    <div class="oops-modern-code">{{ $statusCode ?? 500 }}</div>
    <h1 class="oops-modern-title">{{ $title ?? 'Something went wrong' }}</h1>
    <p class="oops-modern-message">{{ $message ?? 'Please try again later.' }}</p>
    
    @if(isset($buttons) && count($buttons) > 0)
    <div class="oops-modern-actions">
        @foreach($buttons as $button)
        @php
            $url = $button['url'] ?? '/';
            if ($url === 'current' || $url === 'retry') $url = url()->current();
            elseif ($url === 'back') $url = url()->previous();
            $cls = ($button['style'] ?? 'primary') === 'secondary' ? 'oops-modern-btn oops-modern-btn-secondary' : 'oops-modern-btn oops-modern-btn-primary';
        @endphp
        <a class="{{ $cls }}" href="{{ $url }}">{{ $button['text'] ?? 'Go Back' }}</a>
        @endforeach
    </div>
    @else
    <div class="oops-modern-actions">
        <a class="oops-modern-btn oops-modern-btn-primary" href="{{ url('/') }}">Back to home</a>
        <a class="oops-modern-btn oops-modern-btn-secondary" href="{{ url()->current() }}">Retry</a>
    </div>
    @endif
    
    @include('oops-ui::partials.footer')
</div>
