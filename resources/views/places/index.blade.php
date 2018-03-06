@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Places Management</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('places.create') }}"> Create New Place</a>
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
            <th>City Name</th>
            <th>Country</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($data as $key => $place)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $place->city }}</td>
                <td>{{ $place->country }}</td>
                <td>
                    <a class="btn btn-info" href="{{ route('places.show',$place->id) }}">Show</a>
                    @permission('update-place')
                    <a class="btn btn-primary" href="{{ route('places.edit',$place->id) }}">Edit</a>
                    @endpermission

                    @permission('delete-place')
                    {!! Form::open(['method' => 'DELETE','route' => ['places.destroy', $place->id],'style'=>'display:inline']) !!}
                    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                    {!! Form::close() !!}
                    @endpermission
                </td>
            </tr>
        @endforeach
    </table>
    {!! $data->render() !!}
@endsection