@extends('layouts.admin')

@section('page-title', 'Manage')

@section('content')
    <div class="ui card fluid">
        <div class="content">
            <div class="header">
                <h2 class="ui header">{{ __('translations.headings.manage') }}</h2>
            </div>
        </div>
        <div class="content">
            <form  method="POST" action="{{ action('AdminController@create') }}" enctype="multipart/form-data" class="ui form">
                @csrf
                <div class="three fields">
                    <div class="field">
                        <label for="name">{{ __('translations.labels.name') }}</label>
                        <input type="text" id="name" class="input" name="name" value="{{ old('name') }}">
                    </div>
                    <div class="field">
                        <label for="price">{{ __('translations.labels.price') }}</label>
                        <input type="text" id="price" class="input" name="price" value="{{ old('price') }}">
                    </div>
                    <div class="field">
                        <label for="price">{{ __('translations.labels.stock') }}</label>
                        <input type="text" id="price" class="input" name="stock" value="{{ old('stock') }}">
                    </div>
                </div>
                <div class="three fields">
                    <div class="field">
                        <label for="photo">{{ __('translations.labels.photo') }} <small class="text-muted">(jpeg, png, max 5MB)</small></label>
                        <input type="file" id="photo" name="photo">
                    </div>
                </div>
                <button class="ui red button right floated" type="submit">{{ __('translations.buttons.submit') }}</button>
            </form>
        </div>
        @include('layouts.errors')

    </div>
    <div class="ui card fluid">

        <div class="content">
            <table class="ui celled table">
                <thead>
                    <th>{{ __('translations.labels.name') }}</th>
                    <th>{{ __('translations.labels.price') }}</th>
                    <th>{{ __('translations.labels.stock') }}</th>
                    <th>{{ __('translations.labels.orders') }}</th>
                    <th class="right aligned">{{ __('translations.labels.options') }}</th>
                </thead>
                <tbody>
                    @if($products->count())
                        @foreach ($products as $product)
                            <tr>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->price }}</td>
                                <td>{{ $product->stock }}</td>
                                <td>{{ $product->orders }}</td>
                                <td class="right aligned">
                                    <div class="ui items">
                                        <div class="item">
                                            <div class="content">
                                                <form method="GET" action="{{ action('AdminController@productDelete',['id' => $product->id ]) }}" class="ui right floated" onSubmit="return confirm('{{ __('translations.texts.delete_confirm') }} {{ $product->name }}?');">
                                                    <button class="mini ui red button">{{ __('translations.buttons.delete') }}</button>
                                                </form>
                                                <stock-adjust
                                                    class="ui right floated"
                                                    :quantity="{{ $product->stock }}"
                                                    :action="'{{ action('AdminController@stock') }}'"
                                                    :product-id="{{ $product->id }}"
                                                    :text="'{{ __('translations.buttons.adjust_stock') }}'">
                                                </stock-adjust>

                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr class="ui center aligned">
                            <td colspan="6" class="text-center"> {{ __('translations.texts.no_products') }}</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection
@section('page-script-after')
    <script>
        $(document).ready(function(){
            $('.ui.form').form({
                fields: {
                    name : 'empty',
                    price : 'empty',
                    stock : 'empty',
                    photo : 'empty',
                }
            });
        });
    </script>
@endsection
