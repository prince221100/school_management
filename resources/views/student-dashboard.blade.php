<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from preschool.dreamguystech.com/html-template/student-dashboard.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 28 Oct 2021 11:11:43 GMT -->
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
<title>Preskool - Dashboard</title>

<link rel="shortcut icon" href="{{ url('frontend/img/favicon.png')}}">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,500;0,600;0,700;1,400&amp;display=swap">

<link rel="stylesheet" href="{{ url('frontend/plugins/bootstrap/css/bootstrap.min.css')}}">

<link rel="stylesheet" href="{{ url('frontend/plugins/fontawesome/css/fontawesome.min.css')}}">
<link rel="stylesheet" href="{{ url('frontend/plugins/fontawesome/css/all.min.css')}}">

<link rel="stylesheet" href="{{ url('frontend/plugins/simple-calendar/simple-calendar.css')}}">

<link rel="stylesheet" href="{{ url('frontend/css/style.css')}}">
</head>
<body>

<div class="main-wrapper">

<div class="header">

<div class="header-left">
<a href="{{ Route('dashboard')}}" class="logo">
<img src="{{ url('frontend/img/logo.png')}}" alt="Logo">
</a>
<a href="{{ Route('dashboard')}}" class="logo logo-small">
<img src="{{ url('frontend/img/logo-small.png')}}" alt="Logo" width="30" height="30">
</a>
</div>

<a href="javascript:void(0);" id="toggle_btn">
<i class="fas fa-align-left"></i>
</a>

<div class="top-nav-search">
<form>
<input type="text" class="form-control" placeholder="Search here">
<button class="btn" type="submit"><i class="fas fa-search"></i></button>
</form>
</div>


<a class="mobile_btn" id="mobile_btn">
<i class="fas fa-bars"></i>
</a>


<ul class="nav user-menu">


<li class="nav-item dropdown has-arrow">
<a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
<span class="user-img"><img class="rounded-circle" src="{{ url('frontend/img/profiles/new.png')}}" width="31" alt="Ryan Taylor"></span>
</a>

<div class="dropdown-menu">
<div class="user-header">
<div class="avatar avatar-sm">
<img src="{{ url('frontend/img/profiles/new.png')}}" alt="User Image" class="avatar-img rounded-circle">
</div>
<div class="user-text">
<h6>{{ session()->get('fname')}}</h6>
<p class="text-muted mb-0">{{$rname}}</p>
</div>
</div>
<a class="dropdown-item" href="{{Route('profile')}}">My Profile</a>
<a class="dropdown-item" href="{{ Route('logout')}}">Logout</a>
</div>
</li>

</ul>

</div>


<div class="sidebar" id="sidebar">
<div class="sidebar-inner slimscroll">
<div id="sidebar-menu" class="sidebar-menu">
<ul>
<li class="menu-title">
<span>Main Menu</span>
</li>
<li class="submenu active">
<a href="#"><i class="fas fa-user-graduate"></i> <span> Dashboard</span> <span class="menu-arrow"></span></a>
<ul>
{{-- <li><a href="index.html">Admin Dashboard</a></li>
<li><a href="teacher-dashboard.html">Teacher Dashboard</a></li> --}}
<li><a href="{{Route('dashboard')}}" class="active">{{$rname}} Dashboard</a></li>
</ul>
</li>
<li class="submenu">
<a href="#"><i class="fas fa-user-graduate"></i> <span> Students</span> <span class="menu-arrow"></span></a>
<ul>
<li><a href="{{ url('/addstudent')}}">Student List</a></li>
{{-- <li><a href="student-details.html">Student View</a></li>
<li><a href="add-student.html">Student Add</a></li>
<li><a href="edit-student.html">Student Edit</a></li> --}}
</ul>
</li>
<li class="submenu">
<a href="#"><i class="fas fa-chalkboard-teacher"></i> <span> Teachers</span> <span class="menu-arrow"></span></a>
<ul>
<li><a href="{{ url('/addteacher')}}">Teacher List</a></li>
{{-- <li><a href="teacher-details.html">Teacher View</a></li>
<li><a href="add-teacher.html">Teacher Add</a></li>
<li><a href="edit-teacher.html">Teacher Edit</a></li> --}}
</ul>
</li>
<li class="submenu">
<a href="#"><i class="fas fa-building"></i> <span> Classmate Detail</span> <span class="menu-arrow"></span></a>
<ul>
<li><a href="{{Route('classmatedetails')}}">Classmate List</a></li>
{{-- <li><a href="add-department.html">Department Add</a></li>
<li><a href="edit-department.html">Department Edit</a></li> --}}
</ul>
</li>
<li class="submenu">
    <a href="#"><i class="fas fa-book-reader"></i> <span> Subject Details</span> <span class="menu-arrow"></span></a>
    <ul>
    <li><a href="{{Route('subjectdetails')}}">Subject List</a></li>
    {{-- <li><a href="add-subject.html">Subject Add</a></li>
    <li><a href="edit-subject.html">Subject Edit</a></li> --}}
    </ul>
    </li>
{{-- <li class="submenu">
<a href="#"><i class="fas fa-book-reader"></i> <span> Subjects</span> <span class="menu-arrow"></span></a>
<ul>
<li><a href="subjects.html">Subject List</a></li>
<li><a href="add-subject.html">Subject Add</a></li>
<li><a href="edit-subject.html">Subject Edit</a></li>
</ul>
</li> --}}
<li class="menu-title">
<span>Management</span>
</li>
<li>
    <a href="{{Route('showexamdata')}}"><i class="fas fa-clipboard-list"></i> <span>Exam schedule</span></a>
