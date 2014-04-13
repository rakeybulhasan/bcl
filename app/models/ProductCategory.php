<?php
class ProductCategory extends Eloquent
{
    public function productdetail()
    {
        return $this->hasMany('ProductDetail');
    }

    public function delete()
    {
        $this->productdetail()->delete();
        return parent::delete();
    }
}