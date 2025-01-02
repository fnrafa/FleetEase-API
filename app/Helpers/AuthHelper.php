<?php

namespace App\Helpers;

use App\Models\User;

class AuthHelper
{
    public static function getAuthenticatedUser(): User
    {
        $user = Auth()->user();
        if (!($user instanceof User)) {
            abort(ResponseHelper::Forbidden());
        }
        return $user;
    }
}
