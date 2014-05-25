@extends('layouts')
@section('content')

<div class="portlet box purple">
    <div class="portlet-title">
        <div class="caption"><i class="fa fa-reorder"></i>Details Offer Information</div>
        <div class="actions">
            <a class="btn" href="{{ URL::to('offers/index') }}"><i class="fa fa-times"></i></a>
        </div>
    </div>
    <div class="portlet-body form">
        <!-- BEGIN FORM-->
        <form action="form_layouts.html#" class="form-horizontal">
            <div class="form-body">
                <div class="form-group last">
                    {{Form::label('title', 'Title: ', array('class' => 'col-md-3 control-label','id' => ''))}}
                    <div class="col-md-5">
                        <p class="form-control-static">{{ $offerDetails->title }}</p>
                    </div>
                </div>

                <div class="form-group">
                    {{Form::label('description', 'Description: ', array('class' => 'col-md-3 control-label','id' => ''))}}
                    <div class="col-md-5">
                        <p class="form-control-static">{{ $offerDetails->description }}</p>
                    </div>
                </div>

                <div class="form-group">
                    {{Form::label('client_name', 'Client Name: ', array('class' => 'col-md-3 control-label','id' => ''))}}
                    <div class="col-md-5">
                        <p class="form-control-static"> {{$offerDetails->client->first_name.' '.$offerDetails->client->last_name}}</p>
                    </div>
                </div>
                <div class="form-group" id="">
                    {{Form::label('','Category: ', array('class' => 'control-label col-md-3'))}}
                    <div class="col-md-9" style="margin-bottom: 5px">
                        <div class="col-md-3" id="" style="padding-right: 0;padding-left: 0">
                            <p class="form-control-static"><strong> Name</strong></p>
                        </div>
                        <div class="col-md-2" id="" style="padding-right: 0">
                            <p class="form-control-static"><strong>Price</strong> </p>
                        </div>
                        <div class="col-md-2" id="" style="padding-right: 0">
                            <p class="form-control-static"> <strong>Commission</strong></p>
                        </div>
                        <div class="col-md-2" id="" style="padding-right: 0">
                            <p class="form-control-static"> <strong>Line Total</strong></p>
                        </div>

                    </div>
                   <?php $sum=0;?>
                    @foreach ($offerDetails->offerproducts as $value)
                    {{Form::label('','', array('class' => 'control-label col-md-3'))}}
                        <div class="col-md-9" style="margin-bottom: 5px">
                            <div class="col-md-3" id="" style="padding-right: 0;padding-left: 0">
                                <p class="form-control-static"> {{$value->category->category_name}}</p>
                            </div>
                            <div class="col-md-2" id="" style="padding-right: 0">
                                <p class="form-control-static"> {{$value['price']}}</p>
                            </div>
                            <div class="col-md-2" id="" style="padding-right: 0">
                                <p class="form-control-static"> {{(($value['price'] * $value['quantity']) * $value['commission']/100)}}</p>
                            </div>
                            <div class="col-md-2" id="" style="padding-right: 0">
                                <p class="form-control-static"> {{$value['line_total']}}</p>
                            </div>
                        </div>
                        <?php $sum+= $value['line_total'];?>
                    @endforeach
                    {{Form::label('','', array('class' => 'control-label col-md-3'))}}
                    <div class="col-md-9" style="margin-bottom: 5px">
                        <div class="col-md-3" id="" style="padding-right: 0;padding-left: 0">
                            <p class="form-control-static"></p>
                        </div>
                        <div class="col-md-2" id="" style="padding-right: 0">
                            <p class="form-control-static"></p>
                        </div>
                        <div class="col-md-2" id="" style="padding-right: 0">
                            <p class="form-control-static"> <strong>Grand Total</strong></p>
                        </div>
                        <div class="col-md-2" id="" style="padding-right: 0">
                            <p class="form-control-static" style="border-top: 1px solid #000000"> <strong>{{$sum}}</strong></p>
                        </div>

                    </div>
                </div>

            </div>

        </form>
        <!-- END FORM-->
    </div>
</div>
@stop