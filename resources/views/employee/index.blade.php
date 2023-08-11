<x-app-employee-layout>
    <div class="container mt-5 ">
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif


        <x-alert name='success' class="alert alert-success" />
        {{-- <x-alert name='error' class="alert alert-danger" /> --}}

        <div class="d-flex justify-content-between align-items-center my-5">
            <h1 class="fs-3 font-bold">Hello, {{ auth('employee')->user()->name }}</h1>
            <button type="button" class="btn bg-danger text-white" data-bs-toggle="modal" data-bs-target="#createRequestModal">
                Create A New Leave Request
            </button>
        </div>
    

        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Leave Type</th>
                <th scope="col">Start At</th>
                <th scope="col">End At</th>
                <th scope="col">Reason</th>
                <th scope="col">Status</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            @foreach ($requests as $request)

            <tr>
                <th scope="row">{{ $request->id }}</th>
                <td>{{ $request->employee->name }}</td>
                <td>{{ $request->leaveType->name }}</td>
                <td>{{ $request->start_at }}</td>
                <td>{{ $request->end_at }}</td>
                <td>{{ $request->reason }}</td>
                <td>{{ $request->status }}</td>
                <td class="d-flex align-items-center">
                    <a href="{{ route('leaveRequest.edit' , $request->id)}}" class="btn bg-primary text-white me-2">
                        Edit
                    </a>
                    <form action="{{route('leaveRequest.destroy' , $request->id )}}" method="post">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn bg-danger text-white">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
            
            </tbody>
        </table>

        <div class="modal fade" id="createRequestModal" tabindex="-1" aria-labelledby="createRequestModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="text-center">
                        <h3 class="modal-title mt-5 fs-4 " id="createRequestModalLabel" style="font-weight: bold">Create New Leave Request</h3>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{ route('leaveRequest.store') }}">
                            @csrf
                            <div class="mb-3 input-icon">
                                <span class="input-addon"><i class="fa-solid fa-user"></i></span>
                                <input type="text" class="form-control input-border-bottom" id="start_at" name="start_at" placeholder="Start At" required>
                            </div>
                            <div class="mb-3 input-icon">
                                <span class="input-addon"><i class="fa-solid fa-envelope"></i></span>
                                <input type="text" class="form-control input-border-bottom" id="end_at" name="end_at" placeholder="End At" required>
                            </div>
                            <!-- ... other form inputs ... -->
                            <div class="mb-3 input-icon">
                                <span class="input-addon"><i class="fa-solid fa-briefcase"></i></span>
                                <select class="form-control input-border-bottom" id="leave_type_id" name="leave_type_id" required>
                                    <option value="" disabled selected>Select Leave Type</option>
                                    @foreach ($leaveTypes as $leaveType)
                                        <option value="{{ $leaveType->id }}">{{ $leaveType->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <!-- ... other form inputs ... -->

                            <div class="mb-3 input-icon">
                                <span class="input-addon"><i class="fa-solid fa-briefcase"></i></span>
                                <input type="text" class="form-control input-border-bottom" id="reason" name="reason" placeholder="Reason" required>
                            </div>

                            <button type="submit" class="btn bg-danger btn-block text-white w-full">Create</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-employee-layout>
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