@extends('masterpage')

@section('content')
<div class="page-wrapper">
<div class="content container-fluid">

<div class="page-header">
<div class="row align-items-center">
<div class="col">
<h3 class="page-title">Add Teacher</h3>

</div>
</div>
</div>

<div class="row">
<div class="col-sm-12">
<div class="card">
<div class="card-body">
<form action="{{ url('/addteacher')}}" method="POST">
@csrf
<div class="row">
    <div class="col-12">
        <h5 class="form-title"><span>Basic Details</span></h5>
    </div>
    <div class="col-12 col-sm-6">
        <div class="form-group">
            <label>FirstName</label>
            <input type="text" class="form-control" name="firstname">
            @error('firstname')
                <span style="color: red">{{$message}}</span>
            @enderror
        </div>
    </div>
    <div class="col-12 col-sm-6">
        <div class="form-group">
            <label>LastName</label>
            <input type="text" class="form-control" name="lastname">
            @error('lastname')
            <span style="color: red">{{$message}}</span>
        @enderror
        </div>
    </div>
    <div class="col-12 col-sm-6">
        <div class="form-group">
            <label>Role</label>
            <select class="form-control" disabled name="role">
            <option value="2" default>Teacher</option>
            </select>
        </div>
    </div>
    <div class="col-12 col-sm-6">
        <div class="form-group">
        <label>Email</label>
        <input type="email" class="form-control" name="email">
        @error('email')
        <span style="color: red">{{$message}}</span>
    @enderror
        </div>
    </div>
    <div class="col-12 col-sm-6">
        <div class="form-group">
        <label>Mobile</label>
        <input type="text" class="form-control" name="mobile" maxlength="10">
        @error('mobile')
        <span style="color: red">{{$message}}</span>
    @enderror
        </div>
    </div>


    <div class="col-12 col-sm-6">
        <div class="form-group">
        <label>Password</label>
        <input class="form-control" type="text" name="password">
        @error('password')
        <span style="color: red">{{$message}}</span>
        @enderror
        </div>
    </div>
    @if ($errors->any())
        <span style="color: red">{{$errors->first()}}</span>

    @endif
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

</div>
    <div class="col-12">
         <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>
</form>
</div>
</div>
</div>
</div>
</div>
</div>

</div>


@endsection
