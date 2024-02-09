@extends('masterpage')

@section('content')

<div class="page-wrapper">
<div class="content container-fluid">

<div class="page-header">
<div class="row align-items-center">
<div class="col">
<h3 class="page-title">Show Leave Data</h3>
<ul class="breadcrumb">
<li class="breadcrumb-item"><a href="{{Route('dashboard')}}">Dashboard</a></li>
<li class="breadcrumb-item active">All Students Leave Request</li>
</ul>
</div>
{{-- <div class="col-auto text-right float-right ml-auto">
<a href="#" class="btn btn-outline-primary mr-2"><i class="fas fa-download"></i> Download</a>
<a href="add-teacher.html" class="btn btn-primary"><i class="fas fa-plus"></i></a>
</div> --}}
</div>
</div>

<div class="row">
<div class="col-sm-12">
<div class="card card-table">
<div class="card-body">
<div class="table-responsive">
<table class="table table-hover table-center mb-0 datatable">
    <thead>
    <tr>
        <th>ID</th>
        <th>Student Name</th>
        <th>Type</th>
        <th>Start Date</th>
        <th>End Date</th>
        <th>Current Status</th>

        @if (session()->get('role') != 3)

            <th class="text-right">Action</th>
        @endif

    </tr>
    </thead>
<tbody>

@foreach ($val as $tdata)
    <tr>
        @if ($tdata->Admin->role == 3)
            <td>{{$loop->iteration}}</td>
            <td>{{$tdata->Admin->firstname}}</td>


            <td>{{$tdata->type}}</td>
            <td>{{$tdata->start_date}}</td>
            <td>{{$tdata->end_date}}</td>

            @if ($tdata->status == 0)
                <td><span class="badge badge-warning">Pending</span></td>
            @elseif ($tdata->status == 1)
                <td><span class="badge badge-success">Accept</span></td>
            @else
                <td><span class="badge badge-danger">Deny</span></td>

            @endif



        <td class="text-right">
            @if (session()->get('role') != 3)
                @if($tdata->status == 0)
                    <div class="actions">
                    <a href="/acceptrequest/{{$tdata->id}}" class="btn btn-sm bg-success mr-2 edit">Accept</a>

                    <a href="/denyrequest/{{$tdata->id}}" class="btn btn-sm bg-danger mr-2 del">Deny</a>

                    </div>
                @else
                <div class="actions">
                    <a href="" class="btn btn-sm bg-info light mr-2">No pending</a>

                    </div>

                @endif
            @endif
        @endif

    </td>
    </tr>


@endforeach
    @if($errors->any())
    <span style="color: red">{{$errors->first()}}</span>
    @endif



    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    </td>
    </tr>
    </tbody>
    </table>
    </div>
    </div>
    </div>
    {{ $val->links('pagination::bootstrap-5')}}
    </div>
    </div>
    </div>




<script>
    $(document).ready(function(){
        $(".edit").click(function(){
            alert("Are You Sure To Accept Request ??");
        });
        $(".del").click(function(){
            alert("Are You Sure To Deny Request ??");
        });
    });

</script>
</div>

</div>
@endsection
