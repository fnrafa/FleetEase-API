<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Models\Vehicle;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    public function index(): JsonResponse
    {
        $vehicles = Vehicle::all();

        if ($vehicles->isEmpty()) {
            return ResponseHelper::NotFound('No vehicles found.');
        }

        return ResponseHelper::Success('Vehicles fetched successfully.', $vehicles);
    }

    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'license_plate' => 'required|string|unique:vehicles,license_plate|max:20',
            'type' => 'required|in:passenger,cargo',
            'ownership' => 'required|in:company,rental',
            'rental_company' => 'nullable|string|max:255',
            'fuel_efficiency' => 'nullable|string|max:50',
            'next_service_date' => 'nullable|date',
        ]);

        $vehicle = Vehicle::create($request->all());

        return ResponseHelper::Success('Vehicle added successfully.', $vehicle);
    }

    public function update(Request $request, $id): JsonResponse
    {
        $request->validate([
            'license_plate' => 'required|string|unique:vehicles,license_plate,' . $id . '|max:20',
            'type' => 'required|in:passenger,cargo',
            'ownership' => 'required|in:company,rental',
            'rental_company' => 'nullable|string|max:255',
            'fuel_efficiency' => 'nullable|string|max:50',
            'next_service_date' => 'nullable|date',
        ]);

        $vehicle = Vehicle::find($id);

        if (!$vehicle) {
            return ResponseHelper::NotFound('Vehicle not found.');
        }

        $vehicle->update($request->all());

        return ResponseHelper::Success('Vehicle updated successfully.', $vehicle);
    }

    public function destroy($id): JsonResponse
    {
        $vehicle = Vehicle::find($id);

        if (!$vehicle) {
            return ResponseHelper::NotFound('Vehicle not found.');
        }

        $vehicle->delete();

        return ResponseHelper::Success('Vehicle deleted successfully.');
    }
}

