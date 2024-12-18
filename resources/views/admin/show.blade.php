@extends('layouts.admin')

@section('content')
    <div class="card" style="width: 50rem;">
        <div class="card-body">
            <h5 class="card-title">{{$product->name}}</h5>
            <label>Артикул:</label>
            <p class="card-text">{{$product->article}}</p>
            <label>Статус:</label>
            <p class="card-text">{{$product->status}}</p>
            <label>Атрибуты:</label>
            <p class="card-text">{!! str_replace('&amp;', '&', htmlspecialchars($product->data)) !!}</p>
        </div>
    </div>
@endsection
