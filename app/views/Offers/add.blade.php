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


                <div class="form-group category" id="category_list">
                    <div class="list">
                        {{Form::label('category_name','Product Name', array('class' => 'control-label col-md-3'))}}
                        <div class="col-md-9" style="margin-bottom: 5px">

                            <div class="col-md-3" style="padding-right: 0;padding-left: 0">
                                <select id="category_id" class="form-control select2" name="category_id">
                                    <option value="">Select Product</option>
                                    @foreach ($productDropDown as $value)

                                    <optgroup label="{{$value['product_name']}}">

                                        @foreach($value->productcategories as $category)

                                        @if($category['category_name']!='')

                                        <option value="{{$category['id'].'|'.$category['category_name']}}">{{$category['category_name']}}</option>

                                        @else

                                        <option value="{{$category['id'].'|'.$value['product_name']}}">{{$value['product_name']}}</option>
                                        @endif
                                        @endforeach

                                    </optgroup>

                                    @endforeach

                                </select>
                            </div>
                            <div class="col-md-3" id="" style="padding-right: 0">
                                <div style="" class="input-group">
                                    <span class="input-group-addon bootstrap-touchspin-prefix">$</span>
                                    {{Form::text('price',null,array('placeholder' => 'Price', 'class' => 'form-control price','id' =>
                                    'price'))}}
                                </div>
                            </div>
                            <div class="col-md-2" id="" style="padding-right: 0">
                                <div style="" class="input-group">
                                    <span class="input-group-addon bootstrap-touchspin-prefix">%</span>
                                    {{Form::text('commission',null,array('placeholder' => 'Commission', 'class' =>
                                    'form-control commission','id' => 'commission'))}}
                                </div>
                            </div>
                            <div class="col-md-2" id="" style="padding-right: 0">
                                {{Form::text('quantity',null,array('placeholder' => 'Quantity', 'class' => 'form-control','id' => 'quantity'))}}
                            </div>
                            <div class="col-md-2" id="" style="padding-right: 0">
												<span class="input-group-btn" style="padding-left: 5px">
												<a id="product_add" class="btn green" href="javascript:;"> Add</a>
												</span>
                            </div>
                        </div>
                    </div>
                </div>
                <input name="grand_total" class="grand_total" value="" type="hidden">


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


        $('#product_add').live("click", function () {

            saveCategory();
            grandLineTotal();
        });

        function saveCategory(invoice_id)
        {

            var category_id_name = $('#category_id').val();
            var cat_name = category_id_name.split('|');
            var category_id = cat_name[0];
            var category_name = cat_name[1];
            var category_price = $('#price').val();
            var category_commission = $('#commission').val();
            var quantity = $('#quantity').val();
            var line_total =  (category_price * quantity) + ((category_price * quantity) * category_commission/100);

            if(category_id_name=='' || category_price=='' || category_commission == ''|| quantity == ''){
                return false;
            }

            var addinvoice_array = {

                "category_id": category_id,
                "category_name": category_name,
                "category_price": category_price,
                "category_commission": category_commission,
                "quantity": quantity,
                "line_total": line_total
            };

            var html = [];
            html.push('<div class="list"><input type="hidden" class="form-control line_total" name="line_total[]" value="'+addinvoice_array.line_total+'"><label class="control-label col-md-3" for=""></label><div class="col-md-9" style="margin-bottom: 5px">' +
                '<div class="col-md-3" id="" style="padding-right: 0;padding-left: 0"><input type="hidden" class="form-control" name="category_id[]" value="'+addinvoice_array.category_id+'"><input type="text" readonly class="form-control" name="" value="'+addinvoice_array.category_name+'"></div>'+
                '<div class="col-md-3" id="" style="padding-right: 0"><input type="text" readonly class="form-control" name="price[]" value="'+addinvoice_array.category_price+'"></div>' +
                '<div class="col-md-2" id="" style="padding-right: 0"><input type="text" readonly class="form-control" name="commission[]" value="'+addinvoice_array.category_commission+'"></div>' +
                '<div class="col-md-2" id="" style="padding-right: 0"><input type="text" readonly class="form-control" name="quantity[]" value="'+addinvoice_array.quantity+'"></div>' +
                '<div class="col-md-2" id="" style="padding-right: 0"><span class="input-group-btn" style="padding-left: 5px"><input type="button" value="delete" class="btn btn-small btn-danger deleteCategory" rel="" ></span></div>' +
                '</div></div>');
            $('#category_list').append(html);

            $('#category_id').val('');
            $('#price').val('');
            $('#commission').val('');
            $('#quantity').val('');

        }
        $('.deleteCategory').live("click", function (e) {


            //var parant     = $(e.target).closest("div");
            var parant     = $(e.target).closest(".list");
            var answer     = confirm("Are you sure you want to delete this category name?");
            if (answer) {
                parant.remove();
                grandLineTotal();
            } else {
                return false;
            }

        });

        function grandLineTotal(){
            var sum = 0.0;
            $('.line_total').each(function()
            {
                sum += parseFloat(this.value);
            });

            $('input[name=grand_total]').val(sum);
        }
    });

    @stop

</script>
@stop
