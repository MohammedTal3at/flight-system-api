@extends('layouts.app')
 
@section('content')
	<div class="row">
	    <div class="col-lg-12 margin-tb">
	        <div class="pull-left">
	            <h2>Edit Trip Data</h2>
	        </div>
	        <div class="pull-right">
	            <a class="btn btn-primary" href="{{ route('trips.index') }}"> Back</a>
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
	{!! Form::model($trip, ['method' => 'PATCH','route' => ['trips.update', $trip->id]]) !!}
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Company:</strong>
                {!! Form::select('company_id',$companies,$trip->company_id, array('class' => 'form-control')) !!}
            </div>
        </div>


		<div class="col-xs-12 col-sm-12 col-md-12">
			<div class="form-group">
				<strong>From:</strong>
				{!! Form::select('from_place_id',$place_from,$trip->from_place_id, array('class' => 'form-control')) !!}
			</div>
		</div>


		<div class="col-xs-12 col-sm-12 col-md-12">
			<div class="form-group">
				<strong>To:</strong>
				{!! Form::select('to_place_id',$place_to,$trip->to_place_id, array('class' => 'form-control')) !!}
			</div>
		</div>



		<div class="col-xs-12 col-sm-12 col-md-12">
			<div class="form-group">
				<strong>Start Date:</strong>
				{!! Form::date('start_date', $trip->start_date, array('class' => 'form-control')) !!}
			</div>
		</div>

		<div class="col-xs-12 col-sm-12 col-md-12">
			<div class="form-group">
				<strong>Start Time:</strong>
				{!! Form::time('start_time', $trip->start_time, array('class' => 'form-control')) !!}
			</div>
		</div>

		<div class="col-xs-12 col-sm-12 col-md-12">
			<div class="form-group">
				<strong>End Date:</strong>
				{!! Form::date('end_date', $trip->end_date, array('class' => 'form-control')) !!}
			</div>
		</div>


		<div class="col-xs-12 col-sm-12 col-md-12">
			<div class="form-group">
				<strong>Economy Capacity:</strong>
				{!! Form::number('economy', $trip->seatlevels[0]->pivot->available_count, array('class' => 'form-control')) !!}
			</div>
		</div>

		<div class="col-xs-12 col-sm-12 col-md-12">
			<div class="form-group">
				<strong>Economy Seat Price:</strong>
				{!! Form::number('economyprice', $trip->seatlevels[0]->pivot->price, array('class' => 'form-control')) !!}
			</div>
		</div>

		<div class="col-xs-12 col-sm-12 col-md-12">
			<div class="form-group">
				<strong>Standard Capacity:</strong>
				{!! Form::number('standard', $trip->seatlevels[1]->pivot->available_count, array('class' => 'form-control')) !!}
			</div>
		</div>


		<div class="col-xs-12 col-sm-12 col-md-12">
			<div class="form-group">
				<strong>Standard Seat Price:</strong>
				{!! Form::number('standardprice', $trip->seatlevels[1]->pivot->price, array('class' => 'form-control')) !!}
			</div>
		</div>

		<div class="col-xs-12 col-sm-12 col-md-12">
			<div class="form-group">
				<strong>First Class Capacity:</strong>
				{!! Form::number('firstclass', $trip->seatlevels[2]->pivot->available_count, array('class' => 'form-control')) !!}
			</div>
		</div>


		<div class="col-xs-12 col-sm-12 col-md-12">
			<div class="form-group">
				<strong>First Class Seat Price:</strong>
				{!! Form::number('firstclassprice', $trip->seatlevels[2]->pivot->price, array('class' => 'form-control')) !!}
			</div>
		</div>





		<div class="col-xs-12 col-sm-12 col-md-12 text-center">
				<button type="submit" class="btn btn-primary">Submit</button>
        </div>
	</div>
	{!! Form::close() !!}
@endsection