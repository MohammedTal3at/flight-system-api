@extends('layouts.app')
 
@section('content')
	<div class="row">
	    <div class="col-lg-12 margin-tb">
	        <div class="pull-left">
	            <h2>Bookings Management</h2>
	        </div>
	        <div class="pull-right">
	        	@permission('booking-create')
	            <a class="btn btn-success" href="{{ route('bookings.create') }}"> Create New Booking</a>
	            @endpermission
	        </div>
	    </div>
	</div>
	@if ($message = Session::get('success'))
		<div class="alert alert-success">
			<p>{{ $message }}</p>
		</div>
	@endif
	<table class="table table-bordered">
		<tr>
			<th>Booking ID</th>
			<th>Client ID</th>
			<th>Client Name</th>
			<th>Booking Price</th>
			<th>Seat Level </th>
			<th>Booking Date</th>
			<th>Status</th>
			<th>Confirmed By</th>
			<th width="280px">Action</th>
		</tr>
	@foreach ($bookings as $booking)
	<tr>
		<td>{{ $booking->id }}</td>
		<td>{{ $booking->user->id }}</td>
		<td>{{ $booking->user->name }}</td>
		<td>{{ $booking->price }}</td>
		<td>{{ $booking->seatLevels->name }}</td>
		<td>{{date_format( $booking->created_at, 'Y-m-d') }}</td>
		<td>{{ $booking->status }}</td>
		<td>{{ $booking->admin->name }}</td>
		<td>
			<a class="btn btn-info" href="{{ route('bookings.show',$booking->id) }}">Show</a>
			@permission('booking-edit')
			<a class="btn btn-primary" href="{{ route('bookings.edit',$booking->id) }}">Edit</a>
			@endpermission
			@permission('booking-delete')
			{!! Form::open(['method' => 'DELETE','route' => ['bookings.destroy', $booking->id],'style'=>'display:inline']) !!}
            {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
        	{!! Form::close() !!}
        	@endpermission
		</td>
	</tr>
	@endforeach
	</table>
@endsection
