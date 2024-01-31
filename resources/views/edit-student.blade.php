@extends('masterpage')

@section('content')

<div class="page-wrapper">
    <div class="content container-fluid">

    <div class="page-header">
    <div class="row align-items-center">
    <div class="col">
    <h3 class="page-title">Edit Student</h3>

    </div>
    </div>
    </div>

    <div class="row">
    <div class="col-sm-12">
    <div class="card">
    <div class="card-body">
    <form action="/addstudent/{{$val->id}}" method="Post">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col-12">
            <h5 class="form-title"><span>Basic Details</span></h5>
        </div>
        <div class="col-12 col-sm-6">
            <div class="form-group">
                <label>FirstName</label>
                <input type="text" class="form-control"  value="{{$val->firstname}}"   name="firstname">

            </div>
        </div>
        <div class="col-12 col-sm-6">
            <div class="form-group">
                <label>LastName</label>
                <input type="text" class="form-control" name="lastname" value="{{$val->lastname}}">

            </div>
        </div>
        <div class="col-12 col-sm-6">
            <div class="form-group">
                <label>Role</label>
                <select class="form-control" disabled name="role">
                <option value="3" default>Student</option>
                </select>
            </div>
        </div>
        <div class="col-12 col-sm-6">
            <div class="form-group">
            <label>Email</label>
            <input type="email" class="form-control" name="email" value="{{$val->email}}" disabled>

            </div>
        </div>
        <div class="col-12 col-sm-6">
            <div class="form-group">
            <label>Mobile</label>
            <input type="text" class="form-control" name="mobile" maxlength="10" value="{{$val->mobileno}}">

            </div>
        </div>


        <div class="col-12 col-sm-6">
            <div class="form-group">
            <label>Password</label>
            <input class="form-control" type="text" name="password" value="{{$val->password}}">

            </div>
        </div>


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
