<?php


namespace App\Http\Controllers;


use App\Models\Offer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
    public function store(Request $request){
        $messages = $this->getMessages();
        $validator = Validator::make($request->all() , [
            'name' => 'required|max:100|unique:offers,name',
            'price' => 'required|numeric'
        ],$messages);
        if($validator ->fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }
        Offer::create([
            'name' => $request -> name,
            'price' => $request -> price
        ]);
        return redirect()->back()->with(['success'=>'Saved Successfully']);
    }
    public function getMessages(){
        return $messages = [
            'name.required'=>'this field required',
            'price.required'=>'this field required',
            'price.numeric'=>'this field must be numeric'
        ];
    }
}
