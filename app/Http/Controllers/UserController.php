<?php

namespace App\Http\Controllers;

use App\Helpers\AuthHelper;
use App\Helpers\ResponseHelper;
use App\Models\User;
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

    public function index(): JsonResponse
    {
        $users = User::with('position')->get();

        if ($users->isEmpty()) {
            return ResponseHelper::NotFound('No users found.');
        }

        return ResponseHelper::Success('Users fetched successfully.', $users);
    }

    public function show($id): JsonResponse
    {
        $user = User::with([
            'position',
            'position.parent',
            'position.children',
        ])->find($id);

        if (!$user) {
            return ResponseHelper::NotFound('User not found.');
        }

        $parent = User::whereHas('position', function ($query) use ($user) {
            $query->where('id', optional($user["position"])->parent_id);
        })->with('position')->first();

        $children = User::whereHas('position', function ($query) use ($user) {
            $query->where('parent_id', optional($user["position"])->id);
        })->with('position')->get();

        return ResponseHelper::Success('User details fetched successfully.', [
            'user' => $user,
            'parent' => $parent ?: 'No parent found',
            'children' => $children->isEmpty() ? 'No children found' : $children,
        ]);
    }

    public function updatePosition(Request $request, $id): JsonResponse
    {
        $request->validate([
            'position_id' => 'required|exists:positions,id',
        ]);

        $user = User::find($id);

        if (!$user) {
            return ResponseHelper::NotFound('User not found.');
        }

        if ($user->role !== 'approver') {
            return ResponseHelper::Unauthorized('Only approvers can have their position updated.');
        }

        $user->position_id = $request->input('position_id');
        $user->save();

        return ResponseHelper::Success('User position updated successfully.', $user);
    }
}
