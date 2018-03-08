@extends('layouts.app')
 
@section('content')
	<div class="row">
	    <div class="col-lg-12 margin-tb">
            
            @if(@session('msg'))
                <div class="alert alert-success alert-dismissable">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    {{ @session('msg') }}
                </div>
    	    @endif    
            <div class="pull-left">
	            <h2>Create New Booking</h2>
	        </div>
	        <div class="pull-right">
	            <a class="btn btn-primary" href="{{ route('bookings.index') }}">Back</a>
	        </div>
	    </div>
	</div>
	@if (count($errors) > 0)
		<div class="alert alert-danger">
			<strong>Whoops!</strong> There were some problems with your input.<br><br>
			<ul>
				@foreach ($errors->all() as $error)
					<li>{{ $error }}</li>
				@endforeach
			</ul>
		</div>
	@endif
	{!! Form::open(array('route' => 'bookings.store','method'=>'POST')) !!}
    {!! csrf_field() !!}
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Client </strong>
                {{  Form::select('user_id', $users_id, null, ['placeholder' => 'Select Client ...','class' => 'form-control','required'=>'required'])}}
            </div>
        </div>
		<div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Trip Number</strong>
                {{  Form::select('trip_id', $trip_id, null, ['placeholder' => 'Select Trip ID...','class' => 'form-control','required'=>'required'])}}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <strong>Enter Price</strong>
            {{  Form::number('price',null,['class' => 'form-control','required'=>'required'])}}
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
             <div class="form-group">
                <strong>Booking Status</strong>
                {{  Form::select('status', $booking_status, 'waiting', ['class' => 'form-control','required'=>'required'])}}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
             <div class="form-group">
                <strong>Seat Level</strong>
                {{  Form::select('seat_level_id',$seats_levels_id,null, ['placeholder' => 'Select Seat Level ID...','class' => 'form-control','required'=>'required'])}}
            </div>
        </div>

        {{ Form::hidden('confirmed_by',Auth::user()->id) }}
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
				<button type="submit" class="btn btn-primary">Submit</button>
        </div>
	</div>
	{!! Form::close() !!}
@endsection