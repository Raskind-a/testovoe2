@extends('layouts.admin')

@section('content')
    <form action="{{ route('admin.update', $product->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="mb-3">
            <label for="article" class="form-label">Артикул</label>
            <input type="text" class="form-control" id="article" name="article" value="{{$product->article}}">
        </div>

        <div class="mb-3">
            <label for="name" class="form-label">Название</label>
            <input type="text" class="form-control" id="name" name="name" value="{{$product->name}}">
        </div>

        <div class="mb-3">
            <label class="form-label">Статус</label>
            <select class="form-select" aria-label="Статус" name="status">
                <option selected value="1">Доступен</option>
                <option value="0">Недоступен</option>
            </select>
        </div>

        <div class="mb-3" id="attributesContainer">
            <label>Атрибуты:</label>
            @foreach(json_decode($product->data) as $key => $value)
                <div class="input-group mt-1" id="inputGroup">
                    <span class="input-group-text">Название : значение</span>
                    <input type="text" class="form-control" name="data[]" value="{{$key}}">
                    <input type="text" class="form-control" name="data[]" value="{{$value}}">
                </div>
            @endforeach
        </div>
        <div>
            <button type="button" class="btn btn-link" id="addField" name="addField">+Добавить атрибут</button>
        </div>

        <button type="submit" class="btn btn-primary">Сохранить</button>
    </form>

    <script>
        const addInputButton = document.getElementById('addField');
        const removeInputButton = document.getElementById('removeField');
        const attributesContainer = document.getElementById('attributesContainer');

        const attributeTemplate = document.createElement('div');
        attributeTemplate.classList.add('input-group', 'mt-1');
        attributeTemplate.setAttribute('id', 'inputGroup')
        attributeTemplate.innerHTML = `
                <span class="input-group-text">Название : значение</span>
                <input type="text" class="form-control" name="data[]">
                <input type="text" class="form-control" name="data[]">
                <button type="button" class="btn btn-danger" id="removeField" name="removeField">Х</button>
`;

        addInputButton.addEventListener('click', () => {
            const newAttribute = attributeTemplate.cloneNode(true);
            attributesContainer.appendChild(newAttribute);

            const removeButton = newAttribute.querySelector('#removeField');
            removeButton.addEventListener('click', () => {
                attributesContainer.removeChild(newAttribute);
            });
        });

    </script>
@endsection
