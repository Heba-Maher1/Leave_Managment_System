<?php

namespace App\Http\Controllers;

use App\Models\LeaveType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LeaveTypeController extends Controller
{

    public function index()
    {
        $leaves = LeaveType::all();
        $success = session('success');
        return view('admin.leavetype.index' , compact('leaves' , 'success'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string'],
            'description' => ['nullable', 'string'],
        ]);

        $request->merge([
            'user_id' => Auth::id(),
        ]);

        LeaveType::create($request->all());

        return redirect()->route('leavetype.index')->with('success', 'Leave Type Created Successfully');
    }


    public function edit(LeaveType $leavetype)
    {
        if ($leavetype->user_id !== Auth::id()) {
            return redirect()->route('leavetype.index')->withErrors('Unauthorized action.');
        }

        return view('admin.leavetype.edit' , compact('leavetype'));
    }


    public function update(Request $request, LeaveType $leavetype)
    {
        $request->validate([
            'name' => ['required', 'string'],
            'description' => ['nullable', 'string'],
        ]);

        $request->merge([
            'user_id' => Auth::id(),
        ]);

        $leavetype->update($request->all());

        return redirect()->route('leavetype.index' , compact('leavetype'))->with('success', 'Leave Type Updated Successfully');

    }


    public function destroy($id)
    { 

        $leaveType = LeaveType::findOrFail($id);

        if ($leaveType->user_id !== Auth::id()) {
            return redirect()->route('leavetype.index')->withErrors('Unauthorized action.');
        }

        $leaveType->delete();

        return back()->with('success', 'Leave Type Deleted Successfully');

    }
    
}
