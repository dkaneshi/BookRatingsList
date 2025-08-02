# Technical Stack

> Last Updated: 2025-08-02
> Version: 1.0.0

## Application Framework

- **Framework:** Laravel
- **Version:** 12.x
- **PHP Version:** 8.2+

## Database

- **Primary Database:** SQLite
- **ORM:** Eloquent (Laravel's built-in ORM)
- **Migrations:** Laravel migration system

## JavaScript

- **Framework:** Livewire 3
- **Build Tool:** Vite
- **Real-time Updates:** Livewire's reactive components

## CSS Framework

- **Framework:** TailwindCSS
- **Version:** 4.0
- **UI Components:** Flux UI Pro

## Testing Framework

- **Primary Testing:** Pest
- **Test Types:** Feature tests, Unit tests
- **Coverage:** PHPUnit coverage reports

## Development Tools

- **Package Manager:** Composer (PHP), npm (JavaScript)
- **Version Control:** Git
- **Local Development:** Laravel Sail / Herd
- **Code Quality:** Laravel Pint (code formatting)

## Authentication & Security

- **Authentication:** Laravel Breeze/Fortify
- **Email Verification:** Built-in Laravel email verification
- **Password Reset:** Laravel's password reset functionality
- **Security:** Laravel's built-in security features (CSRF, XSS protection)

## Email System

- **Email Driver:** Configurable (SMTP, Mailgun, etc.)
- **Queue System:** Laravel queues for email processing
- **Templates:** Blade email templates

## File Storage

- **Storage:** Laravel filesystem (local/cloud configurable)
- **Asset Compilation:** Vite for asset bundling and optimization

## Deployment

- **Server Requirements:** PHP 8.2+, Composer, Node.js
- **Database:** SQLite (portable, zero-config)
- **Web Server:** Apache/Nginx compatible