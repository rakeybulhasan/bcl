@extends('layouts')
@section('content')
<div class="col-md-12">
<!-- BEGIN VALIDATION STATES-->
<div class="portlet box purple">
    <div class="portlet-title">
        <div class="caption"><i class="fa fa-reorder"></i>Add Products</div>
        <div class="actions">
            <a class="btn" href="{{ URL::to('products/index') }}"><i class="fa fa-times"></i></a>
        </div>
    </div>
    <div class="portlet-body form">
        <!-- BEGIN FORM-->
        {{Form::open(array('url' => 'products/saveproducts/', 'method' => 'post', 'class'=>'form-horizontal', 'id'=>'product_form'))}}
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


                <div class="col-md-9">
                    <div class="radio-list">
                        <label>
                            {{Form::radio('has_category',1,false,array('id' => 'yes_no','class' => 'yes_no'))}}  {{Form::label('Yes')}}
                        </label>
                        <label>
                            {{Form::radio('has_category',0,true,array('id' => 'yes_no','class' => 'yes_no'))}}  {{Form::label('No')}}
                        </label>

                    </div>
                </div>
            </div>
            <div class="form-group category" id="category_list">
               <div class="list">
                {{Form::label('category_name','Category Name', array('class' => 'control-label col-md-3'))}}
                <div class="col-md-9" style="margin-bottom: 5px">
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
            </div>

                <div class="form-group price_commission">
                    {{Form::label('category_name','Product Price', array('class' => 'control-label col-md-3'))}}
                    <div class="col-md-9">
                        <div class="col-md-2" id="" style="padding-right: 0; padding-left: 0">
                            {{Form::text('price',null,array('placeholder' => 'Price', 'class' => 'form-control','id' => 'category_price'))}}
                        </div>
                        <div class="col-md-2" id="" style="padding-right: 0">
                            {{Form::text('commission',null,array('placeholder' => 'Commission', 'class' => 'form-control','id' => 'category_commission'))}}
                        </div>

                    </div>
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
        var form1 = $('#product_form');
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

           $('#yes_no').live("click", function () {

            var ans = $(this).val();
            if(ans == 1)
            {
                $('.price_commission').hide();
                $('.category').fadeIn(1000);


            }
            else
            {
                $('.price_commission').fadeIn(1000);
                $('.category').hide();             }

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
                '<div class="col-md-3" id="" style="padding-right: 0;padding-left: 0"><input type="text" class="form-control" name="category_name[]" value="'+addinvoice_array.category_name+'"></div>'+
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


            //var parant     = $(e.target).closest("div");
            var parant     = $(e.target).closest(".list");
            var answer     = confirm("Are you sure you want to delete this category name?");
            if (answer) {
                parant.remove();
            } else {
                return false;
            }

        });

    });
    @stop
</script>
@stop
