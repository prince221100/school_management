@extends('masterpage')

@section('content')

<div class="page-wrapper">
<div class="content container-fluid">

<div class="page-header">
<div class="row align-items-center">
<div class="col">
<h3 class="page-title">Students</h3>
<ul class="breadcrumb">
<li class="breadcrumb-item"><a href="{{Route('dashboard')}}">Dashboard</a></li>
<li class="breadcrumb-item active">Students</li>
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
        <th>First Name</th>
        <th>Last Name</th>
        <th>Mobile Number</th>
        <th>Email</th>
        @if (session()->get('role') != 3)
        <th class="text-right">Action</th>
        @endif
    </tr>
    </thead>
<tbody>


@foreach ($teacher as $tdata )

<tr>
    <td>{{$loop->iteration}}</td>
    <td>{{$tdata->firstname}}</td>
    <td>{{$tdata->lastname}}</td>
    <td>{{$tdata->mobileno}}</td>
    <td>{{$tdata->email}}</td>


    <td class="text-right">
    @if (session()->get('role') != 3)

    <div class="actions">
        <a href="/addstudent/{{$tdata->id}}/edit" class="btn btn-sm bg-success-light mr-2 edit">
        {{-- <i class="fas fa-pen"></i> --}}Edit
        </a>
        <br><br>
        <form action="/addstudent/{{$tdata->id}}" method="POST">
            @csrf
            @method('DELETE')
                <input type="submit" class="btn btn-sm bg-danger-light del" value="Delete">
        </form>
    </div>
    @endif
    </td>
</tr>


@endforeach
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
{{ $teacher->links('pagination::bootstrap-5')}}
</div>
</div>
</div>

<footer>
<p>Copyright © 2020 Dreamguys.</p>
</footer>
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
