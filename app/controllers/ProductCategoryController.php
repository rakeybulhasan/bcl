<?php
/**
 * Created by PhpStorm.
 * User: rocky
 * Date: 4/8/14
 * Time: 2:49 PM
 */
class ProductCategoryController extends BaseController{
    public function __construct()
    {
        $this->beforeFilter('admin');
    }
    public function getIndex()
    {
        $productcategories = ProductCategory::all();
        return View::make('ProductCategory.list')
            ->with('list',$productcategories);
    }

    public function getAdd()
    {

        return View::make('ProductCategory.add');

    }
    public function postSavecategory()
    {
        $ruless = array(
            'category_name' => 'required'

        );
        $validate = Validator::make(Input::all(), $ruless);

        if($validate->fails())
        {
            return Redirect::to('categories/add')
                ->withErrors($validate);
        }
        else{
            $category = new ProductCategory();

            $category->category_name  = Input::get('category_name');
            $category->user_name = Session::get('email');
            $category->save();
            Session::flash('message', 'Product Category has been Successfully Created.');
            return Redirect::to('categories/index');
        }

    }
    public function getUpdate($id)
    {
        $user = ProductCategory::find($id);
        return View::make('ProductCategory.update')
            ->with('userdata',$user);

    }
    public function putCategoryupdate($id)
    {
        $ruless = array(
            'category_name' => 'required'

        );
        $validate = Validator::make(Input::all(), $ruless);

        if($validate->fails())
        {
            return Redirect::to('categories/update/'.$id)
                ->withErrors($validate);
        }
        else{
            $user = ProductCategory::find($id);

            $user->category_name  = Input::get('category_name');
            $user->save();
            Session::flash('message', 'Product Category has been Successfully Updated.');
            return Redirect::to('categories/index');
        }
    }

    public function getDelete($id)
    {
        $del = ProductCategory::find($id);
        $del->delete();
        return Redirect::to('categories/index');
    }


}
