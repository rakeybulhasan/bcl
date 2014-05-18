@extends('layouts')
@section('content')
<div class="portlet box purple">
    <div class="portlet-title">
        <div class="caption"><i class="fa fa-cogs"></i>@if(Request::is('offers/index'))Active OffersList @elseif(Request::is('offers/archivelist'))Archive OffersList @elseif(Request::is('offers/deletelist'))Deleted OffersList @endif</div>
        <div class="actions">
            <a href="{{ URL::to('offers/add') }}" class="btn green"><i class="fa fa-plus"></i> Add Offer</a>
<!--            <a href="table_managed.html#" class="btn yellow"><i class="fa fa-print"></i> Print</a>-->
        </div>
    </div>
    <div class="portlet-body">
        <div style="min-height: 70px">
            <div style="float: left; width: auto; padding-top: 15px" id="statusDiv">

                <a href="{{ URL::to('offers/index') }}" id="activeList">Active</a>&nbsp;|&nbsp;
                <a href="{{ URL::to('offers/archivelist') }}" id="archiveList">Archived</a>&nbsp;|&nbsp;
                <a href="{{ URL::to('offers/deletelist') }}" id="deleteList">Deleted</a>

            </div>
            <div style="float: left;width: 80%; margin-left: 20px">
     @if (Session::has('message'))
        <div class="alert alert-success">
            <button data-close="alert" class="close"></button>
            {{ Session::get('message') }}
        </div>
            @endif
            </div>
        </div>
        <div style="clear: both;"></div>
        <table class="table table-striped table-bordered table-hover" id="sample_3">
            <thead>
            <tr>
                <th class="table-checkbox"><input type="checkbox" class="group-checkable" data-set="#sample_3 .checkboxes" /></th>
                <th>Title</th>
                <th>Description</th>
                <th>Category</th>
                <th>Price</th>
                <th>Commission</th>
                <th>Quantity</th>
                <th>Line Total </th>
                @if(Request::is('offers/index'))
                <th>Status</th>
                @endif
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($offers as $key => $value)
            <tr class="odd gradeX">
                <td> {{Form::checkbox('sex',1,false,array('class'=>'checkboxes','value'=>1))}}</td>
                <td> {{ Str::limit($value-> title, 20) }}</td>
                <td> {{ $value-> description }}</td>
                <td> {{ ($value-> category -> category_name)? $value-> category -> category_name : $value-> category -> product -> product_name }}</td>
                <td> {{ $value-> price }}</td>
                <td> {{ $value-> price * $value-> quantity * ($value->commission/100) }}</td>
                <td> {{ $value-> quantity }}</td>
                <td> {{ $value-> line_total }}</td>
                @if(Request::is('offers/index'))
                <td> {{ $value-> status }}</td>
                @endif
                @if(Request::is('offers/deletelist') || Request::is('offers/archivelist'))
                <td> <a class="btn default btn-xs dark-stripe" href="{{ URL::to('offers/details/'.$value->id)}}"><i class="fa fa-eye"></i> Details</a></td>
                @else
                <td> <a class="btn default btn-xs dark-stripe" href="{{ URL::to('offers/details/'.$value->id)}}"><i class="fa fa-eye"></i> Details</a>
                    <a class="btn default btn-xs green-stripe" href="{{ URL::to('offers/update/'.$value->id)}}"><i class="fa fa-edit"></i> Update</a>
                    <a class="btn default btn-xs red-stripe" href="{{ URL::to('offers/delete/'.$value->id)}}"><i class="fa fa-trash-o"></i> Delete</a>
                    <a class="btn default btn-xs blue-stripe" href="{{ URL::to('offers/archive/'.$value->id)}}"><i class="fa fa-clipboard"></i> Archive</a> </td>
                @endif

            </tr>
            @endforeach

            </tbody>
        </table>
    </div>
</div>

<!--<script type="text/javascript">
    @section('javascript')
    jQuery(document).ready(function() {
    // Put page-specific javascript here
    $('#sample_3').dataTable({
        "aoColumns": [
            { "bSortable": false },
            null,
            null,
            null,
            null,
            null,
             @if(Request::is('offers/index'))
        { "bSortable": false },
        @endif
            { "bSortable": false },
            { "bSortable": false },
            { "bSortable": false }
        ],
        "aLengthMenu": [
            [5, 15, 20, -1],
            [5, 15, 20, "All"] // change per page values here
        ],
        // set the initial value
        "iDisplayLength": 15,
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

        jQuery('#sample_3 .group-checkable').change(function () {
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
    })
    @stop
</script>-->

@stop