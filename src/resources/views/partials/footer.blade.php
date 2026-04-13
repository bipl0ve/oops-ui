@php
    $footerConfig = $settings['footer'] ?? [];
    $showFooter = ($footerConfig['enabled'] ?? false) === true;
    
    if (!$showFooter) {
        return; // Don't render footer if not enabled
    }
    
    $companyName = $footerConfig['company_name'] ?? null;
    $copyrightText = $footerConfig['copyright_text'] ?? null;
    $showYear = $footerConfig['show_year'] ?? true;
    $menuItems = $footerConfig['menu_items'] ?? [];
    $socialLinks = $footerConfig['social_links'] ?? [];
    $contactInfo = $footerConfig['contact_info'] ?? [];
    $customText = $footerConfig['custom_text'] ?? null;
    
    // Replace {current_year} placeholder in copyright text
    if ($copyrightText) {
        $currentYear = date('Y');
        $copyrightText = str_replace('{current_year}', $currentYear, $copyrightText);
    }
    
    // Only show footer if user has configured actual content
    // Don't show if everything is empty/null
    $hasMenuItems = !empty($menuItems);
    $hasSocialLinks = !empty($socialLinks);
    $hasContactInfo = !empty($contactInfo);
    $hasCustomText = !empty($customText);
    $hasCopyright = !empty($copyrightText) || !empty($companyName);
    
    $hasAnyContent = $hasMenuItems || $hasSocialLinks || $hasContactInfo || $hasCustomText || $hasCopyright;
    
    if (!$hasAnyContent) {
        return; // Don't render footer if no content is configured
    }
    
    // Get template name for CSS class prefix
    $templateName = $template ?? 'layout';
    $prefix = 'oops-' . $templateName;
@endphp

<div class="{{ $prefix }}-footer">
    @if($hasMenuItems || $hasSocialLinks || $hasContactInfo || $hasCustomText)
    <div class="{{ $prefix }}-footer-grid">
        {{-- Menu Items Section - Only if items exist --}}
        @if($hasMenuItems)
        <div class="{{ $prefix }}-footer-section">
            <h4 class="{{ $prefix }}-footer-title">{{ $footerConfig['menu_title'] ?? 'Quick Links' }}</h4>
            <ul class="{{ $prefix }}-footer-menu">
                @foreach($menuItems as $item)
                    @if(isset($item['text']) && isset($item['url']))
                    <li class="{{ $prefix }}-footer-menu-item">
                        <a href="{{ $item['url'] }}" 
                           class="{{ $prefix }}-footer-link"
                           @if(($item['new_tab'] ?? false) === true) target="_blank" rel="noopener noreferrer" @endif>
                            {{ $item['text'] }}
                        </a>
                    </li>
                    @endif
                @endforeach
            </ul>
        </div>
        @endif
        
        {{-- Contact Information Section - Only if contact info exists --}}
        @if($hasContactInfo)
        <div class="{{ $prefix }}-footer-section">
            <h4 class="{{ $prefix }}-footer-title">{{ $footerConfig['contact_title'] ?? 'Contact Us' }}</h4>
            <div class="{{ $prefix }}-footer-contact">
                @if(isset($contactInfo['email']))
                <div class="{{ $prefix }}-footer-contact-item">
                    <span class="{{ $prefix }}-footer-contact-label">Email</span>
                    <a href="mailto:{{ $contactInfo['email'] }}" class="{{ $prefix }}-footer-contact-link">
                        {{ $contactInfo['email'] }}
                    </a>
                </div>
                @endif
                
                @if(isset($contactInfo['phone']))
                <div class="{{ $prefix }}-footer-contact-item">
                    <span class="{{ $prefix }}-footer-contact-label">Phone</span>
                    <a href="tel:{{ $contactInfo['phone'] }}" class="{{ $prefix }}-footer-contact-link">
                        {{ $contactInfo['phone'] }}
                    </a>
                </div>
                @endif
                
                @if(isset($contactInfo['address']))
                <div class="{{ $prefix }}-footer-contact-item">
                    <span class="{{ $prefix }}-footer-contact-label">Address</span>
                    <span class="{{ $prefix }}-footer-contact-value">{{ $contactInfo['address'] }}</span>
                </div>
                @endif
            </div>
        </div>
        @endif
        
        {{-- Social Links Section - Only if social links exist --}}
        @if($hasSocialLinks)
        <div class="{{ $prefix }}-footer-section">
            <h4 class="{{ $prefix }}-footer-title">{{ $footerConfig['social_title'] ?? 'Follow Us' }}</h4>
            <div class="{{ $prefix }}-footer-social">
                @foreach($socialLinks as $social)
                    @if(isset($social['platform']) && isset($social['url']))
                    <a href="{{ $social['url'] }}" 
                       class="{{ $prefix }}-footer-social-link" 
                       title="{{ ucfirst($social['platform']) }}"
                       target="_blank" 
                       rel="noopener noreferrer">
                        {{ strtoupper(substr($social['platform'], 0, 1)) }}
                    </a>
                    @endif
                @endforeach
            </div>
        </div>
        @endif
        
        {{-- Custom Text Section - Only if custom text exists --}}
        @if($hasCustomText)
        <div class="{{ $prefix }}-footer-section">
            <h4 class="{{ $prefix }}-footer-title">{{ $footerConfig['custom_title'] ?? 'About' }}</h4>
            <div class="{{ $prefix }}-footer-custom">
                {!! nl2br(e($customText)) !!}
            </div>
        </div>
        @endif
    </div>
    @endif
    
    {{-- Copyright Section - Only if copyright text or company name is set --}}
    @if($hasCopyright)
    <div class="{{ $prefix }}-footer-copyright">
        <p class="{{ $prefix }}-footer-copyright-text">
            @if($copyrightText)
                {{-- Use custom copyright text (with year placeholders already replaced) --}}
                {{ $copyrightText }}
            @elseif($companyName)
                {{-- Use default format only if company name is set --}}
                &copy; @if($showYear){{ date('Y') }}@endif {{ $companyName }}. All rights reserved.
            @endif
        </p>
    </div>
    @endif
</div>
