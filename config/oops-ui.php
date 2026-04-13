<?php

return [

    /*
    |--------------------------------------------------------------------------
    | API Response Mode
    |--------------------------------------------------------------------------
    |
    | Controls how errors are returned for API requests.
    | Options: 'auto' (default), 'json', 'html'
    |
    */

    'api_error_mode' => 'auto',

    /*
    |--------------------------------------------------------------------------
    | API Base Path
    |--------------------------------------------------------------------------
    |
    | The base path used to detect API requests.
    | Default: null (uses Laravel's 'api' prefix)
    | Examples: null, '', 'api/v1', 'rest'
    |
    */

    'api_base_path' => null,

    /*
    |--------------------------------------------------------------------------
    | Global Settings
    |--------------------------------------------------------------------------
    */

    'settings' => [

        /*
        | Default Template
        | Available: layout, modern, minimal, classic, gradient, illustration,
        |            neon, glass, terminal, animated, split
        */
        'default_template' => 'layout',

        /*
        | App Layout
        | Your Blade layout file to wrap error pages (e.g., 'layouts.app')
        | Set to null for standalone full HTML error pages
        */
        'app_layout' => null,

        /*
        | App Layout Section
        | The section name where error content will be injected
        | Must match @oopsError('section_name') in your layout
        */
        'app_layout_section' => null,

        /*
        | Theme
        | Options: 'light' or 'dark'
        */
        'theme' => 'light',

        /*
        | Layout
        | Currently only 'centered' is supported
        */
        'layout' => 'centered',

        /*
        | Color Scheme (for 'layout' template)
        */
        'colors' => [
            'background' => '#f8fafc',
            'card' => '#ffffff',
            'text' => '#0f172a',
            'muted' => '#475569',
            'border' => '#e2e8f0',
            'accent' => '#0f766e',
            'accent_soft' => '#ccfbf1',
        ],

        /*
        | Typography (for 'layout' template)
        */
        'typography' => [
            'font_family' => '"Segoe UI", Tahoma, Geneva, Verdana, sans-serif',
            'title_size' => '30px',
            'message_size' => '16px',
        ],

        /*
        | Card Settings (for 'layout' template)
        */
        'card' => [
            'max_width' => '640px',
            'padding' => '28px',
            'border_radius' => '16px',
        ],

        /*
        | Footer Configuration
        */
        'footer' => [
            'enabled' => false,
            'company_name' => null,
            'copyright_text' => null,  // Use {current_year} for automatic year
            'show_year' => true,
            'menu_items' => [],
            'menu_title' => 'Quick Links',
            'contact_info' => [],
            'contact_title' => 'Contact Us',
            'social_links' => [],
            'social_title' => 'Follow Us',
            'custom_text' => null,
            'custom_title' => 'About',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Error Page Paths
    |--------------------------------------------------------------------------
    |
    | Specify custom Blade view paths for specific error codes.
    | Use 'default' to check for Laravel's default error views first.
    |
    */

    'error_pages' => [
        // '404' => 'errors.my-custom-404',
        // '500' => 'default',
    ],

    /*
    |--------------------------------------------------------------------------
    | Error Page Configurations
    |--------------------------------------------------------------------------
    |
    | Customize individual error pages by status code.
    | Available fields: template, title, message, buttons, image
    |
    */

    'errors' => [
        
        // Example configuration:
        // '404' => [
        //     'template' => 'modern',  // Optional: Override default_template
        //     'title' => 'Page Not Found',
        //     'message' => 'The page you are looking for does not exist.',
        //     'buttons' => [
        //         ['text' => 'Go Home', 'url' => '/', 'style' => 'primary'],
        //         ['text' => 'Contact Support', 'url' => '/support', 'style' => 'secondary'],
        //     ],
        //     'image' => [
        //         'url' => '/images/404.svg',
        //         'alt' => 'Page not found illustration',
        //     ],
        // ],

    ],

];
