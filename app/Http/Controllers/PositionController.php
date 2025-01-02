<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Models\Position;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    public function index(): JsonResponse
    {
        $positions = Position::all();

        if ($positions->isEmpty()) {
            return ResponseHelper::NotFound('No positions found.');
        }

        return ResponseHelper::Success('Positions fetched successfully.', $positions);
    }

    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'level' => 'required|integer',
            'parent_id' => 'nullable|exists:positions,id',
        ]);

        $position = Position::create($request->all());

        return ResponseHelper::Success('Position added successfully.', $position);
    }

    public function update(Request $request, $id): JsonResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'level' => 'required|integer',
            'parent_id' => 'nullable|exists:positions,id',
        ]);

        $position = Position::find($id);

        if (!$position) {
            return ResponseHelper::NotFound('Position not found.');
        }

        $position->update($request->all());

        return ResponseHelper::Success('Position updated successfully.', $position);
    }
}
