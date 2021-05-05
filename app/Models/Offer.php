<?php

namespace App\Models;

use App\Scopes\OfferScope;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    protected $table = 'offers';
    protected $fillable = ['photo', 'name_ar', 'name_en', 'price', 'details_ar',
                            'details_en', 'status', 'created_at', 'updated_at'];
    protected $hidden = ['created_at', 'updated_at'];

    // Register My Global Scope To The Model

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new OfferScope);
    }

    /* -------------------------------------------------------- */

    // Scopes Methods - "Local"

    public function scopeInactive($query){
        return $query->where('status', '0');
    }

    public function scopeInvalid($query){
        return $query->where('status', '0')->whereNull('details_ar');
    }

    /* -------------------------------------------------------- */

    // Mutators Methods

    public function setNameEnAttribute($val){
        $this->attributes['name_en'] = strtoupper($val);
    }

}
