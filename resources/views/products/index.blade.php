@extends('layouts.app')

@section('content')

    @if($message = Session::get('success'))
        <div class="container">
            <div class="alert alert-danger text-xl-center">
                <h4>{{ $message }}</h4>
            </div>
        </div>
    @endif

    <div class="container">
        <div class="row">
            <div class="col-6">
                <h1>Products List</h1>
            </div>
            <div class="col-6">
                <a class="float-end m-2" href="{{ route('products.create') }}">
                    <button type="button" class="btn btn-success">ADD</button>
                </a>
                <a class="float-end m-2" href="{{ route('products.trash') }}">
                    <button type="button" class="btn btn-dark">Trash List</button>
                </a>
            </div>
        </div>
    </div>

    <div class="container">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Description</th>
                <th scope="col">Amount</th>
                <th scope="col">Cost</th>
                <th scope="col">Created at</th>
                <th scope="col">Category</th>
                <th scope="col">Photo</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($products as $product)
                <tr>
                    <th scope="row">{{$product->id}}</th>
                    <td>{{$product->name}}</td>
                    <td>{{$product->description}}</td>
                    <td>{{$product->amount}}</td>
                    <td>{{$product->price}}</td>
                    <td>{{$product->created_at}}</td>
                    <td>@if(!is_null($product->category)){{$product->category->name}}
                        @else No Category
                        @endif</td>
                    <td>
                        @if(!is_null($product->image_path))
                        <img class="img_show_table"
                             src="{{ asset('storage/' . $product->image_path) }}" alt="photo product">
                        @else
                            <img class="img_show_table"
                                 src="{{ asset('storage/products/default_image.png') }}" alt="photo product">
                        @endif
                    </td>
                    <td>
                        <form class="col-md-8 formWrapper" method="post" action="{{ route('products.destroy', $product->id)}}">
                            @csrf
                            @method('DELETE')
                            <a class="btn btn-info btn-sm" href="{{ route('products.show',$product->id) }}">
                                Show
                            </a>
                            <a class="btn btn-warning btn-sm" href="{{ route('products.edit',$product->id) }}">
                                edit
                            </a>
                            <input type="submit" class="btn btn-danger btn-sm"
                                   onclick="return confirm('Are you sure you want delete?')" value="Delete">
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $products->links() }}
    </div>
@endsection


