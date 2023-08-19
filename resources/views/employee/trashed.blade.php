<x-app-layout>
    <div class="container mt-5 ">

        <x-alert name='success' class="alert alert-success" />
        <x-alert name='errors' class="alert alert-danger" />

        <div class="d-flex justify-content-between align-items-center my-5">
            <h1 class="fs-3 font-bold">Trashed Leave Requests</h1>

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
                    <form action="{{route('employee.restoreRequest' , $request->id)}}" class="me-3" method="post">
                        @csrf
                        @method('put')
                        <button type="submit">
                            <i class="fa-solid fa-trash-can-arrow-up" style="color: #41768a"></i>
                        </button>
                    </form>
                    <form action="{{route('employee.forcedeleteRequest' , $request->id)}}" method="post">
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

    </div>
</x-app-layout>
<style>
 

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
  