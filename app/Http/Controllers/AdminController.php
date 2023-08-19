<?php

namespace App\Http\Controllers;

use App\Models\LeaveRequest;
use App\Models\LeaveType;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redis;

class AdminController extends Controller
{
    public function dashboard()
    {
        $adminId = Auth::id();
        $employees = User::where('id', $adminId)->get();
        $requests = LeaveRequest::all();
        $success = session('success');
        return view('admin.dashboard' , compact('employees' , 'requests', 'success'));
    }

    public function showEmployee()
    {
        $adminId = Auth::id();
        $employees = User::where('role','=','employee')->get();
        $success = session('success');
        return view('admin.employee.index' , compact('employees' , 'success'));
    }

    public function createEmployee(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string'],
            'email' => ['required', 'email', 'unique:users'],
            'department' => ['required', 'string'],
            'job' => ['required', 'string'],
            'password' => ['required', 'string', 'min:8'], // Add validation for password
        ]);
    
        $adminId = auth()->user()->id; // Get the ID of the logged-in admin

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'department' => $request->input('department'),
            'job' => $request->input('job'),
            'password' => Hash::make($request->input('password')), // Hash the password
            'role' => 'employee', // Set the default role
            'email_verified_at' => now(), // Set email_verified_at if necessary
            'created_by' => $adminId, // Set the created_by value
        ]);
    
        return redirect()->route('admin.employee')->with('success', 'Employee Created Successfully');
    }

    public function editEmployee(User $employee)
    {

        if ($employee->created_by !== Auth::id()) {
            return redirect()->route('admin.employee')->with('errors' , 'Unauthorized action.');
        }

        return view('admin.employee.edit' , compact('employee'));
    }

    public function updateEmployee(Request $request, User $employee)
    {
        $request->validate([
            'name' => ['required', 'string'],
            'email' => ['required', 'email'],
            'department' => ['required', 'string'],
            'job' => ['required', 'string'],
            'password' => ['required'],
        ]);

        $request->merge([
            'user_id' => Auth::id(),
        ]);

        $employee->update($request->all());

        return redirect()->route('admin.employee' , compact('employee'))->with('success', 'Employee Updated Successfully'); 
    }

    public function destroyEmployee (User $employee)
    {
        if ($employee->created_by !== Auth::id()) {
            return redirect()->route('admin.employee')->with('errors' , 'Unauthorized action.');
        }

        $employee->delete();

        return back()->with('success', 'Employee Deleted Successfully');
    }
    public function trashedEmployee ()
    {
        $employees = User::onlyTrashed()->latest('deleted_at')->get();
        return view('admin.employee.trashed' , compact('employees'));
    }

    public function restoreEmployee ($id)
    {
        $employee = User::onlyTrashed()->findOrFail($id);
        $employee->restore(); 
        return redirect()->route('admin.employee')->with('success' , "Employee ({$employee->name}) restored")->with('errors' , 'error in restore' );  
    }
    
    public function forceDeleteEmployee ($id)
    {
        $employee = User::withTrashed()->findOrFail($id);
        $employee->forceDelete();

        return redirect()->route('admin.employee')->with('success' , "Employee ({$employee->name}) deleted forever!")->with('errors' , 'error in delete forever' );
    }

    public function createLeaveType(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string'],
            'description' => ['nullable', 'string'],
        ]);

        $request->merge([
            'user_id' => Auth::id(),
        ]);

        LeaveType::create($request->all());

        return redirect()->route('admin.leaveType')->with('success', 'Leave Type Created Successfully');

    }

    public function showLeaveType()
    {
        $leaves = LeaveType::all();
        $success = session('success');
        return view('admin.leavetype.index' , compact('leaves' , 'success'));
    }

    public function editLeaveType(LeaveType $leavetype)
    {
        if ($leavetype->user_id !== Auth::id()) {
            return redirect()->route('admin.leaveType')->with('errors' , 'Unauthorized action.');;
        }

        return view('admin.leavetype.edit' , compact('leavetype'));
        
    }
    public function updateLeaveType(Request $request , LeaveType $leavetype)
    {
        $request->validate([
            'name' => ['required', 'string'],
            'description' => ['nullable', 'string'],
        ]);

        $request->merge([
            'user_id' => Auth::id(),
        ]);

        $leavetype->update($request->all());

        return redirect()->route('admin.leaveType' , compact('leavetype'))->with('success', 'Leave Type Updated Successfully');
    }
    
    public function destroyLeaveType($id)
    {
        $leaveType = LeaveType::findOrFail($id);

        if ($leaveType->user_id !== Auth::id()) {
            return redirect()->route('admin.leaveType')->with('errors' , 'Unauthorized action.');
        }

        $leaveType->delete();

        return back()->with('success', 'Leave Type Deleted Successfully');
    }

    public function trashedType ()
    {
        $leaves = LeaveType::onlyTrashed()->latest('deleted_at')->get();
        return view('admin.leavetype.trashed' , compact('leaves'));
    }

    public function restoreType ($id)
    {
        $leaveType = LeaveType::onlyTrashed()->findOrFail($id);
        $leaveType->restore(); 
        return redirect()->route('admin.leaveType')->with('success' , "Leave Type ({$leaveType->name}) restored")->with('errors' , 'error in restore' );  
    }
    
    public function forceDeleteType ($id)
    {
        $leaveType = LeaveType::withTrashed()->findOrFail($id);
        $leaveType->forceDelete();

        return redirect()->route('admin.leaveType')->with('success' , "Leave Type ({$leaveType->name}) deleted forever!")->with('errors' , 'error in delete forever' );
    }

    public function approve($id)
    {
        $leaveRequest = LeaveRequest::findOrFail($id);
        $leaveRequest->status = 'approved';
        $leaveRequest->save(); 
    
        return redirect()->route('admin.dashboard')->with('success', 'Leave request approved successfully.');
    }
    
    public function deny($id)
    {
        $leaveRequest = LeaveRequest::findOrFail($id);
        $leaveRequest->status = 'denied';
        $leaveRequest->save();
    
        return redirect()->route('admin.dashboard')->with('success', 'Leave request denied successfully.');
    }
    



}
