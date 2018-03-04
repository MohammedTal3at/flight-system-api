@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Companies Management</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('companies.create') }}"> Create New Company</a>
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
            <th>Email</th>
            <th>Name</th>
            <th>Address</th>
            <th>City</th>
            <th>Country</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($data as $key => $company)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $company->email }}</td>
                <td>{{ $company->name }}</td>
                <td>{{ $company->address }}</td>
                <td>{{ $company->city }}</td>
                <td>{{ $company->country }}</td>
                <td>
                    <a class="btn btn-info" href="{{ route('companies.show',$company->id) }}">Show</a>
                    @permission('edit-company')
                    <a class="btn btn-primary" href="{{ route('companies.edit',$company->id) }}">Edit</a>
                    @endpermission

                    @permission('delete-company')
                    {!! Form::open(['method' => 'DELETE','route' => ['companies.destroy', $company->id],'style'=>'display:inline']) !!}
                    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                    {!! Form::close() !!}
                    @endpermission
                </td>
            </tr>
        @endforeach
    </table>
    {!! $data->render() !!}
@endsection