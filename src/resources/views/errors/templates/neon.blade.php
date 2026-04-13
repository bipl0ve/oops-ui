@php $isDark = ($settings['theme'] ?? 'light') === 'dark'; @endphp
@php $isAppLayout = $isAppLayout ?? false; @endphp
<style>
    /* Neon Template Specific Styles */
    .oops-neon-wrap {
        {{ $isAppLayout ? 'width: 100%; margin: 0;' : 'max-width: 700px; width: 100%; margin: 0 auto;' }}
        text-align: center;
        font-family: 'Courier New', monospace;
        background: {{ $isDark ? '#000000' : '#0a0a0a' }};
        padding: 40px 20px;
        border-radius: 8px;
    }
    
    .oops-neon-wrap::before {
        content: '';
        position: fixed;
        inset: 0;
        background:
            repeating-linear-gradient(0deg, {{ $isDark ? 'rgba(255,0,255,0.05)' : 'rgba(255,0,255,0.03)' }} 0px, transparent 1px, transparent 2px, {{ $isDark ? 'rgba(255,0,255,0.05)' : 'rgba(255,0,255,0.03)' }} 3px),
            repeating-linear-gradient(90deg, {{ $isDark ? 'rgba(0,255,255,0.05)' : 'rgba(0,255,255,0.03)' }} 0px, transparent 1px, transparent 2px, {{ $isDark ? 'rgba(0,255,255,0.05)' : 'rgba(0,255,255,0.03)' }} 3px);
        pointer-events: none;
        z-index: -1;
    }
    
    .oops-neon-code {
        font-size: 140px;
        font-weight: 900;
        line-height: 1;
        color: {{ $isDark ? '#ff00ff' : '#cc00cc' }};
        text-shadow: {{ $isDark ? '0 0 10px #ff00ff, 0 0 20px #ff00ff, 0 0 40px #ff00ff, 0 0 80px #ff00ff' : '0 0 8px #cc00cc, 0 0 15px #cc00cc, 0 0 30px #cc00cc' }};
        animation: oops-neon-flicker 3s infinite alternate;
        margin: 0 0 20px;
    }
    
    @keyframes oops-neon-flicker {
        0%, 18%, 22%, 25%, 53%, 57%, 100% { 
            text-shadow: {{ $isDark ? '0 0 10px #ff00ff, 0 0 20px #ff00ff, 0 0 40px #ff00ff, 0 0 80px #ff00ff' : '0 0 8px #cc00cc, 0 0 15px #cc00cc, 0 0 30px #cc00cc' }}; 
        }
        20%, 24%, 55% { 
            text-shadow: none; 
        }
    }
    
    .oops-neon-title {
        font-size: 36px;
        font-weight: 700;
        margin: 0 0 16px;
        color: {{ $isDark ? '#00ffff' : '#00cccc' }};
        text-shadow: {{ $isDark ? '0 0 10px #00ffff, 0 0 20px #00ffff' : '0 0 8px #00cccc, 0 0 15px #00cccc' }};
        text-transform: uppercase;
        letter-spacing: 3px;
    }
    
    .oops-neon-message {
        font-size: 18px;
        color: {{ $isDark ? '#a0a0ff' : '#8080dd' }};
        margin: 0 0 40px;
        line-height: 1.6;
    }
    
    .oops-neon-actions {
        display: flex;
        gap: 16px;
        justify-content: center;
        flex-wrap: wrap;
    }
    
    .oops-neon-btn {
        padding: 16px 36px;
        text-decoration: none;
        font-weight: 700;
        font-size: 16px;
        transition: all 0.3s;
        display: inline-block;
        text-transform: uppercase;
        letter-spacing: 2px;
        border: 2px solid;
    }
    
    .oops-neon-btn-primary {
        background: transparent;
        color: {{ $isDark ? '#ff00ff' : '#cc00cc' }};
        border-color: {{ $isDark ? '#ff00ff' : '#cc00cc' }};
        box-shadow: {{ $isDark ? '0 0 10px #ff00ff, inset 0 0 10px rgba(255,0,255,0.2)' : '0 0 8px #cc00cc, inset 0 0 8px rgba(204,0,204,0.2)' }};
    }
    
    .oops-neon-btn-primary:hover {
        background: {{ $isDark ? '#ff00ff' : '#cc00cc' }};
        color: #000;
        box-shadow: {{ $isDark ? '0 0 20px #ff00ff, 0 0 40px #ff00ff' : '0 0 15px #cc00cc, 0 0 30px #cc00cc' }};
    }
    
    .oops-neon-btn-secondary {
        background: transparent;
        color: {{ $isDark ? '#00ffff' : '#00cccc' }};
        border-color: {{ $isDark ? '#00ffff' : '#00cccc' }};
        box-shadow: {{ $isDark ? '0 0 10px #00ffff, inset 0 0 10px rgba(0,255,255,0.2)' : '0 0 8px #00cccc, inset 0 0 8px rgba(0,204,204,0.2)' }};
    }
    
    .oops-neon-btn-secondary:hover {
        background: {{ $isDark ? '#00ffff' : '#00cccc' }};
        color: #000;
        box-shadow: {{ $isDark ? '0 0 20px #00ffff, 0 0 40px #00ffff' : '0 0 15px #00cccc, 0 0 30px #00cccc' }};
    }
    
    @media (max-width: 640px) {
        .oops-neon-code { font-size: 90px; }
        .oops-neon-title { font-size: 28px; letter-spacing: 2px; }
        .oops-neon-message { font-size: 16px; }
        .oops-neon-actions { flex-direction: column; }
        .oops-neon-btn { width: 100%; text-align: center; }
    }
    
    /* Footer Styles */
    .oops-neon-footer {
        margin-top: 80px;
        padding: 40px 20px 0;
        border-top: 1px solid {{ $isDark ? '#ff00ff' : '#cc00cc' }};
        box-shadow: {{ $isDark ? '0 -2px 20px rgba(255, 0, 255, 0.2)' : '0 -2px 15px rgba(204, 0, 204, 0.15)' }};
    }
    .oops-neon-footer-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 32px;
        margin-bottom: 24px;
        text-align: left;
    }
    .oops-neon-footer-section { }
    .oops-neon-footer-title {
        font-size: 16px;
        font-weight: 700;
        color: {{ $isDark ? '#00ffff' : '#00cccc' }};
        margin: 0 0 12px;
        text-transform: uppercase;
        letter-spacing: 2px;
        text-shadow: {{ $isDark ? '0 0 10px #00ffff' : '0 0 8px #00cccc' }};
    }
    .oops-neon-footer-menu {
        list-style: none;
        padding: 0;
        margin: 0;
        display: flex;
        flex-wrap: wrap;
        gap: 8px 16px;
    }
    .oops-neon-footer-menu-item { }
    .oops-neon-footer-link {
        color: {{ $isDark ? '#a0a0ff' : '#8080dd' }};
        text-decoration: none;
        font-size: 15px;
        transition: all 0.2s;
    }
    .oops-neon-footer-link:hover {
        color: {{ $isDark ? '#ff00ff' : '#cc00cc' }};
        text-shadow: {{ $isDark ? '0 0 10px #ff00ff' : '0 0 8px #cc00cc' }};
    }
    .oops-neon-footer-contact { }
    .oops-neon-footer-contact-item { margin-bottom: 8px; }
    .oops-neon-footer-contact-label {
        font-weight: 700;
        color: {{ $isDark ? '#00ffff' : '#00cccc' }};
        font-size: 14px;
        display: block;
        margin-bottom: 4px;
        text-transform: uppercase;
        letter-spacing: 1px;
    }
    .oops-neon-footer-contact-link {
        color: {{ $isDark ? '#ff00ff' : '#cc00cc' }};
        text-decoration: none;
        font-size: 15px;
        transition: all 0.2s;
    }
    .oops-neon-footer-contact-link:hover {
        text-shadow: {{ $isDark ? '0 0 10px #ff00ff' : '0 0 8px #cc00cc' }};
    }
    .oops-neon-footer-contact-value {
        color: {{ $isDark ? '#a0a0ff' : '#8080dd' }};
        font-size: 15px;
    }
    .oops-neon-footer-social {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
    }
    .oops-neon-footer-social-link {
        width: 44px;
        height: 44px;
        border-radius: 0;
        background: transparent;
        color: {{ $isDark ? '#00ffff' : '#00cccc' }};
        border: 2px solid {{ $isDark ? '#00ffff' : '#00cccc' }};
        display: flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        font-weight: 700;
        font-size: 16px;
        transition: all 0.3s;
        box-shadow: {{ $isDark ? '0 0 10px rgba(0, 255, 255, 0.3)' : '0 0 8px rgba(0, 204, 204, 0.25)' }};
    }
    .oops-neon-footer-social-link:hover {
        background: {{ $isDark ? '#00ffff' : '#00cccc' }};
        color: #000;
        box-shadow: {{ $isDark ? '0 0 20px #00ffff' : '0 0 15px #00cccc' }};
    }
    .oops-neon-footer-custom {
        color: {{ $isDark ? '#a0a0ff' : '#8080dd' }};
        font-size: 15px;
        line-height: 1.6;
    }
    .oops-neon-footer-copyright {
        margin-top: 32px;
        padding-top: 32px;
        border-top: 1px solid {{ $isDark ? '#00ffff' : '#00cccc' }};
        box-shadow: {{ $isDark ? '0 -2px 20px rgba(0, 255, 255, 0.2)' : '0 -2px 15px rgba(0, 204, 204, 0.15)' }};
        text-align: center;
    }
    .oops-neon-footer-copyright-text {
        color: {{ $isDark ? '#a0a0ff' : '#8080dd' }};
        font-size: 14px;
        margin: 0;
        text-transform: uppercase;
        letter-spacing: 1px;
    }
    @media (max-width: 640px) {
        .oops-neon-footer-grid { grid-template-columns: 1fr; gap: 24px; }
    }
