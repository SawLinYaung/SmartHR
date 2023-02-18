@extends('layouts.app')
@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{route('holiday.update', $holiday->id)}}" method="POST" autocomplete="off" id="edit-form" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="md-form">
                <label for="">Title</label>
                <input type="text" name="title" class="form-control" value="{{$holiday->title}}">
            </div>
            <div class="md-form">
                <label for="">Date</label>
                <input type="text" name="date" class="form-control start" value="{{$holiday->date}}">
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
{!!JsValidator::formRequest('App\Http\Requests\UpdateHoliday', '#edit-form');!!}

<script>
    $(document).ready(function(){
        $('.start').daterangepicker({
                "singleDatePicker": true,
                "autoApply": true,
                "showDropdowns": true,
                "locale": {
                    "format": "YYYY-MM-DD",
                }
            });

            $('.end').daterangepicker({
                "singleDatePicker": true,
                "autoApply": true,
                "showDropdowns": true,
                "locale": {
                    "format": "YYYY-MM-DD",
                }
            });
    });
</script>
@endsection
