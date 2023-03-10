@extends('layouts.app')
@section('title', 'Edit Designation')
@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{route('designation.update', $designation->id)}}" method="POST" autocomplete="off" id="edit-form" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="md-form">
                <label for="">Title</label>
                <input type="text" name="title" class="form-control" value="{{$designation->title}}">
            </div>

            <div class="d-flex justify-content-center mt-5 mb-3">
                <div class="col-md-6">
                    <button type="submit" class="btn btn-theme btn-sm btn-block">Confirm</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
@section('script')
{!!JsValidator::formRequest('App\Http\Requests\UpdateDesignation', '#edit-form');!!}

<script>
    $(document).ready(function(){
    });
</script>
@endsection
