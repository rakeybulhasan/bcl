<?php
/**
 * Created by PhpStorm.
 * User: rocky
 * Date: 4/8/14
 * Time: 2:49 PM
 */
class ProductController extends BaseController
{
    public function __construct()
    {
        $this->beforeFilter('admin');
    }

    public function getIndex()
    {
        $products = Product::all();

        return View::make('Products.list')
            ->with('list', $products);
    }

    public function getAdd()
    {

        return View::make('Products.add');
    }

    public function postSaveproducts()
    {
        $ruless = array(
            'product_name' => 'required'

        );
        $validate = Validator::make(Input::all(), $ruless);

        if ($validate->fails()) {
            return Redirect::to('products/add')
                ->withErrors($validate);
        } else {
            $product = new Product;
            $product_categories = new ProductCategory;

            $product->product_name = Input::get('product_name');
            $product->created_by = Session::get('created_by');
            $product->description = Input::get('description');
            $yes_no  = $product->has_category = Input::get('has_category');
            if ($yes_no == 0) {
                if ($product->save()) {
                    $product_categories->product_id = $product->id;
                    $product_categories->parent_id = 0;
                    $product_categories->price = Input::get('price');
                    $product_categories->commission = Input::get('commission');
                }
                $product_categories->save();
            } else {

                if ($product->save()) {

                    $categories_name = Input::get('category_name');
                    $categories_price = Input::get('category_price');
                    $categories_commission = Input::get('category_commission');
                    if (!empty($categories_name) && is_array($categories_name)) {
                        foreach ($categories_name as $key => $category_name) {
                            $product_categories = new ProductCategory;
                            $product_categories->product_id = $product->id;
                            $product_categories->parent_id = $key;
                            $product_categories->category_name = $category_name;
                            $product_categories->price = $categories_price[$key];
                            $product_categories->commission = $categories_commission[$key];
                            $product_categories->save();
                        }
                    }
                }

            }

            Session::flash('message', 'Product has been Successfully Created.');
            return Redirect::to('products/index');
        }

    }

    public function putProductupdate($id)
    {
        $ruless = array(
            'product_name' => 'required'

        );
        $validate = Validator::make(Input::all(), $ruless);

        if ($validate->fails()) {
            return Redirect::to('products/update/' . $id)
                ->withErrors($validate);
        } else {
            $product = Product::find($id);

            $product->product_name = Input::get('product_name');
            $product->created_by = Session::get('created_by');
            $product->description = Input::get('description');
            $yes_no = $product->has_category = Input::get('has_category');
            if ($yes_no == 0) {
                if ($product->save()) {
                   // ProductCategory::where('product_id', '=', $id)->delete();
                    $product_categories = array();
                    $product_categories['product_id'] = $product->id;
                    $product_categories['parent_id'] = 0;
                    $product_categories['category_name'] = '';
                    $price = Input::get('price');
                    $product_price = Input::get('product_price');
                    $product_categories['price'] = ($price) ? $price : $product_price;
                    $commission = Input::get('commission');
                    $product_commission = Input::get('product_commission');
                    $product_categories['commission'] = ($commission) ? $commission : $product_commission;
                    ProductCategory::where('product_id', '=', $id)-> update($product_categories);
                    //$product_categories->save();
                }
            } else {

                if ($product->save()) {
                    //ProductCategory::where('product_id', '=', $id)->delete();
                    $categories_id = Input::get('id');
                  //var_dump($categories_id);die();
                    $category_name = Input::get('category_name');
                    $categories_price = Input::get('category_price');
                    $categories_commission = Input::get('category_commission');
                   // var_dump($categories_name);die();
                    if (!empty($category_name)) {
                        foreach ($categories_id as $key => $category_id) {
                            if($category_id!=''){
                            $product_categories = array();
                            $product_categories['product_id'] = $product->id;
                            $product_categories['parent_id'] = 0;
                            $product_categories['category_name'] = $category_name[$key];
                            $product_categories['price'] = $categories_price[$key];
                            $product_categories['commission'] = $categories_commission[$key];

                          ProductCategory::where('id','=',$category_id)-> update($product_categories);
                        }else{
                                $product_categories = new ProductCategory;
                                $product_categories->product_id = $product->id;
                                $product_categories->parent_id = 0;
                                $product_categories->category_name = $category_name[$key];
                                $product_categories->price = $categories_price[$key];
                                $product_categories->commission = $categories_commission[$key];
                                $product_categories->save();
                            }

                        }
                    }
                }

            }
            Session::flash('message', 'Product has been Successfully Updated.');
            return Redirect::to('products/index');
        }
    }

    public function getUpdate($id)
    {
        $info = Product::find($id);
        return View::make('Products.update')
            ->with('productdata', $info);


    }

    public function categoryInlineUpdate()
    {
        $id = $_POST['category_id'];
        $productcategory = ProductCategory::find($id);
        $productcategory->price = $_POST['price'];
        $productcategory->commission = $_POST['commission'];
        $productcategory->save();
        $response_array['success_message'] = 'Product category has been Successfully Updated.';
        $this->outputAsJSON($response_array);

    }

    protected function outputAsJSON($data)
    {
        // header("content-type: application/json");
        echo json_encode($data);
    }

    public function getCategoryById()
    {
        $id_name = $_POST['category_id'];
        $id = explode("|", $id_name);
        $info = ProductCategory::find($id[0])->toJson();
        return $info;

    }

    public function getDeleteCategoryById()
    {
        $id = $_POST['category_id'];
        $del = ProductCategory::find($id);
        $del->delete();

    }

    public function getDelete($id)
    {
        $del = Product::find($id);
        try {
            $del->delete();
            Session::flash('message', 'Product has been Successfully Deleted.');
        } catch (Exception $e) {
            Session::flash('message', 'This product can\'t delete because it  is used to file');
        }

        return Redirect::to('products/index');
    }

}
