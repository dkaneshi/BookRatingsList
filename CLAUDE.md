# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Tech Stack

- **Laravel 12** with **PHP 8.2+**
- **Livewire 3** with **Volt** for reactive components
- **Flux UI Pro** for premium UI components
- **SQLite** database (file: `database/database.sqlite`)
- **Vite** for frontend build
- **Tailwind CSS 4** for styling

## Essential Commands

### Development
```bash
# Start all development services (recommended)
composer dev

# Run individual services
php artisan serve          # Laravel dev server
php artisan queue:listen   # Queue worker
php artisan pail          # Real-time logs
npm run dev               # Vite with hot reload
```

### Testing
```bash
# Run full test suite with coverage
composer test

# Run specific test types
composer test:unit        # Unit tests only (75% min coverage)
php artisan test --filter=BookListTest  # Run specific test
php artisan test Feature/Livewire       # Run test directory
```

### Code Quality
```bash
# Run all linting/formatting
composer lint

# Individual tools
composer test:lint        # Code style (Pint)
composer test:types       # Static analysis (PHPStan)
composer test:typos       # Spell checking (Peck)
```

### Database
```bash
php artisan migrate              # Run migrations
php artisan migrate:fresh --seed # Reset DB with seeds
```

## Architecture Overview

### Livewire Components Pattern
The app uses Livewire components as the primary application layer:
- **Components**: `app/Livewire/` - Main business logic
- **Forms**: `app/Livewire/Forms/` - Form objects with validation
- **Actions**: `app/Livewire/Actions/` - Reusable business logic

Example pattern:
```php
// Component: app/Livewire/CreateBook.php
class CreateBook extends Component {
    public BookForm $form;
    
    public function save(InsertBookAction $action): void {
        $this->validate();
        $action->handle($this->form);
        $this->redirect('/books', navigate: true);
    }
}

// Form: app/Livewire/Forms/BookForm.php
class BookForm extends Form {
    #[Required]
    public string $title = '';
    // ... validation rules
}

// Action: app/Livewire/Actions/InsertBookAction.php
class InsertBookAction {
    public function handle(BookForm $form): void {
        Book::create($form->all());
    }
}
```

### Testing with Pest
Tests use Pest PHP with Livewire testing helpers:
```php
it('can delete a book when authenticated', function () {
    $user = User::factory()->create();
    $book = Book::factory()->create();
    
    Livewire::actingAs($user)
        ->test(BookList::class)
        ->call('delete', $book)
        ->assertOk();
        
    $this->assertDatabaseMissing('books', ['id' => $book->id]);
});
```

### Key Models
- **User**: Standard Laravel auth with separated first_name/last_name
- **Book**: Main entity with title, author, isbn, published_at, rating

### Flux UI Components
Located in `resources/views/flux/` - custom wrappers around Flux UI Pro components. Always check existing patterns before creating new UI elements.

## Important Notes

- Always use `navigate: true` for Livewire redirects to enable SPA-like navigation
- Run `composer lint` before committing to ensure code quality
- Test coverage minimum is 75% - new features must include tests
- Database is SQLite - use appropriate syntax for queries
- Flux UI Pro is a premium library - components are in `resources/views/flux/`