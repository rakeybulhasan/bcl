<?php
class ProductCategory extends Eloquent
{
    protected $table = 'product_categories';

    public function offers()
    {
        return $this->hasMany('Offer');
    }

    public function product()
    {
        return $this->belongsTo('Product');
    }

}