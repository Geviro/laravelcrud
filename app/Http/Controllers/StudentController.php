<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Student::all();
        return view('students.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('students.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'name' => 'required|string|min:3|max:255',
            'age' => 'required|integer|min:1',
        ]);

        // Crear un nuevo estudiante usando el método `create` del modelo
        Student::create($request->all());

        // Redireccionar a la vista de listado de estudiantes
        return redirect()->route('students.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Búsqueda del Estudiante por ID
        $student = Student::findOrFail($id);

        // Retorno de la Vista de Edición
        return view('students.edit', compact('student'));        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validar los datos del formulario
        $request->validate([
            'name' => 'required|string|min:3|max:255',
            'age' => 'required|integer|min:1',
        ]);

        // Buscar el estudiante por su ID
        $student = Student::findOrFail($id);

        // Actualizar los datos del estudiante
        $student->update($request->all());

        // Redireccionar a la vista de listado de estudiantes
        return redirect()->route('students.index');        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Búsqueda del Estudiante por ID
        $student = Student::findOrFail($id);

        // Eliminación del Estudiante:
        $student->delete();

        // Redirección a la Vista de Listado de Estudiantes
        return redirect()->route('students.index');
    }
}
