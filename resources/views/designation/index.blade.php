@extends('layouts.app')
@section('title', 'Designations')
@section('content')
<div>
    <a href="{{route('designation.create')}}" class="btn btn-theme btn-sm"><i class="fas fa-plus-circle"></i> Create
        Designation</a>
</div>
<div class="card">
    <div class="card-body">
        <table class="table table-bordered Datatable" style="width:100%;">
            <thead>
                <th class="text-center no-sort no-search"></th>
                <th class="text-center">Title</th>
                <th class="text-center no-sort">Action</th>
                <th class="text-center no-search hidden">Updated at</th>
            </thead>
        </table>
    </div>
</div>
@endsection
@section('script')
<script>
    $(document).ready(function(){
            var table = $('.Datatable').DataTable({
                ajax: '/designation/datatable/ssd',
                columns: [
                    { data: 'plus-icon', name: 'plus-icon', class: 'text-center' },
                    { data: 'title', name: 'title', class: 'text-center' },
                    { data: 'action', name: 'action', class: 'text-center' },
                    { data: 'updated_at', name: 'updated_at', class: 'text-center' },
                ],
                order: [[ 3, "desc" ]],
            });

            $(document).on('click', '.delete-btn', function(e){
                e.preventDefault();

                var id = $(this).data('id');

                if(id == 1){
                    console.log("Can't delete");
                    swal("Sorry!", "You cannot delete it.!", "error");
                }

                else{
                    swal({
                    text: "Are you sure you want to delete?",
                    buttons: true,
                    dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            $.ajax({
                                method: "DELETE",
                                url: `/designation/${id}`,
                            }).done(function( res ) {
                                table.ajax.reload();
                            });
                        }
                    });
                }
            });
        });
</script>
@endsection
