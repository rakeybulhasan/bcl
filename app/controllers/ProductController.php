<?php
/**
 * Created by PhpStorm.
 * User: rocky
 * Date: 4/8/14
 * Time: 2:49 PM
 */
class ProductController extends BaseController{
    public function __construct()
    {
        $this->beforeFilter('admin');
    }
 /*   public function getIndex()
    {
        $products = Product::with('productcategories')
            ->get();

        return View::make('Products.list')
            ->with('list',$products);
    }*/
    public function getIndex()
    {
        $products = Product::all();

        return View::make('Products.list')
            ->with('list',$products);
    }
    public function getAdd()
    {
        /* $categories = ProductCategory::all();
         $array = array();

         foreach($categories as $category){
             $array[$category->id] = $category->category_name;
         }*/
        return View::make('Products.add');
    }

    public function postSaveproducts()
    {
        $ruless = array(
            'product_name' => 'required'

        );
        $validate = Validator::make(Input::all(), $ruless);

        if($validate->fails())
        {
            return Redirect::to('products/add')
                ->withErrors($validate);
        }
        else{
            $product = new Product;
            $product_categories = new ProductCategory;

            $product->product_name  = Input::get('product_name');
            $product->created_by = Session::get('created_by');
            $product->description = Input::get('description');
            $yes_no = Input::get('yes_no');
            if($yes_no == 0)
            {
                if($product->save())
                {
                    $product_categories->product_id = $product->id;
                    $product_categories->parent_id = 0;
                    $product_categories->price = Input::get('price');
                    $product_categories->commission = Input::get('commission');
                }
                $product_categories->save();
            }
            else{

                if($product->save()){

                    $categories_name=Input::get('category_name');
                    $categories_price=Input::get('category_price');
                    $categories_commission=Input::get('category_commission');
                    if(!empty($categories_name)){
                        foreach($categories_name as $key=>$category_name){
                            $product_categories = new ProductCategory;
                            $product_categories->product_id = $product->id;
                            $product_categories->parent_id = $key;
                            $product_categories->category_name=$category_name;
                            $product_categories->price=$categories_price[$key];
                            $product_categories->commission=$categories_commission[$key];
                            $product_categories->save();
                        }
                    }
                }

            }

            Session::flash('message', 'Product has been Successfully Created.');
            return Redirect::to('products/index');
        }

    }

    public function getUpdate($id)
    {
        $info = Product::find($id);
//        $ok = $info->getinfo($id);
        var_dump($info);
        die();

    }

    public function getDelete($id)
    {
        $del = Product::find($id);
        $del->delete();
        Session::flash('message', 'Product has been Successfully Deleted.');
        return Redirect::to('products/index');
    }

}
