<?php
class ProductCategory extends Eloquent
{
    protected $table = 'product_categories';
    public function productdetail()
    {
        return $this->hasMany('ProductDetail');
    }

    public function delete()
    {
        $this->productdetail()->delete();
        return parent::delete();
    }

    public function product()
    {
        return $this->belongsTo('Product');
    }
}