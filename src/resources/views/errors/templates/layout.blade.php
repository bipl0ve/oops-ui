@php $isDark = ($settings['theme'] ?? 'light') === 'dark'; @endphp
@php $isAppLayout = $isAppLayout ?? false; @endphp
<style>
    /* Layout Template Specific Styles */
    .oops-layout-card {
        {{ $isAppLayout ? 'width: 100%;' : 'width: min(640px, 100%);' }}
        background: {{ $isDark ? '#1e293b' : '#ffffff' }};
        border: 1px solid {{ $isDark ? '#334155' : '#e2e8f0' }};
        border-radius: 16px;
        padding: 28px;
        box-shadow: 0 14px 34px rgba(15, 23, 42, 0.08);
    }
    
    .oops-layout-status {
        display: inline-block;
        font-weight: 700;
        font-size: 13px;
        letter-spacing: 0.04em;
        text-transform: uppercase;
        color: {{ $isDark ? '#14b8a6' : '#0f766e' }};
        background: {{ $isDark ? '#134e4a' : '#ccfbf1' }};
        border-radius: 999px;
        padding: 6px 11px;
        margin-bottom: 14px;
    }
    
    .oops-layout-card h1 {
        margin: 0 0 10px;
        font-size: 30px;
        line-height: 1.1;
        color: {{ $isDark ? '#f1f5f9' : '#0f172a' }};
    }
    
    .oops-layout-card p {
        margin: 0;
        color: {{ $isDark ? '#cbd5e1' : '#475569' }};
        line-height: 1.5;
    }
    
    .oops-layout-image {
        margin: 20px 0;
    }
    
    .oops-layout-image img {
        max-width: 100%;
        height: auto;
        border-radius: 8px;
    }
    
    .oops-layout-actions {
        margin-top: 20px;
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }
    
    .oops-layout-btn {
        text-decoration: none;
        padding: 10px 14px;
        border-radius: 10px;
        border: 1px solid {{ $isDark ? '#334155' : '#e2e8f0' }};
        color: {{ $isDark ? '#f1f5f9' : '#0f172a' }};
        background: {{ $isDark ? '#1e293b' : '#ffffff' }};
        font-size: 14px;
        font-weight: 600;
        transition: all 0.2s;
    }
    
    .oops-layout-btn-primary {
        border-color: {{ $isDark ? '#14b8a6' : '#0f766e' }};
        color: {{ $isDark ? '#14b8a6' : '#0f766e' }};
        background: {{ $isDark ? '#134e4a' : '#ccfbf1' }};
    }
    
    .oops-layout-btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }
    
    @media (max-width: 640px) {
        .oops-layout-card h1 {
            font-size: 24px;
        }
        
        .oops-layout-actions {
            flex-direction: column;
        }
        
        .oops-layout-btn {
            width: 100%;
            text-align: center;
        }
    }
    
    /* Footer Styles */
    .oops-layout-footer {
        margin-top: 32px;
        padding-top: 28px;
        border-top: 1px solid {{ $isDark ? '#334155' : '#e2e8f0' }};
    }
    
    .oops-layout-footer-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 24px;
        margin-bottom: 24px;
    }
    
    .oops-layout-footer-section {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }
    
    .oops-layout-footer-title {
        font-weight: 600;
        font-size: 13px;
        letter-spacing: 0.03em;
        text-transform: uppercase;
        color: {{ $isDark ? '#f1f5f9' : '#0f172a' }};
        margin: 0 0 6px 0;
        opacity: 0.9;
    }
    
    .oops-layout-footer-menu {
        list-style: none;
        padding: 0;
        margin: 0;
        display: flex;
        flex-wrap: wrap;
        gap: 16px 24px;
        align-items: center;
    }
    
    .oops-layout-footer-menu-item {
        margin: 0;
        line-height: 1.4;
    }
    
    .oops-layout-footer-link {
        color: {{ $isDark ? '#cbd5e1' : '#475569' }};
        text-decoration: none;
        font-size: 13px;
        transition: all 0.2s ease;
        display: inline-block;
        position: relative;
        padding: 4px 0;
    }
    
    .oops-layout-footer-link:hover {
        color: {{ $isDark ? '#14b8a6' : '#0f766e' }};
    }
    
    .oops-layout-footer-link::after {
        content: '';
        position: absolute;
        left: 0;
        bottom: 0;
        width: 0;
        height: 2px;
        background: {{ $isDark ? '#14b8a6' : '#0f766e' }};
        transition: width 0.3s ease;
    }
    
    .oops-layout-footer-link:hover::after {
        width: 100%;
    }
    
    .oops-layout-footer-social {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
        align-items: center;
    }
    
    .oops-layout-footer-social-link {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 32px;
        height: 32px;
        border-radius: 8px;
        background: {{ $isDark ? '#134e4a' : '#ccfbf1' }};
        color: {{ $isDark ? '#14b8a6' : '#0f766e' }};
        text-decoration: none;
        font-size: 12px;
        font-weight: 700;
        transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
    }
    
    .oops-layout-footer-social-link:hover {
        background: {{ $isDark ? '#14b8a6' : '#0f766e' }};
        color: white;
        transform: translateY(-2px) scale(1.05);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.12);
    }
    
    .oops-layout-footer-contact {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }
    
    .oops-layout-footer-contact-item {
        display: flex;
        flex-direction: column;
        gap: 2px;
        font-size: 13px;
        line-height: 1.5;
    }
    
    .oops-layout-footer-contact-label {
        font-weight: 600;
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: {{ $isDark ? '#f1f5f9' : '#0f172a' }};
        opacity: 0.7;
    }
    
    .oops-layout-footer-contact-value {
        color: {{ $isDark ? '#cbd5e1' : '#475569' }};
    }
    
    .oops-layout-footer-contact-link {
        color: {{ $isDark ? '#14b8a6' : '#0f766e' }};
        text-decoration: none;
        transition: all 0.2s ease;
    }
    
    .oops-layout-footer-contact-link:hover {
        color: {{ $isDark ? '#f1f5f9' : '#0f172a' }};
        text-decoration: underline;
    }
    
    .oops-layout-footer-custom {
        color: {{ $isDark ? '#cbd5e1' : '#475569' }};
        font-size: 13px;
        line-height: 1.6;
    }
    
    .oops-layout-footer-copyright {
        padding-top: 20px;
        border-top: 1px solid {{ $isDark ? '#334155' : '#e2e8f0' }};
        text-align: center;
    }
    
    .oops-layout-footer-copyright-text {
        margin: 0;
        color: {{ $isDark ? '#cbd5e1' : '#475569' }};
        font-size: 12px;
        line-height: 1.5;
        opacity: 0.8;
    }
    
    @media (max-width: 768px) {
        .oops-layout-footer {
            margin-top: 24px;
            padding-top: 24px;
        }
        
        .oops-layout-footer-grid {
            grid-template-columns: 1fr;
            gap: 20px;
            margin-bottom: 20px;
        }
        
        .oops-layout-footer-menu {
            gap: 12px 20px;
        }
        
        .oops-layout-footer-copyright {
            padding-top: 16px;
        }
        
        .oops-layout-footer-copyright-text {
            font-size: 11px;
        }
    }
    
    @media (max-width: 480px) {
        .oops-layout-footer {
            margin-top: 20px;
            padding-top: 20px;
        }
        
        .oops-layout-footer-grid {
            gap: 16px;
            margin-bottom: 16px;
        }
        
        .oops-layout-footer-title {
            font-size: 12px;
            margin-bottom: 8px;
        }
        
        .oops-layout-footer-menu {
            gap: 10px 16px;
        }
        
        .oops-layout-footer-link,
        .oops-layout-footer-contact-item,
        .oops-layout-footer-custom {
            font-size: 12px;
        }
        
        .oops-layout-footer-social-link {
            width: 28px;
            height: 28px;
            font-size: 11px;
        }
    }
