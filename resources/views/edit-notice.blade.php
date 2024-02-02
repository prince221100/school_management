@extends('masterpage')

@section('content')


<div class="page-wrapper">
<div class="content container-fluid">

<div class="page-header">
<div class="row align-items-center">
<div class="col">
<h3 class="page-title">Edit Notice Board</h3>

</div>
</div>
</div>

<div class="row">
<div class="col-sm-12">
<div class="card">
<div class="card-body">
<form action="/updatenoticedetails/{{$val->id}}" method="POST">
    @csrf
<div class="row">
<div class="col-12">
<h5 class="form-title"><span>Notice Details</span></h5>
</div>
<div class="col-12 col-sm-12">
<div class="form-group">
<label>Message </label>
<textarea rows="5" name="message" class="col-12 col-sm-12">{{$val->Message}}
</textarea><br>
@error('message')
<span style="color: red">{{ $message }}</span>
@enderror
</div>
</div>

<div class="col-12 col-sm-12">
    <div class="form-group">
    <label>Date</label><br>
    <input type="date" name="date" class="col-12 col-sm-4" id="date" value="{{$val->date}}">
    <br>
    @error('date')
    <span style="color: red">{{ $message }}</span>
    @enderror
</div>
</div>
<br>
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
