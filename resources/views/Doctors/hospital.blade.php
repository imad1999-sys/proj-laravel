@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="flex-center position-ref full-height">
            <div class="content">
                <div class="title m-b-md"style="font-family: 'Baloo Paaji 2', cursive;">
                    {{__('messages.hospitalTitle')}}
                </div>
                <br>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">{{__('messages.nameOfHospital')}}</th>
                        <th scope="col">{{__('messages.address')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(isset($hospitals) && $hospitals->count() > 0)
                        @foreach($hospitals as $hospital)
                    <tr>
                        <th scope="row">{{$hospital -> id}}</th>
                        <td>{{$hospital -> name}}</td>
                        <td>{{$hospital -> address}}</td>
                        <td><a href="{{route('hospital.doctors',$hospital -> id)}}" type="button" class="btn btn-outline-success">Show Doctors</a></td>
                    </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop
