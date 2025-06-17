<?php

declare(strict_types=1);

use App\Livewire\Auth\Login;
use App\Models\User;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Livewire\Livewire;

it('can render the login component', function () {
    Livewire::test(Login::class)
        ->assertOk();
});

it('requires email to be provided', function () {
    Livewire::test(Login::class)
        ->set('email', '')
        ->set('password', 'password')
        ->call('login')
        ->assertHasErrors(['email' => 'required']);
});

it('requires email to be valid', function () {
    Livewire::test(Login::class)
        ->set('email', 'not-an-email')
        ->set('password', 'password')
        ->call('login')
        ->assertHasErrors(['email' => 'email']);
});

it('requires password to be provided', function () {
    Livewire::test(Login::class)
        ->set('email', 'test@example.com')
        ->set('password', '')
        ->call('login')
        ->assertHasErrors(['password' => 'required']);
});

it('can authenticate a user with correct credentials', function () {
    $user = User::factory()->create();

    Livewire::test(Login::class)
        ->set('email', $user->email)
        ->set('password', 'password')
        ->call('login')
        ->assertHasNoErrors()
        ->assertRedirect(route('home', absolute: false));

    $this->assertAuthenticated();
});

it('cannot authenticate a user with incorrect password', function () {
    $user = User::factory()->create();

    Livewire::test(Login::class)
        ->set('email', $user->email)
        ->set('password', 'wrong-password')
        ->call('login')
        ->assertHasErrors('email');

    $this->assertGuest();
});

it('remembers user when remember option is selected', function () {
    $user = User::factory()->create();

    Livewire::test(Login::class)
        ->set('email', $user->email)
        ->set('password', 'password')
        ->set('remember', true)
        ->call('login');

    $this->assertAuthenticatedAs($user);
    $this->assertNotNull($this->app['cookie']->getQueuedCookies()[0]);
});

it('shows throttle message after too many failed attempts', function () {
    $user = User::factory()->create();
    $email = $user->email;
    $ip = '127.0.0.1';

    // Set up the request IP
    $this->app['request']->server->set('REMOTE_ADDR', $ip);

    // Create the throttle key the same way the component does
    $throttleKey = Str::transliterate(Str::lower($email).'|'.$ip);

    // Clear rate limiter for this test
    RateLimiter::clear($throttleKey);

    // Expect the Lockout event to be dispatched
    Event::fake([Lockout::class]);

    // Manually hit the rate limiter to simulate 6 failed attempts (exceeding the 5 limit)
    for ($i = 0; $i < 6; $i++) {
        RateLimiter::hit($throttleKey);
    }

    // Verify that we've reached the limit
    $this->assertTrue(RateLimiter::tooManyAttempts($throttleKey, 5));

    // The next login attempt should show an error message on the email field
    Livewire::test(Login::class)
        ->set('email', $email)
        ->set('password', 'wrong-password')
        ->call('login')
        ->assertHasErrors(['email']);

    // Verify the Lockout event was dispatched
    Event::assertDispatched(Lockout::class);
});

it('clears rate limiter after successful login', function () {
    $user = User::factory()->create();
    $email = $user->email;

    // Clear rate limiter for this test
    $throttleKey = Str::transliterate(Str::lower($email).'|127.0.0.1');
    RateLimiter::clear($throttleKey);

    // Make a failed attempt to increment the counter
    try {
        Livewire::test(Login::class)
            ->set('email', $email)
            ->set('password', 'wrong-password')
            ->call('login');
    } catch (ValidationException $e) {
        // Expected exception
    }

    // Verify the rate limiter was incremented
    $this->assertEquals(1, RateLimiter::attempts($throttleKey));

    // Now login successfully
    Livewire::test(Login::class)
        ->set('email', $email)
        ->set('password', 'password')
        ->call('login');

    // Verify the rate limiter was cleared
    $this->assertEquals(0, RateLimiter::attempts($throttleKey));
});

it('generates the correct throttle key', function () {
    $email = 'test@example.com';
    $ip = '127.0.0.1';

    // Create a reflection of the Login class to access protected method
    $login = new Login();
    $reflection = new ReflectionClass($login);
    $method = $reflection->getMethod('throttleKey');
    $method->setAccessible(true);

    // Set the email property
    $emailProperty = $reflection->getProperty('email');
    $emailProperty->setAccessible(true);
    $emailProperty->setValue($login, $email);

    // Mock the request IP
    $this->app['request']->server->set('REMOTE_ADDR', $ip);

    // Call the throttleKey method
    $throttleKey = $method->invoke($login);

    // Verify the throttle key format
    $expectedKey = Str::transliterate(Str::lower($email).'|'.$ip);
    $this->assertEquals($expectedKey, $throttleKey);
});
