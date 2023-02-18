@extends('layouts.app')
@section('title','Employees')

@section('content')
    <div>
        <a href="{{route('employee.create')}}" class="btn btn-theme btn-sm mb-2 mx-3"> <i class="fas fa-plus-circle"></i> Create Employee</a>
    </div>
    <div class="card">
        <div class="card-body">
            <table class="table table-striped table-bordered cell-border Datatable" style="width:100%">
                <thead>
                    <tr>
                        <th class="text-center no-sort no-search"></th>
                        <th class="text-center no-sort"></th>
                        <th class="text-center">Employee ID</th>
                        <th class="text-center">Name</th>
                        <th class="text-center">Phone</th>
                        <th class="text-center">Email</th>
                        <th class="text-center">Department</th>
                        <th class="text-center">Designation</th>
                        <th class="text-center">Is Present</th>
                        <th class="text-center">Action</th>
                        <th class="text-center hidden no-sort no-search">Updated at</th>
                    </tr>
                </thead>
            </table> 
        </div>
    </div>
@endsection

@section('script')
<script>
$(document).ready(function(){
    $('.Datatable').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        ajax: 'employee/datatable/ssd',
        columns: [
            { data : 'plus_icon', name: 'plus_icon', class: 'text-center'},
            { data: 'profile_img', name: 'profile_img', class: 'text-center' },
            { data : 'employee_id', name: 'employee_id', class: 'text-center'},
            { data: 'name', name: 'name', class: 'text-center'},
            { data: 'phone', name: 'phone', class: 'text-center'},
            { data: 'email', name: 'email', class: 'text-center' },
            { data: 'department_name', name: 'department_name', class: 'text-center'},
            { data: 'designation_name', name: 'designation_name', class: 'text-center'},
            { data: 'is_present', name: 'is_present', class: 'text-center'},
            { data: 'action', name: 'action', class: 'text-center'},
            { data: 'updated_at', name: 'updated_at', class: 'text-center'},
            
        ],
        order: [[ 10, "desc" ]],
        columnDefs:[
            {
                "targets": [10],
                "visible":false
            },
            {
                "targets": [0],
                "class":"control"
            },
            {
                "targets": [8],
                "orderable":false,
            },
            {
                "targets": "no-sort",
                "orderable": false,
            },
            {
                "targets": "no-search",
                "searchable":false
            },
            {
                "targets": "hidden",
                "visisible": false
            }
        ],
        language: {
        "processing": "<img src='/image/loading.gif' style='width:50px'/><p class='my-3'>...Loading...</p>",
    }
    });

    // Parent To child Select မှတ်ခြင်း

    $(document).on('click', '.delete-btn', function(e){
        console.log('delete');
        e.preventDefault();
        Swal.fire({
            title: 'Successfully Created',
            text: "{{session('create')}}",
            icon: 'success',
            confirmButtonText: 'Continue'
        })
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {
                console.log('deleted');
            }
        });  
    });    
});
</script>
@endsection