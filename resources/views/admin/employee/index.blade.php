<x-app-layout>
    
    <div class="container mt-5 ">
        
        <x-alert name='success' class="alert alert-success" />
        <x-alert name='errors' class="alert alert-danger" />

        <div class="d-flex justify-content-between align-items-center my-5">
            <h1 class="fs-3 font-bold">Employees</h1>
            <button type="button" class="btn text-white" style="background-color: #41768a" data-bs-toggle="modal" data-bs-target="#createEmployeeModal">
                Create A New Employee
            </button>
        </div>

        <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Department</th>
                <th scope="col">Job</th>
                <th scope="col">Created By</th>
                <th scope="col"></th>
              </tr>
            </thead>
            <tbody>
            @foreach ($employees as $employee)

              <tr>
                <th scope="row">{{ $employee->id }}</th>
                <td>{{ $employee->email }}</td>
                <td>{{ $employee->name }}</td>
                <td>{{ $employee->department }}</td>
                <td>{{ $employee->job }}</td>
                <td>
                    @if ($employee->createdByAdmin)
                        {{ $employee->createdByAdmin->name }}
                    @else
                        N/A
                    @endif
                </td>
                <td class="d-flex align-items-center">
                    <a href="{{route('admin.editEmployee' , $employee->id)}}" class="me-3" >
                        <i class="fa-solid fa-pen" style="color: #41768a"></i>
                    </a>
                    <form action="{{route('admin.destroyEmployee' , $employee->id)}}" method="post">
                        @csrf
                        @method('delete')
                        <button type="submit">
                            <i class="fa-solid fa-trash text-danger"></i>
                        </button>
                    </form>
                </td>
              </tr>
            @endforeach
            
            </tbody>
          </table>

          <div class="modal fade" id="createEmployeeModal" tabindex="-1" aria-labelledby="createEmployeeModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="text-center">
                        <h3 class="modal-title mt-5 fs-4 " id="createEmployeeModalLabel" style="font-weight: bold">Create New Employee</h3>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{route('admin.createEmployee')}}">
                            @csrf
                            <div class="mb-3 input-icon">
                                <span class="input-addon"><i class="fa-solid fa-user"></i></span>
                                <input type="text" class="form-control input-border-bottom" id="name" name="name" placeholder="Name" required>
                            </div>
                            <div class="mb-3 input-icon">
                                <span class="input-addon"><i class="fa-solid fa-envelope"></i></span>
                                <input type="email" class="form-control input-border-bottom" id="email" name="email" placeholder="Email" required>
                            </div>
                            <div class="mb-3 input-icon">
                                <span class="input-addon"><i class="fa-solid fa-briefcase"></i></span>
                                <input type="text" class="form-control input-border-bottom" id="department" name="department" placeholder="Department" required>
                            </div>
                            <div class="mb-3 input-icon">
                                <span class="input-addon"><i class="fa-solid fa-briefcase"></i></span>
                                <input type="text" class="form-control input-border-bottom" id="job" name="job" placeholder="Job" required>
                            </div>
                            <div class="mb-3 input-icon">
                                <span class="input-addon"><i class="fa-solid fa-lock"></i></span>
                                <input type="password" class="form-control input-border-bottom" id="password" name="password" placeholder="password" required>
                            </div>
                            <button type="submit" class="btn btn-block text-white w-full" style="background-color: #41768a">Create</button>
                        </form>
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

</style>