@extends('layouts')
@section('content')
<h2>Details User Information</h2>
<div clas="">
    {{Form::label('name', 'FirstName: ', array('class' => '','id' => ''))}}
    {{ $userdata->first_name.' '.$userdata->last_name }}
</div>
<div clas="">
    {{Form::label('email', 'Email: ', array('class' => '','id' => ''))}}
    {{ $userdata->email }}
</div>

<div clas="">

    {{Form::label('sex', 'Sex: ', array('class' => '','id' => ''))}}
    {{($userdata->sex == 0)?'Female':'Male'}}

</div>
<div clas="">
    {{Form::label('phone', 'phone: ', array('class' => '','id' => ''))}}
    {{ $userdata->phone }}
</div>
<div clas="">
    {{Form::label('address', 'Address: ', array('class' => '','id' => ''))}}
    {{ $userdata->address }}
</div>
<div clas="">
    {{Form::label('group_id', 'Type: ', array('class' => '','id' => ''))}}
    {{($userdata->group_id == 1)?'Admin':'Manager'}}
</div>
<div clas="">
    {{Form::label('country_id', 'Country Name: ', array('class' => '','id' => ''))}}
    {{ $userdata->country->name }}
</div>

@stop