</style>

<div class="oops-layout-card">
    <span class="oops-layout-status">Error {{ $statusCode ?? 500 }}</span>
    <h1>{{ $title ?? 'Something went wrong' }}</h1>
    <p>{{ $message ?? 'Please try again later.' }}</p>

    @if(isset($image) && !empty($image['url']))
    <div class="oops-layout-image">
        <img src="{{ $image['url'] }}" alt="{{ $image['alt'] ?? 'Error illustration' }}" />
    </div>
    @endif

    @if(isset($buttons) && count($buttons) > 0)
    <div class="oops-layout-actions">
        @foreach($buttons as $button)
        @php
            $url = $button['url'] ?? '/';
            if ($url === 'current' || $url === 'retry') {
                $url = url()->current();
            } elseif ($url === 'back') {
                $url = url()->previous();
            }
            $btnClass = ($button['style'] ?? 'primary') === 'primary' ? 'oops-layout-btn oops-layout-btn-primary' : 'oops-layout-btn';
        @endphp
        <a class="{{ $btnClass }}" href="{{ $url }}">
            {{ $button['text'] ?? 'Go Back' }}
        </a>
        @endforeach
    </div>
    @else
    <div class="oops-layout-actions">
        <a class="oops-layout-btn oops-layout-btn-primary" href="{{ url('/') }}">Back to home</a>
        <a class="oops-layout-btn" href="{{ url()->current() }}">Retry</a>
    </div>
    @endif
    
    @include('oops-ui::partials.footer')
</div>
