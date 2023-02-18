@extends('layouts.app')
@section('title','Edit Employee')

@section('content')
   <div class="card">
        <div class="card-body">
        <form action="{{route('employee.update', $employee->id)}}" method="POST" autocomplete="off" id="edit-form" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="md-form">
                    <label for="">Employee ID</label>
                    <input type="text" name="employee_id" class="form-control" value="{{$employee->employee_id}}"/>
                </div>
                <div class="md-form">
                    <label for="">Name</label>
                    <input type="text" name="name" class="form-control" value="{{$employee->name}}" />
                </div>
                <div class="md-form">
                    <label for="">Phone</label>
                    <input type="number" name="phone" class="form-control" value="{{$employee->phone}}" />
                </div>
                <div class="md-form">
                    <label for="">Nrc Number</label>
                    <input type="text" name="nrc_number" class="form-control" value="{{$employee->nrc_number}}" />
                </div>
                <div class="md-form">
                    <label for="">Gender</label>
                    <br/><br/>
                    <select name="gender" class="form-control">
                        <option value="0" @if($employee->gender == '0') selected @endif>Male</option>
                        <option value="1" @if($employee->gender == '1') selected @endif>Female</option>
                    </select>
                </div>
                <div class="md-form">
                    <label for="">Email</label>
                    <input type="email" name="email" class="form-control" value="{{$employee->email}}" />
                </div>
                <div class="md-form">
                    <label for="">Birthday</label>
                    <input type="text" name="birthday" class="form-control birthday" value="{{$employee->birthday}}" />
                </div>
                <div class="md-form">
                    <label for="">Address</label>
                    <textarea name="address" id="" cols="30" class="md-textarea form-control">{{$employee->address}}</textarea>
                </div>
                <div class="md-form">
                    <label for="">Department</label>
                    <br/><br/>
                    <select name="department_id" class="form-control">
                        @foreach($departments as $department)
                            <option value="{{$department->id}}" @if($employee->department_id == $department->id) selected @endif>{{$department->title}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Designation</label>
                    <select name="designation_id" class="form-control">
                        @foreach ($designations as $designation)
                        <option value="{{$designation->id}}" @if($employee->designation_id == $designation->id) selected @endif>{{$designation->title}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="md-form">
                    <label for="">Date of Join</label>
                    <input type="text" name="date_of_join" class="form-control date_of_join" value="{{$employee->date_of_join}}" />
                </div>
                <div class="md-form">
                    <label for="">Is Present?</label>
                    <br/><br/>
                    <select name="is_present" class="form-control">
                        <option value="1" @if($employee->is_present == 1) selected @endif>Yes</option>
                        <option value="0" @if($employee->is_present == 0) selected @endif>No</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Profile Image</label>
                    <input type="file" name="profile_img" class="form-control p-1" id="profile_img">
                    <div class="preview_img my-2">
                        @if($employee->profile_img)
                        <img src="{{$employee->profile_img_path()}}" alt="wrong path">
                        @endif
                    </div>
                </div>       
                <div class="d-flex justify-content-center">
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-theme btn-sm btn-block my-4">Update</button>
                    </div>
                </div>
            </form>
        </div>
   </div>
@endsection

@section('script')
{!!$validator = JsValidator::formRequest('App\Http\Requests\UpdateEmployee', '#edit-form');!!}
<script>
    $(document).ready(function(){
        $('.birthday').daterangepicker({
            "autoApply": true,
            "showDropdowns": true,
            "maxDate" :moment(),//current date = moment();
            "singleDatePicker": true,
            "locale": {
                "format": "YYYY/MM/DD",
            }
        });
        $('.date_of_join').daterangepicker({
            "autoApply": true,
            "showDropdowns": true,
            "singleDatePicker": true,
            "locale": {
                "format": "YYYY/MM/DD",
            }
        });
        $('#profile_img').on('change', function(){
            console.log('changed');
            var file_length = document.getElementById('profile_img').files.length;
            //ကိုယ်ဘယ်နှဖိုင်ရွေးထားလဲ သိအောင်လို့။
            $('.preview_img').html('');
            for(var i = 0; i < file_length; i++){
                $('.preview_img').append(`<img src="${URL.createObjectURL(event.target.files[i])}"/>`);
            }
        });    
    })
</script>
@endsection