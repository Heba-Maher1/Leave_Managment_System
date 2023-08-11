<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class EmployeeController extends Controller
{

    public function index()
    {
        $adminId = Auth::id();
        $employees = Employee::where('user_id', $adminId)->get();
        $success = session('success');
        return view('admin.employee.index' , compact('employees' , 'success'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string'],
            'email' => ['required', 'email'],
            'department' => ['required', 'string'],
            'job' => ['required', 'string'],
        ]);

        $request->merge([
            'password' => Str::random(10),
            'user_id' => Auth::id(),
        ]);

        Employee::create($request->all());

        return redirect()->route('employee.index')->with('success', 'Employee Created Successfully');
    }


    public function edit(Employee $employee)
    {
        return view('admin.employee.edit' , compact('employee'));
    }



    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'name' => ['required', 'string'],
            'email' => ['required', 'email'],
            'department' => ['required', 'string'],
            'job' => ['required', 'string'],
        ]);

        $request->merge([
            'password' => Str::random(10),
            'user_id' => Auth::id(),
        ]);

        $employee->update($request->all());

        return redirect()->route('employee.index' , compact('employee'))->with('success', 'Employee Updated Successfully');
    }


    public function destroy(Employee $employee)
    {
        $employee->delete();

        return back()->with('success', 'Employee Deleted Successfully');

    }
    
}
