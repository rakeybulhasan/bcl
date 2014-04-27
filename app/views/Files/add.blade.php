@extends('layouts')
@section('content')
<div class="col-md-12">
    <!-- BEGIN VALIDATION STATES-->
    <div class="portlet box purple">
        <div class="portlet-title">
            <div class="caption"><i class="fa fa-reorder"></i>Add Offer</div>

        </div>
        <div class="portlet-body form">
            <!-- BEGIN FORM-->
            {{Form::open(array('url' => 'files/saveFiles/', 'files' => true, 'method' => 'post',
            'class'=>'form-horizontal', 'id'=>'user_form'))}}
            <div class="form-body">
                <div class="alert alert-danger display-hide">
                    <button data-close="alert" class="close"></button>
                    You have some form errors. Please check below.
                </div>
                <div class="alert alert-success display-hide">
                    <button data-close="alert" class="close"></button>
                    Your form validation is successful!
                </div>


                <select name="category_id" class="form-control category_id">
                    @foreach ($productDropDown as $key => $value)
                    <option value="<?php echo $value['id'] ?>"> <?php echo $value['product_name'] ?> </option>
                    @foreach($value->productcategories as $id=>$products)
                    <option value="<?php echo $products['id'] ?>"> <?php echo $products['category_name'] ?> </option>
                    @endforeach
                    @endforeach
                </select>

                <div class="form-group">
                    <label class="control-label col-md-3">Product</label>
                    <div class="col-md-4">

                        <select id="select2_sample2" class="form-control select2">

                         @foreach ($productDropDown as $key => $value)

                            <optgroup label="{{$value['product_name']}}">

                                @foreach($value->productcategories as $id=>$category)

                                  @if($category['category_name']!='')

                                <option value="{{$category['id']}}">{{$category['category_name']}}</option>

                                   @else

                                <option value="{{$category['id']}}">{{$value['product_name']}}</option>
                                @endif
                                @endforeach

                            </optgroup>

                         @endforeach

                        </select>

                    </div>
                </div>


                <div class="form-group">
                    {{HTML::decode(Form::label('title','Title',array('class' => 'control-label col-md-3')))}}
                    <div class="col-md-4">
                        {{Form::text('title',null,array('placeholder' => 'Title', 'class' => 'form-control','id' =>
                        'title'))}}
                    </div>
                </div>
                <div class="form-group">
                    {{HTML::decode(Form::label('description','Description',array('class' => 'control-label
                    col-md-3')))}}
                    <div class="col-md-4">
                        {{Form::textarea('description',null,array('class' => 'form-control','id' => 'Description',
                        'rows'=>'3'))}}
                    </div>
                </div>

                <div class="form-group">
                    {{HTML::decode(Form::label('price','Price',array('class' => 'control-label col-md-3')))}}
                    <div class="col-md-4">
                        {{Form::text('price',null,array('placeholder' => 'Price', 'class' => 'form-control','id' =>
                        'price'))}}
                    </div>
                </div>
                <div class="form-group">
                    {{HTML::decode(Form::label('commission','Commission',array('class' => 'control-label col-md-3')))}}
                    <div class="col-md-4">
                        {{Form::text('commission',null,array('placeholder' => 'Commission', 'class' =>
                        'form-control','id' => 'commission'))}}
                    </div>
                </div>


                <div class="form-group">
                    {{Form::label('pi','Has Pi?',array('class' => 'col-md-3 control-label'))}}


                    <div class="col-md-9">
                        <div class="radio-list">
                            <label>
                                {{Form::radio('pi',1,true,array('class' => 'pi'))}} {{Form::label('Yes')}}
                            </label>
                            <label>
                                {{Form::radio('pi',0,false,array('class' => 'pi'))}} {{Form::label('No')}}
                            </label>

                        </div>
                    </div>
                </div>
                <div class="attach">

                    <div class="form-group">
                        {{HTML::decode(Form::label('attachment','Attachment',array('class' => 'control-label
                        col-md-3')))}}
                        <div class="col-md-4">
                            {{Form::file('attachment',null,array( 'class' => 'form-control','id' => 'attachment'))}}
                        </div>
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
    @
    section('javascript')

    jQuery(document).ready(function () {
        // Put page-specific javascript here
        $('.attach').hide();
        var form1 = $('#user_form');
        var error1 = $('.alert-danger', form1);
        var success1 = $('.alert-success', form1);

        form1.validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "",
            rules: {
                title: {
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
        $('#pi').live("click", function () {

            var ans = $(this).val();
            if (ans == 1) {
                $('.attach').hide();
            }
            else {
                $('.attach').fadeIn(1000);
            }

        });
    });

    @
    stop

</script>
@stop
