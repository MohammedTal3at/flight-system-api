@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Show Trip </h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('trips.index') }}"> Back</a>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-xs-2 col-sm-2 col-md-2">

        </div>

        <div class="col-xs-8 col-sm-8 col-md-8 form-group">
            <img style="display:block; margin-left:auto; margin-right:auto" class="img-responsive" src="{{ str_replace('/var/www/html', '',$trip->getMedia()[0]->getPath()) }}">
        </div>
        <div class="col-xs-2 col-sm-2 col-md-2">

        </div>

    </div>

    <div class="row">

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Company Name:</strong>
                {{ $trip->company->name }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>From:</strong>
                {{ $trip->place_from->city }}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>To:</strong>
                {{ $trip->place_to->city }}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Starts At:</strong>
                {{ $trip->start_date }}, {{$trip->start_time}}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>End Date:</strong>
                {{ $trip->end_date }}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Economy Capacity:</strong>
                {{ $trip->seatlevels[0]->pivot->available_count }}
            </div>
        </div>


        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Economy Seat Price:</strong>
                {{ $trip->seatlevels[0]->pivot->price }}
            </div>
        </div>


        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Standard Capacity:</strong>
                {{ $trip->seatlevels[1]->pivot->available_count }}
            </div>
        </div>


        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Standard Seat Price:</strong>
                {{ $trip->seatlevels[1]->pivot->price }}
            </div>
        </div>


        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>First Class Capacity:</strong>
                {{ $trip->seatlevels[2]->pivot->available_count }}
            </div>
        </div>


        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Fist Class Seat Price:</strong>
                {{ $trip->seatlevels[2]->pivot->price }}
            </div>
        </div>


    </div>
@endsection