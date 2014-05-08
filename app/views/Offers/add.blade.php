@extends('layouts')
@section('content')
<div class="col-md-12">
    <!-- BEGIN VALIDATION STATES-->
    <div class="portlet box purple">
        <div class="portlet-title">
            <div class="caption"><i class="fa fa-reorder"></i>Add Offer</div>
            <div class="actions">
                <a class="btn" href="{{ URL::to('offers/index') }}"><i class="fa fa-times"></i></a>
            </div>
        </div>
        <div class="portlet-body form">
            <!-- BEGIN FORM-->
            {{Form::open(array('url' => 'offers/savefiles/', 'files' => true, 'method' => 'post',
            'class'=>'form-horizontal', 'id'=>'offer_form'))}}
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
                    <label class="control-label col-md-3">Client</label>

                    <div class="col-md-4">

                        <select id="client_id" class="form-control select2" name="client_id">
                            <option value="">Select Cient</option>
                            @foreach ($clientDropDown as $value)

                            <option value="{{$value['id']}}">{{$value['first_name'].' '.$value['last_name']}}</option>

                            @endforeach

                        </select>

                    </div>
                </div>


                <div class="form-group">
                    <label class="control-label col-md-3">Product</label>

                    <div class="col-md-4">

                        <select id="category_id" class="form-control select2" name="category_id">
                           <option value="">Select Product</option>
                            @foreach ($productDropDown as $value)

                            <optgroup label="{{$value['product_name']}}">

                                @foreach($value->productcategories as $category)

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
                    {{HTML::decode(Form::label('price','Price',array('class' => 'control-label col-md-3')))}}
                    <div class="col-md-4">
                        <div style="" class="input-group">
                            <span class="input-group-addon bootstrap-touchspin-prefix">$</span>
                        {{Form::text('price',null,array('placeholder' => 'Price', 'class' => 'form-control price','id' =>
                        'price'))}}
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    {{HTML::decode(Form::label('commission','Commission',array('class' => 'control-label col-md-3')))}}
                    <div class="col-md-4">
                        <div style="" class="input-group">
                            <span class="input-group-addon bootstrap-touchspin-prefix">%</span>
                        {{Form::text('commission',null,array('placeholder' => 'Commission', 'class' =>
                        'form-control commission','id' => 'commission'))}}
                            </div>
                    </div>
                </div>

                <div class="form-group">
                    {{HTML::decode(Form::label('quantity','Quantity',array('class' => 'control-label col-md-3')))}}
                    <div class="col-md-4">
                        {{Form::text('quantity',null,array('placeholder' => 'Quantity', 'class' =>
                        'form-control','id' => 'quantity'))}}
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
                        <div class="col-md-9">
                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                <div class="input-group">
													<span class="input-group-btn">
													<span class="uneditable-input">
													<i class="fa fa-file fileupload-exists"></i>
													<span class="fileupload-preview"></span>
													</span>
													</span>
													<span class="btn default btn-file">
													<span class="fileupload-new"><i class="fa fa-paper-clip"></i> Select file</span>
													<span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                                               {{Form::file('attachment',null,array( 'class' => 'default','id' => 'attachment'))}}
													</span>
                                    <a data-dismiss="fileupload" class="btn red fileupload-exists" href="form_component.html#"><i class="fa fa-trash-o"></i> Remove</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
            <div class="form-actions fluid">
                <div class="col-md-offset-3 col-md-9">
                    {{Form::button('Save as Draft',array('type' => 'submit','class' => 'btn green','name' => 'save_as_draft','id' => 'save'))}}
                    {{Form::button('Send an Email',array('type' => 'submit','class' => 'btn green','name' => 'send_an_email','id' => 'save'))}}
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

    jQuery(document).ready(function () {
        // Put page-specific javascript here
        $('.attach').hide();
        var form1 = $('#offer_form');
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
                },
                client_id: {
                    required: true
                },
                category_id: {
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


        $('#category_id').on("change", function () {
            getPriceCommission(jQuery(this));
        });

        function getPriceCommission(elm) {
            var category_id = elm.val();

            $.ajax({

                type: "post",
                url: "{{ URL::to('category') }}",

                data: "category_id=" + category_id,
                dataType: "json",
                async: false,
                success: function (msg) {
                    //alert(msg.price);
                    $('#price').val(msg.price);
                    $('#commission').val(msg.commission);
                }
            });
        }


    });

    @stop

</script>
@stop
