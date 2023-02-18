@extends('layouts.app')
@section('title','Smart HR')
@section('content')
<div class="" style="width:100%"> 
<!-- div class="container" ပါအစက ။ခပ်သေးသေးကြိုက်ရင် container နဲ့ ပြန်အုပ်လိုက်။ -->
    <div class="row">
        <div class="col-lg-8 col-md-12 py-3">
            <div class="card">
                    <div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
                        <h6 class="mb-0 fw-bold ">Employees Attendance</h6>                    
                    </div>
                <div class="card-body">
                    <div class="">
                        <div id="attendance_div" class="chart"></div>
                    </div>
                </div>
            </div>
            
            <div class="row g-3 py-4">    
                <div class="col-md-6 py-3">
                    <div class="card present-late-info">
                        <div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
                            <h6 class="mb-0 fw-bold ">Employees Availability</h6>
                        </div>
                        <div class="card-body">
                            <div class="row g-2 row-deck">
                                <div class="col-md-6 col-sm-6 py-2">
                                    <div class="card">
                                        <div class="card-body ">
                                            <i class="fa-solid fa-check-to-slot"></i>
                                            <h6 class="mt-3 mb-0 fw-bold small-14">Attendance</h6>
                                            <span class="text-muted">22</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 py-2">
                                    <div class="card">
                                        <div class="card-body ">
                                            <i class="fa-solid fa-clock"></i>
                                            <h6 class="mt-3 mb-0 fw-bold small-14">Late Coming</h6>
                                            <span class="text-muted">5</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 py-2">
                                    <div class="card">
                                        <div class="card-body ">
                                            <i class="fa-solid fa-ban"></i>
                                            <h6 class="mt-3 mb-0 fw-bold small-14">Absent</h6>
                                            <span class="text-muted">5</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 py-2">
                                    <div class="card">
                                        <div class="card-body ">
                                            <i class="fa-solid fa-umbrella-beach"></i>
                                            <h6 class="mt-3 mb-0 fw-bold small-14">Leave Apply</h6>
                                            <span class="text-muted">14</span> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 py-3">
                    <div class="card total-no">
                        <div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
                            <h6 class="mb-0 fw-bold ">Total Employees</h6>
                            <h4 class="mb-0 fw-bold ">30</h4>
                        </div>
                        <div id="employee_div"></div>
                    </div>
                </div>
            </div>
                           
            <div class="card py-3">
                <div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
                    <h6 class="mb-0 fw-bold ">Hired Designations Per Year</h6>                    
                </div>
                <div class="card-body">
                    <div class="">
                        <div id="hired_div" class="chart"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-12 py-3">
            <div class="card" style="background:#484c7f;">
                <div class="card-body row">
                    <div class="col homefas">
                        <span class="avatar lg bg-white rounded-circle text-center d-flex align-items-center justify-content-center">
                            <i class="fa-solid fa-file"></i>
                        </span>
                        <h1 class="mt-3 mb-0 fw-bold text-white">200</h1>
                        <span class="text-white">Applications</span>
                    </div>
                    <div class="col">
                        <img class="img-fluid" src="{{asset('image/interview.png')}}" alt="interview">
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
                    <h6 class="mb-0 fw-bold ">Upcomming Interviews</h6>
                </div>
                <div class="card-body">
                    <div class="flex-grow-1">
                        <div class="py-2 d-flex align-items-center border-bottom flex-wrap">
                            <div class="d-flex align-items-center flex-fill">
                                <img class="avatar lg rounded-circle img-thumbnail" src="{{asset('image/user1.png')}}" alt="profile">
                                <div class="d-flex flex-column ps-3">
                                    <h6 class="fw-bold mb-0 small-14">Aung Thu </h6>
                                    <span class="text-muted">Ui/UX Designer</span>
                                </div>
                            </div>
                            <div class="time-block text-truncate">
                                <i class="icofont-clock-time"></i> 1:00 - 1:30
                            </div>
                        </div>
                        <div class="py-2 d-flex align-items-center border-bottom flex-wrap">
                            <div class="d-flex align-items-center flex-fill">
                                <img class="avatar lg rounded-circle img-thumbnail" src="{{asset('image/user2.png')}}" alt="profile">
                                <div class="d-flex flex-column ps-3">
                                    <h6 class="fw-bold mb-0 small-14">Si Thu Soe</h6>
                                    <span class="text-muted">Web Design</span>
                                </div>
                            </div>
                            <div class="time-block text-truncate">
                                <i class="icofont-clock-time"></i> 9:00 - 1:30
                            </div>
                        </div>
                        <div class="py-2 d-flex align-items-center border-bottom flex-wrap">
                            <div class="d-flex align-items-center flex-fill">
                                <img class="avatar lg rounded-circle img-thumbnail" src="{{asset('image/user3.png')}}" alt="profile">
                                <div class="d-flex flex-column ps-3">
                                    <h6 class="fw-bold mb-0 small-14">Kyaw Kyaw Aung</h6>
                                    <span class="text-muted">PHP Developer</span>
                                </div>
                            </div>
                            <div class="time-block text-truncate">
                                <i class="icofont-clock-time"></i> 1:30 - 2:30
                            </div>
                        </div>
                        <div class="py-2 d-flex align-items-center border-bottom flex-wrap">
                            <div class="d-flex align-items-center flex-fill">
                                <img class="avatar lg rounded-circle img-thumbnail" src="{{asset('image/user4.png')}}" alt="profile">
                                <div class="d-flex flex-column ps-3">
                                    <h6 class="fw-bold mb-0 small-14">Myo Ko Ko</h6>
                                    <span class="text-muted">IOS Developer</span>
                                </div>
                            </div>
                            <div class="time-block text-truncate">
                                <i class="icofont-clock-time"></i> 2:00 - 3:30
                            </div>
                        </div>
                        <div class="py-2 d-flex align-items-center border-bottom flex-wrap">
                            <div class="d-flex align-items-center flex-fill">
                                <img class="avatar lg rounded-circle img-thumbnail" src="{{asset('image/user5.png')}}" alt="profile">
                                <div class="d-flex flex-column ps-3">
                                    <h6 class="fw-bold mb-0 small-14">Hla Hla Tin</h6>
                                    <span class="text-muted">HR Assistant</span>
                                </div>
                            </div>
                            <div class="time-block text-truncate">
                                <i class="icofont-clock-time"></i> 4:00 - 4:30
                            </div>
                        </div>
                        <div class="py-2 d-flex align-items-center border-bottom flex-wrap">
                            <div class="d-flex align-items-center flex-fill">
                                <img class="avatar lg rounded-circle img-thumbnail" src="{{asset('image/user6.png')}}" alt="profile">
                                <div class="d-flex flex-column ps-3">
                                    <h6 class="fw-bold mb-0 small-14">Pan Pan</h6>
                                    <span class="text-muted">Unity 3d</span>
                                </div>
                            </div>
                            <div class="time-block text-truncate">
                                <i class="icofont-clock-time"></i> 7:00 - 8:00
                            </div>
                        </div>
                        <div class="py-2 d-flex align-items-center  flex-wrap">
                            <div class="d-flex align-items-center flex-fill">
                                <img class="avatar lg rounded-circle img-thumbnail" src="{{asset('image/user10.jpg')}}" alt="profile">
                                <div class="d-flex flex-column ps-3">
                                    <h6 class="fw-bold mb-0 small-14">Khin Mu Yar</h6>
                                    <span class="text-muted">Networking</span>
                                </div>
                            </div>
                            <div class="time-block text-truncate">
                                <i class="icofont-clock-time"></i> 8:00 - 9:00
                            </div>
                        </div>
                        <div class="py-2 d-flex align-items-center  flex-wrap">
                            <div class="d-flex align-items-center flex-fill">
                                <img class="avatar lg rounded-circle img-thumbnail" src="{{asset('image/user7.png')}}" alt="profile">
                                <div class="d-flex flex-column ps-3">
                                    <h6 class="fw-bold mb-0 small-14">Kyi Pyar</h6>
                                    <span class="text-muted">Networking</span>
                                </div>
                            </div>
                            <div class="time-block text-truncate">
                                <i class="icofont-clock-time"></i> 12:00 - 13:00
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script type="text/javascript">
    // Start Attendance Chart
    google.load("visualization", "1", {packages:["corechart"]});
    google.setOnLoadCallback(drawChart1);
    function drawChart1() {
        var data = google.visualization.arrayToDataTable([
        ['Days','No of People'],
          ['1 Jan',30],
          ['2 Jan',30],
          ['3 Jan',30],
          ['4 Jan',28],
          ['5 Jan',28],
          ['6 Jan',29],
          ['7 Jan',30],
          ['8 Jan',30],
          ['9 Jan',30],
          ['10 Jan',30],
          ['11 Jan',25],
          ['12 Jan',27],
          ['13 Jan',29],
          ['14 Jan',29],
          ['15 Jan',28],
          ['16 Jan',26],
          ['17 Jan',14],
          ['18 Jan',27],
          ['19 Jan',29],
          ['20 Jan',30],
          ['21 Jan',30],
          ['22 Jan',30],
          ['23 Jan',0],
          ['24 Jan',0],
          ['25 Jan',0],
          ['26 Jan',0],
          ['27 Jan',0],
          ['28 Jan',0],
          ['29 Jan',0],
          ['30 Jan',0],
          ['31 Jan',0]
      ]);
    var options = {
        title: '2023 January Attendance',
        hAxis: {title: 'Year', titleTextStyle: {color: 'blue'}}
    };

    var chart = new google.visualization.ColumnChart(document.getElementById('attendance_div'));
    chart.draw(data, options);
    }
    // End Attendance Chart

    // Start Hired Chart
    google.load("visualization", "1", {packages:["corechart"]});
    google.setOnLoadCallback(drawChart2);
    function drawChart2() {
    var data = google.visualization.arrayToDataTable([
        ['Designation', 'Front-End Developer','Back-End Developer', 'UI/UX Designer', { role: 'annotation' } ],
        ['2010', 1, 5, 2, ''],
        ['2011', 1, 2, 3, ''],
        ['2013', 2, 0, 1, ''],
        ['2014', 1, 3, 0, ''],
        ['2018', 1, 3, 0, ''],
        ['2023', 0, 2, 5, '']
    ]);

    var options = {
        title: 'Hired Positon',
        legend: { position: 'top', maxLines: 3 },
        bar: { groupWidth: '75%' },
        colors: ['#484c7f','#222fe0','#53efcb'],
        isStacked: true,
    };

    var chart = new google.visualization.ColumnChart(document.getElementById('hired_div'));
    chart.draw(data, options);
    }
    // End Hired Chart

    // Start No of Employee Chart
    google.load("visualization", "1", {packages:["corechart"]});
    google.setOnLoadCallback(drawChart3);
    function drawChart3() {
    var data = google.visualization.arrayToDataTable([
        ['Gender', 'No'],
        ['Male',18],
        ['Female',12]
    ]);

    var options = {
        title: 'No of Employee',
        colors: ['#484c7f','#ffb703'],

        pieHole: 0.4,
        pieSliceText:'value',
    };

    var chart = new google.visualization.PieChart(document.getElementById('employee_div'));
    chart.draw(data, options);
    }
    // End No of Employee Chart

    $(window).resize(function(){
    drawChart1();
    drawChart2();
    drawChart3();
    });

// Reminder: you need to put https://www.google.com/jsapi in the head of your document or as an external resource on codepen //
</script>
@endsection
