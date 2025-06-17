You are an expert in PHP, Laravel, Livewire, Alpine.js, Flux, and Tailwind CSS

I. Coding Standards
* Use PHP v8.3 features
* Follow pint.json coding rules
* Enforce strict types and array shapes via PHPStan.

II. Project Structure and Architecture
* Delete .gitkeep when adding a file.
* Stick to the existing structure —no new folders.
* Avoid DB::; use Model::query only.
* No dependency changes without approval
* Dependencies
  * Laravel 12 (latest stable version)
  * Livewire 3.5+ for real-time, reactive components
  * Alpine.js for lightweight JavaScript interactions
  * Tailwind CSS for utility-first styling
  * Flux for pre-built UI components and themes
  * Composer for dependency management
  * NPM/Yarn for frontend dependencies

III. Directory Conventions
* app/Http/Controllers
    * No abstract/base controllers
* app/Http/Requests
    * Use FormRequest for validation
    * Name with Create, Update, Delete
* app/Actions
    * Use Actions pattern and name verbs.
    * Example:
      ```php
      public function store(CreateTodoRequest $request, CreateTodoAction $action)
      {
          $user = $request->user();
   
          $action->handle($user, $request->validated());
      }
      ```
* app/Models
    * Avoid fillable
* database/migrations
    * Omit down() in new migrations.

IV. Testing
* Use Pest PHP for all tests.
    * Use the ```it()``` function over the ```test()``` function
    * Use the expectation API when possible.
* Run ```composer lint``` after changes
* Run ```composer test``` before finalizing.
* Don't remove tests without approval.
* All code must be tested.
* Generate a {Model}Factory with each model.
* Test Directory Structure
    * Console: tests/Feature/Console
    * Controllers: tests/Feature/Http
    * Actions: tests/Unit/Actions
    * Models: tests/Unit/Models
    * Jobs: test/Unit/Jobs

V. Styling & UI
* Use Flux components when possible
* Use Tailwind CSS for styling components, following a utility-first approach.
* Follow a consistent design language using Tailwind CSS classes and Flux themes.
* Implement responsive design and dark mode using Tailwind and Flux utilities.
* Optimize for accessibility (e.g., aria-attributes) when using components.
* Keep UI minimal

VI. Task Completion Requirements
* Recompile assets after frontend changes.
* Follow all rules before marking tasks complete.

VII. Laravel Best Practices
* Use Eloquent ORM instead of raw SQL queries when possible.
* Implement Repository pattern for data access layer.
* Use Laravel's built-in authentication and authorization features.
* Use Laravel's caching mechanisms for improved performance.
* Implement job queues for long-running tasks.
* Use Pest PHP for unit and feature tests.
  * Use the `it()` function over the `test()` function
  * Use the Pest expectation API when possible.
* Implement API versioning for public APIs.
* Use Laravel's localization features for multi-language support.
* Implement proper CSRF protection and security measures.
* Use Laravel Mix or Vite for asset compilation.
* Implement proper database indexing for improved query performance.
* Use Laravel's built-in pagination features.
* Implement proper error logging and monitoring.
* Implement proper database transactions for data integrity.
* Use Livewire components to break down complex UIs into smaller, reusable units.
* Use Laravel's event and listener system for decoupled code.
* Implement Laravel's built-in scheduling features for recurring tasks.

VIII. Essential Guidelines and Best Practices
* Follow Laravel's MVC and component-based architecture.
* Use Laravel's routing system for defining application endpoints.
* Implement proper request validation using Form Requests.
* Use Livewire and Blade components for interactive UIs.
* Implement proper database relationships using Eloquent.
* Use Laravel's built-in authentication scaffolding.
* Implement proper API resource transformations.
* Use Laravel's event and listener system for decoupled code.
* Use Tailwind CSS and Flux for consistent and efficient styling.
* Implement complex UI patterns using Livewire and Alpine.js._
