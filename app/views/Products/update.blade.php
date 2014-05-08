@extends('layouts')
@section('content')
<div class="col-md-12">
    <!-- BEGIN VALIDATION STATES-->
    <div class="portlet box purple">
        <div class="portlet-title">
            <div class="caption"><i class="fa fa-reorder"></i>Update Product</div>
            <div class="actions">
                <a class="btn" href="{{ URL::to('products/index') }}"><i class="fa fa-times"></i></a>
            </div>
        </div>
        <div class="portlet-body form">
            <!-- BEGIN FORM-->
            {{Form::model($productdata,array('action' => array('ProductController@putProductupdate', $productdata->id), 'method' => 'PUT', 'class'=>'form-horizontal', 'id'=>'product_update_form'))}}
            <div class="form-body">
                <div class="alert alert-danger display-hide">
                    <button data-close="alert" class="close"></button>
                    You have some form errors. Please check below.
                </div>
                <div class="alert alert-success display-hide">
                    <button data-close="alert" class="close"></button>
                    Your form validation is successful!
                </div>
                <div class="form-group">
                    {{HTML::decode(Form::label('product_name','Product Name<span class="required">*</span>',array('class' => 'control-label col-md-3')))}}
                    <div class="col-md-4">
                        {{Form::text('product_name',null,array('placeholder' => 'Product name', 'class' => 'form-control','id' => 'product_name'))}}
                    </div>
                </div>

                <div class="form-group">
                    {{Form::label('yes_no','Do you Add Category?',array('class' => 'col-md-3 control-label'))}}
                    <div class="col-md-4">
                        <div class="radio-list" data-error-container="#form_2_membership_error">
                            <label>
                                {{Form::radio('has_category',1,'', array('class' => 'yes_no', 'id' => 'yes_no'))}}  {{Form::label('Yes')}}
                            </label>
                            <label>
                                {{Form::radio('has_category',0,'', array('class' => 'yes_no', 'id' => 'yes_no'))}}  {{Form::label('No')}}
                            </label>

                        </div>
                        <div id="form_2_membership_error"></div>
                    </div>
                </div>
                <div class="form-group category">
                    {{Form::label('category_name','Category Name', array('class' => 'control-label col-md-3'))}}
                    <div class="col-md-9">

                    <div class="col-md-3" style="padding-right: 0;padding-left: 0">
                            {{Form::text('category_name',null,array('placeholder' => 'Category name', 'class' => 'form-control','id' => 'category_name'))}}
                    </div>
                    <div class="col-md-2" id="" style="padding-right: 0">
                            {{Form::text('category_price',null,array('placeholder' => 'Price', 'class' => 'form-control','id' => 'category_price'))}}
                    </div>
                    <div class="col-md-2" id="" style="padding-right: 0">
                            {{Form::text('category_commission',null,array('placeholder' => 'Commission', 'class' => 'form-control','id' => 'category_commission'))}}
                    </div>
                    <div class="col-md-2" id="" style="padding-right: 0">
												<span class="input-group-btn" style="padding-left: 5px">
												<a id="category_add" class="btn green" href="javascript:;"> Add</a>
												</span>
                    </div>
                   </div>
                </div>

                @foreach ($productdata->productcategories as $category)
                @if($category['category_name']=='')
                <div class="form-group price_commission">
                    {{Form::label('price','Product Price', array('class' => 'control-label col-md-3'))}}
                    <div class="col-md-9">
                        {{Form::hidden('id[]',$category['id'], array('class' => 'form-control'))}}
                    <div class="col-md-2" id="" style="padding-right: 0; padding-left: 0">
                            {{Form::text('price',$productdata->productcategories[0]['price'],array('placeholder' => 'Price', 'rel'=>$productdata->productcategories[0]['price'], 'class' => 'form-control category_price','id' => 'category_price'))}}
                    </div>
                    <div class="col-md-2" id="" style="padding-right: 0">
                            {{Form::text('commission',$productdata->productcategories[0]['commission'],array('placeholder' => 'Commission', 'class' => 'form-control','id' => 'category_commission'))}}
                    </div>

                   </div>
                </div>

                @endif
                @endforeach
                <div class="form-group product_price">
                    {{Form::label('product_price','Product Price', array('class' => 'control-label col-md-3'))}}
                    <div class="col-md-9">
                        <div class="col-md-2" id="" style="padding-right: 0; padding-left: 0">
                            {{Form::text('product_price',null,array('placeholder' => 'Price', 'class' => 'form-control category_price','id' => 'category_price'))}}
                        </div>
                        <div class="col-md-2" id="" style="padding-right: 0">
                            {{Form::text('product_commission',null,array('placeholder' => 'Commission', 'class' => 'form-control','id' => 'category_commission'))}}
                        </div>

                    </div>
                </div>

                <div class="form-group" id="category_list">
                    @foreach ($productdata->productcategories as $category)
                    @if($category['category_name']!='')
                    <div class="list">
                    {{Form::label('','', array('class' => 'control-label col-md-3'))}}

                    <div class="col-md-9" style="margin-bottom: 5px">
                        {{Form::hidden('id[]',$category['id'], array('class' => 'form-control'))}}
                        <div class="col-md-3" id="" style="padding-right: 0;padding-left: 0">
                            {{Form::text('category_name[]',$category['category_name'],array('placeholder' => 'Category name', 'class' => 'form-control','id' => 'category_name'))}}
                        </div>
                        <div class="col-md-2" id="" style="padding-right: 0">
                            {{Form::text('category_price[]',$category['price'],array('placeholder' => 'Price', 'class' => 'form-control category_price','id' => 'category_price'))}}
                        </div>
                        <div class="col-md-2" id="" style="padding-right: 0">
                            {{Form::text('category_commission[]',$category['commission'],array('placeholder' => 'Commission', 'class' => 'form-control','id' => 'category_commission'))}}
                        </div>
                        <div class="col-md-2" id="" style="padding-right: 0">
                            <span class="input-group-btn" style="padding-left: 5px"><input type="button" value="delete" class="btn btn-small btn-danger deleteCategory" rel="{{$category['id']}}" ></span>
                        </div>
                    </div>
                    </div>
                    @endif
                    @endforeach
                </div>
                <div class="form-group">
                    {{HTML::decode(Form::label('description','Description',array('class' => 'control-label col-md-3')))}}
                    <div class="col-md-4">
                        {{Form::textarea('description',null,array('class' => 'form-control','id' => 'description', 'rows'=>'3'))}}
                    </div>
                </div>

                <div class="form-actions fluid">
                    <div class="col-md-offset-3 col-md-9">
                        {{Form::button('Save',array('type' => 'submit','class' => 'btn green','id' => 'save'))}}
                        {{Form::button('Cancel',array('type'=>'reset', 'class' => 'btn default','id' => 'cancel'))}}

                    </div>
                </div>
            {{Form::close()}}
            <!-- END FORM-->
        </div>
    </div>
    <!-- END VALIDATION STATES-->
