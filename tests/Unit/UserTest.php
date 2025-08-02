<?php

declare(strict_types=1);

use App\Models\User;

test('user can be created with separated name fields', function (): void {
    $user = User::factory()->create([
        'first_name' => 'John',
        'middle_name' => 'Michael',
        'last_name' => 'Doe',
        'suffix' => 'Jr.',
    ]);

    expect($user->first_name)->toBe('John');
    expect($user->middle_name)->toBe('Michael');
    expect($user->last_name)->toBe('Doe');
    expect($user->suffix)->toBe('Jr.');
});

test('user can be created with only required name fields', function (): void {
    $user = User::factory()->create([
        'first_name' => 'Jane',
        'last_name' => 'Smith',
        'middle_name' => null,
        'suffix' => null,
    ]);

    expect($user->first_name)->toBe('Jane');
    expect($user->last_name)->toBe('Smith');
    expect($user->middle_name)->toBeNull();
    expect($user->suffix)->toBeNull();
});

test('user full_name accessor returns properly formatted name', function (): void {
    $user = User::factory()->create([
        'first_name' => 'John',
        'middle_name' => 'Michael',
        'last_name' => 'Doe',
        'suffix' => 'Jr.',
    ]);

    expect($user->full_name)->toBe('John Michael Doe Jr.');
});

test('user full_name accessor handles missing middle name and suffix', function (): void {
    $user = User::factory()->create([
        'first_name' => 'Jane',
        'last_name' => 'Smith',
        'middle_name' => null,
        'suffix' => null,
    ]);

    expect($user->full_name)->toBe('Jane Smith');
});

test('user full_name accessor handles only missing middle name', function (): void {
    $user = User::factory()->create([
        'first_name' => 'John',
        'middle_name' => null,
        'last_name' => 'Doe',
        'suffix' => 'Sr.',
    ]);

    expect($user->full_name)->toBe('John Doe Sr.');
});

test('user full_name accessor handles only missing suffix', function (): void {
    $user = User::factory()->create([
        'first_name' => 'John',
        'middle_name' => 'Michael',
        'last_name' => 'Doe',
        'suffix' => null,
    ]);

    expect($user->full_name)->toBe('John Michael Doe');
});

test('user initials method works with separated name fields', function (): void {
    $user = User::factory()->create([
        'first_name' => 'John',
        'middle_name' => 'Michael',
        'last_name' => 'Doe',
        'suffix' => 'Jr.',
    ]);

    expect($user->initials())->toBe('JD');
});
