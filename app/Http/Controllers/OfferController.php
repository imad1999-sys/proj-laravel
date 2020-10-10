<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use App\Trais\OfferTrait;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    use OfferTrait;
    public function createOffer(){
        return view('offersAjax.create');
    }
    public function saveOffer(Request $request){
        $fileName = $this -> saveImage($request -> photo , 'images/offers');
        Offer::create([
            'photo' => $fileName,
            'name' => $request -> name,
            'price' => $request -> price,
        ]);
        return response() -> json([
            'status' => true,
            'msg' => __('messages.offerSavedSuccessfully')
        ]);
    }
    public function getAllOffers(){
        $offers = Offer::select('id','name','price')->limit(10)->get();
        return view('offersAjax.all' , compact('offers'));
    }
    public function deleteOffer(Request  $request){
        $offer = Offer::find($request -> id);
        if(!$offer){
            return redirect() -> back() -> with(['error' => __('messages.errorOffer')]);
        }
        $offer -> delete();
        return response() -> json([
            'status' => true,
            'msg' => __('messages.offerDeletedSuccessfully'),
            'id'=>$request ->id
        ]);
    }
}
