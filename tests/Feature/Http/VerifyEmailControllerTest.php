<?php

declare(strict_types=1);

use App\Models\User;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\URL;

it('redirects to home with verified parameter when email is already verified', function () {
    // Create a user with a verified email
    $user = User::factory()->create([
        'email_verified_at' => now(),
    ]);

    // Generate a signed URL
    $verificationUrl = URL::temporarySignedRoute(
        'verification.verify',
        now()->addMinutes(60),
        ['id' => $user->id, 'hash' => sha1($user->email)]
    );

    // Act as the user and visit the verification URL
    $response = $this->actingAs($user)->get($verificationUrl);

    // Assert the response
    $response->assertRedirect(route('home', absolute: false).'?verified=1');
});

it('marks email as verified and fires verified event when email is not verified', function () {
    // Create a user with an unverified email
    $user = User::factory()->create([
        'email_verified_at' => null,
    ]);

    // Listen for the Verified event
    Event::fake();

    // Generate a signed URL
    $verificationUrl = URL::temporarySignedRoute(
        'verification.verify',
        now()->addMinutes(60),
        ['id' => $user->id, 'hash' => sha1($user->email)]
    );

    // Act as the user and visit the verification URL
    $response = $this->actingAs($user)->get($verificationUrl);

    // Assert the response
    $response->assertRedirect(route('home', absolute: false).'?verified=1');

    // Refresh the user and check if the email is verified
    $user->refresh();
    expect($user->hasVerifiedEmail())->toBeTrue();

    // Assert that the Verified event was dispatched
    Event::assertDispatched(Verified::class, function ($event) use ($user) {
        return $event->user->is($user);
    });
});

it('handles invalid verification links', function () {
    // Create a user with an unverified email
    $user = User::factory()->create([
        'email_verified_at' => null,
    ]);

    // Generate an invalid signed URL (wrong hash)
    $invalidVerificationUrl = URL::temporarySignedRoute(
        'verification.verify',
        now()->addMinutes(60),
        ['id' => $user->id, 'hash' => 'invalid-hash']
    );

    // Act as the user and visit the invalid verification URL
    $response = $this->actingAs($user)->get($invalidVerificationUrl);

    // Assert the response is a 403 (forbidden)
    $response->assertStatus(403);

    // Refresh the user and check if the email is still unverified
    $user->refresh();
    expect($user->hasVerifiedEmail())->toBeFalse();
});

it('handles expired verification links', function () {
    // Create a user with an unverified email
    $user = User::factory()->create([
        'email_verified_at' => null,
    ]);

    // Generate an expired signed URL
    $expiredVerificationUrl = URL::temporarySignedRoute(
        'verification.verify',
        now()->subMinutes(60), // Expired 60 minutes ago
        ['id' => $user->id, 'hash' => sha1($user->email)]
    );

    // Act as the user and visit the expired verification URL
    $response = $this->actingAs($user)->get($expiredVerificationUrl);

    // Assert the response is a 403 (forbidden)
    $response->assertStatus(403);

    // Refresh the user and check if the email is still unverified
    $user->refresh();
    expect($user->hasVerifiedEmail())->toBeFalse();
});
