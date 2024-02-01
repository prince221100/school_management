@extends('masterpage')

@section('content')


<div class="page-wrapper">
<div class="content container-fluid">

<div class="page-header">
<div class="row align-items-center">
<div class="col">
<h3 class="page-title">Update Exam Schedule</h3>

</div>
</div>
</div>

<div class="row">
<div class="col-sm-12">
<div class="card">
<div class="card-body">
<form action="/updateexamdetails/{{$val->id}}" method="POST">
    @csrf
<div class="row">
<div class="col-12">
<h5 class="form-title"><span>Exam Assign</span></h5>
</div>
<div class="col-12 col-sm-12">
<div class="form-group">
<label>Class & Subject Name </label>
<select name="classname"  class="col-12 col-sm-12">
    <option selected value="{{$val->Class_info->id}}_{{$val->subject_info->id}}" >{{$val->Class_info->class_name}} - {{$val->subject_info->subject_name}} </option>
@foreach ( $class as $classname )
    <option value="{{$classname->class_name}}_{{$classname->Subject_info->id}}">{{$classname->class_info->class_name}} - {{$classname->Subject_info->subject_name}}</option>
@endforeach
</select>
@error('classname')
<span style="color: red">{{ $message }}</span>
@enderror
</div>
</div>

<div class="col-12 col-sm-4">
    <div class="form-group">
    <label>Date</label><br>
    <input type="date" name="date" class="col-12 col-sm-12" id="date" value="{{$val->date}}">

    @error('date')
    <span style="color: red">{{ $message }}</span>
    @enderror
    </div>
    </div>
    <div class="col-12 col-sm-4">
        <div class="form-group">
        <label>Start time</label><br>
            <input type="time" name="starttime" class="col-12 col-sm-12" value="{{$val->start_time}}">
        @error('starttime')
        <span style="color: red">{{ $message }}</span>
        @enderror
        </div>
        </div>
        <div class="col-12 col-sm-4">
            <div class="form-group">
            <label>End time</label><br>
                <input type="time" name="endtime" class="col-12 col-sm-12" value="{{$val->end_time}}">

            @error('endtime')
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
<script>
$(function(){
    var dtToday = new Date();

    var month = dtToday.getMonth() + 1;
    var day = dtToday.getDate();
    var year = dtToday.getFullYear();
    if(month < 10)
        month = '0' + month.toString();
    if(day < 10)
        day = '0' + day.toString();

    var maxDate = year + '-' + month + '-' + day;
    // alert(maxDate);
    $('#date').attr('min', maxDate);
});
</script>
@endsection
