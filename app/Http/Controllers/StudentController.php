<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        return response()->json([
            'message' => 'Success',
            'data' => Student::all()
        ]);
    }

    public function show($id)
    {
        $student = Student::find($id);

        if (!$student) {
            return response()->json(['message' => 'Not found'], 404);
        }

        return response()->json([
            'message' => 'Success',
            'data' => $student
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'nim' => 'required',
            'email' => 'required|email',
            'age' => 'required|integer|min:1'
        ]);

        $student = Student::create($request->all());

        return response()->json([
            'message' => 'Student created',
            'data' => $student
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $student = Student::find($id);

        if (!$student) {
            return response()->json(['message' => 'Not found'], 404);
        }

        $request->validate([
            'name' => 'required',
            'nim' => 'required',
            'email' => 'required|email',
            'age' => 'required|integer|min:1'
        ]);

        $student->update($request->all());

        return response()->json([
            'message' => 'Student updated',
            'data' => $student
        ]);
    }

    public function destroy($id)
    {
        $student = Student::find($id);

        if (!$student) {
            return response()->json(['message' => 'Not found'], 404);
        }

        $student->delete();

        return response()->json([
            'message' => 'Student deleted'
        ]);
    }
}