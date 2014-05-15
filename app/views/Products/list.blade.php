@extends('layouts')
@section('content')
<style>
    table select{
        width: 100%;
    }
</style>
<div class="portlet box purple">
    <div class="portlet-title">
        <div class="caption"><i class="fa fa-cogs"></i>Product List</div>
        <div class="actions">
            <a href="{{ URL::to('products/add') }}" class="btn green"><i class="fa fa-plus"></i> Product Add</a>
            <!--            <a href="table_managed.html#" class="btn yellow"><i class="fa fa-print"></i> Print</a>-->
        </div>
    </div>
    <div class="portlet-body">
        @if (Session::has('message'))
        <div class="alert alert-success">
            <button data-close="alert" class="close"></button>
            {{ Session::get('message') }}
        </div>

        @endif
        <div class="success_message" style="display: none">

        </div>

        <table class="table table-striped table-bordered table-hover" id="sample_3">
            <thead>
            <tr>
                <th class="table-checkbox"><input type="checkbox" class="group-checkable" data-set="#sample_3 .checkboxes" /></th>
                <th>Product Name</th>
                <th>Description</th>
                <th>Category Name</th>
                <th>Price</th>
                <th>Commission</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($list as $key => $value)
            <tr class="odd gradeX">

                <td> {{Form::checkbox('',1,false,array('class'=>'checkboxes','value'=>1))}}</td>
                <td> {{ $value->product_name }}</td>
                <td> {{ $value->description }}</td>
                <td>
                    <select name="category_id" class="form-control category_id">

                      @foreach($value->productcategories as $id=>$categories)
                            <option value="<?php echo $categories['id'] ?>"> <?php echo ($categories['category_name']!='')?  $categories['category_name']: $value->product_name ?> </option>
                      @endforeach

                    </select>

                </td>
                <td>

                 <input type="text" class="form-control price" name="price" value="">

                </td>
                <td>
                    <input type="text" class="form-control commission" name="commission" value="">
                </td>

                <td> <a class="btn default btn-xs blue-stripe inline_update" href="javascript:;"><i class="fa fa-edit"></i> Inline Update</a>
                  <a class="btn default btn-xs green-stripe" href="{{ URL::to('products/update/'.$value->id)}}"><i class="fa fa-edit"></i> Update</a>
                   <a class="btn default btn-xs red-stripe" href="{{ URL::to('products/delete/'.$value->id)}}"><i class="fa fa-trash-o"></i> Delete</a></td>

            </tr>
            @endforeach

            </tbody>
        </table>
    </div>
</div>


<script type="text/javascript">
    @section('javascript')
    jQuery(document).ready(function() {
        // Put page-specific javascript here
        $('#sample_3').dataTable({
            "aoColumns": [
                { "bSortable": false },
                null,

                { "bSortable": false },
                { "bSortable": false },
                { "bSortable": false },
                { "bSortable": false },
                { "bSortable": false }
            ],
            "aLengthMenu": [
                [5, 15, 20, -1],
                [5, 15, 20, "All"] // change per page values here
            ],
            // set the initial value
            "iDisplayLength": 5,
            "sPaginationType": "bootstrap",
            "oLanguage": {
                "sLengthMenu": "_MENU_ records",
                "oPaginate": {
                    "sPrevious": "Prev",
                    "sNext": "Next"
                }
            },
            "aoColumnDefs": [{
                'bSortable': false,
                'aTargets': [0]
            }
            ]
        });

        jQuery('#sample_3 .group-checkable').live('change', function () {
            var set = jQuery(this).attr("data-set");
            var checked = jQuery(this).is(":checked");
            jQuery(set).each(function () {
                if (checked) {
                    $(this).attr("checked", true);
                } else {
                    $(this).attr("checked", false);
                }
            });
            jQuery.uniform.update(set);
        });
        jQuery('#sample_3_wrapper .dataTables_filter input').addClass("form-control input-small"); // modify table search input
        jQuery('#sample_3_wrapper .dataTables_length select').addClass("form-control input-xsmall"); // modify table per page dropdown
        jQuery('#sample_3_wrapper .dataTables_length select').select2(); // initialize select2 dropdown
        //var form1 = $('#user_update_form');
        var success1 = $('.alert-success');
        success1.fadeOut(5000);


        $('.category_id').live("change focus click", function () {

            perticularTaskResult(jQuery(this));
        });

        function perticularTaskResult(elm) {
            var category_id = elm.val();

            $.ajax({

                type: "post",
                url: "{{ URL::to('category') }}",

                data: "category_id=" + category_id,
                dataType: "json",
                async: false,
                success: function (msg) {
                    elm.closest('tr').find('.price').val(msg.price);
                    elm.closest('tr').find('.commission').val(msg.commission);
                    elm.closest('tr').find('.inline_update').attr('rel',msg.id);
                }
            });
        }

        $('.inline_update').live("click", function(){
            var category_id = $(this).attr('rel');
            var price = $(this).closest('tr').find('.price').val();
            var commission = $(this).closest('tr').find('.commission').val();

            if(category_id!='' || price!='' || commission != ''){
                $.ajax({
                    type: "post",
                    url: "{{ URL::to('categoryupdate') }}",
                    data: "category_id=" + category_id + "&price=" + price + "&commission=" + commission,
                    dataType: "json",
                    async: false,
                    success: function (msg) {
                        $('.success_message').html(msg.success_message).fadeIn(1000).fadeOut(5000);
                    }
                });
            }


        });
    })
    @stop
</script>
@stop