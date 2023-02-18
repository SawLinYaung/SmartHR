<div class="table-responsive">
    <table class="table table-bordered table-striped">
        <thead>
            <th>Employee</th>
            @foreach ($periods as $period)
                @php 
                    $holiday = \App\Holiday::where(['date' => $period->format('Y-m-d')])->first();
                @endphp
                @if($holiday != null)
                    <th class="text-center alert-warning">{{$period->format('d')}} <br> {{$period->format('D')}}</th>
                @endif
                @if($holiday == null)
                    <th class="text-center @if($period->format('D') == 'Sat' || $period->format('D') == 'Sun') alert-success @endif">{{$period->format('d')}} <br> {{$period->format('D')}}</th>            
                @endif        
            @endforeach
        </thead>
        <tbody>
            @foreach ($employees as $employee)
            <tr>
                <td>{{$employee->name}}</td>
                @foreach ($periods as $period)
                    @php
                    $office_start_time = $period->format('Y-m-d') . ' ' . $company_setting->office_start_time;
                    $office_end_time = $period->format('Y-m-d') . ' ' . $company_setting->office_end_time;
                    $break_start_time = $period->format('Y-m-d') . ' ' . $company_setting->break_start_time;
                    $break_end_time = $period->format('Y-m-d') . ' ' . $company_setting->break_end_time;

                    $checkin_icon = '';
                    $checkout_icon = '';

                    $attendance = collect($attendances)->where('user_id', $employee->id)->where('date',
                    $period->format('Y-m-d'))->first();

                    $holiday = \App\Holiday::where(['date' => $period->format('Y-m-d')])->first();
                    $leave = DB::select( DB::raw("SELECT * FROM leaves WHERE '". $period ."' BETWEEN leaves.from AND leaves.to and user_id='".$employee->id."'"));

                    if($attendance){
                        if(!is_null($attendance->checkin_time)){
                            if($attendance->checkin_time < $office_start_time){
                                $checkin_icon='<i class="fas fa-check-circle text-success"></i>' ;
                            }else if($attendance->checkin_time > $office_start_time && $attendance->checkin_time < $break_start_time){
                                $checkin_icon='<i class="fas fa-check-circle text-warning"></i>' ;
                            }else{
                                $checkin_icon='<i class="fas fa-times-circle text-danger"></i>' ;
                            }
                        }else{
                            $checkin_icon='<i class="fas fa-times-circle text-danger"></i>' ;
                        }

                        if(!is_null($attendance->checkout_time)){
                            if($attendance->checkout_time < $break_end_time){
                                $checkout_icon='<i class="fas fa-times-circle text-danger"></i>' ;
                            }else if($attendance->checkout_time > $break_end_time && $attendance->checkout_time < $office_end_time){
                                $checkout_icon='<i class="fas fa-check-circle text-warning"></i>' ;
                            }else{
                                $checkout_icon='<i class="fas fa-check-circle text-success"></i>' ;
                            }
                        }else{
                            $checkout_icon='<i class="fas fa-times-circle text-danger"></i>' ;
                        }
                    }
                    else{
                        if($period->format('Y-m-d') <= now())
                        {
                            $checkin_icon='<i class="fas fa-times-circle text-danger"></i>' ;
                        $checkout_icon='<i class="fas fa-times-circle text-danger"></i>' ;
                        }

                    }
                    @endphp
                    
                    
                
                    @if($holiday == null)
                        @if($period->format('D') == 'Sat' || $period->format('D') == 'Sun')
                        <td class="text-center ) alert-success">
                        
                        </td>
                        @endif
                        @if($period->format('D') != 'Sat' && $period->format('D') != 'Sun')
                            @if($leave == null)
                                <td class="text-center )">
                                    <div>{!!$checkin_icon!!}</div>
                                    <div>{!!$checkout_icon!!}</div>
                                </td>
                            @endif
                            @if($leave != null)
                                @if($leave[0]->leave_type ==0)
                                <td style="background:#32a8a6;color:#fff;">CL</td>
                                @endif
                                @if($leave[0]->leave_type ==1)
                                <td style="background:#fcba03;color:#fff;">PL</td>
                                @endif
                                @if($leave[0]->leave_type ==2)
                                <td style="background:#03ebfc;color:#fff;">ML</td>
                                @endif
                                @if($leave[0]->leave_type ==3)
                                <td style="background:#02405f;color:#fff;">WS</td>
                                @endif
                                @if($leave[0]->leave_type ==4)
                                <td style="background:#d2fc03;color:#fff;">EL</td>
                                @endif
                                @if($leave[0]->leave_type ==5)
                                <td style="background:#034afc;color:#fff;">SL</td>
                                @endif
                                @if($leave[0]->leave_type ==6)
                                <td style="background:#fc03b1;color:#fff;">BML</td>
                                @endif
                            @endif
                        @endif
                    @endif
                    @if($holiday !=null)
                        <td class="text-center alert-warning">
                        </td>
                    @endif
                @endforeach
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
