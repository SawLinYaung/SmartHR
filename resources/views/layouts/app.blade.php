<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <!-- Bootstrap core CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">

    <!-- Material Design Bootstrap -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/css/mdb.min.css" rel="stylesheet">

    {{-- Datatable --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.bootstrap4.min.css">
    
    {{-- Daterange picker --}}
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/viewerjs/1.10.1/viewer.min.css">

    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    @yield('extra_css')
</head>

<body>
    <div class="page-wrapper chiller-theme">
        <nav id="sidebar" class="sidebar-wrapper">
            <div class="sidebar-content">
            <div class="sidebar-brand">
                <a href="/">Smart HR</a>
                <div id="close-sidebar">
                    <i class="fas fa-times"></i>
                </div>
            </div>
            <div class="sidebar-header">
                <div class="user-pic">
                    <img class="img-responsive img-rounded" 
                    src="{{auth()->user()->profile_img_path()}}"
                    alt="User picture">
                </div>
                <div class="user-info">
                    <span class="user-name">{{auth()->user()->name}}</span>
                </span>
                <span class="user-role">
                    @php
                    $des_id = auth()->user()->designation_id;
                    $des_title = \App\Designation::where(['id' => $des_id])->first();
                    if($des_title == null){
                        $des_title ='';
                    }
                    @endphp

                    {{$des_title->title}}
                </span> 
                <!-- ပြင်ရန် -->
                <span class="user-status">
                    <i class="fa fa-circle"></i>
                    <span>Online</span>
                </span>
                </div>
            </div>
            <!-- sidebar-header  -->
            <div class="sidebar-menu">
                <ul>
                <li class="header-menu">
                    <span>General</span>
                </li>
                <li>
                    <a href="/">
                    <i class="fa fa-home"></i>
                    <span>Home</span>
                    </a>
                </li>

                @if($des_id == 1)
                <li class="sidebar-dropdown">
                    <a href="#">
                        <i class="fa-solid fa-user"></i>
                        <span>Employees</span>
                    </a>
                    <div class="sidebar-submenu">
                    <ul>
                        <li>
                        <a href="{{route('employee.create')}}">Add Employee Information
                        </a>
                        </li>
                        <li>
                        <a href="{{route('employee.index')}}">View Employee Information</a>
                        </li>
                        <li>
                        <a href="{{route('department.create')}}">Add Department</a>
                        </li>
                        <li>
                        <a href="{{route('department.index')}}">View Department</a>
                        </li>
                        <li>
                        <a href="{{route('designation.create')}}">Add Designation</a>
                        </li>
                        <li>
                        <a href="{{route('designation.index')}}">View Designation</a>
                        </li>
                        <li>
                        <a href="{{route('salary.create')}}">Add Salary</a>
                        </li>
                        <li>
                        <a href="{{route('salary.index')}}">View Salary</a>
                        </li>
                    </ul>
                    </div>
                </li>                
                <li class="sidebar-dropdown">
                    <a href="#">
                    <i class="fa-solid fa-comment"></i>
                        <span>Interview</span>
                    </a>
                    <div class="sidebar-submenu">
                    <ul>
                        <li>
                        <a href="#">Add Interview
                        </a>
                        </li>
                        <li>
                        <a href="#">View Interview</a>
                        </li>
                    </ul>
                    </div>
                </li>
                @endif
                <li class="sidebar-dropdown">
                    <a href="#">
                        <i class="fa-sharp fa-solid fa-briefcase"></i>
                        <span>Project</span>
                    </a>
                    <div class="sidebar-submenu">
                    <ul>
                        @if($des_id == 1)
                        <li>
                        <a href="{{route('project.create')}}">Add Project Information
                        </a>
                        </li>
                        <li>
                        <a href="{{route('project.index')}}">View All Project</a>
                        </li>
                        @endif
                        <li>
                        <a href="{{route('my-project.index')}}">View My Projects</a>
                        </li>
                    </ul>
                    </div>
                </li>
                @if($des_id == 1)
                <li class="sidebar-dropdown">
                    <a href="#">
                        <i class="fa-solid fa-check"></i>                                                                    
                        <span>Attendance</span>
                    </a>
                    <div class="sidebar-submenu">
                    <ul>
                        <li>
                            <a href="{{route('attendance.index')}}">View Attendance
                        </a>
                        </li>
                        <li>
                            <a href="{{route('attendance-scan')}}">Scan Attendance</a>
                        </li>
                        <li>
                            <a href="{{route('leave.create')}}">Add Leave</a>
                        </li>
                        <li>
                            <a href="{{route('leave.index')}}">View Leave</a>
                        </li>
                        
                    </ul>
                    </div>
                </li>
                <li class="sidebar-dropdown">
                    <a href="#">
                        <i class="fa-solid fa-umbrella-beach"></i>
                        <span>Holiday</span>
                    </a>
                    <div class="sidebar-submenu">
                    <ul>                        
                        <li>
                            <a href="{{route('holiday.create')}}">Add Holiday</a>
                        </li>
                        <li>
                            <a href="{{route('holiday.index')}}">View Holiday</a>
                        </li>                                             
                    </ul>
                    </div>
                </li>
                @endif
                <li class="sidebar-dropdown">
                    <a href="#">
                        <i class="fa-solid fa-check"></i>                                                                    
                        <span>Payroll</span>
                    </a>
                    <div class="sidebar-submenu">
                    <ul>
                        @if($des_id == 1)
                        <li>
                            <a href="{{route('payroll')}}">View Payroll
                        </a>
                        @endif
                        </li>
                        <li>
                            <a href="{{route('my-payroll')}}">My Payroll</a>
                        </li>                        
                    </ul>
                    </div>
                </li>
                @if($des_id == 1)
                <li class="sidebar-dropdown">
                    <a href="#">
                        <i class="fa-solid fa-money-bill"></i>
                        <span>Expense</span>
                    </a>
                    <div class="sidebar-submenu">
                    <ul>
                        <li>
                        <a href="#">Add Expense
                        </a>
                        </li>
                        <li>
                        <a href="#">View Expense</a>
                        </li>
                        <li>
                        <a href="#">Add Expense Category</a>
                        </li>
                        <li>
                        <a href="#">View Expense Category</a>
                        </li>
                    </ul>
                    </div>
                </li>
                <li class="sidebar-dropdown">
                    <a href="#">
                    <i class="fa-solid fa-chart-gantt"></i>                     
                        <span>Report</span>
                    </a>
                    <div class="sidebar-submenu">
                    <ul>
                        <li>
                        <a href="#">Finanical Report
                        </a>
                        </li>
                        <li>
                        <a href="#">Project Report</a>
                        </li>
                        <li>
                        <a href="#">Attendance Report</a>
                        </li>
                    </ul>
                    </div>
                </li>
                <li>
                    <a href="{{route('company-setting.show', 1)}}">
                    <i class="fa-solid fa-gear"></i>                    
                    <span>Company Setting</span>
                    </a>
                </li>
                @endif
                <li>
                    <a href="{{route('logout')}}"
                    onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">

                    <i class="fa-solid fa-right-from-bracket"></i>                   
                    <span>Logout</span>
                    </a>
                </li>
                <li class="nav-item dropdown">
                    
                    <ul class="dropdown-menu">
                        <li>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </li>
                

                </ul>
            </div>
            <!-- sidebar-menu  -->
            </div>
            <!-- sidebar-content  -->
        
        </nav>
        <div class="app-bar" style="min-height:100px;">
            <div class="d-flex">
                <div class="">
                    <div class="d-flex justify-content-between align-items-center py-3">
                        <a href="#" id="show-sidebar">
                            <i class="fas fa-bars"></i>
                        </a> 
                        <a href=""></a>  
                        <a href=""></a> 
                        <div id="about-user" style="position:absolute;top:0;right:10px;padding-top:15px">
                            <div class="user-info-container bg-primary">
                                <div class="user-pic mx-2">
                                    <img 
                                    src="{{auth()->user()->profile_img_path()}}"
                                     alt="wrong photo" id="user-img">
                                </div>
                                <div id="user-info mx-2 bg-danger">
                                    <span class="fw-bold">{{auth()->user()->name}}</span><br/>
                                    <small>{{$des_title->title}}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="py-4 content">
            <div class="d-flex">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>

    <!-- JQuery -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js">
    </script>

    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.min.js"></script>

    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/js/mdb.min.js">
    </script>

    {{-- Datatable --}}
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.jsdelivr.net/g/mark.js(jquery.mark.min.js)"></script>
    <script src="https://cdn.datatables.net/plug-ins/1.10.13/features/mark.js/datatables.mark.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.bootstrap4.min.js"></script>

    {{-- Daterange picker --}}
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

    <!-- Laravel Javascript Validation -->
    <script type="text/javascript" src="{{ url('vendor/jsvalidation/js/jsvalidation.js')}}"></script>

    {{-- Sweet alert 2 --}}
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- Sweet alert --}}
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script src="{{ asset('vendor/larapass/js/larapass.js') }}"></script>

    <!-- View JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/viewerjs/1.10.1/viewer.min.js"></script>

     <!--Load the AJAX API-->
     <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
     
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'top',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
        });

        $(function ($) {

            let token = document.head.querySelector('meta[name="csrf-token"]');
            if(token){
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN' : token.content
                    }
                });
            }else{
                console.error('CSRF Token not found.');
            }

            $(".sidebar-dropdown > a").click(function() {
                $(".sidebar-submenu").slideUp(200);
                if (
                    $(this).parent().hasClass("active")
                ) {
                    $(".sidebar-dropdown").removeClass("active");
                    $(this).parent().removeClass("active");
                } else {
                    $(".sidebar-dropdown").removeClass("active");
                    $(this).next(".sidebar-submenu").slideDown(200);
                    $(this).parent().addClass("active");
                }
            });

            $("#close-sidebar").click(function(e) {
                e.preventDefault();
                $(".page-wrapper").removeClass("toggled");
            });

            $("#show-sidebar").click(function(e) {
                e.preventDefault();
                $(".page-wrapper").addClass("toggled");
            });

            @if(request()->is('/'))
            document.addEventListener('click', function(event){
                if(document.getElementById('show-sidebar').contains(event.target)){
                    $(".page-wrapper").addClass("toggled");
                }else if(!document.getElementById('sidebar').contains(event.target)){
                    $(".page-wrapper").removeClass("toggled");
                }
            });
            @endif

            @if(session('create'))
            Swal.fire({
                title: 'Successfully Created',
                text: "{{session('create')}}",
                icon: 'success',
                confirmButtonText: 'Continue'
            });
            @endif

            $.extend(true, $.fn.dataTable.defaults, {
                responsive: true,
                processing: true,
                serverSide: true,
                mark: true,
                columnDefs: [
                    {
                        "targets": [ 0 ],
                        "class": "control"
                    },
                    {
                        "targets": 'no-sort',
                        "orderable": false,
                    },
                    {
                        "targets": 'no-search',
                        "searchable": false,
                    },
                    {
                        "targets": 'hidden',
                        "visible": false,
                    }
                ],
                language: {
                    "paginate": {
                        "previous": "<i class='far fa-arrow-alt-circle-left'></i>",
                        "next": "<i class='far fa-arrow-alt-circle-right'></i>"
                    },
                    "processing": "<img src='/image/loading.gif' style='width:50px'/><p class='my-3'>... Loading ...</p>",
                },
            });

            $('#back-btn').on("click", function(e){
                e.preventDefault();
                window.history.go(-1);
                return false;
            });

            $('.select-ninja').select2({
                placeholder: '-- Please Choose --',
                allowClear: true,
                theme: 'bootstrap4'
            });
        });
    </script>

    @yield('script')
</body>

</html>
