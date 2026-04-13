@php $isDark = ($settings['theme'] ?? 'light') === 'dark'; @endphp
@php $isAppLayout = $isAppLayout ?? false; @endphp
<style>
    /* Animated Template Specific Styles */
    .oops-animated-container {
        position: relative;
        width: 100%;
        {{ $isAppLayout ? '' : 'min-height: 100vh;' }}
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 40px 20px;
        overflow: hidden;
        background: {{ $isDark ? '#0f172a' : '#f8fafc' }};
    }
    
    .oops-animated-shapes {
        position: absolute;
        inset: 0;
        overflow: hidden;
        z-index: 0;
    }
    
    .oops-animated-shape {
        position: absolute;
        opacity: 0.1;
        animation: oops-animated-float 20s infinite ease-in-out;
    }
    
    .oops-animated-shape:nth-child(1) { 
        width: 80px; 
        height: 80px; 
        background: #667eea; 
        border-radius: 50%; 
        top: 10%; 
        left: 10%; 
        animation-delay: 0s; 
    }
    
    .oops-animated-shape:nth-child(2) { 
        width: 60px; 
        height: 60px; 
        background: #764ba2; 
        border-radius: 30%; 
        top: 60%; 
        left: 80%; 
        animation-delay: 2s; 
    }
    
    .oops-animated-shape:nth-child(3) { 
        width: 100px; 
        height: 100px; 
        background: #f093fb; 
        border-radius: 20%; 
        top: 80%; 
        left: 20%; 
        animation-delay: 4s; 
    }
    
    .oops-animated-shape:nth-child(4) { 
        width: 70px; 
        height: 70px; 
        background: #4facfe; 
        border-radius: 50%; 
        top: 20%; 
        left: 70%; 
        animation-delay: 1s; 
    }
    
    @keyframes oops-animated-float {
        0%, 100% { transform: translateY(0) rotate(0deg); }
        25% { transform: translateY(-30px) rotate(90deg); }
        50% { transform: translateY(0) rotate(180deg); }
        75% { transform: translateY(30px) rotate(270deg); }
    }
    
    .oops-animated-wrap {
        max-width: 600px;
        width: 100%;
        text-align: center;
        animation: oops-animated-fadein 0.8s ease-out;
        position: relative;
        z-index: 1;
    }
    
    @keyframes oops-animated-fadein {
        from { opacity: 0; transform: translateY(30px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    .oops-animated-icon {
        width: 120px; 
        height: 120px;
        margin: 0 auto 24px;
        animation: oops-animated-bounce 2s infinite;
    }
    
    @keyframes oops-animated-bounce {
        0%, 20%, 50%, 80%, 100% { transform: translateY(0); }
        40% { transform: translateY(-20px); }
        60% { transform: translateY(-10px); }
    }
    
    .oops-animated-icon svg { 
        width: 100%; 
        height: 100%; 
    }
    
    .oops-animated-code {
        font-size: 80px;
        font-weight: 900;
        line-height: 1;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin: 0 0 16px;
        animation: oops-animated-pulse 2s infinite;
    }
    
    @keyframes oops-animated-pulse {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.05); }
    }
    
    .oops-animated-title {
        font-size: 32px;
        font-weight: 700;
        margin: 0 0 16px;
        animation: oops-animated-slidein 0.8s ease-out 0.2s both;
        color: {{ $isDark ? '#f1f5f9' : '#0f172a' }};
    }
    
    @keyframes oops-animated-slidein {
        from { opacity: 0; transform: translateX(-20px); }
        to { opacity: 1; transform: translateX(0); }
    }
    
    .oops-animated-message {
        font-size: 18px;
        color: {{ $isDark ? '#cbd5e1' : '#475569' }};
        margin: 0 0 32px;
        line-height: 1.6;
        animation: oops-animated-slidein 0.8s ease-out 0.4s both;
    }
    
    .oops-animated-actions {
        display: flex;
        gap: 12px;
        justify-content: center;
        flex-wrap: wrap;
        animation: oops-animated-slidein 0.8s ease-out 0.6s both;
    }
    
    .oops-animated-btn {
        padding: 14px 32px;
        border-radius: 50px;
        text-decoration: none;
        font-weight: 600;
        font-size: 16px;
        transition: all 0.3s;
        display: inline-block;
        position: relative;
        overflow: hidden;
    }
    
    .oops-animated-btn::before {
        content: '';
        position: absolute;
        top: 50%; 
        left: 50%;
        width: 0; 
        height: 0;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.3);
        transform: translate(-50%, -50%);
        transition: width 0.6s, height 0.6s;
    }
    
    .oops-animated-btn:hover::before { 
        width: 300px; 
        height: 300px; 
    }
    
    .oops-animated-btn-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
    }
    
    .oops-animated-btn-primary:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 25px rgba(102, 126, 234, 0.4);
    }
    
    .oops-animated-btn-secondary {
        background: {{ $isDark ? '#1e293b' : '#ffffff' }};
        color: {{ $isDark ? '#f1f5f9' : '#0f172a' }};
        border: 2px solid {{ $isDark ? '#334155' : '#e2e8f0' }};
    }
    
    .oops-animated-btn-secondary:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }
    
    @media (max-width: 640px) {
        .oops-animated-container { padding: 30px 15px; }
        .oops-animated-icon { width: 80px; height: 80px; }
        .oops-animated-code { font-size: 60px; }
        .oops-animated-title { font-size: 24px; }
        .oops-animated-message { font-size: 16px; }
        .oops-animated-actions { flex-direction: column; }
        .oops-animated-btn { width: 100%; }
    }
    
    /* Footer Styles */
    .oops-animated-footer {
        margin-top: 60px;
        padding-top: 40px;
        border-top: 2px solid {{ $isDark ? '#334155' : '#e2e8f0' }};
        animation: oops-animated-slidein 0.8s ease-out 0.8s both;
    }
    .oops-animated-footer-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 32px;
        margin-bottom: 24px;
        text-align: left;
    }
    .oops-animated-footer-section { }
    .oops-animated-footer-title {
        font-size: 16px;
        font-weight: 700;
        color: {{ $isDark ? '#f1f5f9' : '#0f172a' }};
        margin: 0 0 12px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    .oops-animated-footer-menu {
        list-style: none;
        padding: 0;
        margin: 0;
        display: flex;
        flex-wrap: wrap;
        gap: 8px 16px;
    }
    .oops-animated-footer-menu-item { }
    .oops-animated-footer-link {
        color: {{ $isDark ? '#cbd5e1' : '#475569' }};
        text-decoration: none;
        font-size: 15px;
        transition: all 0.2s;
    }
    .oops-animated-footer-link:hover {
        color: #667eea;
        transform: translateX(3px);
    }
    .oops-animated-footer-contact { }
    .oops-animated-footer-contact-item { margin-bottom: 8px; }
    .oops-animated-footer-contact-label {
        font-weight: 700;
        color: {{ $isDark ? '#f1f5f9' : '#0f172a' }};
        font-size: 14px;
        display: block;
        margin-bottom: 4px;
    }
    .oops-animated-footer-contact-link {
        color: #667eea;
        text-decoration: none;
        font-size: 15px;
        transition: all 0.2s;
    }
    .oops-animated-footer-contact-link:hover {
        color: #764ba2;
        transform: translateX(3px);
    }
    .oops-animated-footer-contact-value {
        color: {{ $isDark ? '#cbd5e1' : '#475569' }};
        font-size: 15px;
    }
    .oops-animated-footer-social {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
    }
    .oops-animated-footer-social-link {
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
        position: relative;
        overflow: hidden;
    }
    .oops-animated-footer-social-link::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 0;
        height: 0;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.3);
        transform: translate(-50%, -50%);
        transition: width 0.6s, height 0.6s;
    }
    .oops-animated-footer-social-link:hover::before {
        width: 100px;
        height: 100px;
    }
    .oops-animated-footer-social-link:hover {
        transform: translateY(-3px) rotate(10deg);
        box-shadow: 0 10px 25px rgba(102, 126, 234, 0.4);
    }
    .oops-animated-footer-custom {
        color: {{ $isDark ? '#cbd5e1' : '#475569' }};
        font-size: 15px;
        line-height: 1.6;
    }
    .oops-animated-footer-copyright {
        padding-top: 24px;
        border-top: 2px solid {{ $isDark ? '#334155' : '#e2e8f0' }};
        text-align: center;
    }
    .oops-animated-footer-copyright-text {
        color: {{ $isDark ? '#cbd5e1' : '#475569' }};
        font-size: 14px;
        margin: 0;
    }
    @media (max-width: 640px) {
        .oops-animated-footer-grid { grid-template-columns: 1fr; gap: 24px; }
    }
