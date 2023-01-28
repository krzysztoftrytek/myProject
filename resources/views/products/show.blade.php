@extends('layouts.app')

@section('content')
    <div class="container">
        <a class="btn btn-primary" href="{{ route('products.index')}}"> < BACK</a>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-bg-success">
                        <h2 class="text-xl-center">Product: {{ $product->name }}</h2>
                    </div>
                    <div class="card-body">

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text"
                                       class="form-control" name="name"
                                       value="{{ $product->name }}" disabled>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="description" class="col-md-4 col-form-label text-md-end">Description</label>
                            <div class="col-md-6">
                                    <textarea id="description"
                                              class="form-control"
                                              name="description"
                                              disabled>{{ $product->description}}</textarea>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="amount" class="col-md-4 col-form-label text-md-end">Amount</label>

                            <div class="col-md-6">
                                <input id="amount" type="number" min="0"
                                       class="form-control" name="amount"
                                       value="{{ $product->amount }}" disabled>
                            </div>
                        </div>

                        <div class="row justify-content-center m-4">
                            <h2 class="text-xl-center">Actual Photo:</h2>
                            @if(!is_null($product->image_path))
                                <img src="{{ asset('storage/' . $product->image_path) }}"
                                     class="img_show_edit" alt="product photo">
                            @else
                                <img src="{{ asset('storage/products/default_image.png')}}"
                                     class="img_show_edit" alt="product photo">
                            @endif
                        </div>

                        <div class="row mb-3">
                            <label for="price" class="col-md-4 col-form-label text-md-end">Price</label>
                            <div class="col-md-6">
                                <input id="price" type="number" step="0.01" min="0"
                                       name="price"
                                       value="{{ $product->price}}" disabled>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
