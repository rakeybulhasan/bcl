<?php
class OfferProduct extends Eloquent
{
    public function offer()
    {
        return $this->belongsTo('Offer');
    }
    public function category()
    {
        return $this->belongsTo('ProductCategory');
    }
}