</li>
<li class="submenu">
<a href="#"><i class="fas fa-file-invoice-dollar"></i> <span> Accounts</span> <span class="menu-arrow"></span></a>
<ul>
<li><a href="fees-collections.html">Fees Collection</a></li>
<li><a href="expenses.html">Expenses</a></li>
<li><a href="salary.html">Salary</a></li>
<li><a href="add-fees-collection.html">Add Fees</a></li>
<li><a href="add-expenses.html">Add Expenses</a></li>
<li><a href="add-salary.html">Add Salary</a></li>
</ul>
</li>
<li>
<a href="holiday.html"><i class="fas fa-holly-berry"></i> <span>Holiday</span></a>
</li>
<li>
<a href="fees.html"><i class="fas fa-comment-dollar"></i> <span>Fees</span></a>
</li>

<li>
<a href="event.html"><i class="fas fa-calendar-day"></i> <span>Events</span></a>
</li>
<li>
<a href="time-table.html"><i class="fas fa-table"></i> <span>Time Table</span></a>
</li>
<li>
<a href="library.html"><i class="fas fa-book"></i> <span>Library</span></a>
</li>
{{-- <li class="menu-title">
<span>Pages</span>
</li>
<li class="submenu">
<a href="#"><i class="fas fa-shield-alt"></i> <span> Authentication </span> <span class="menu-arrow"></span></a>
<ul>
<li><a href="login.html">Login</a></li>
<li><a href="register.html">Register</a></li>
<li><a href="forgot-password.html">Forgot Password</a></li>
<li><a href="error-404.html">Error Page</a></li>
</ul>
</li>
<li>
<a href="blank-page.html"><i class="fas fa-file"></i> <span>Blank Page</span></a>
</li>
<li class="menu-title">
<span>Others</span>
</li>
<li>
<a href="sports.html"><i class="fas fa-baseball-ball"></i> <span>Sports</span></a>
</li>
<li>
<a href="hostel.html"><i class="fas fa-hotel"></i> <span>Hostel</span></a>
</li>
<li>
<a href="transport.html"><i class="fas fa-bus"></i> <span>Transport</span></a>
</li>
<li class="menu-title">
<span>UI Interface</span>
</li> --}}
{{-- <li>
<a href="components.html"><i class="fas fa-vector-square"></i> <span>Components</span></a>
</li>
<li class="submenu">
<a href="#"><i class="fas fa-columns"></i> <span> Forms </span> <span class="menu-arrow"></span></a>
<ul>
<li><a href="form-basic-inputs.html">Basic Inputs </a></li>
<li><a href="form-input-groups.html">Input Groups </a></li>
<li><a href="form-horizontal.html">Horizontal Form </a></li>
<li><a href="form-vertical.html"> Vertical Form </a></li>
<li><a href="form-mask.html"> Form Mask </a></li>
<li><a href="form-validation.html"> Form Validation </a></li>
</ul>
</li>
<li class="submenu">
<a href="#"><i class="fas fa-table"></i> <span> Tables </span> <span class="menu-arrow"></span></a>
<ul>
<li><a href="tables-basic.html">Basic Tables </a></li>
<li><a href="data-tables.html">Data Table </a></li>
</ul>
</li>
<li class="submenu">
<a href="javascript:void(0);"><i class="fas fa-code"></i> <span>Multi Level</span> <span class="menu-arrow"></span></a>
<ul>
<li class="submenu">
<a href="javascript:void(0);"> <span>Level 1</span> <span class="menu-arrow"></span></a>
<ul>
<li><a href="javascript:void(0);"><span>Level 2</span></a></li>
<li class="submenu">
<a href="javascript:void(0);"> <span> Level 2</span> <span class="menu-arrow"></span></a>
<ul>
<li><a href="javascript:void(0);">Level 3</a></li>
<li><a href="javascript:void(0);">Level 3</a></li>
</ul>
</li>
<li><a href="javascript:void(0);"> <span>Level 2</span></a></li>
</ul>
</li>
<li>
<a href="javascript:void(0);"> <span>Level 1</span></a>
</li>
</ul>
</li>
</ul> --}}
</div>
</div>
</div>


