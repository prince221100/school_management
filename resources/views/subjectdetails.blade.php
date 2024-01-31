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
<li class="breadcrumb-item active">All Subject Details</li>
</ul>
</div>

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
        <th>Subject Name</th>
        <th>Teacher Name</th>
        <th>Teacher Email</th>
        <th>Teacher Mobile No.</th>

    </tr>
    </thead>
<tbody>
@if ($val)

    @foreach ($val as $tdata)
    <tr>
        <td>{{$loop->iteration}}</td>
        <td>{{$tdata->Subject_info->subject_name}}</td>
        <td>{{$tdata->Admin->firstname}}</td>
        <td>{{$tdata->Admin->email}}</td>
        <td>{{$tdata->Admin->mobileno}}</td>
    </tr>

    @endforeach
{{ $val->links('pagination::bootstrap-5')}}

    @else
        <tr><td>Data is not Found</td></tr>
    @endif
</td>
</tr>
</tbody>
</table>
    </div>
</div>
</div>
{{-- {{ $data->links('pagination::bootstrap-5')}} --}}
</div>
</div>
</div>

</div>

</div>
@endsection
