<?php


namespace App\Http\Controllers;


use App\Http\Requests\OfferRequest;
use App\Models\Offer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use LaravelLocalization;

class CrudController extends Controller
{
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
        Offer::create([
            'name_en' => $request -> name,
            'name_ar' => $request -> name_ar,
            'price' => $request -> price
        ]);
        return redirect()->back()->with(['success'=>'Saved Successfully']);
    }
    /*public function getMessages(){
        return $messages = [
            'name.required'=>__('messages.offerNameRequired'),
            'price.required'=>__('messages.priceRequired'),
            'price.numeric'=>__('messages.priceNumeric')
        ];
    }*/
    public function getAllOffers(){
        $offers = Offer::select('id','name_'.LaravelLocalization::getCurrentLocale().' as name','price')->get();
        return view('offers.all' , compact('offers'));
    }
}
