<x-app-layout>
    <div class="container mt-5 ">

      @if (session('error'))
          <div class="alert alert-danger">
              {{ session('error') }}
          </div>
      @endif
      <div class="d-flex justify-content-between align-items-center my-5">
        <h1 class="fs-3 font-bold">Employees' Leave Requests</h1>
        <div class="mb-3">
          <select class="form-control text-white" id="statusFilter" style="background-color: #41768a">
              <option value="">All</option>
              <option value="approved">Approved</option>
              <option value="denied">Denied</option>
              <option value="pending">Pending</option>
          </select>
        </div>
      </div>  
      

   
      <table class="table" id="requestTable">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Employee Name</th>
            <th scope="col">Employee Department</th>
            <th scope="col">Leave Name</th>
            <th scope="col">Start At</th>
            <th scope="col">End At</th>
            <th scope="col">reason</th>
            <th scope="col">status</th>
            <th scope="col"></th>
          </tr>
        </thead>
        <tbody>

        @foreach ($requests as $request)

          <tr data-status="{{ $request->status }}">
            <th scope="row">{{ $request->id }}</th>
            <td>{{ $request->user->name }}</td>
            <td>{{ $request->user->department }} - {{ $request->user->job }} </td>
            <td>{{ isset($request->leaveType) ? $request->leaveType->name : 'null' }}</td>
            <td>{{ $request->start_at }}</td>
            <td>{{ $request->end_at}}</td>
            <td>{{ $request->reason}}</td>
            <td>{{ $request->status}}</td>
            <td class="d-flex align-items-center">
              <form action="{{ route('leave-requests.approve', $request->id) }}" method="POST" style="display: inline;">
                @csrf
                @method('put')
                <button type="submit" class="btn me-3">
                    <i class="fa-solid fa-check" style="color: #41768a"></i>
                </button>
            </form>
            <form action="{{ route('leave-requests.deny', $request->id) }}" method="POST" style="display: inline;">
                @csrf
                @method('put')
                <button type="submit" class="btn text-danger">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </form>
            </td>
          </tr>
        @endforeach
        
        </tbody>
      </table>
    </div>


</x-app-layout>

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
