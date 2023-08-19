<?php

namespace App\Http\Controllers;

use App\Models\LeaveRequest;
use App\Models\LeaveType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployeeController extends Controller
{
    public function dashboard()
    {
        $employee = Auth::user();
        $requests = $employee->leaveRequests; // Assuming the relationship is named leaveRequests
        $leaveTypes = LeaveType::all();
        
        return view('employee.dashboard', compact('requests', 'leaveTypes'));
    }

    public function createLeaveRequest(Request $request)
    {
        $user = Auth::user();
        $currentYear = now()->year;
        $requestCount = $user->leaveRequests()
            ->whereYear('created_at', $currentYear)
            ->count();

        if ($requestCount >= 6) {
            return back()->with('error', 'You can\'t make more than 6 requests in the year!');
        }

        $request->validate([
            'start_at' => ['required'],
            'end_at' => ['required'],
            'reason' => ['required', 'string'],
        ]);

        $leaveRequest = new LeaveRequest();
        $leaveRequest->user_id = $user->id;
        $leaveRequest->leave_type_id = $request->input('leave_type_id');
        $leaveRequest->start_at = $request->input('start_at');
        $leaveRequest->end_at = $request->input('end_at');
        $leaveRequest->reason = $request->input('reason');

        $leaveRequest->save();
    
        return back()->with('success', 'Leave request created successfully.');
    }

    public function editLeaveRequest(LeaveRequest $leaveRequest)
    {
        $leaveTypes = LeaveType::all(); // Assuming you have a LeaveType model
        $selectedLeaveTypeId = $leaveRequest->leave_type_id;

        return view('employee.edit', [
            'leaveRequest' => $leaveRequest,
            'leaveTypes' => $leaveTypes,
            'selectedLeaveTypeId' => $selectedLeaveTypeId,
        ]);
    }

    public function updateLeaveRequest(Request $request, LeaveRequest $leaveRequest)
    {
        $request->validate([
            'start_at' => ['required'],
            'end_at' => ['required'],
            'reason' => ['required', 'string'],
            'status' => ['in:pending,approved,denied'],
        ]);

        $leaveRequest->update($request->all());

        return redirect()->route('employee.dashboard')->with('success', 'Leave request updated successfully.');
    }

    public function destroyLeaveRequest(LeaveRequest $leaveRequest)
    {
        $leaveRequest->delete();

        return back()->with('success', 'Leave request Deleted successfully.');
    }

    public function trashedRequest ()
    {
        $requests = LeaveRequest::onlyTrashed()->latest('deleted_at')->get();
        return view('employee.trashed' , compact('requests'));
    }

    public function restoreRequest ($id)
    {
        $requests = LeaveRequest::onlyTrashed()->findOrFail($id);
        $requests->restore(); 
        return redirect()->route('employee.dashboard')->with('success' , "Leave Request restored");
    }
    
    public function forceDeleteRequest ($id)
    {
        $requests = LeaveRequest::withTrashed()->findOrFail($id);
        $requests->forceDelete();

        return redirect()->route('employee.dashboard')->with('success' , "Leave Request deleted forever!");
    }

}
