<x-app-layout>
    
    <div class="container mt-5 ">
        <x-alert name='success' class="alert alert-success" />
        <x-alert name='error' class="alert alert-danger" />

        <h1 class="my-4 fs-3 font-bold">Update Leave Request</h1>

        <form method="POST" action="{{ route('employee.updateLeaveRequest', $leaveRequest->id ) }}">
            @csrf
            @method('put')
            <div class="mb-3 input-icon">
                <span class="input-addon"><i class="fa-solid fa-user"></i></span>
                <input type="text" value="{{$leaveRequest->start_at}}" class="form-control input-border-bottom" id="start_at" name="start_at" placeholder="start_at" required>
            </div>
            <div class="mb-3 input-icon">
                <span class="input-addon"><i class="fa-solid fa-envelope"></i></span>
                <input type="text" value="{{$leaveRequest->end_at}}"  class="form-control input-border-bottom" id="end_at" name="end_at" placeholder="end_at" required>
            </div>
            <div class="mb-3 input-icon">
                <span class="input-addon"><i class="fa-solid fa-briefcase"></i></span>
                <select class="form-control input-border-bottom" id="leave_type_id" name="leave_type_id" required>
                    <option value="" disabled>Select Leave Type</option>
                    @foreach ($leaveTypes as $leaveType)
                        <option value="{{ $leaveType->id }}" {{ $selectedLeaveTypeId == $leaveType->id ? 'selected' : '' }}>
                            {{ $leaveType->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3 input-icon">
                <span class="input-addon"><i class="fa-solid fa-briefcase"></i></span>
                <input type="text" value="{{$leaveRequest->reason}}" class="form-control input-border-bottom" id="reason" name="reason" placeholder="reason" required>
            </div>
            <button type="submit" class="btn btn-block text-white w-full"  style="background: #41768a">Update</button>
        </form>

        


        
</x-app-layout>

<style>
    .input-icon {
    position: relative;
}

.input-addon {
    position: absolute;
    top: 0;
    left: 0;
    bottom: 0;
    padding: 8px;
    pointer-events: none;
}

.input-border-bottom {
    border: none;
    border-bottom: 1px solid #ced4da;
    border-radius: 0;
    padding-left: 40px; /* Adjust the padding based on your icon size */
}

</style>

