@extends('layouts')
@section('content')
<h2>Details Offer Information</h2>
<div clas="">
    {{Form::label('title', 'Title: ', array('class' => '','id' => ''))}}
    {{ $offerDetails->title }}
</div>
<div clas="">
    {{Form::label('description', 'Description: ', array('class' => '','id' => ''))}}
    {{ $offerDetails->description }}
</div>

<div clas="">

    {{Form::label('category_id', 'Category_id: ', array('class' => '','id' => ''))}}
    {{$offerDetails->category->category_name}}

</div>
<div clas="">
    {{Form::label('client_id', 'Client_id: ', array('class' => '','id' => ''))}}

    {{ $offerDetails->client->first_name}}
</div>
<div clas="">
    {{Form::label('price', 'Price: ', array('class' => '','id' => ''))}}
    {{ $offerDetails->price }}
</div>
<div clas="">
    {{Form::label('commission', 'Commission: ', array('class' => '','id' => ''))}}
    {{$offerDetails->commission}}
</div>
<div clas="">
    {{Form::label('quantity', 'Quantity: ', array('class' => '','id' => ''))}}
    {{ $offerDetails->quantity }}
</div>
<div clas="">
    {{Form::label('line_total', 'Line total: ', array('class' => '','id' => ''))}}
    {{ $offerDetails->line_total }}
</div>
<div clas="">
    {{Form::label('attachment', 'Attachment: ', array('class' => '','id' => ''))}}
    {{ $offerDetails->attachment }}
</div>
<div clas="">
    {{Form::label('created_by', 'Created by: ', array('class' => '','id' => ''))}}
    {{ $offerDetails->created_by }}
</div>

@stop