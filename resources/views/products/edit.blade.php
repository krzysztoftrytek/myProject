@extends('layouts.app')

@section('content')
    <div class="container">
        <a class="btn btn-primary" href="{{ route('products.index')}}"> < BACK</a>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit Product</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('products.update', $product->id) }}"
                              enctype="multipart/form-data">
                            @csrf

                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-form-label text-md-end">Name</label>

                                <div class="col-md-6">
                                    <input id="name" type="text"
                                           class="form-control @error('name') is-invalid @enderror" name="name"
                                           value="{{$product->name}}" required autocomplete="name" autofocus>
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="description" class="col-md-4 col-form-label text-md-end">Description</label>
                                <div class="col-md-6">
                                    <textarea id="description"
                                              class="form-control @error('description') is-invalid @enderror"
                                              name="description"
                                              autofocus>{{$product->description}}</textarea>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="amount" class="col-md-4 col-form-label text-md-end">Amount</label>

                                <div class="col-md-6">
                                    <input id="amount" type="number" min="0"
                                           class="form-control @error('amount') is-invalid @enderror" name="amount"
                                           value="{{$product->amount}}" required autocomplete="amount" autofocus>
                                    @error('amount')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="price" class="col-md-4 col-form-label text-md-end">Price</label>
                                <div class="col-md-6">
                                    <input id="price" type="number" step="0.01" min="0"
                                           class="form-control @error('price') is-invalid @enderror"
                                           name="price"
                                           value="{{$product->price}}" required autocomplete="price" autofocus>

                                    @error('price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="image" class="col-md-4 col-form-label text-md-end">Photo</label>
                                <div class="col-md-6">
                                    <input id="image"
                                           type="file"
                                           class="form-control"
                                           name="image"
                                           onchange="loadFile(event)">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="category"
                                       class="col-md-4 col-form-label text-md-end">{{ __('Category') }}</label>
                                <div class="col-md-6">
                                    <select id="category"
                                            class="form-control @error('category_id') is-invalid @enderror"
                                            name="category_id">
                                        <option value="">No category</option>
                                        @foreach($categories as $category)
                                            <option
                                                value="{{ $category->id }}"
                                                @if($product->isSelectedCategory($category->id)) selected @endif>
                                                {{ $category->name}}</option>
                                        @endforeach
                                    </select>

                                    @error('category_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="row justify-content-center m-4">
                                <h2 class="text-xl-center">Actual Photo:</h2>
                                @if(!is_null($product->image_path))
                                    <img src="{{ asset('storage/' . $product->image_path) }}"
                                         class="img_show_edit" alt="product photo"
                                @else
                                    <img src="{{ asset('storage/products/default_image.png')}}"
                                         class="img_show_edit" alt="product photo"
                                @endif
                            </div>

                            <div class="row mb-0 justify-content-center">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Change') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<script>
    let loadFile = function (event) {
        let output = document.getElementById("output");
        output.src = URL.createObjectURL(event.target.files[0]);
        console.log(output);
    }
</script>
