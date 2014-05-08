<?php


class Country extends Eloquent
{
    public function getCountries()
    {

        $countries = DB::table('countries')->get();
        return $countries;
    }

    public function getCountriesDropDown()
    {
        $countries = $this->getcountries();

        $array = array();

        foreach($countries as $country){
            $array[$country->id] = $country->name;
        }

        return $array;
    }

    public function users()
    {
        return $this->hasMany('User');
    }
}