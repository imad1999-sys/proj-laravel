<?php


namespace App\Http\Controllers;


use App\Events\VideoViewer;
use App\Http\Requests\OfferRequest;
use App\Models\Offer;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use LaravelLocalization;
use App\Trais\OfferTrait;

class CrudController extends Controller
{
    use OfferTrait;
    public function __construct()
    {

    }
    public function getOffers(){
        return Offer::select('id','name')->get();
    }
    /*public function store(){
        Offer::create([
            'name' =>'Imad',
            'price' =>'100000',
        ]);
    }*/
    public function create(){
        return view('offers\create');
    }
    public function store(OfferRequest $request){
        //$messages = $this->getMessages();
       /* $validator = Validator::make($request->all() , [
            'name' => 'required|max:100|unique:offers,name',
            'price' => 'required|numeric'
        ],$messages);
        if($validator ->fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }*/
        $fileName = $this -> saveImage($request -> photo , 'images/offers');
        Offer::create([
            'name' => $request -> name,
            'price' => $request -> price,
            'photo' => $fileName
        ]);
        return redirect()->back()->with(['success'=>'Saved Successfully']);
    }
    public function getAllOffers(){
        $offers = Offer::select('id','name','price')->get();
        return view('offers.all' , compact('offers'));
    }
    public function editOffers($offer_id){
        $offer = Offer::find($offer_id);
        if(!$offer){
            return redirect()->back();
        }
        $offer = Offer::select('id','name','price')->find($offer_id);
        return view('offers.edit',compact('offer'));
    }
    public function updateOffer(OfferRequest $request , $offer_id){
        $offer = Offer::find($offer_id);
        if(!$offer){
            return redirect()->back();
        }
        $offer -> update($request -> all());
        return redirect()->back()->with(['success'=>'Update Successfully']);
    }
    public function getVideo(){
        $video = Video::first();
        event(new VideoViewer($video));
        return view('video')->with('video' , $video);
    }
    public function deleteOffer($offer_id){
        $offer = Offer::find($offer_id);
        if(!$offer){
            return redirect() -> back() -> with(['error' => __('messages.errorOffer')]);
        }
        $offer -> delete();
        return redirect()->route('offers.all')->with(['success' => __('messages.offerDeletedSuccessfully')]);
    }
}
