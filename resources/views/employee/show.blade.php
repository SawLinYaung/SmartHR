@extends('layouts.app')
@section('title','Employee Detail')
@section('content')
<div class="container">
    <div class="row justify-content-center align-content-center">
        <div class="card">
            <div class="card-body px-3">
                <div class="row">
                    <div class="col-md-6" id="employee-img">
                        <img src="{{$employee->profile_img_path()}}" alt="wrong profile" class="profile-img">
                    </div>
                    <div class="col-md-6"></div>
                </div>
                <div class="row">
                <div class="col-md-6">
                        <div class="mb-3">
                            <p class="mb-1"><i class="fa-solid fa-id-card"></i> Employee ID</p>
                            <p class="text-muted mb-0">{{$employee->employee_id}}</p>
                        </div>
                    </div>   
                    <div class="col-md-6">
                        <div class="mb-3">
                            <p class="mb-1"><i class="fa-solid fa-user"></i> Name</p>
                            <p class="text-muted mb-0">{{$employee->name}}</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <p class="mb-1"><i class="fa-solid fa-phone"></i> Phone</p>
                            <p class="text-muted mb-0">{{$employee->phone}}</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <p class="mb-1"><i class="fa-solid fa-envelope"></i> Email</p>
                            <p class="text-muted mb-0">{{$employee->email}}</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <p class="mb-1"><i class="fa-solid fa-id-card"></i> Nrc Number</p>
                            <p class="text-muted mb-0">{{$employee->nrc_number}}</p>
                        </div>
                    </div>    
                    <div class="col-md-6">
                        <div class="mb-3">
                            <p class="mb-1"><i class="fa-solid fa-venus-mars"></i> Gender</p>
                            <p class="text-muted mb-0">
                                @if($employee->gender =='0')
                                Male
                                @endif
                                @if($employee->gender =='1')
                                Female
                                @endif
                            </p>
                        </div>
                    </div>   
                    <div class="col-md-6">
                        <div class="mb-3">
                            <p class="mb-1"><i class="fa-solid fa-cake-candles"></i> Birthday</p>
                            <p class="text-muted mb-0">{{$employee->birthday}}</p>
                        </div>
                    </div>               
                    <div class="col-md-6">
                        <div class="mb-3">
                            <p class="mb-1"><i class="fa-sharp fa-solid fa-location-dot"></i> Address</p>
                            <p class="text-muted mb-0">{{$employee->address}}</p>
                        </div>
                    </div>   
                    <div class="col-md-6">
                        <div class="mb-3">
                        <p class="mb-1"><i class="fa-solid fa-plus"></i> Department</p>
                            <p class="text-muted mb-0">{{$employee->department ? $employee->department->title: '-'}}</p>
                        </div>
                    </div>   
                    <div class="col-md-6">
                        <div class="mb-3">
                            <p class="mb-1"><i class="fa-solid fa-calendar-days"></i> Date of Join</p>
                            <p class="text-muted mb-0">{{$employee->date_of_join}}</p>
                        </div>
                    </div>   
                    <div class="col-md-6">
                        <div class="mb-3">
                            <p class="mb-1"><i class="fa-solid fa-check"></i> Is Present?</p>
                            <p class="text-muted mb-0">
                                @if($employee->is_present == 1)
                                <span class="badge badge-pill badge-success" style="background:green !important;">Present</span>
                                @else
                                <span class="badge badge-pill badge-danger" style="background:red !important;">Leave</span>
                                @endif
                            </p>
                        </div>
                    </div>   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    $(document).ready(function(){
        new Viewer(document.getElementById('employee-img'));
    });
</script>
@endsection