</style>

<div class="oops-neon-wrap">
    <div class="oops-neon-code">{{ $statusCode ?? 500 }}</div>
    <h1 class="oops-neon-title">{{ $title ?? 'System Error' }}</h1>
    <p class="oops-neon-message">{{ $message ?? 'Connection to the mainframe has been interrupted.' }}</p>
    @if(isset($buttons) && count($buttons) > 0)
    <div class="oops-neon-actions">
        @foreach($buttons as $button)
        @php
            $url = $button['url'] ?? '/';
            if ($url === 'current' || $url === 'retry') $url = url()->current();
            elseif ($url === 'back') $url = url()->previous();
            $cls = ($button['style'] ?? 'primary') === 'secondary' ? 'oops-neon-btn oops-neon-btn-secondary' : 'oops-neon-btn oops-neon-btn-primary';
        @endphp
        <a class="{{ $cls }}" href="{{ $url }}">{{ $button['text'] ?? 'Go Back' }}</a>
        @endforeach
    </div>
    @else
    <div class="oops-neon-actions">
        <a class="oops-neon-btn oops-neon-btn-primary" href="{{ url('/') }}">Back to home</a>
        <a class="oops-neon-btn oops-neon-btn-secondary" href="{{ url()->current() }}">Retry</a>
    </div>
    @endif
    
    @include('oops-ui::partials.footer')
</div>
