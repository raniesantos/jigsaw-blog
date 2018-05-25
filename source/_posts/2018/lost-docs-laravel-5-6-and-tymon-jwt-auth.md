---
title: 'Lost Docs: Laravel 5.6 and tymon/jwt-auth'
date: '2018-05-26'
tags:
  - authentication
  - laravel
comments: true
---
This post will show you how to use `tymon/jwt-auth` with Laravel. I decided to make this post because the docs for this package are still somewhat incomplete and a lot of people are struggling to use it.

Important notes before continuing:

- I will be using these specific versions: Laravel **5.6** and tymon/jwt-auth **1.0.0-rc.2**.
- This post will not cover usage with Lumen.
- This post will only cover the backend setup.
- This post assumes that you know your way around Laravel so I won't be adding explanations to the parts I consider to be basic or common knowledge in Laravel.

## Installation and Congifuration

### Install with Composer

```shell
$ composer require tymon/jwt-auth
```

**NOTE:** Since I'm using Laravel 5.6, I skipped the service provider step.

### Publish the Config File

```shell
$ php artisan vendor:publish --provider="Tymon\JWTAuth\Providers\LaravelServiceProvider"
```

### Generate the JWT Secret Key

```shell
$ php artisan jwt:secret
```

### User Model

Implement the `JWTSubject` contract and then add the methods `getJWTIdentifier()` and `getJWTCustomClaims()`.

```php
<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject; // 'use' the contract

// implement it
class User extends Authenticatable implements JWTSubject
{
    // default user model code

    // add these 2 methods
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}
```

### Changes to config/auth.php

```php
'defaults' => [
    // change 'web' to 'api'
    'guard' => 'api',
    'passwords' => 'users',
],

'guards' => [
    'web' => [
        'driver' => 'session',
        'provider' => 'users',
    ],

    'api' => [
        // change 'token' to 'jwt'
        'driver' => 'jwt',
        'provider' => 'users',
    ],
],
```

## Usage

This is the part where I diverge from the docs. Instead of defining a new controller, I will override and add methods to the already existing controllers in `app/Http/Controllers/Auth`.

Diving into the inner working of these controllers and the traits that they use was a *journey* like no other. It's not necessary, but I suggest you do the same if you want to have a better understanding of why and how the code I will show you works.

Go to `vendor/laravel/framework/src/Illuminate/Foundation/Auth` to find the traits I mentioned.

### User Registration

I'll start with registration first because it's the most straightforward and I won't be using the trait.

Quick note, JWT authentication doesn't have any use for 'remember me' tokens so you should remove them from the default migrations.

To start, wipe `routes/api.php` clean and then add the code below.

```php
<?php

Route::namespace('Auth')->group(function () {
    Route::post('/register', 'RegisterController@register');

    // other routes will be added here later
});
```

Now for the controller.

First, remove the `Validator` facade and `RegistersUsers` trait. Next, remove everything in the controller except the constructor. Then, override the `register` method.

```php
<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function register()
    {
        $data = request()->validate([
            // add your rules here
        ]);

        $data['password'] = Hash::make($data['password']);

        $user = User::create($data);

        $token = auth()->attempt(request()->only(['email', 'password']));

        $message = 'Your account has been created.';

        return response()->json(compact('token', 'user', 'message'));
    }
}
```

RegisterController notes:

- I used the new validation style that was introduced in Laravel 5.5. It returns the validated data so you can pass it directly into Eloquent's `create` or `update` method.
- I made sure to hash the password before passing it into the create method.
- I immediately generate a token for the new user so I can include it in the response. This is convenient because you can configure your frontend to immediately log the user in after registration.

### User Login

Add these routes inside the route group that was defined earlier.

```php
Route::post('/login', 'LoginController@login');

Route::post('/logout', 'LoginController@logout');
```

Then modify the controller.

```php
<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    private $token;

    public function __construct()
    {
        $this->middleware('guest')->only('login');
        $this->middleware('jwt.auth')->only('logout');
    }

    protected function attemptLogin(Request $request)
    {
        $this->token = auth()->attempt($this->credentials($request));
        return (bool) $this->token;
    }

    protected function sendLoginResponse(Request $request)
    {
        return response()->json([
            'token' => $this->token,
            'user' => auth()->user(),
            'message' => 'You are now signed in.',
        ]);
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        return response()->json(['message' => trans('auth.failed')], 422);
    }

    public function logout()
    {
        auth()->logout();
        return response()->json(['message' => 'You have been signed out.']);
    }
}
```

LoginController notes:

- The `jwt.auth` middleware on the logout method is intentional. This is because an expired token can't be invalidated. The scenario here is that if you logout with an expired token, the middleware will reject the request, the token should be refreshed, and only then will the token be properly invalidated. Feel free to come up with a different implementation if this doesn't sit well with you and share it with me in the comments.
- All of the methods I added here are overrides for methods in the `AuthenticatesUsers` trait.

### Token Handling

Create a separate controller specifically for token manipulation. This controller will be responsible for refreshing the token and returning the user from the token.

```shell
$ php artisan make:controller Auth/TokenController
```

Add these routes.

```php
Route::get('/refresh', 'TokenController@refresh');

Route::get('/user', 'TokenController@toUser');
```

Add the controller code.

```php
<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

class TokenController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->only('refresh');
        $this->middleware('jwt.auth')->only('toUser');
    }

    public function refresh()
    {
        return response()->json(['token' => auth()->refresh()]);
    }

    public function toUser()
    {
        return auth()->user();
    }
}
```
