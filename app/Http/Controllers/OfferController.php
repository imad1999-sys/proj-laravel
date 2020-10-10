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
    public function editOffers(Request  $request){
        $offer = Offer::find($request -> offer_id);
        if(!$offer){
            return response() -> json([
                'status' => false,
                'msg' => __('messages.offerNotExist'),
            ]);
        }
        $offer = Offer::select('id','name','price')->find($request -> offer_id);
        return view('offersAjax.edit',compact('offer'));
    }
    public function updateOffer(Request $request){
        $offer = Offer::find($request -> id);
        if(!$offer){
            return response() -> json([
                'status' => false,
                'msg' => __('messages.offerNotExist'),
            ]);
        }
        $offer -> update($request -> all());
        return response() -> json([
            'status' => true,
            'msg' => __('messages.offerSavedSuccessfully')
        ]);
    }
}
