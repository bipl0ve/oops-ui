# Oops UI - Beautiful Error Pages for Laravel

<!-- [![Latest Version on Packagist](https://img.shields.io/packagist/v/biplove/oops-ui.svg?style=flat-square)](https://packagist.org/packages/biplove/oops-ui)
[![Total Downloads](https://img.shields.io/packagist/dt/biplove/oops-ui.svg?style=flat-square)](https://packagist.org/packages/biplove/oops-ui)
[![License](https://img.shields.io/packagist/l/biplove/oops-ui.svg?style=flat-square)](https://packagist.org/packages/biplove/oops-ui) -->

Beautiful, customizable error pages for Laravel applications with zero configuration required.


## About

Oops UI is a Laravel package that transforms your error pages into beautiful, professional-looking pages with minimal effort. It works out of the box with sensible defaults and offers extensive customization options through a simple configuration file.

## Features

- 🚀 **Zero Setup** - Works immediately after installation
- 🎨 **11 Beautiful Templates** - Modern, Minimal, Classic, Gradient, Illustration, Neon, Glass, Terminal, Animated, Split, and Layout
- 🌙 **Dark Mode Support** - All templates support both light and dark themes
- 📱 **Responsive Design** - Looks great on all devices
- 🎯 **App Layout Integration** - Wrap error pages in your existing application layout
- 📄 **Customizable Footer** - Add menu items, contact info, social links, and custom text
- 🔌 **API Support** - Automatically returns JSON for API requests and HTML for web requests
- 🌍 **Translation Ready** - Full localization support
- ♿ **Accessible** - WCAG compliant with semantic HTML
- 🔧 **Laravel 8-11 Compatible** - Works across multiple Laravel versions

## Requirements

- PHP 8.1 or higher
- Laravel 8.x, 9.x, 10.x, or 11.x

## Installation

Install the package via Composer:

```bash
composer require biplove/oops-ui
```

That's it! The package will automatically register and start working. Error pages will now use the beautiful default templates.

## Quick Start

### Publish Configuration (Optional)

If you want to customize the error pages, publish the configuration file:

```bash
php artisan oops:install
```

Or manually:

```bash
php artisan vendor:publish --tag=oops-ui-config
```

This will create a `config/oops-ui.php` file where you can customize everything.

### Basic Customization

Edit `config/oops-ui.php`:

```php
'settings' => [
    'default_template' => 'modern',  // Choose your template
    'theme' => 'dark',               // Enable dark mode
],

'errors' => [
    '404' => [
        'title' => 'Page Not Found',
        'message' => 'The page you are looking for does not exist.',
        'buttons' => [
            ['text' => 'Go Home', 'url' => '/', 'style' => 'primary'],
        ],
    ],
],
```

After making changes, clear the cache:

```bash
php artisan config:clear
```

## Documentation

For complete documentation including all features, configuration options, templates, and examples, please visit:

📚 **[Full Documentation](https://oopsui-docs.netlify.app/)**

## Testing

Run the test suite:

```bash
composer test
```

## Troubleshooting

If you encounter issues after installation:

```bash
php artisan config:clear
php artisan view:clear
php artisan cache:clear
composer dump-autoload
```

For more help, check the [documentation](https://oopsui-docs.netlify.app/).

## License

The MIT License (MIT). Please see [LICENSE](LICENSE) for more information.

## Support

- **Issues**: [GitHub Issues](https://github.com/bipl0ve/oops-ui/issues)
- **Documentation**: [Full Documentation](https://oopsui-docs.netlify.app/)
- **Source**: [GitHub Repository](https://github.com/bipl0ve/oops-ui)
