<?php

namespace App\Http\Controllers;

use App\Models\LeaveRequest;
use App\Models\LeaveType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LeaveRequestController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    public function store(Request $request)
    {
        $leaveRequest = new LeaveRequest();
        $leaveRequest->employee_id = Auth::guard('employee')->id();
        $leaveRequest->leave_type_id = $request->input('leave_type_id'); // This is the selected leave type ID
        $leaveRequest->start_at = $request->input('start_at');
        $leaveRequest->end_at = $request->input('end_at');
        $leaveRequest->reason = $request->input('reason');
        $leaveRequest->status = 'pending'; // Assuming you have a default status
    
        $leaveRequest->save();
    
        return back()->with('success', 'Leave request created successfully.');
    }


    public function edit(LeaveRequest $leaveRequest)
    {
        $leaveTypes = LeaveType::all(); // Assuming you have a LeaveType model
        $selectedLeaveTypeId = $leaveRequest->leave_type_id;
    
        return view('employee.edit', [
            'leaveRequest' => $leaveRequest,
            'leaveTypes' => $leaveTypes,
            'selectedLeaveTypeId' => $selectedLeaveTypeId,
        ]);
    }


    public function update(Request $request, LeaveRequest $leaveRequest)
    {
        $request->validate([
            'start_at' => ['required'],
            'end_at' => ['required'],
            'reason' => ['required' , 'string'],
        ]);

        $leaveRequest->update($request->all());
    
        return redirect()->route('employee.dashboard')->with('success', 'Leave request updated successfully.');
    }

 
    public function destroy(LeaveRequest $leaveRequest)
    {
        $leaveRequest->delete();

        return back()->with('success', 'Leave request Deleted successfully.');
    }
}
