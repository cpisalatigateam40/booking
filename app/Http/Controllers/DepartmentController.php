<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index()
    {
        return view('department.index');
    }

    public function store(Request $request)
    {
        // ✅ Validate input
        $validated = $request->validate([
            'department' => 'required|string|max:255|unique:departments,department',
        ]);

        // ✅ Create new department
        $department = new Department();
        $department->department = $validated['department'];
        $department->save();

        // ✅ Redirect or return JSON (depending on your use case)
        return redirect()->back()->with('success', 'Departemen berhasil ditambahkan.');
        // Or if using AJAX:
        // return response()->json(['success' => true, 'data' => $department]);
    }
}
