@extends('masterpage')

@section('content')


<div class="page-wrapper">
<div class="content container-fluid">

<div class="page-header">
<div class="row align-items-center">
<div class="col">
<h3 class="page-title">Add Class</h3>

</div>
</div>
</div>

<div class="row">
<div class="col-sm-12">
<div class="card">
<div class="card-body">
<form action="{{ Route('addclasst')}}" method="POST">
    @csrf
<div class="row">
<div class="col-12">
<h5 class="form-title"><span>Class Details</span></h5>
</div>
<div class="col-12 col-sm-12">
<div class="form-group">
<label>Class Name</label>
<select name="classname"  class="col-12 col-sm-12">
    <option selected disabled>Please Select Class</option>
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
<label>Subject Name</label>
<select name="subjectname"  class="col-12 col-sm-12">
    <option selected disabled>Please Select Subject Name</option>

    @foreach ( $subject as $subjectname )
        <option value="{{$subjectname->id}}">{{$subjectname->subject_name}}</option>
    @endforeach
</select>
@error('subjectname')
<span style="color: red">{{ $message }}</span>
@enderror
</div>
</div>
<div class="col-12 col-sm-12">
<div class="form-group">
<label>Teacher Name</label>
<select name="teachername"  class="col-12 col-sm-12">
    <option selected disabled>Please Select Teacher Name</option>

    @foreach ( $teacher as $teachername )
        <option value="{{$teachername->id}}">{{$teachername->firstname}}</option>

    @endforeach
</select>
@error('teachername')
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
