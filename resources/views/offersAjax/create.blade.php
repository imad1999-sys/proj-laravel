@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="flex-center position-ref full-height">
            <div class="content">
                <div class="title m-b-md"style="font-family: 'Baloo Paaji 2', cursive;">
                    {{__('messages.addYourOffer')}}
                </div>
                @if(\Illuminate\Support\Facades\Session::has('success'))
                    <div class="alert alert-success" role="alert" style="font-family: 'Baloo Tammudu 2', cursive;">
                        {{\Illuminate\Support\Facades\Session::get('success')}}
                    </div>
                @endif
                <br>
                <form method="POST" action="" id="offerForm" name="offerForm" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputEmail1" style="font-family: 'Baloo Tammudu 2', cursive;">{{__('messages.offerPhoto')}}</label>
                        <input type="file" class="form-control" name="photo" id="photo">
                        @error('photo')
                        <small class="form-text text-danger" style="font-family: 'Baloo Tammudu 2', cursive;">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1" style="font-family: 'Baloo Tammudu 2', cursive;">{{__('messages.offerName')}}</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="Enter the Name" style="font-family: 'Baloo Tammudu 2', cursive;">
                        @error('name')
                        <small class="form-text text-danger" style="font-family: 'Baloo Tammudu 2', cursive;">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1" style="font-family: 'Baloo Tammudu 2', cursive;">{{__('messages.offerPrice')}}</label>
                        <input type="text" class="form-control" name="price" id="price" placeholder="Enter the Price" style="font-family: 'Baloo Tammudu 2', cursive;">
                        @error('price')
                        <small class="form-text text-danger" style="font-family: 'Baloo Tammudu 2', cursive;">{{$message}}</small>
                        @enderror
                    </div>
                    <button id="saveOffer" type="submit" class="btn btn-primary" style="font-family: 'Baloo Tammudu 2', cursive;">{{__('messages.storeOffer')}}</button>
                    <div class="alert alert-success" role="alert" id="successMsg" style="display: none; margin-top: 100px">
                        {{ __('messages.offerSavedSuccessfully')}}
                    </div>
                    <div class="alert alert-danger" role="alert" id="failedMag" style="display: none">
                        {{ __('messages.Failed')}}
                    </div>
                </form>
            </div>
        </div>
    </div>
    @stop
@section('scripts')
    <script>
        $(document).on('click','#saveOffer',function(e){
            console.log($("input[name = 'photo']").val());
            e.preventDefault()
            var formData = new FormData($('#offerForm')[0]);
            $.ajax({
                type : 'POST',
                enctype: 'multipart/form-data',
                url : "{{route('ajax.offers.store')}}",
                data : formData,
                processData: false,
                contentType: false,
                cache: false,
                success : function (data){
                    if(data.status == true){
                        $('#successMsg').show();
                    }
                },
                error : function(error){

                }
            });
        });
    </script>
    @stop
