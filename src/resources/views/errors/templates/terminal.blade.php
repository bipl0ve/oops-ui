@php $isDark = ($settings['theme'] ?? 'light') === 'dark'; @endphp
<style>
    /* Terminal Template Specific Styles */
    .oops-terminal-wrap { 
        width: 100%; 
        font-family: 'Courier New', 'Consolas', monospace;
    }
    
    .oops-terminal-window {
        background: #1a1a1a;
        border-radius: 8px;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5);
        overflow: hidden;
    }
    
    .oops-terminal-bar {
        background: #2a2a2a;
        padding: 12px 16px;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    
    .oops-terminal-dot {
        width: 12px; 
        height: 12px;
        border-radius: 50%;
    }
    
    .oops-terminal-dot-red { background: #ff5f56; }
    .oops-terminal-dot-yellow { background: #ffbd2e; }
    .oops-terminal-dot-green { background: #27c93f; }
    
    .oops-terminal-bar-title {
        color: #8a8a8a;
        font-size: 13px;
        margin-left: 12px;
    }
    
    .oops-terminal-body {
        padding: 24px;
        min-height: 400px;
        background: #0c0c0c;
        color: #00ff00;
    }
    
    .oops-terminal-line { 
        margin-bottom: 8px; 
        line-height: 1.6; 
    }
    
    .oops-terminal-prompt { color: #00ff00; }
    .oops-terminal-error { color: #ff5555; }
    .oops-terminal-warn { color: #ffff55; }
    
    .oops-terminal-big {
        font-size: 48px;
        font-weight: bold;
        color: #ff5555;
        margin: 20px 0;
        text-shadow: 0 0 10px rgba(255, 85, 85, 0.5);
    }
    
    .oops-terminal-cursor {
        display: inline-block;
        width: 10px; 
        height: 20px;
        background: #00ff00;
        animation: oops-terminal-blink 1s infinite;
        margin-left: 4px;
        vertical-align: middle;
    }
    
    @keyframes oops-terminal-blink {
        0%, 50% { opacity: 1; }
        51%, 100% { opacity: 0; }
    }
    
    .oops-terminal-actions {
        margin-top: 32px;
        display: flex;
        gap: 16px;
        flex-wrap: wrap;
    }
    
    .oops-terminal-btn {
        padding: 10px 24px;
        border: 2px solid #00ff00;
        background: transparent;
        color: #00ff00;
        text-decoration: none;
        font-weight: 600;
        font-size: 14px;
        transition: all 0.3s;
        display: inline-block;
        font-family: 'Courier New', monospace;
    }
    
    .oops-terminal-btn:hover {
        background: #00ff00;
        color: #000;
        box-shadow: 0 0 20px rgba(0, 255, 0, 0.5);
    }
    
    .oops-terminal-btn-secondary {
        border-color: #ffff55;
        color: #ffff55;
    }
    
    .oops-terminal-btn-secondary:hover {
        background: #ffff55;
        color: #000;
        box-shadow: 0 0 20px rgba(255, 255, 85, 0.5);
    }
    
    @media (max-width: 640px) {
        .oops-terminal-body { padding: 16px; min-height: 300px; }
        .oops-terminal-big { font-size: 32px; }
        .oops-terminal-actions { flex-direction: column; }
        .oops-terminal-btn { width: 100%; text-align: center; }
    }
    
    /* Footer Styles */
    .oops-terminal-footer {
        margin-top: 40px;
        padding-top: 32px;
        border-top: 2px solid #00ff00;
        font-family: 'Courier New', 'Consolas', monospace;
    }
    .oops-terminal-footer-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 32px;
        margin-bottom: 24px;
        text-align: left;
    }
    .oops-terminal-footer-section { }
    .oops-terminal-footer-title {
        font-size: 16px;
        font-weight: 700;
        color: #00ff00;
        margin: 0 0 12px;
        text-transform: uppercase;
        letter-spacing: 2px;
    }
    .oops-terminal-footer-menu {
        list-style: none;
        padding: 0;
        margin: 0;
        display: flex;
        flex-wrap: wrap;
        gap: 8px 16px;
    }
    .oops-terminal-footer-menu-item { }
    .oops-terminal-footer-link {
        color: #00ff00;
        text-decoration: none;
        font-size: 15px;
        transition: all 0.2s;
    }
    .oops-terminal-footer-link:hover {
        color: #ffff55;
        text-shadow: 0 0 10px #ffff55;
    }
    .oops-terminal-footer-contact { }
    .oops-terminal-footer-contact-item { margin-bottom: 8px; }
    .oops-terminal-footer-contact-label {
        font-weight: 700;
        color: #ffff55;
        font-size: 14px;
        display: block;
        margin-bottom: 4px;
        text-transform: uppercase;
    }
    .oops-terminal-footer-contact-link {
        color: #00ff00;
        text-decoration: none;
        font-size: 15px;
    }
    .oops-terminal-footer-contact-link:hover { text-decoration: underline; }
    .oops-terminal-footer-contact-value {
        color: #00ff00;
        font-size: 15px;
    }
    .oops-terminal-footer-social {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
    }
    .oops-terminal-footer-social-link {
        width: 40px;
        height: 40px;
        border-radius: 0;
        background: transparent;
        color: #00ff00;
        border: 2px solid #00ff00;
        display: flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        font-weight: 700;
        font-size: 14px;
        transition: all 0.3s;
    }
    .oops-terminal-footer-social-link:hover {
        background: #00ff00;
        color: #000;
        box-shadow: 0 0 20px rgba(0, 255, 0, 0.5);
    }
    .oops-terminal-footer-custom {
        color: #00ff00;
        font-size: 15px;
        line-height: 1.6;
    }
    .oops-terminal-footer-copyright {
        padding-top: 24px;
        border-top: 1px solid #00ff00;
        text-align: center;
    }
    .oops-terminal-footer-copyright-text {
        color: #00ff00;
        font-size: 14px;
        margin: 0;
    }
    @media (max-width: 640px) {
        .oops-terminal-footer-grid { grid-template-columns: 1fr; gap: 24px; }
    }
</style>

<div class="oops-terminal-wrap">
    <div class="oops-terminal-window">
        <div class="oops-terminal-bar">
            <div class="oops-terminal-dot oops-terminal-dot-red"></div>
            <div class="oops-terminal-dot oops-terminal-dot-yellow"></div>
            <div class="oops-terminal-dot oops-terminal-dot-green"></div>
            <div class="oops-terminal-bar-title">error@terminal: ~</div>
        </div>
        <div class="oops-terminal-body">
            <div class="oops-terminal-line"><span class="oops-terminal-prompt">user@system:~$</span> ./request.sh</div>
            <div class="oops-terminal-line oops-terminal-error">ERROR: Request failed with status {{ $statusCode ?? 500 }}</div>
            <div class="oops-terminal-line"><span class="oops-terminal-prompt">user@system:~$</span> cat error.log</div>
            <div class="oops-terminal-big">[{{ $statusCode ?? 500 }}] ERROR</div>
            <div class="oops-terminal-line oops-terminal-warn">⚠ {{ $title ?? 'System Error Occurred' }}</div>
            <div class="oops-terminal-line">{{ $message ?? 'The requested operation could not be completed.' }}</div>
            <div class="oops-terminal-line" style="margin-top:16px">
                <span class="oops-terminal-prompt">user@system:~$</span>
                <span class="oops-terminal-cursor"></span>
            </div>
            @if(isset($buttons) && count($buttons) > 0)
            <div class="oops-terminal-actions">
                @foreach($buttons as $button)
                @php
                    $url = $button['url'] ?? '/';
                    if ($url === 'current' || $url === 'retry') $url = url()->current();
                    elseif ($url === 'back') $url = url()->previous();
                    $cls = ($button['style'] ?? 'primary') === 'secondary' ? 'oops-terminal-btn oops-terminal-btn-secondary' : 'oops-terminal-btn';
                @endphp
                <a class="{{ $cls }}" href="{{ $url }}">$ {{ $button['text'] ?? 'Go Back' }}</a>
                @endforeach
            </div>
            @else
            <div class="oops-terminal-actions">
                <a class="oops-terminal-btn" href="{{ url('/') }}">$ Back to home</a>
                <a class="oops-terminal-btn oops-terminal-btn-secondary" href="{{ url()->current() }}">$ Retry</a>
            </div>
            @endif
            
            @include('oops-ui::partials.footer')
        </div>
    </div>
</div>
