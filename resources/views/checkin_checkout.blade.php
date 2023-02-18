@extends('layouts.app_plain')
@section('title','Check In - Check Out')
@section('content')
<div class="d-flex justify-content-center align-items-center" style="height:100vh;">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="my-5 text-center">
                    <h5>QR Code</h5>
                    <div class="visible-print text-center">
                    <img 
                    src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(200)->generate($hash_value)) !!} " alt="wrong_image" style="height:300px;width:300px;">

                    <p class="text-muted mt-3">Please scan QR to check in or checkout</p>
                </div>
                </div>
                <hr>

            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
 $(document).ready(function(){
    });
    </script>
@endsection