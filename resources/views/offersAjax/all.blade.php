@extends('layouts.app')

@section('content')
    @if(\Illuminate\Support\Facades\Session::get('success'))
        <div class="alert alert-success" role="alert">
            {{Session::get('success')}}
        </div>
    @endif
    @if(\Illuminate\Support\Facades\Session::get('error'))
        <div class="alert alert-danger" role="alert">
            {{Session::get('error')}}
        </div>
    @endif
    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">{{__('messages.ID')}}</th>
            <th scope="col">{{__('messages.offerName')}}</th>
            <th scope="col">{{__('messages.offerPrice')}}</th>
            <th scope="col">{{__('messages.operation')}}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($offers as $offer)
            <tr class="offerRow{{$offer -> id}}">
                <th scope="row">{{$offer -> id}}</th>
                <td>{{$offer -> name}}</td>
                <td>{{$offer -> price}}</td>
                <td><a href="{{route('ajax.offers.edit',$offer->id)}}" type="button" class="btn btn-dark">{{__('messages.update')}}</a></td>
                <td><a href="" offer_id="{{$offer -> id}}" type="button" class="deleteButton btn btn-danger">{{__('messages.delete')}}</a></td>
            </tr>
        @endforeach
        </tbody>
        <div class="alert alert-success" role="alert" id="successMsg" style="display: none; margin-top: 100px">
            {{ __('messages.offerSavedSuccessfully')}}
        </div>
    </table>
    @stop

@section('scripts')
    <script>
        $(document).on('click','.deleteButton',function(e){
            e.preventDefault()
            var offer_id = $(this).attr('offer_id');
            $.ajax({
                type : 'POST',
                url : "{{route('ajax.offers.delete')}}",
                data : {
                    '_token' : "{{csrf_token()}}",
                    'id': offer_id,
                },
                success : function (data){
                    if(data.status == true){
                        $('#successMsg').show();
                    }
                    $('.offerRow'+data.id).remove();
                },
                error : function(error){

                }
            });
        });
    </script>
@stop
