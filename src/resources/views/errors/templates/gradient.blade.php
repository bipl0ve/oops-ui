@php $isDark = ($settings['theme'] ?? 'light') === 'dark'; @endphp
<style>
    .oops-gradient-page {
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #f093fb 100%);
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
    }
    .oops-gradient-card {
        width: 100%;
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border-radius: 24px;
        padding: 50px 40px;
        text-align: center;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
    }
    .oops-gradient-icon {
        width: 80px;
        height: 80px;
        margin: 0 auto 24px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 28px;
        font-weight: 900;
        color: white;
    }
    .oops-gradient-title {
        font-size: 32px;
        font-weight: 800;
        margin: 0 0 12px;
        color: #1a1a1a;
    }
    .oops-gradient-message {
        font-size: 16px;
        color: #666666;
        margin: 0 0 32px;
        line-height: 1.6;
    }
    .oops-gradient-actions {
        display: flex;
        gap: 12px;
        justify-content: center;
        flex-wrap: wrap;
    }
    .oops-gradient-btn {
        padding: 14px 28px;
        border-radius: 12px;
        text-decoration: none;
        font-weight: 600;
        font-size: 15px;
        transition: all 0.3s;
        display: inline-block;
    }
    .oops-gradient-btn-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
    }
    .oops-gradient-btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(102, 126, 234, 0.6);
    }
    .oops-gradient-btn-secondary {
        background: white;
        color: #667eea;
        border: 2px solid #667eea;
    }
    .oops-gradient-btn-secondary:hover { background: #f8f9ff; }
    @media (max-width: 640px) {
        .oops-gradient-card { padding: 40px 24px; }
        .oops-gradient-title { font-size: 26px; }
        .oops-gradient-actions { flex-direction: column; }
        .oops-gradient-btn { width: 100%; text-align: center; }
    }
    
    /* Footer Styles */
    .oops-gradient-footer {
        margin-top: 48px;
        padding-top: 32px;
        border-top: 2px solid rgba(255, 255, 255, 0.2);
    }
    .oops-gradient-footer-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 32px;
        margin-bottom: 24px;
    }
    .oops-gradient-footer-section { }
    .oops-gradient-footer-title {
        font-size: 16px;
        font-weight: 700;
        color: #1a1a1a;
        margin: 0 0 12px;
        text-transform: uppercase;
        letter-spacing: 1px;
    }
    .oops-gradient-footer-menu {
        list-style: none;
        padding: 0;
        margin: 0;
        display: flex;
        flex-wrap: wrap;
        gap: 8px 16px;
    }
    .oops-gradient-footer-menu-item { }
    .oops-gradient-footer-link {
        color: #666666;
        text-decoration: none;
        font-size: 15px;
        font-weight: 500;
        transition: color 0.2s;
    }
    .oops-gradient-footer-link:hover { color: #667eea; }
    .oops-gradient-footer-contact { }
    .oops-gradient-footer-contact-item { margin-bottom: 8px; }
    .oops-gradient-footer-contact-label {
        font-weight: 600;
        color: #1a1a1a;
        font-size: 14px;
        display: block;
        margin-bottom: 4px;
    }
    .oops-gradient-footer-contact-link {
        color: #667eea;
        text-decoration: none;
        font-size: 15px;
        font-weight: 500;
    }
    .oops-gradient-footer-contact-link:hover { text-decoration: underline; }
    .oops-gradient-footer-contact-value {
        color: #666666;
        font-size: 15px;
    }
    .oops-gradient-footer-social {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
    }
    .oops-gradient-footer-social-link {
        width: 44px;
        height: 44px;
        border-radius: 50%;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        font-weight: 700;
        font-size: 16px;
        transition: all 0.3s;
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
    }
    .oops-gradient-footer-social-link:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 20px rgba(102, 126, 234, 0.5);
    }
    .oops-gradient-footer-custom {
        color: #666666;
        font-size: 15px;
        line-height: 1.6;
    }
    .oops-gradient-footer-copyright {
        padding-top: 24px;
        border-top: 2px solid rgba(255, 255, 255, 0.2);
        text-align: center;
    }
    .oops-gradient-footer-copyright-text {
        color: #666666;
        font-size: 14px;
        margin: 0;
        font-weight: 500;
    }
    @media (max-width: 640px) {
        .oops-gradient-footer-grid { grid-template-columns: 1fr; gap: 24px; }
    }
</style>

<div class="oops-gradient-page">
    <div class="oops-gradient-card">
        <div class="oops-gradient-icon">{{ $statusCode ?? 500 }}</div>
        <h1 class="oops-gradient-title">{{ $title ?? 'Oops!' }}</h1>
        <p class="oops-gradient-message">{{ $message ?? 'Something went wrong.' }}</p>
        @if(isset($buttons) && count($buttons) > 0)
        <div class="oops-gradient-actions">
            @foreach($buttons as $button)
            @php
                $url = $button['url'] ?? '/';
                if ($url === 'current' || $url === 'retry') $url = url()->current();
                elseif ($url === 'back') $url = url()->previous();
                $cls = ($button['style'] ?? 'primary') === 'secondary' ? 'oops-gradient-btn oops-gradient-btn-secondary' : 'oops-gradient-btn oops-gradient-btn-primary';
            @endphp
            <a class="{{ $cls }}" href="{{ $url }}">{{ $button['text'] ?? 'Go Back' }}</a>
            @endforeach
        </div>
        @endif
        
        @include('oops-ui::partials.footer')
    </div>
</div>
