<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\LeaveRequest;
use App\Models\LeaveType;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redis;

class EmployeePageController extends Controller
{
    public function index()
    {
        $employeeId = Auth::guard('employee')->id(); // Get the authenticated employee's ID
        $requests = LeaveRequest::where('employee_id', $employeeId)->get();
        $leaveTypes = LeaveType::all();
    
        return view('employee.index', compact('requests', 'leaveTypes'));
    }


    public function loginForm()
    {
        $error = session('error');
        return view('employee.login', compact('error'));
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        // dd($credentials);
        if (Auth::guard('employee')->attempt($credentials)) {
            
            return redirect()->route('employee.dashboard')->with('success', 'Employee Login Successfully');

        } else {

            return back()->with('error', 'Invalid Email Or Password')->withInput();
        }
    }

    public function registerForm(){

        return view ('employee.register') ;
    }

    public function register(Request $request){

        Employee::insert([
            'name' => $request->input('name'),
            'department' => $request->input('department'),
            'job' => $request->input('job'),
            'email' => $request->input('email'),
            'password' =>Hash::make($request->password),
            "created_at" => Carbon::now(),
        ]);
        return redirect()->route('employee.dashboard')->with('success' , 'Employee Created Successfully');
    }
}
