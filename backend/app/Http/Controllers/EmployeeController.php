<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    // Render the main page view
    public function index() {
        return view('employees');
    }

    // Read: Return JSON API data for the table
    public function apiIndex() {
        return response()->json(Employee::all());
    }

    // Create: Store a new record
    public function store(Request $request) {
        $validated = $request->validate([
            'fname' => 'required|string|max:255',
            'mname' => 'nullable|string|max:255',
            'lname' => 'required|string|max:255',
        ]);

        $employee = Employee::create($validated);
        return response()->json(['message' => 'Created successfully', 'data' => $employee], 201);
    }

    // Update: Modify an existing record
    public function update(Request $request, Employee $employee) {
        $validated = $request->validate([
            'fname' => 'required|string|max:255',
            'mname' => 'nullable|string|max:255',
            'lname' => 'required|string|max:255',
        ]);

        $employee->update($validated);
        return response()->json(['message' => 'Updated successfully', 'data' => $employee]);
    }

    // Delete: Remove a record
    public function destroy(Employee $employee) {
        $employee->delete();
        return response()->json(['message' => 'Deleted successfully']);
    }
} 
