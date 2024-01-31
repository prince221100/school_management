@extends('masterpage')

@section('content')


<div class="page-wrapper">
<div class="content container-fluid">

<div class="page-header">
<div class="row align-items-center">
<div class="col">
<h3 class="page-title">Edit Class</h3>

</div>
</div>
</div>

<div class="row">
<div class="col-sm-12">
<div class="card">
<div class="card-body">
<form action="/editclassstudent/{{$val->id}}" method="POST">
    @csrf
<div class="row">
<div class="col-12">
<h5 class="form-title"><span>Class Details</span></h5>
</div>
<div class="col-12 col-sm-12">
<div class="form-group">
<label>Class Name</label>
{{-- {{$val->class_name}} --}}
<select name="classname"  class="col-12 col-sm-12">
    <option value="{{$val->class_name}}" selected >{{$val->class_info->class_name}}</option>

@foreach ( $class as $classname )
    <option value="{{$classname->id}}">{{$classname->class_name}}</option>
@endforeach
</select>
@error('classname')
<span style="color: red">{{ $message }}</span>
@enderror
</div>
</div>

<div class="col-12 col-sm-12">
<div class="form-group">
<label>Student Name</label>

<select name="studentname"  class="col-12 col-sm-12">
    <option value="{{$val->student_id}}" selected>{{$val->Admin->firstname}}</option>

</select>
@error('studentname')
<span style="color: red">{{ $message }}</span>
@enderror
</div>
</div>

@if($errors->any())
<span style="color: red">{{$errors->first()}}</span>
@endif

@if (session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

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
