<x-app-layout>
    <div class="container mt-5 ">
      @if (session('error'))
          <div class="alert alert-danger">
              {{ session('error') }}
          </div>
      @endif

        <h1 class="fs-3 font-bold mb-5">Employees' Leave Requests</h1>

   
    <table class="table">
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

          <tr>
            <th scope="row">{{ $request->id }}</th>
            <td>{{ $request->employee->name }}</td>
            <td>{{ $request->employee->department }} - {{ $request->employee->job }} </td>
            <td>{{ $request->leaveType->name }}</td>
            <td>{{ $request->start_at }}</td>
            <td>{{ $request->end_at}}</td>
            <td>{{ $request->reason}}</td>
            <td>{{ $request->status}}</td>
            <td class="d-flex align-items-center">
                <a href="{{ route('leavetype.edit' , $request->id)}}" class="btn bg-primary text-white me-2">
                    Edit
                </a>
                <form action="{{route('leavetype.destroy' , $request->id )}}" method="post">
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
    </div>


</x-app-layout>
