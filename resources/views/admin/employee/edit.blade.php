<x-app-layout>
    
    <div class="container mt-5 ">
        <x-alert name='success' class="alert alert-success" />
        <x-alert name='error' class="alert alert-danger" />

        <h1 class="my-4 fs-3 font-bold">Update An Employee</h1>

        <form method="POST" action="{{ route('admin.updateEmployee' , $employee->id) }}">
            @csrf
            @method('put')
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
            <div class="mb-3 input-icon">
                <span class="input-addon"><i class="fa-solid fa-lock"></i></i></span>
                <input type="password" value="{{$employee->password}}" class="form-control input-border-bottom" id="password" name="password" placeholder="password" required>
            </div>
            <button type="submit" class="btn btn-block text-white w-full" style="background: #41768a">Update</button>
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

