@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="flex-center position-ref full-height">
            <div class="content">
                <div class="title m-b-md"style="font-family: 'Baloo Paaji 2', cursive;">
                    {{__('messages.doctorTitle')}}
                </div>
                <br>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">{{__('messages.name')}}</th>
                        <th scope="col">{{__('messages.title')}}</th>
                        <th scope="col">{{__('messages.hospital_ID')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(isset($doctor) && $doctor->count() > 0)
                        @foreach($doctor as $doc)
                            <tr>
                                <th scope="row">{{$doc -> id}}</th>
                                <td>{{$doc -> name}}</td>
                                <td>{{$doc -> title}}</td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @stop