<div class="page-wrapper">
<div class="content container-fluid">

<div class="page-header">
<div class="row">
<div class="col-sm-12">
<h3 class="page-title">Welcome {{session()->get('fname')}}</h3>
<ul class="breadcrumb">
{{-- <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li> --}}
<li class="breadcrumb-item active">{{$rname}} Dashboard</li>
</ul>
</div>
</div>
</div>


<div class="row">
    <div class="col-xl-3 col-sm-6 col-12 d-flex">
        <div class="card bg-five w-100">
        <div class="card-body">
        <div class="db-widgets d-flex justify-content-between align-items-center">
        <div class="db-icon">
        <i class="fas fa-user-graduate"></i>
        </div>
        <div class="db-info">
        <h3>{{$tcount}}</h3>
        <h6><a href="{{ url('/addteacher')}}">Total Teachers</a></h6>
        </div>
        </div>
        </div>
        </div>
        </div>
    <div class="col-xl-3 col-sm-6 col-12 d-flex">
    <div class="card bg-six w-100">
    <div class="card-body">
    <div class="db-widgets d-flex justify-content-between align-items-center">
    <div class="db-icon">
    <i class="fas fa-user-graduate"></i>
    </div>
    <div class="db-info">
    <h3>{{$scount}}</h3>
    <h6><a href="{{ url('/addstudent')}}">Total Students</a></h6>
    </div>
    </div>
    </div>
    </div>
    </div>
    <div class="col-xl-3 col-sm-6 col-12 d-flex">
    <div class="card bg-ten w-100">
    <div class="card-body">
    <div class="db-widgets d-flex justify-content-between align-items-center">
    <div class="db-icon">
    <i class="fas fa-clipboard-list"></i>
    </div>
    <div class="db-info">
    @if ($classname)
    <h3>{{$classname}}</h3>
    @else
        <h3>Not Assigned</h3>
    @endif
    <h6>Class Assigned</h6>
    </div>
    </div>
    </div>
    </div>
    </div>
<div class="col-xl-3 col-sm-6 col-12 d-flex">
<div class="card bg-eleven w-100">
<div class="card-body">
<div class="db-widgets d-flex justify-content-between align-items-center">
<div class="db-icon">
<i class="fas fa-clipboard-check"></i>
</div>
<div class="db-info">
    @if ($totalstudent)
    <h3>{{$totalstudent}}</h3>
    @else
        <h3>No Data</h3>
    @endif
    <h6><a href="/classmate">Classmates</a></h6>
</div>
</div>
</div>
</div>
</div>
</div>


