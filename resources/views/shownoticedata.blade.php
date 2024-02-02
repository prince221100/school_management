@extends('masterpage')

@section('content')

<div class="page-wrapper">
<div class="content container-fluid">

<div class="page-header">
<div class="row align-items-center">
<div class="col">
<h3 class="page-title">Show Data</h3>
<ul class="breadcrumb">
<li class="breadcrumb-item"><a href="{{Route('dashboard')}}">Dashboard</a></li>
<li class="breadcrumb-item active">All Notice details</li>
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
        <th>Message</th>
        <th>Date (YYYY-MM-DD)</th>

        @if (session()->get('role') == 1)
        <th class="text-right">Action</th>
        @endif
    </tr>
    </thead>
<tbody>
    @foreach ($val as $tdata)
    <tr>
        <td>{{$loop->iteration}}</td>
        <td>{{$tdata->Message}}</td>
        <td>{{$tdata->date}}</td>
        <td class="text-right">
        @if (session()->get('role') == 1)

        <div class="actions">
        <a href="/editnoticedetails/{{$tdata->id}}" class="btn btn-sm bg-success-light mr-2 edit">
            {{-- <i class="fas fa-pen"></i> --}}Edit
            </a>

            <a href="/delnoticedetails/{{$tdata->id}}" class="btn btn-sm bg-danger-light mr-2 del">Delete</a>

            </div>
        @endif
        </td>
    </tr>


    @endforeach
    {{ $val->links('pagination::bootstrap-5')}}

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
    </div>
    </div>
    </div>




<script>
    $(document).ready(function(){
        $(".edit").click(function(){
            alert("Are You sure for Edit ??");
        });
        $(".del").click(function(){
            alert("Are You sure to delete record ??");
        });
    });

</script>
</div>

</div>
@endsection
