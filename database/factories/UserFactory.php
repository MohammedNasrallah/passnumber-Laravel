<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
    ];
});

$messages = [
    'username.required' => 'Username is required.',
    'username.unique' => 'Username already exists.',
    // 'usermail.required' => 'You must provide a valid E-mail.', // Email validation message disabled
    // 'usermail.email' => 'You must provide a valid E-mail.', // Email validation message disabled
    'password.required' => 'Password is required.',
   // 'regularpass.required' => 'Regular password is required.',
];

$validator = Validator::make($request->all(), [
    'username' => 'required|min:4|max:32|unique:users,username',
    // 'usermail' => 'required|email|unique:users,email', // Email validation disabled
    'password' => 'required|min:4|max:4',
    //'regularpass' => 'required|min:8' // Email validation disabled
], $messages);

if ($validator->fails()) {
    return redirect()->back()->withErrors($validator)->withInput();
}

// Registration logic here

// Send notification for successful registration
// Your notification logic here
