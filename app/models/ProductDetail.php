<?php
class ProductDetail extends Eloquent
{
    protected $table='product_details';
    public function products()
    {
        return $this->belongsTo('Product');
    }
  public function productcategory()
    {
        return $this->belongsTo('ProductCategory');
    }


}