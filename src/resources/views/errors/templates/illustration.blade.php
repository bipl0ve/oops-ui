@php $isDark = ($settings['theme'] ?? 'light') === 'dark'; @endphp
<style>
    .oops-illus-page {
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
        background: {{ $isDark ? '#1a1a2e' : '#f0f4f8' }};
        color: {{ $isDark ? '#eaeaea' : '#2d3748' }};
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
    }
    .oops-illus-wrap {
        width: 100%;
        text-align: center;
    }
    .oops-illus-svg {
        width: 200px;
        height: 200px;
        margin: 0 auto 30px;
    }
    .oops-illus-svg svg { width: 100%; height: 100%; }
    .oops-illus-code {
        font-size: 100px;
        font-weight: 900;
        color: {{ $isDark ? '#4a5568' : '#cbd5e0' }};
        line-height: 1;
        margin: 0 0 20px;
    }
    .oops-illus-title {
        font-size: 36px;
        font-weight: 700;
        margin: 0 0 16px;
        color: {{ $isDark ? '#ffffff' : '#1a202c' }};
    }
    .oops-illus-message {
        font-size: 18px;
        color: {{ $isDark ? '#a0aec0' : '#718096' }};
        margin: 0 0 36px;
        line-height: 1.7;
    }
    .oops-illus-actions {
        display: flex;
        gap: 16px;
        justify-content: center;
        flex-wrap: wrap;
    }
    .oops-illus-btn {
        padding: 16px 36px;
        border-radius: 50px;
        text-decoration: none;
        font-weight: 600;
        font-size: 16px;
        transition: all 0.3s;
        display: inline-block;
    }
    .oops-illus-btn-primary {
        background: #4299e1;
        color: white;
        box-shadow: 0 4px 14px rgba(66,153,225,0.4);
    }
    .oops-illus-btn-primary:hover {
        background: #3182ce;
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(66,153,225,0.6);
    }
    .oops-illus-btn-secondary {
        background: {{ $isDark ? '#2d3748' : '#edf2f7' }};
        color: {{ $isDark ? '#eaeaea' : '#2d3748' }};
    }
    .oops-illus-btn-secondary:hover { background: {{ $isDark ? '#4a5568' : '#e2e8f0' }}; }
    @media (max-width: 640px) {
        .oops-illus-svg { width: 150px; height: 150px; }
        .oops-illus-code { font-size: 70px; }
        .oops-illus-title { font-size: 28px; }
        .oops-illus-message { font-size: 16px; }
        .oops-illus-actions { flex-direction: column; }
        .oops-illus-btn { width: 100%; }
    }
    
    /* Footer Styles */
    .oops-illus-footer {
        margin-top: 60px;
        padding-top: 40px;
        border-top: 2px solid {{ $isDark ? '#2d3748' : '#e2e8f0' }};
    }
    .oops-illus-footer-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 32px;
        margin-bottom: 24px;
        text-align: left;
    }
    .oops-illus-footer-section { }
    .oops-illus-footer-title {
        font-size: 16px;
        font-weight: 700;
        color: {{ $isDark ? '#ffffff' : '#1a202c' }};
        margin: 0 0 12px;
    }
    .oops-illus-footer-menu {
        list-style: none;
        padding: 0;
        margin: 0;
        display: flex;
        flex-wrap: wrap;
        gap: 8px 16px;
    }
    .oops-illus-footer-menu-item { }
    .oops-illus-footer-link {
        color: {{ $isDark ? '#a0aec0' : '#718096' }};
        text-decoration: none;
        font-size: 15px;
        transition: color 0.2s;
    }
    .oops-illus-footer-link:hover { color: #4299e1; }
    .oops-illus-footer-contact { }
    .oops-illus-footer-contact-item { margin-bottom: 8px; }
    .oops-illus-footer-contact-label {
        font-weight: 600;
        color: {{ $isDark ? '#eaeaea' : '#2d3748' }};
        font-size: 14px;
        display: block;
        margin-bottom: 4px;
    }
    .oops-illus-footer-contact-link {
        color: #4299e1;
        text-decoration: none;
        font-size: 15px;
    }
    .oops-illus-footer-contact-link:hover { text-decoration: underline; }
    .oops-illus-footer-contact-value {
        color: {{ $isDark ? '#a0aec0' : '#718096' }};
        font-size: 15px;
    }
    .oops-illus-footer-social {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
    }
    .oops-illus-footer-social-link {
        width: 44px;
        height: 44px;
        border-radius: 50%;
        background: #4299e1;
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        font-weight: 600;
        font-size: 16px;
        transition: all 0.3s;
        box-shadow: 0 4px 14px rgba(66,153,225,0.3);
    }
    .oops-illus-footer-social-link:hover {
        background: #3182ce;
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(66,153,225,0.5);
    }
    .oops-illus-footer-custom {
        color: {{ $isDark ? '#a0aec0' : '#718096' }};
        font-size: 15px;
        line-height: 1.6;
    }
    .oops-illus-footer-copyright {
        padding-top: 24px;
        border-top: 2px solid {{ $isDark ? '#2d3748' : '#e2e8f0' }};
        text-align: center;
    }
    .oops-illus-footer-copyright-text {
        color: {{ $isDark ? '#a0aec0' : '#718096' }};
        font-size: 14px;
        margin: 0;
    }
    @media (max-width: 640px) {
        .oops-illus-footer-grid { grid-template-columns: 1fr; gap: 24px; }
    }
</style>

<div class="oops-illus-page">
    <div class="oops-illus-wrap">
        <div class="oops-illus-svg">
            <svg viewBox="0 0 200 200" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle cx="100" cy="100" r="80" fill="#4299e1" opacity="0.1"/>
                <path d="M100 60V100M100 120V130" stroke="#4299e1" stroke-width="8" stroke-linecap="round"/>
                <circle cx="100" cy="100" r="70" stroke="#4299e1" stroke-width="4"/>
            </svg>
        </div>
        <div class="oops-illus-code">{{ $statusCode ?? 500 }}</div>
        <h1 class="oops-illus-title">{{ $title ?? 'Oops!' }}</h1>
        <p class="oops-illus-message">{{ $message ?? 'Something unexpected happened.' }}</p>
        @if(isset($buttons) && count($buttons) > 0)
        <div class="oops-illus-actions">
            @foreach($buttons as $button)
            @php
                $url = $button['url'] ?? '/';
                if ($url === 'current' || $url === 'retry') $url = url()->current();
                elseif ($url === 'back') $url = url()->previous();
                $cls = ($button['style'] ?? 'primary') === 'secondary' ? 'oops-illus-btn oops-illus-btn-secondary' : 'oops-illus-btn oops-illus-btn-primary';
            @endphp
            <a class="{{ $cls }}" href="{{ $url }}">{{ $button['text'] ?? 'Go Back' }}</a>
            @endforeach
        </div>
        @endif
        
        @include('oops-ui::partials.footer')
    </div>
</div>
