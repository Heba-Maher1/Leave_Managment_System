<x-app-layout>
    <div class="container mt-5">
        <x-alert name='success' class="alert alert-success" />
        <x-alert name='errors' class="alert alert-danger" />

        <div class="d-flex justify-content-between align-items-center my-5">
            <h1 class="fs-3 font-bold">Hello, {{ Auth::user()->name }}</h1>
            <button type="button" class="btn text-white" style="background-color: #41768a" data-bs-toggle="modal" data-bs-target="#createRequestModal">
                Create A New Leave Request
            </button>
        </div>

        <div class="mb-3">
            <select class="form-control" id="statusFilter">
                <option value="">All</option>
                <option value="approved">Approved</option>
                <option value="denied">Denied</option>
                <option value="pending">Pending</option>
            </select>
          </div>
    

        <table class="table" id="requestTable">
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

            <tr class="{{ $request->status === 'denied' ? 'locked' : '' }}" data-status="{{ $request->status }}">
                <th scope="row">{{ $request->id }}</th>
                <td>{{ $request->user->name }}</td>
                <td>{{ $request->leaveType->name }}</td>
                <td>{{ $request->start_at }}</td>
                <td>{{ $request->end_at }}</td>
                <td>{{ $request->reason }}</td>
                <td>{{ $request->status }}</td>
                @if ($request->status !== 'denied')
                <td class="d-flex align-items-center">
                    <a href="{{ route('employee.editLeaveRequest' , $request->id)}}" class="me-3">
                        <i class="fa-solid fa-pen" style="color: #41768a"></i>
                    </a>
                    <form action="{{route('employee.destroyLeaveRequest' , $request->id )}}" method="post">
                        @csrf
                        @method('delete')
                        <button type="submit">
                            <i class="fa-solid fa-trash text-danger"></i>
                        </button>
                    </form>
                </td>
                @endif
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
                        <form method="POST" action="{{ route('employee.createLeaveRequest') }}">
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

                            <button type="submit" class="btn btn-block text-white w-full" style="background-color: #41768a">Create</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>  
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

.locked {
    background-color: #f1f1f1;
    /* You can also adjust other styles to indicate the locked state */
}
</style>

<script>
    const statusFilter = document.getElementById('statusFilter');
    const requestTable = document.getElementById('requestTable');
  
    statusFilter.addEventListener('change', function () {
        const selectedStatus = statusFilter.value;
        const rows = requestTable.querySelectorAll('tbody tr');
  
        rows.forEach(row => {
            const rowStatus = row.getAttribute('data-status');
            if (!selectedStatus || rowStatus === selectedStatus) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });
  </script>
  