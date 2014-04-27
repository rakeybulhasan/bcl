<?php
/**
 * Created by PhpStorm.
 * User: rocky
 * Date: 4/8/14
 * Time: 2:50 PM
 */


class Product extends Eloquent
{
    protected $table = 'products';

    public function delete()
    {
        $this->productcategories()->delete();
        return parent::delete();
    }

    public function productcategories()
    {
        return $this->hasMany('ProductCategory');
    }


}