</div>
<script type="text/javascript">
    @section('javascript')
    jQuery(document).ready(function() {
        $('.category').hide();
        $('.product_price').hide();
        var form1 = $('#product_update_form');
        var error1 = $('.alert-danger', form1);
        var success1 = $('.alert-success', form1);

        form1.validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "",
            rules: {
                product_name: {
                    minlength: 2,
                    required: true
                },
                yes_no:{
                    required:true
                }
            },
            messages: { // custom messages for radio buttons and checkboxes
                yes_no: {
                    required: "Please select a Option."
                }
            },
            errorPlacement: function (error, element) { // render error placement for each input type
                if (element.parent(".input-group").size() > 0) {
                    error.insertAfter(element.parent(".input-group"));
                } else if (element.attr("data-error-container")) {
                    error.appendTo(element.attr("data-error-container"));
                } else if (element.parents('.radio-list').size() > 0) {
                    error.appendTo(element.parents('.radio-list').attr("data-error-container"));
                } else if (element.parents('.radio-inline').size() > 0) {
                    error.appendTo(element.parents('.radio-inline').attr("data-error-container"));
                } else {
                    error.insertAfter(element); // for other inputs, just perform default behavior
                }
            },


            invalidHandler: function (event, validator) { //display error alert on form submit
                success1.hide();
                error1.show();
                App.scrollTo(error1, -200);
            },

            highlight: function (element) { // hightlight error inputs
                $(element)
                    .closest('.form-group').addClass('has-error'); // set error class to the control group
            },

            unhighlight: function (element) { // revert the change done by hightlight
                $(element)
                    .closest('.form-group').removeClass('has-error'); // set error class to the control group
            },

            success: function (label) {
                label
                    .closest('.form-group').removeClass('has-error'); // set success class to the control group
            }

            /* submitHandler: function (form) {
             success1.show();
             error1.hide();
             }*/
        });
        $("#price").TouchSpin({
            inputGroupClass: 'input-medium',
            spinUpClass: 'green',
            spinDownClass: 'green',
            min: -1000000000,
            max: 1000000000,
            stepinterval: 50,
            maxboostedstep: 10000000,
            prefix: '$'
        });
        $("#commission").TouchSpin({
            inputGroupClass: 'input-medium',
            spinUpClass: 'blue',
            spinDownClass: 'blue',
            min: 0,
            max: 100,
            step: 0.1,
            decimals: 2,
            boostat: 5,
            maxboostedstep: 10,
            postfix: '%'
        });

        $('#yes_no').live("click", function () {

            var ans = $(this).val();
            if(ans == 1)
            {
                $('.price_commission').hide();
                $('.product_price').hide();

                $('#category_list').fadeIn(1000);
                $('.category').fadeIn(1000);


            }
            else

            {
                var category_price = $('.category_price').val();

                if(category_price){
                    $('.price_commission').fadeIn(1000);
                }else{

                    $('.product_price').fadeIn(1000);
                }
                $('#category_list').hide();
                $('.category').hide();
            }

        });

        $('#category_add').live("click", function () {

            saveCategory();
        });

        function saveCategory(invoice_id)
        {

            var category_name = $('#category_name').val();
            var category_price = $('#category_price').val();
            var category_commission = $('#category_commission').val();

            if(category_name=='' || category_price=='' || category_commission == ''){
                return false;
            }

            var addinvoice_array = {

                "category_name": category_name,
                "category_price": category_price,
                "category_commission": category_commission
            };

            var html = [];
            html.push('<div class="list"><label class="control-label col-md-3" for=""></label><div class="col-md-9" style="margin-bottom: 5px">' +
                '<div class="col-md-3" id="" style="padding-right: 0;padding-left: 0"><input type="hidden" class="form-control" name="id[]" value="">' +
                '<input type="text" class="form-control" name="category_name[]" value="'+addinvoice_array.category_name+'"></div>'+
                '<div class="col-md-2" id="" style="padding-right: 0"><input type="text" class="form-control" name="category_price[]" value="'+addinvoice_array.category_price+'"></div>' +
                '<div class="col-md-2" id="" style="padding-right: 0"><input type="text" class="form-control" name="category_commission[]" value="'+addinvoice_array.category_commission+'"></div>' +
                '<div class="col-md-2" id="" style="padding-right: 0"><span class="input-group-btn" style="padding-left: 5px"><input type="button" value="delete" class="btn btn-small btn-danger deleteCategory" rel="" ></span></div>' +
                '</div></div>');

            $('#category_list').append(html);

            $('#category_name').val('');
            $('#category_price').val('');
            $('#category_commission').val('');

        }
        $('.deleteCategory').live("click", function (e) {


            var parant     = $(e.target).closest(".list");
            var category_id = $(this).attr('rel');

            var answer     = confirm("Are you sure you want to delete this category name?");
            if (answer) {
                parant.remove();

            } else {
                return false;
            }
            $.ajax({
                type: "post",
                url: "{{ URL::to('categoryDelete') }}",

                data: "category_id=" + category_id,
                dataType: "json",
                async: false,
                success: function (msg) {

                }
            });

        });

    });

    @stop
</script>
@stop
