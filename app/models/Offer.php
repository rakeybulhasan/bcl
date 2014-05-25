<?php
/**
 * Created by JetBrains PhpStorm.
 * User: asraf
 * Date: 4/27/14
 * Time: 2:54 PM
 * To change this template use File | Settings | File Templates.
 */
class Offer extends Eloquent{
    protected $table = 'offers';

   /* public function category()
    {
        return $this->belongsTo('ProductCategory');
    }*/

    public function client()
    {
        return $this->belongsTo('ClientSupplier');
    }
    public function user()
    {
        return $this->belongsTo('User');
    }
    public function offerproducts()
    {
        return $this->hasMany('OfferProduct');
    }
}