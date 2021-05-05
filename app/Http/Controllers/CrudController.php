<?php

namespace App\Http\Controllers;

use App\Events\VideoViewer;
use App\Http\Requests\OfferRequest;
use App\Models\Offer;
use App\Models\Video;
use App\Scopes\OfferScope;
use App\Traits\OfferTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use LaravelLocalization;

class CrudController extends Controller
{
    use OfferTrait;
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

    public function store(OfferRequest $request){
        // Validate Data Before Insert to DB.

//        $rules = $this->getRules();
//        $messages = $this->getMessages();
//
//        $validator = Validator::make($request->all(), $rules, $messages);
//        if ($validator->fails()){
//            return redirect()->back()->withErrors($validator)->withInputs($request->all());
//        }

        $file_name = $this->saveImage($request->photo, 'images/offers');

        // Insert Data.
        Offer::create([
            'photo' => $file_name,
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
            'price' => $request->price,
            'details_ar' => $request->details_ar,
            'details_en' => $request->details_en,
        ]);
        return redirect()->back()->with(['success' => 'تم إضافة العرض بنجاح']);
    }



//    public function getRules(){
//        return $rules = [
//                    'name' => 'required|max:100|unique:offers,name',
//                    'price' => 'required|numeric',
//                    'details' => 'required',
//                ];
//    }
//
//    public function getMessages(){
//        return $messages = [
//                    'name.required' => trans('messages.OfferNameRequired'),
//                    'name.unique' => trans('messages.OfferNameUnique'),
//                    'price.required' => trans('messages.PriceRequired'),
//                    'price.numeric' => trans('messages.PriceNumeric'),
//                    'details.required' => trans('messages.DetailsRequired'),
//                ];
//    }

    public function getAllOffers(){
//        $offers = Offer::select(
//            'id',
//            'price',
//            'name_'.LaravelLocalization::getCurrentLocale().' as name',
//            'details_'.LaravelLocalization::getCurrentLocale().' as details')->get(); // Return Collection
//        return view('offers.all', compact('offers'));

        // With Pagination
        $offers = Offer::select(
            'id',
            'price',
            'name_'.LaravelLocalization::getCurrentLocale().' as name',
            'details_'.LaravelLocalization::getCurrentLocale().' as details')->paginate(PAGINATION_COUNT); // Return Collection
        //return view('offers.all', compact('offers'));

        return view('offers.paginations', compact('offers'));
    }

    public function editOffer($offer_id){
        $offer = Offer::find($offer_id);
        if (!$offer){
            return redirect()-back();
        }
        $offer = Offer::select('id', 'name_ar', 'name_en', 'details_ar', 'details_en', 'price')->find($offer_id);
        return view('offers.edit', compact('offer'));
    }

    public function delete($offer_id){
        // Check If Offer ID Exists
        $offer = Offer::find($offer_id);
        if (!$offer){
            return redirect()->back()->with(['error' => trans('messages.OfferNotExist')]);
        }
        $offer->delete();
        return redirect()->route('offers.all')->with(['success' => trans('messages.OfferDeleted')]);
    }

    public function updateOffer(OfferRequest $request, $offer_id){
        $offer = Offer::find($offer_id);
        if (!$offer){
            return redirect()-back();
        }
        $offer->update($request->all());
        return redirect()->back()->with(['success' => 'تم التحديث بنجاح']);
    }

    public function getVideo(){
        $video = Video::first();
        event(new VideoViewer($video));
        return view('video')->with('video', $video);
    }

    // Laravel Scope Methods - Local Scope

    public function getAllInactiveOffers(){
        //return Offer::inactive()->get(); // Get All Inactive Status Offers
        // Global Scope
        //return Offer::get();
        // How To Remove Global Scope
        return Offer::withoutGlobalScope(OfferScope::class)->get();
    }
}
