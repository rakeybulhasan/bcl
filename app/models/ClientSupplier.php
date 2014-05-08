<?php
/**
 * Created by PhpStorm.
 * User: rocky
 * Date: 4/3/14
 * Time: 12:29 PM
 */
class ClientSupplier extends Eloquent
{
    public function country()
    {
        return $this->belongsTo('Country');
    }

    public function offers()
    {
        return $this->hasMany('Offer');
    }

}