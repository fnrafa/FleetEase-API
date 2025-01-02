<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Models\Driver;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    public function index(): JsonResponse
    {
        $drivers = Driver::all();

        if ($drivers->isEmpty()) {
            return ResponseHelper::NotFound('No drivers found.');
        }

        return ResponseHelper::Success('Drivers fetched successfully.', $drivers);
    }

    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'license_number' => 'required|string|unique:drivers,license_number',
            'contact_number' => 'nullable|string|max:20',
        ]);

        $driver = Driver::create($request->all());

        return ResponseHelper::Success('Driver added successfully.', $driver);
    }

    public function update(Request $request, $id): JsonResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'license_number' => 'required|string|unique:drivers,license_number,' . $id,
            'contact_number' => 'nullable|string|max:20',
        ]);

        $driver = Driver::find($id);

        if (!$driver) {
            return ResponseHelper::NotFound('Driver not found.');
        }

        $driver->update($request->all());

        return ResponseHelper::Success('Driver updated successfully.', $driver);
    }

    public function destroy($id): JsonResponse
    {
        $driver = Driver::find($id);

        if (!$driver) {
            return ResponseHelper::NotFound('Driver not found.');
        }

        $driver->delete();

        return ResponseHelper::Success('Driver deleted successfully.');
    }
}
