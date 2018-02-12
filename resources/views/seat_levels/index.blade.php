@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Seat Levels Management</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('seats.create') }}"> Create New Level</a>
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
            <th>No</th>
            <th>Name</th>
            <th>Description</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($data as $key => $seat_level)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $seat_level->name }}</td>
                <td>{{ $seat_level->description }}</td>
                <td>
                    <a class="btn btn-info" href="{{ route('seats.show',$seat_level->id) }}">Show</a>
                    @permission('update-seat-level')
                    <a class="btn btn-primary" href="{{ route('seats.edit',$seat_level->id) }}">Edit</a>
                    @endpermission

                    @permission('delete-seat-level')
                    {!! Form::open(['method' => 'DELETE','route' => ['seats.destroy', $seat_level->id],'style'=>'display:inline']) !!}
                    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                    {!! Form::close() !!}
                    @endpermission
                </td>
            </tr>
        @endforeach
    </table>
    {!! $data->render() !!}
@endsection