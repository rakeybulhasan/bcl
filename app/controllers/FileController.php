<?php

/**
 * Created by PhpStorm.
 * User: rocky
 * Date: 4/24/14
 * Time: 12:34 PM
 */
class FileController extends BaseController
{

    public function getIndex()
    {

    }

    public function getAdd()
    {
        $productList = Product::all();
        return View::make('Files.add')
            ->with('productDropDown', $productList);
    }
}