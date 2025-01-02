<?php

namespace App\Http\Controllers;

use App\Helpers\AuthHelper;
use App\Helpers\ResponseHelper;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function updatePassword(Request $request): JsonResponse
    {
        $request->validate([
            'current_password' => 'required|string',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        $user = AuthHelper::getAuthenticatedUser();

        if (!Hash::check($request["current_password"], $user->password)) {
            return ResponseHelper::Unauthorized('Current password is incorrect.');
        }

        $user->password = Hash::make($request["new_password"]);
        $user->save();

        return ResponseHelper::Success('Password updated successfully.');
    }
}
