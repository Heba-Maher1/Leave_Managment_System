<x-app-layout>
    
    <div class="container mt-5 ">
        <x-alert name='success' class="alert alert-success" />
        <x-alert name='errors' class="alert alert-danger" />

        <div class="d-flex justify-content-between align-items-center my-5">
            <h1 class="fs-3 font-bold">Leave Types</h1>
            <button type="button" class="btn bg-danger text-white" data-bs-toggle="modal" data-bs-target="#createLeaveModal">
                Create A New Leave Type
            </button>
        </div>

        <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Description</th>
                <th scope="col">Admin</th>
                <th scope="col"></th>
              </tr>
            </thead>
            <tbody>
            @foreach ($leaves as $leave)

              <tr>
                <th scope="row">{{ $leave->id }}</th>
                <td>{{ $leave->name }}</td>
                <td>{{ $leave->description }}</td>
                <td>{{ $leave->user->name }}</td>
                <td class="d-flex align-items-center">
                    <a href="{{route('leavetype.edit' , $leave->id )}}" class="btn bg-primary text-white me-2">
                        Edit
                    </a>
                    <form action="{{route('leavetype.destroy' , $leave->id )}}" method="post">
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

          <div class="modal fade" id="createLeaveModal" tabindex="-1" aria-labelledby="createLeaveModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="text-center">
                        <h3 class="modal-title mt-5 fs-4 " id="createLeaveModalLabel" style="font-weight: bold">Create New Leave</h3>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{ route('leavetype.store') }}">
                            @csrf
                            <div class="mb-3 input-icon">
                                <span class="input-addon"><i class="fa-solid fa-user"></i></span>
                                <input type="text" class="form-control input-border-bottom" id="name" name="name" placeholder="Name" required>
                            </div>
                            <div class="mb-3 input-icon">
                                <span class="input-addon"><i class="fa-solid fa-envelope"></i></span>
                                <textarea type="text" class="form-control input-border-bottom" id="description" name="description" placeholder="Description" required></textarea>
                            </div>

                            <button type="submit" class="btn bg-danger btn-block text-white w-full">Create</button>
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