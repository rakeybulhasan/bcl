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
    public function getList()
    {
      $list = DB::table('products')
            ->Join('product_details','product_details.product_id','=','products.id')
            ->Join('product_categories','product_categories.id','=','product_details.product_category_id')
            ->get();

        return $list;
    }
    public function getinfo($id)
{
    $list = DB::table('products')
        ->Join('product_details','products.id','=','product_details.product_id')
        ->Join('product_categories','product_categories.id','=','product_details.product_category_id')
        ->where('products.id','=',$id)
        ->get();
   // print_r($list) ; exit;
    return $list;
}
    public function productdetail()
    {
    return 'ok';
       // return $this->hasMany('ProductDetail', 'product_id');
       // return $this->belongsToMany('ProductDetail');
    }


}