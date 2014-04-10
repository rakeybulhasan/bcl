@extends('layouts')
@section('content')
<div class="portlet box purple">
    <div class="portlet-title">
        <div class="caption"><i class="fa fa-cogs"></i>Users List</div>
        <div class="actions">
            <a href="{{ URL::to('users/add') }}" class="btn green"><i class="fa fa-plus"></i> Add User</a>
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

        <table class="table table-striped table-bordered table-hover" id="sample_3">
            <thead>
            <tr>
                <th class="table-checkbox"><input type="checkbox" class="group-checkable" data-set="#sample_3 .checkboxes" /></th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Country</th>
                <th>User Type</th>
                <th>Details</th>
                <th>update</th>
                <th>Delete</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $key => $value)
            <tr class="odd gradeX">

                <td> {{Form::checkbox('sex',1,false,array('class'=>'checkboxes','value'=>1))}}</td>
                <td> {{ $value->first_name.' '.$value->last_name  }}</td>
                <td> {{ $value->email }}</td>
                <td> {{ $value->phone }}</td>
                <td> {{ $value->country->name }}</td>
                <td> {{($value->group_id==1)?'Admin':'Manager'}}</td>
                <td> <a href="{{ URL::to('users/details/'.$value->id)}}">Details</a></td>
                <td> <a href="{{ URL::to('users/update/'.$value->id)}}">Update</a></td>
                <td> <a href="{{ URL::to('users/delete/'.$value->id)}}">Delete</a></td>




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
            null,
            null,
            null,
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
        success1.hide(10000);
    })
    @stop
</script>

@stop