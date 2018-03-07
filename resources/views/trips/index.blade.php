@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Trips Management</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('trips.create') }}"> Create New Trip</a>
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
            <th>Company Name</th>
            <th>Start at</th>
            <th>End Date</th>
            <th>From</th>
            <th>To</th>

            <th width="280px">Action</th>
        </tr>
        @foreach ($data as $key => $trip)
            <tr>
                <td>{{ $trip->Company->name }}</td>
                <td>{{ $trip->start_date }}, {{ $trip->start_time }} </td>
                <td>{{ $trip->end_date }}</td>
                <td>{{ $trip->place_from->city }}, {{$trip->place_from->country}}</td>
                <td>{{ $trip->place_to->city }}, {{$trip->place_from->country}}</td>


                <td>
                    <a class="btn btn-info" href="{{ route('trips.show',$trip->id) }}">Show</a>
                    @permission('update-place')
                    <a class="btn btn-primary" href="{{ route('trips.edit',$trip->id) }}">Edit</a>
                    @endpermission

                    @permission('delete-place')
                    {!! Form::open(['method' => 'DELETE','route' => ['trips.destroy', $trip->id],'style'=>'display:inline']) !!}
                    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                    {!! Form::close() !!}
                    @endpermission
                </td>
            </tr>
        @endforeach
    </table>
    {!! $data->render() !!}
@endsection