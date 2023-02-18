@extends('layouts.app')
@section('content')
<div class="card">
    <div class="card-body">
        @include('layouts.error')
        <form action="{{route('leave.store')}}" method="POST" autocomplete="off" enctype="multipart/form-data" id="create-form">
            @csrf

            <div class="form-group">
                <label for="">Employee</label>
                <select name="user_id" class="form-control select-ninja">
                    <option value="">-- Please Choose --</option>
                    @foreach ($employees as $employee)
                    <option value="{{$employee->id}}" @if(old('user_id') == $employee->id) selected @endif>{{$employee->employee_id}} ({{$employee->name}})</option>
                    @endforeach
                </select>
            </div>

            <div class="md-form">
                <label for="">From</label>
                <input type="text" name="from" class="form-control from" value="{{old('from')}}">
            </div>

            <div class="md-form">
                <label for="">To</label>
                <input type="text" name="to" class="form-control to" value="{{old('to')}}">
            </div>

            <div class="form-group">
                <label for="">Leave Type</label>
                <select name="leave_type" class="form-control">
                    <option value="0">Causal Leave</option>
                    <option value="1">Paternity Leave</option>
                    <option value="2">Medical Leave</option>
                    <option value="3">Without Salary Leave</option>
                    <option value="4">Earn Leave</option>
                    <option value="5">Study Leave</option>
                    <option value="6">Bereavement Leave</option>
                </select>
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
{!!JsValidator::formRequest('App\Http\Requests\StoreLeave', '#create-form');!!}

<script>
    $(document).ready(function(){
    });
    $('.from').daterangepicker({
            "autoApply": true,
            "showDropdowns": true,
            "singleDatePicker": true,
            "locale": {
                "format": "YYYY/MM/DD",
            }
        });
        $('.to').daterangepicker({
            "autoApply": true,
            "showDropdowns": true,
            "singleDatePicker": true,
            "locale": {
                "format": "YYYY/MM/DD",
            }
        });
</script>
@endsection
