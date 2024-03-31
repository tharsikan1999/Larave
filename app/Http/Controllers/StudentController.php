<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Students;

use function Pest\Laravel\get;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    // Fetch paginated students data
    $students = Students::orderBy('id', 'desc')->paginate(7); // Assuming 10 students per page

    // Pass the paginated data to the Vue component
    return inertia('Students', [
        'students' => $students->items(),
        'currentPage' => $students->currentPage(),
        'lastPage' => $students->lastPage(),
    ]);
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('Student/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'email' => 'required|email',
            'firstname' => 'required', // Corrected field name
            'lastname' => 'required',
            'age' => 'required|numeric',
            'status' => 'required',
        ]);
        // Extract the attributes from the request
        $attributes = [
            'email' => $request->input('email'),
            'firstname' => $request->input('firstname'), // Corrected field name
            'lastname' => $request->input('lastname'),
            'age' => $request->input('age'),
            'status' => $request->input('status'),
        ];
    
        // Create a new student record with the extracted attributes
        Students::create($attributes);
    
        return redirect()->route('students.index')->with('success', 'Student created successfully');
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
    public function edit(Students $Student)
    {
        $student = Students::find($Student->id);
        
        return inertia('Student/Edit', ['student' => $student]);
        
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Students $Student)
    {
        // Validate the request data
        $request->validate([
            'email' => 'required|email ',
            'firstname' => 'required', // Corrected field name
            'lastname' => 'required',
            'age' => 'required|numeric | min:1  | max:100',
            'status' => 'required',
        ]);
        

        $data = $request->all();

        if($Student->update($data)){
            
            return redirect()->route('students.index')->with('success', 'Student updated successfully');
        }
        else{
            dd('Student not updated');
        }
        
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Students $Students)
    {
        $Students->delete();

        return redirect()->route('students.index')->with('success', 'Student deleted successfully');

    }
}
