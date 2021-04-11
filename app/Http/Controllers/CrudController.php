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
        return Offer::select('name','price')->get();
    }

//    public function store(){
//        Offer::create([
//            'name' => 'offer3',
//            'price' => '4000',
//            'details' => 'ay haga hena'
//        ]);
//    }

    public function create(){
        return view('offers.create');
    }

    public function store(Request $request){
        // Validate Data Before Insert to DB.

        $rules = $this->getRules();
        $messages = $this->getMessages();

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInputs($request->all());
        }

        // Insert Data.
        Offer::create([
            'name' => $request->name,
            'price' => $request->price,
            'details' => $request->details,
        ]);
        return redirect()->back()->with(['success' => 'تم إضافة العرض بنجاح']);
    }

    public function getRules(){
        return $rules = [
                    'name' => 'required|max:100|unique:offers,name',
                    'price' => 'required|numeric',
                    'details' => 'required',
                ];
    }

    public function getMessages(){
        return $messages = [
                    'name.required' => trans('messages.OfferNameRequired'),
                    'name.unique' => trans('messages.OfferNameUnique'),
                    'price.required' => trans('messages.PriceRequired'),
                    'price.numeric' => trans('messages.PriceNumeric'),
                    'details.required' => trans('messages.DetailsRequired'),
                ];
    }

}
