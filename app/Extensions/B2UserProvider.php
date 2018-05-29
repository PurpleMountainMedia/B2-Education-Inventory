<?php

namespace App\Extensions;

use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Contracts\Auth\Authenticatable;
use Socialite;
use Auth;
use Illuminate\Auth\AuthenticationException;

class B2UserProvider implements UserProvider
{
    public function retrieveById($identifier)
    {
        try {
            return Socialite::driver('b2systems')->userFromToken($identifier);
        } catch (AuthenticationException $e) {
            return null;
        }
    }

    public function retrieveByToken($identifier, $token)
    {
        try {
            return Socialite::driver('b2systems')->userFromToken($identifier);
        } catch (AuthenticationException $e) {
            return null;
        }
    }

    public function updateRememberToken(Authenticatable $user, $token)
    {
        return null;
    }

    public function retrieveByCredentials(array $credentials)
    {
        return null;
    }

    public function validateCredentials(Authenticatable $user, array $credentials)
    {
        return null;
    }
}
