<div class="table-responsive">
    <table class="table table-bordered table-striped">
    <thead class="" style="background:#484c7f;color:#fff">
            <th>Employee</th>
            <th class="text-center">Days of Month</th>
            <th class="text-center">Working Day</th>
            <th class="text-center">Off Day</th>
            <th class="text-center">Attendance Day</th>
            <th class="text-center">Absence Day</th>
            <th class="text-center">Leave Without Salary</th>
            <th class="text-center">Leave With Salary</th>
            <th class="text-center">Attendance Fine</th>
            <th class="text-center">Salary</th>
            <th class="text-center">Per Day (MMK)</th>
            <th class="text-center">Total (MMK)</th>
        </thead>
        <tbody>
            
            @foreach($periods as $period)
                @php
                if($period->isWeekday())
                {
                    $holiday = \App\Holiday::where(['date' => $period->format('Y-m-d')])->first();
                    if($holiday !=null)
                    {
                        $offDays++;
                        $workingDays--;   
                    }
                }
                @endphp
            @endforeach
        @foreach ($employees as $employee)
            @php
            $attendanceDays = 0;
            $ws_leave_Days = 0;
            $late = 0;
            $early = 0;
            $fineTotal = 0;
            $other_leave_Days = 0;
            $user_salary = 0;
            $salary = collect($employee->salaries)->where('month', $month)->where('year', $year)->first();
            $perDay = $salary ? ($salary->amount / $workingDays) : 0;
            $user_salary = $salary? $salary->amount :0;
            @endphp

            @foreach ($periods as $period)
            @if($period->isWeekday())
            @php
            $office_start_time = $period->format('Y-m-d') . ' ' . $company_setting->office_start_time;
            $office_end_time = $period->format('Y-m-d') . ' ' . $company_setting->office_end_time;
            $break_start_time = $period->format('Y-m-d') . ' ' . $company_setting->break_start_time;
            $break_end_time = $period->format('Y-m-d') . ' ' . $company_setting->break_end_time;

            $attendance = collect($attendances)->where('user_id', $employee->id)->where('date',
            $period->format('Y-m-d'))->first();


            $ws_leave = DB::select( DB::raw("SELECT * FROM leaves WHERE '". $period ."' BETWEEN leaves.from AND leaves.to and user_id='".$employee->id."' and leaves.leave_type='3'"));
            $late = DB::select( DB::raw("SELECT time FROM fines WHERE date ='".$period."' and user_id='".$employee->id."' and fines.status='1'"));
            $early = DB::select( DB::raw("SELECT time FROM fines WHERE date ='".$period."' and user_id='".$employee->id."' and fines.status='0'"));

            if($late != null)
            {
                if($late[0]->time <=10 && $late[0]->time>=5){
                    $fineTotal = $fineTotal + $perDay/8;
                }
                else if($late[0]->time <=30 && $late[0]->time>10){
                    $fineTotal = $fineTotal + $perDay/4;
                }
                else if($late[0]->time >30){
                    $fineTotal =$fineTotal + $perDay/2;
                }
            }
            
            if($early != null)
            {
                if($early[0]->time <=10 && $early[0]->time>=5){
                    $fineTotal = $fineTotal + $perDay/8;
                }
                else if($early[0]->time <=30 && $early[0]->time>10){
                    $fineTotal = $fineTotal + $perDay/4;
                }
                else if($early[0]->time >30){
                    $fineTotal =$fineTotal + $perDay/2;
                }
            }
            
            
            if($ws_leave !=null){
                $ws_leave_Days++;
            }

            $other_leave = DB::select( DB::raw("SELECT * FROM leaves WHERE '". $period ."' BETWEEN leaves.from AND leaves.to and user_id='".$employee->id."' and leaves.leave_type !='3'"));
            if($other_leave !=null){
                $other_leave_Days++;
            }
            if($attendance){
                if(!is_null($attendance->checkin_time)){
                    if($attendance->checkin_time < $office_start_time){
                        $attendanceDays += 0.5;
                    }else if($attendance->checkin_time > $office_start_time && $attendance->checkin_time < $break_start_time){
                        $attendanceDays += 0.5;
                    }else{
                        $attendanceDays += 0;
                    }
                }else{
                    $attendanceDays += 0;
                }

                if(!is_null($attendance->checkout_time)){
                    if($attendance->checkout_time < $break_end_time){
                        $attendanceDays += 0;
                    }else if($attendance->checkout_time > $break_end_time && $attendance->checkout_time < $office_end_time){
                        $attendanceDays += 0.5;
                    }else{
                        $attendanceDays += 0.5;
                    }
                }else{
                    $attendanceDays += 0;
                }
            }
            @endphp
            @endif
        @endforeach

            @php
            $absenceDays = $workingDays - $attendanceDays -$other_leave_Days;
            $total = $perDay * ($attendanceDays+$other_leave_Days);
            @endphp

            <tr>
                <td>{{$employee->name}}</td>
                <td class="text-center">{{$daysInMonth}}</td>
                <td class="text-center">{{$workingDays}}</td>
                <td class="text-center">{{$offDays}}</td>
                <td class="text-center">{{$attendanceDays}}</td>
                <td class="text-center">{{$absenceDays}}</td>
                <td>{{$ws_leave_Days}}</td>
                <td>{{$other_leave_Days}}</td>
                <td>{{$fineTotal}}</td>
                <td>{{$user_salary}}</td>
                <td class="text-center">{{number_format($perDay)}}</td>
                <td class="text-center">{{number_format($total-$fineTotal)}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
