<?php
/**
 * Created by PhpStorm.
 * User: rocky
 * Date: 4/8/14
 * Time: 2:49 PM
 */
class ProductController extends BaseController{

    public function getIndex()
    {

        $products = Product::all();
        //var_dump($products);
        return View::make('Products.list')
            ->with('list',$products);
    }

    public function getAdd()
    {
        $categories = ProductCategory::all();
        $array = array();

        foreach($categories as $category){
            $array[$category->id] = $category->category_name;
        }
        return View::make('Products.add')
            ->with('category',$array);
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

            $product->product_name  = Input::get('product_name');
            $product->user_name = Session::get('email');
            $product->description = Input::get('description');
            $product->price = Input::get('price');
            $product->commission = Input::get('commission');
            if($product->save()){
                $product_id = $product->id;
                $categories_name=Input::get('category_name');
                foreach($categories_name as $category_name){
                    $product_details= new ProductDetail;
                    $product_details->product_id=$product_id;
                    $product_details->product_category_id=$category_name;
                    $product_details->save();
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
        die();
        return Redirect::to('products/index');
    }

}
