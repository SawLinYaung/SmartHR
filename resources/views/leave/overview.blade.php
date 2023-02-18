@extends('layouts.app')
@section('title', 'leave (Overview)')
@section('content')
<div class="card">
    <div class="card-body">
        <div class="row mb-3">
            <div class="col-md-3">
            <label for="">Employee Name</label>
                <input type="text" class="form-control employee_name" placeholder="">
            </div>
            <div class="col-md-3">
                <label for="">Leave Types</label>
                <div class="form-group">
                    <select name="" class="form-control select-leave">
                        <option value="0">-- Please Choose Leave Type --</option>
                        <option value="1">Causal Leave</option>
                        <option value="2">Paternity Leave</option>
                        <option value="3">Medical Leave</option>
                        <option value="4">Earn Leave</option>
                        <option value="5">Study Leave</option>
                        <option value="6">Bereavement Leave</option>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <label for="">From</label>
                <input type="text" name="from" class="form-control from" placeholder = "From">
            </div>

            <div class="col-md-3">
                <label for="">To</label>
                <input type="text" name="to" class="form-control to" placeholder="To">
            </div>

            <div class="col-md-3">
                <button class="btn btn-theme btn-sm btn-block search-btn"><i class="fas fa-search"></i> Search</button>
            </div>

        </div>


        <div class="leave_overview_table"></div>
    </div>
</div>
@endsection
@section('script')
<script>
    $(document).ready(function(){
        $('.select-leave').select2({
            placeholder: '-- Please Choose (Year) --',
            allowClear: true,
            theme: 'bootstrap4'
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

        leaveOverviewTable();

        function leaveOverviewTable(){
            var employee_name = $('.employee_name').val();
            var leave_type = $('.select-leave').val();
            var from = $('.from').val();
            var to = $('.to').val();

            $.ajax({
                url: `/leave-overview-table?employee_name=${employee_name}&leave_type=${leave_type}&from=${from}&to=${to}`,
                type: 'GET',
                success: function(res){
                    $('.leave_overview_table').html(res);
                }
            });
        }

        $('.search-btn').on('click', function(event){
            event.preventDefault();
            leaveOverviewTable();
        });

        
    });
</script>
@endsection
