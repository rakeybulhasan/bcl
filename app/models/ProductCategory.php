<?php
class ProductCategory extends Eloquent
{
    public function productdetail()
    {
        return $this->belongsToMany('ProductDetail');
    }
}