</style>

<div class="oops-animated-container">
    <div class="oops-animated-shapes">
        <div class="oops-animated-shape"></div>
        <div class="oops-animated-shape"></div>
        <div class="oops-animated-shape"></div>
        <div class="oops-animated-shape"></div>
    </div>
    <div class="oops-animated-wrap">
    <div class="oops-animated-icon">
        <svg viewBox="0 0 120 120" fill="none" xmlns="http://www.w3.org/2000/svg">
            <circle cx="60" cy="60" r="50" stroke="#667eea" stroke-width="4" fill="none"/>
            <path d="M60 30 L60 70" stroke="#667eea" stroke-width="6" stroke-linecap="round"/>
            <circle cx="60" cy="85" r="4" fill="#667eea"/>
        </svg>
    </div>
    <div class="oops-animated-code">{{ $statusCode ?? 500 }}</div>
    <h1 class="oops-animated-title">{{ $title ?? 'Oops! Something went wrong' }}</h1>
    <p class="oops-animated-message">{{ $message ?? "Don't worry, we're on it! Please try again." }}</p>
    @if(isset($buttons) && count($buttons) > 0)
    <div class="oops-animated-actions">
        @foreach($buttons as $button)
        @php
            $url = $button['url'] ?? '/';
            if ($url === 'current' || $url === 'retry') $url = url()->current();
            elseif ($url === 'back') $url = url()->previous();
            $cls = ($button['style'] ?? 'primary') === 'secondary' ? 'oops-animated-btn oops-animated-btn-secondary' : 'oops-animated-btn oops-animated-btn-primary';
        @endphp
        <a class="{{ $cls }}" href="{{ $url }}">{{ $button['text'] ?? 'Go Back' }}</a>
        @endforeach
    </div>
    @else
    <div class="oops-animated-actions">
        <a class="oops-animated-btn oops-animated-btn-primary" href="{{ url('/') }}">Back to home</a>
        <a class="oops-animated-btn oops-animated-btn-secondary" href="{{ url()->current() }}">Retry</a>
    </div>
    @endif
    
    @include('oops-ui::partials.footer')
    </div>
</div>
