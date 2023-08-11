<x-app-layout>
    
    <div class="container mt-5">
        <x-alert name='success' class="alert alert-success" />
        <x-alert name='error' class="alert alert-danger" />

        <h1 class="my-4 fs-3 font-weight-bold">Update An Employee</h1>


        <form method="POST" action="{{ route('leavetype.update', $leavetype->id) }}">
            @csrf
            @method('put')
            <div class="mb-3 input-icon">
                <span class="input-addon"><i class="fa-solid fa-signature"></i></span>
                <input type="text" value="{{ $leavetype->name }}" class="form-control input-border-bottom" id="name" name="name" placeholder="Name" required>
            </div>
            <div class="mb-3 input-icon">
                <span class="input-addon"><i class="fa-solid fa-pen"></i></span>
                <textarea class="form-control input-border-bottom" id="description" name="description" placeholder="Description" required>{{ $leavetype->description }}</textarea>
            </div>
            <button type="submit" class="btn bg-danger btn-block text-white w-full">Update</button>
        </form>
     
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