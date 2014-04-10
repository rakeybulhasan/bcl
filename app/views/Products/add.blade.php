@extends('layouts')
@section('content')
<div class="col-md-12">
    <!-- BEGIN VALIDATION STATES-->
    <div class="portlet box purple">
        <div class="portlet-title">
            <div class="caption"><i class="fa fa-reorder"></i>Add Products</div>

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
                    {{Form::label('category_name','Category Name', array('class' => 'control-label col-md-3'))}}
                    <div class="col-md-4">
                        {{Form::select('category_name[]', $category,'null', array('class'=>'form-control','multiple' => true))}}
                    </div>
                </div>
                <div class="form-group">
                    {{HTML::decode(Form::label('description','Description',array('class' => 'control-label col-md-3')))}}
                    <div class="col-md-4">
                        {{Form::textarea('description',null,array('class' => 'form-control','id' => 'description', 'rows'=>'3'))}}
                    </div>
                </div>
                <div class="form-group">
                    {{HTML::decode(Form::label('price','Price',array('class' => 'control-label col-md-3')))}}
                    <div class="col-md-4 pricing-head">
                        {{Form::text('price','100',array('placeholder' => 'Price', 'class' => 'form-control','id' => 'price'))}}
                    </div>
                </div>
                <div class="form-group">
                    {{HTML::decode(Form::label('commission','Commission',array('class' => 'control-label col-md-3')))}}
                    <div class="col-md-4">
                        {{Form::text('commission',5.00,array('placeholder' => 'Commission', 'class' => 'form-control','id' => 'commission'))}}
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

        });
        @stop
    </script>@stop
