@extends('layouts.admin')

@section('content')
    <h1>Продукты</h1>
    <a href="{{ route('admin.create') }}">
        <button type="button" class="btn btn-primary">Добавить</button>
    </a>

    <div class="table">
        <table class="table table-striped-columns">
            <thead>
            <tr>
                <th>Артикул</th>
                <th>Название</th>
                <th>Статус</th>
                <th>Атрибуты</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($products as $product)
                <tr>
                    <td>{{ $product->article }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->status }}</td>
                    <td>{{ $product->data }}</td>
                    <td class="d-flex justify-content-end gap-3">
                        <a href="{{route('admin.show', $product->id)}}">
                            <button type="button" class="btn btn-primary">Открыть</button>
                        </a>

                        <a href="{{route('admin.edit', $product->id)}}">
                            <button type="button" class="btn btn-primary">Редактировать</button>
                        </a>

                        <form action="{{ route('admin.delete', $product->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Удалить</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
