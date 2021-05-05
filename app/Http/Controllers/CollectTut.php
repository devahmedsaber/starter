<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use Illuminate\Http\Request;

class CollectTut extends Controller
{
    public function index(){
//        $numbers = [1, 2, 3, 4];
//        $col = collect($numbers);
//        return $col->avg();
//        $names = collect(['name', 'age']);
//        $res = $names->combine(['ahmed', 22]);
//        return $res;
//        $numbers = collect(['1','2','3', '3', '4']);
//        return $numbers->count();
//        $numbers = collect(['1','2','3', '3', '4']);
//        return $numbers->countBy();
//        $numbers = collect(['1','3', '3', '4']);
//        return $numbers->duplicates();
        //each
        //filter
        //search
        //transform
    }

    public function complex(){
        $offers = Offer::get();
        // Remove With each()
//        $offers->each(function ($offer){
//            unset($offer->photo);
//            return $offer;
//        });
//        return $offers;
        // Add With each()
        $offers->each(function ($offer){
            if($offer -> price == 4432){
                unset($offer->photo);
            }
            $offer->MSG = 'Hello';
            return $offer;
        });
        return $offers;
    }

    // Using Filter
    public function complexFilter(){
        $offers = Offer::get();
        $offers = collect($offers);
        $res = $offers->filter(function ($value, $key){
            return $value['price'] == 111;
        });
        return $res;
    }

    // Using Transform
    public function complexTransform(){
        $offers = Offer::get();
        $offers = collect($offers);
        $res = $offers->transform(function ($value, $key){
            $data = [];
            $data['name_ar'] = $value['name_ar'];
            $data['type'] = 'fresh';
            return $data;
        });
        return $res;
    }
}
