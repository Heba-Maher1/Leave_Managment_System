<x-app-layout>
    
    <div class="container mt-5 ">
        
        <x-alert name='success' class="alert alert-success" />
        <x-alert name='errors' class="alert alert-danger" />

        <div class="d-flex justify-content-between align-items-center my-5">
            <h1 class="fs-3 font-bold">Trashed Leave Types</h1>

        </div>

        <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Description</th>
                <th scope="col">Create By</th>
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
                    <form action="{{route('admin.restoreType' , $leave->id)}}" class="me-3" method="post">
                        @csrf
                        @method('put')
                        <button type="submit">
                            <i class="fa-solid fa-trash-can-arrow-up" style="color: #41768a"></i>
                        </button>
                    </form>
                    <form action="{{route('admin.forcedeleteType' , $leave->id)}}" method="post">
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