<div class="row">
<div class="col-12 col-lg-12 col-xl-9">
<div class="card flex-fill">
<div class="card-header">
<div class="row align-items-center">
<div class="col-6">
<h5 class="card-title">Today’s Lesson</h5>
</div>
<div class="col-6">
<span class="float-right view-link"><a href="#">View All Courses</a></span>
</div>
</div>
</div>
<div class="dash-circle">
<div class="row">
<div class="col-12 col-lg-6 col-xl-6 dash-widget3">
<div class="card-body dash-widget1">
<div class="circle-bar circle-bar2">
<div class="circle-graph2" data-percent="20">
<b>20%</b>
</div>
<h6>Lesson Learned</h6>
<h4>10 <span>/ 50</span></h4>
</div>
<div class="dash-details">
<h4>Facilisi etiam</h4>
<ul>
<li><i class="fas fa-clock"></i> 2.30pm - 3.30pm</li>
<li><i class="fas fa-book-open"></i> 5 Lessons</li>
<li><i class="fas fa-hourglass-end"></i> 60 Minutes</li>
<li><i class="fas fa-clipboard-check"></i> 5 Asignment</li>
</ul>
<div class="dash-btn">
<button type="submit" class="btn btn-info btn-border">Skip</button>
<button type="submit" class="btn btn-info">Continue</button>
</div>
</div>
</div>
</div>
<div class="col-12 col-lg-6 col-xl-6 dash-widget4">
<div class="card-body dash-widget1 dash-widget2">
<div class="circle-bar circle-bar3">
<div class="circle-graph3" data-percent="50">
<b>50%</b>
</div>
<h6>Lesson Learned</h6>
<h4>25 <span>/ 50</span></h4>
</div>
<div class="dash-details">
<h4>Augue mauris</h4>
<ul>
<li><i class="fas fa-clock"></i> 3.30pm - 4.30pm</li>
<li><i class="fas fa-book-open"></i> 6 Lessons</li>
<li><i class="fas fa-hourglass-end"></i> 60 Minutes</li>
<li><i class="fas fa-clipboard-check"></i> 6 Asignment</li>
</ul>
<div class="dash-btn">
<button type="submit" class="btn btn-info btn-border">Skip</button>
<button type="submit" class="btn btn-info">Continue</button>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<div class="row">
<div class="col-12 col-lg-12 col-xl-8 d-flex">
<div class="card flex-fill">
<div class="card-header">
<div class="row align-items-center">
<div class="col-6">
<h5 class="card-title">Learning Activity</h5>
</div>
<div class="col-6">
<ul class="list-inline-group text-right mb-0 pl-0">
<li class="list-inline-item">
<div class="form-group mb-0 amount-spent-select">
<select class="form-control form-control-sm">
<option>Weekly</option>
<option>Monthly</option>
<option>Yearly</option>
</select>
</div>
</li>
</ul>
</div>
</div>
</div>
<div class="card-body">
<div id="apexcharts-area"></div>
</div>
</div>
</div>
<div class="col-12 col-lg-12 col-xl-4 d-flex">
<div class="card flex-fill">
<div class="card-header">
<h5 class="card-title">Learning History</h5>
</div>
<div class="card-body">
<div class="teaching-card">
<ul class="activity-feed">
<li class="feed-item">
<div class="feed-date1">Sep 05, 9 am - 10 am (60min)</div>
<span class="feed-text1"><a>Lorem ipsum dolor</a></span>
<p><span>In Progress</span></p>
</li>
<li class="feed-item">
<div class="feed-date1">Sep 04, 2 pm - 3 pm (70min)</div>
<span class="feed-text1"><a>Et dolore magna</a></span>
<p>Completed</p>
</li>
<li class="feed-item">
<div class="feed-date1">Sep 02, 1 pm - 2 am (80min)</div>
<span class="feed-text1"><a>Exercitation ullamco</a></span>
<p><span>In Progress</span></p>
</li>
<li class="feed-item">
<div class="feed-date1">Aug 30, 10 am - 12 pm (90min)</div>
<span class="feed-text1"><a>Occaecat cupidatat</a></span>
<p>Completed</p>
</li>
</ul>
</div>
</div>
</div>
</div>
</div>
</div>
<div class="col-12 col-lg-12 col-xl-3 d-flex">
<div class="card flex-fill">
<div class="card-header">
<div class="row align-items-center">
<div class="col-12">
<h5 class="card-title">Calendar</h5>
</div>
</div>
</div>
<div class="card-body">
<div id="calendar-doctor" class="calendar-container"></div>
<div class="calendar-info calendar-info1">
<div class="calendar-details">
<p>09 am</p>
<h6 class="calendar-blue d-flex justify-content-between align-items-center">Fermentum <span>09am - 10pm</span></h6>
</div>
<div class="calendar-details">
<p>10 am</p>
<h6 class="calendar-violet d-flex justify-content-between align-items-center">Pharetra et <span>10am - 11am</span></h6>
</div>
<div class="calendar-details">
<p>11 am</p>
<h6 class="calendar-red d-flex justify-content-between align-items-center">Break <span>11am - 11.30am</span></h6>
</div>
<div class="calendar-details">
<p>12 pm</p>
<h6 class="calendar-orange d-flex justify-content-between align-items-center">Massa <span>11.30am - 12.00pm</span></h6>
</div>
<div class="calendar-details">
<p>09 am</p>
<h6 class="calendar-blue d-flex justify-content-between align-items-center">Fermentum <span>09am - 10pm</span></h6>
</div>
</div>
</div>
</div>
</div>
</div>

</div>

<footer>
<p>Copyright © 2020 Dreamguys.</p>
</footer>

</div>

</div>


<script src="{{ url('frontend/js/jquery-3.6.0.min.js')}}"></script>

<script src="{{ url('frontend/js/popper.min.js')}}"></script>
<script src="{{ url('frontend/plugins/bootstrap/js/bootstrap.min.js')}}"></script>

<script src="{{ url('frontend/plugins/slimscroll/jquery.slimscroll.min.js')}}"></script>

<script src="{{ url('frontend/plugins/apexchart/apexcharts.min.js')}}"></script>
<script src="{{ url('frontend/plugins/apexchart/chart-data.js')}}"></script>

<script src="{{ url('frontend/plugins/simple-calendar/jquery.simple-calendar.js')}}"></script>
<script src="{{ url('frontend/js/calander.js')}}"></script>

<script src="{{ url('frontend/js/circle-progress.min.js')}}"></script>

<script src="{{ url('frontend/js/script.js')}}"></script>
</body>

<!-- Mirrored from preschool.dreamguystech.com/html-template/student-dashboard.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 28 Oct 2021 11:11:43 GMT -->
</html>
