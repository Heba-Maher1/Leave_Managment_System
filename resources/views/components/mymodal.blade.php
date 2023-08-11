<div class="modal fade" id="{{$id}}" tabindex="-1" aria-labelledby="{{$id}}Label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="text-center">
                <h3 class="modal-title mt-5 fs-4 " id="{{$id}}Label" style="font-weight: bold">Create New Employee</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('employee.update' , $employee->id) }}">
                    @csrf
                    <div class="mb-3 input-icon">
                        <span class="input-addon"><i class="fa-solid fa-user"></i></span>
                        <input type="text" value="{{$employee->name}}" class="form-control input-border-bottom" id="name" name="name" placeholder="Name" required>
                    </div>
                    <div class="mb-3 input-icon">
                        <span class="input-addon"><i class="fa-solid fa-envelope"></i></span>
                        <input type="email" value="{{$employee->email}}"  class="form-control input-border-bottom" id="email" name="email" placeholder="Email" required>
                    </div>
                    <div class="mb-3 input-icon">
                        <span class="input-addon"><i class="fa-solid fa-briefcase"></i></span>
                        <input type="text" value="{{$employee->department}}"  class="form-control input-border-bottom" id="department" name="department" placeholder="Department" required>
                    </div>
                    <div class="mb-3 input-icon">
                        <span class="input-addon"><i class="fa-solid fa-briefcase"></i></span>
                        <input type="text" value="{{$employee->job}}" class="form-control input-border-bottom" id="job" name="job" placeholder="Job" required>
                    </div>
                    <button type="submit" class="btn bg-danger btn-block text-white w-full">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>