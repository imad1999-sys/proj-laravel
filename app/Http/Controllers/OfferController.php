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
}
