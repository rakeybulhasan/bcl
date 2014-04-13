@extends('layouts')
@section('content')
<div class="col-md-12">
    <!-- BEGIN VALIDATION STATES-->
    <div class="portlet box purple">
        <div class="portlet-title">
            <div class="caption"><i class="fa fa-reorder"></i>Update Product Category</div>

        </div>
        <div class="portlet-body form">
            <!-- BEGIN FORM-->
            {{Form::model($userdata,array('action' => array('ProductCategoryController@putCategoryupdate', $userdata->id), 'method' => 'PUT', 'class'=>'form-horizontal', 'id'=>'user_update_form'))}}
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
                    {{HTML::decode(Form::label('category_name','Product Category Name<span class="required">*</span>',array('class' => 'control-label col-md-3')))}}
                    <div class="col-md-4">
                        {{Form::text('category_name',null,array('placeholder' => 'Product Category Name', 'class' => 'form-control','id' => 'category_name'))}}
                    </div>
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
    // Put page-specific javascript here
    var form1 = $('#user_update_form');
    var error1 = $('.alert-danger', form1);
    var success1 = $('.alert-success', form1);

    form1.validate({
        errorElement: 'span', //default input error message container
        errorClass: 'help-block', // default input error message class
        focusInvalid: false, // do not focus the last invalid input
        ignore: "",
        rules: {
            type_name: {
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
    });

    @stop
</script>
@stop
