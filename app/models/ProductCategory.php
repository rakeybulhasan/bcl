<?php
class ProductCategory extends Eloquent
{
    protected $table = 'product_categories';

    public function product()
    {
        return $this->belongsTo('Product');
    }
}