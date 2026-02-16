# Laravel Content Distribution Platform

A modern Laravel application for managing and distributing video content, built with Livewire and Flux UI components.

## Features

- **Content Management**: Organize videos, movies, and series
- **Category System**: Flexible categorization with tags
- **Project Management**: Track content projects with metadata
- **Multi-language Support**: Subtitles and dubbing management
- **Episode Tracking**: Manage series episodes and seasons
- **Trailer Support**: Multiple trailer uploads per content
- **Quality Control**: Track video quality and technical specifications
- **Metadata Rich**: Store director, cast, year, country, genre information

## Tech Stack

- **Backend**: Laravel 12.x with PHP 8.2+
- **Frontend**: Livewire with Volt and Flux UI
- **Database**: SQLite (default), MySQL/PostgreSQL supported
- **Testing**: Pest PHP for unit and feature tests
- **Build Tools**: Vite for asset compilation

## Requirements

- PHP 8.2 or higher
- Composer
- Node.js & NPM
- SQLite/MySQL/PostgreSQL

## Installation

1. Clone the repository:
```bash
git clone https://github.com/stukenov/laravel-content-distribution.git
cd laravel-content-distribution
```

2. Install PHP dependencies:
```bash
composer install
```

3. Install JavaScript dependencies:
```bash
npm install
```

4. Copy the environment file:
```bash
cp .env.example .env
```

5. Generate application key:
```bash
php artisan key:generate
```

6. Create database file (for SQLite):
```bash
touch database/database.sqlite
```

7. Run migrations:
```bash
php artisan migrate
```

8. Build frontend assets:
```bash
npm run build
```

## Development

Start the development server:
```bash
php artisan serve
```

Watch for frontend changes:
```bash
npm run dev
```

Run with queue and Vite concurrently:
```bash
composer dev
```

## Database Schema

### Projects Table
- Content metadata (title, description, author)
- Media files (images, trailers, episodes)
- Technical details (quality, year, country)
- Localization (subtitles, dubbing)
- Categorization via relationships

### Categories Table
- Hierarchical content categories
- Slug-based URLs

### Tags Table
- Flexible tagging system
- Many-to-many with projects

## Testing

Run tests with Pest:
```bash
php artisan test
```

With coverage:
```bash
php artisan test --coverage
```

## Configuration

### Database
Edit `.env` to configure your database:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=content_distribution
DB_USERNAME=root
DB_PASSWORD=
```

### Storage
Configure filesystem for media storage in `config/filesystems.php`.

## Project Structure

```
app/
├── Models/
│   ├── Projects.php    # Content projects
│   ├── Category.php    # Categories
│   └── Tag.php         # Tags
resources/
├── views/              # Blade templates
└── js/                 # Frontend assets
database/
├── migrations/         # Database migrations
└── seeders/           # Database seeders
```

## API (Future)

This platform is designed to serve as a content distribution backend. API endpoints can be added for:
- Content listing and filtering
- Category browsing
- Search functionality
- Metadata retrieval

## Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## Author

Copyright (c) 2025 Saken Tukenov

## Acknowledgments

- Built with [Laravel](https://laravel.com/)
- UI powered by [Livewire](https://livewire.laravel.com/) and [Flux](https://flux.laravel.com/)
- Testing with [Pest PHP](https://pestphp.com/)
