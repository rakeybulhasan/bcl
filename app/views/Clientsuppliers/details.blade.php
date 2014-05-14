@extends('layouts')
@section('content')

<div class="portlet box purple">
    <div class="portlet-title">
        <div class="caption"><i class="fa fa-reorder"></i>Details {{ ($userdata->group_id==2)?'Supplier':'Client' }} Information</div>

    </div>
    <div class="portlet-body form">
        <!-- BEGIN FORM-->
        <form action="" class="form-horizontal">
            <div class="form-body">
                <div class="form-group last">
                    {{Form::label('name', 'Name: ', array('class' => 'col-md-3 control-label','id' => ''))}}
                    <div class="col-md-5">
                        <p class="form-control-static">{{ $userdata->first_name.' '.$userdata->last_name }}</p>
                    </div>
                </div>

                <div class="form-group">
                    {{Form::label('email', 'Email: ', array('class' => 'col-md-3 control-label','id' => ''))}}
                    <div class="col-md-5">
                        <p class="form-control-static">{{ $userdata->email }}</p>
                    </div>
                </div>

                <div class="form-group">
                    {{Form::label('sex', 'Sex: ', array('class' => 'col-md-3 control-label','id' => ''))}}
                    <div class="col-md-5">
                        <p class="form-control-static"> {{($userdata->sex == 0)?'Female':'Male'}}</p>
                    </div>
                </div>

                <div class="form-group">
                    {{Form::label('phone', 'Phone: ', array('class' => 'col-md-3 control-label','id' => ''))}}
                    <div class="col-md-5">
                        <p class="form-control-static">{{ $userdata->phone }}</p>
                    </div>
                </div>

                <div class="form-group">
                    {{Form::label('address', 'Address: ', array('class' => 'col-md-3 control-label','id' => ''))}}
                    <div class="col-md-4">
                        <p class="form-control-static">{{ $userdata->address }}</p>
                    </div>
                </div>

                <div class="form-group">
                    {{Form::label('group_id', 'Type: ', array('class' => 'col-md-3 control-label','id' => ''))}}
                    <div class="col-md-4">
                        <p class="form-control-static">{{ ($userdata->group_id==2)?'Supplier':'Client' }}</p>
                    </div>
                </div>

                <div class="form-group">
                    {{Form::label('country', 'Country Name: ', array('class' => 'col-md-3 control-label','id' => ''))}}
                    <div class="col-md-4">
                        <p class="form-control-static"> {{ $userdata->country->name }}</p>
                    </div>
                </div>
            </div>

        </form>
        <!-- END FORM-->
    </div>
</div>
@stop