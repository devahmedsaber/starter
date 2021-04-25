<?php

namespace App\Http\Controllers;

use App\Http\Requests\OfferRequest;
use App\Models\Offer;
use App\Traits\OfferTrait;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    use OfferTrait;
    public function create(){
        // View Form To Add Offer
        return view('ajaxoffers.create');
    }
    public function store(Request $request){
        // Save Offer Into DB Using Ajax
        $file_name = $this->saveImage($request->photo, 'images/offers');

        // Insert Data.
        $offer = Offer::create([
            'photo' => $file_name,
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
            'price' => $request->price,
            'details_ar' => $request->details_ar,
            'details_en' => $request->details_en,
        ]);
        if ($offer){
            return response()->json([
                'status' => true,
                'msg' => 'تم الحفظ بنجاح',

            ]);
        }else{
            return response()->json([
                'status' => false,
                'msg' => 'فشل الحفظ برجاء المحاولة مجددآ',

            ]);
        }

    }
}
