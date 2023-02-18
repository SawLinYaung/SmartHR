<?php

namespace App\Http\Controllers;

use PDF;
use App\Fine;
use App\User;
use App\Holiday;
use Carbon\Carbon;
use App\CompanySetting;
use App\CheckinCheckout;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAttendance;
use App\Http\Requests\UpdateAttendance;

class AttendanceController extends Controller
{
    public function index()
    {
        $period = '2023-02-14';
        $employee_id = '1';
        $month = '2';
        $year = '2023';
        // $employee_id = 3;
        // $has_leave = DB::select( DB::raw("SELECT * FROM leaves WHERE '". $period ."' BETWEEN leaves.from AND leaves.to and user_id='".$employee_id."'"));
        // dd($has_leave);


        // $late = DB::select( DB::raw("SELECT time FROM fines WHERE date ='".$period."' and user_id='".$employee_id."' and fines.status='1'"));

        // dd($late[0]->time);

        // $holidays = Holiday::whereMonth('date',$month)->whereYear('date',$year)->get();
        // $holidays_count = $holidays->count();
        // dd($holidays_count);

        return view('attendance.index');
    }

    public function ssd(Request $request)
    {
        $attendances = CheckinCheckout::with('employee');

        return Datatables::of($attendances)
            ->filterColumn('employee_name', function ($query, $keyword) {
                $query->whereHas('employee', function ($q1) use ($keyword) {
                    $q1->where('name', 'like', '%' . $keyword . '%');
                });
            })
            ->addColumn('employee_name', function ($each) {
                return $each->employee ? $each->employee->name : '-';
            })
            ->addColumn('action', function ($each) {
                $edit_icon = '';
                $delete_icon = '';

                    $edit_icon = '<a href="' . route('attendance.edit', $each->id) . '" class="text-warning"><i class="far fa-edit"></i></a>';
                

                    $delete_icon = '<a href="#" class="text-danger delete-btn" data-id="' . $each->id . '"><i class="fas fa-trash-alt"></i></a>';
                

                return '<div class="action-icon">' . $edit_icon . $delete_icon . '</div>';
            })
            ->addColumn('plus-icon', function ($each) {
                return null;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function create()
    {
        $employees = User::orderBy("employee_id")->get();
        return view('attendance.create', compact('employees'));
    }

    public function store(StoreAttendance $request)
    {
        
        $date = $request->date;
        $Day = \Carbon\Carbon::createFromFormat('Y-m-d',$date)->format('D');
        $holiday = Holiday::where('date',$date)->first();

        if($holiday != null){
            return back()->withErrors(['fail' => $date.'is a holiday.'])->withInput();
        }
        else if($Day == 'Sat' || $Day =='Sun'){
            return back()->withErrors(['fail' => $date.'is an offday.'])->withInput();
        }
        else if (CheckinCheckout::where('user_id', $request->user_id)->where('date', $request->date)->exists()) {
            return back()->withErrors(['fail' => 'Already defined.'])->withInput();
        }

        $attendance = new CheckinCheckout();
        $attendance->user_id = $request->user_id;
        $attendance->date = $request->date;
        $attendance->checkin_time = $request->date . ' ' . $request->checkin_time;
        $attendance->checkout_time = $request->date . ' ' . $request->checkout_time;
        $attendance->save();

        $setting = CompanySetting::findOrFail('1');
        $checkins = Carbon::parse($request->checkin_time);
        $start = Carbon::parse($setting->office_start_time);
        $late = $checkins->diffInMinutes($start);   
        
        if (strtotime($setting->office_start_time) < strtotime($request->checkin_time)) {
            $fine = new Fine();
            $fine->user_id = $request->user_id;
            $fine->date = $request->date;
            $fine->status = "1"; //နောက်ကျတာ။ 
            $fine->time = $late; //minutes;
            $fine->save();
        } 

        $checkouts = Carbon::parse($request->checkout_time);
        $end = Carbon::parse($setting->office_end_time);
        $early = $checkouts->diffInMinutes($end);

        if(strtotime($setting->office_end_time) > strtotime($request->checkout_time)){
            $fine = new Fine();
            $fine->user_id = $request->user_id;
            $fine->date = $request->date;
            $fine->status = "0"; //စောပြန်တာ။
            $fine->time = $early;
            $fine->save();
        }

        return redirect()->route('attendance.index')->with('create', 'Attendance is successfully created.');
    }

    public function edit($id)
    {
        $attendance = CheckinCheckout::findOrFail($id);
        $employees = User::orderBy("employee_id")->get();
        return view('attendance.edit', compact('attendance', 'employees'));
    }

    public function update($id, UpdateAttendance $request)
    {
        $attendance = CheckinCheckout::findOrFail($id);

        if (CheckinCheckout::where('user_id', $request->user_id)->where('date', $request->date)->where('id', '!=', $attendance->id)->exists()) {
            return back()->withErrors(['fail' => 'Already defined.'])->withInput();
        }

        $attendance->user_id = $request->user_id;
        $attendance->date = $request->date;
        $attendance->checkin_time = $request->date . ' ' . $request->checkin_time;
        $attendance->checkout_time = $request->date . ' ' . $request->checkout_time;
        $attendance->update();

        return redirect()->route('attendance.index')->with('update', 'Attendance is successfully updated.');
    }

    public function destroy($id)
    {
        $attendance = CheckinCheckout::findOrFail($id);
        $attendance->delete();

        return 'success';
    }

    public function overview(Request $request)
    {
       return view('attendance.overview');
    }

    public function overviewTable(Request $request)
    {
        $month = $request->month;
        $year = $request->year;
        $startOfMonth = $year . '-' . $month . '-01';
        $endOfMonth = Carbon::parse($startOfMonth)->endOfMonth()->format('Y-m-d');

        $employees = User::orderBy('employee_id')->where('name', 'like', '%' . $request->employee_name . '%')->get();
        $company_setting = CompanySetting::findOrFail(1);
        $periods = new CarbonPeriod($startOfMonth, $endOfMonth);
        $attendances = CheckinCheckout::whereMonth('date', $month)->whereYear('date', $year)->get();



        $holidays = Holiday::whereYear("date","=",$year)
                            ->whereMonth("date","=",$month)->get();
                        
        return view('components.attendance_overview_table', compact('employees','holidays','company_setting', 'periods', 'attendances'))->render();
    }

    public function pdfDownload(){
        $attendances = CheckinCheckout::with('employee')->get();

        $pdf = PDF::loadView('pdf.attendance', ['attendances' => $attendances]);
        return $pdf->download('attendance.pdf');
    }
}
