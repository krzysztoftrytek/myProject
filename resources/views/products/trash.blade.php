@extends('layouts.app')

@section('content')

    @if($message = Session::get('success'))
        <div class="container">
            <div class="alert alert-info text-xl-center">
                <h4>{{ $message }}</h4>
            </div>
        </div>
    @endif
    @if($message = Session::get('success_delete'))
        <div class="container">
            <div class="alert alert-danger text-xl-center">
                <h4>{{ $message }}</h4>
            </div>
        </div>
    @endif

    <div class="container">
        <a class="float-end" href="{{ route('products.index') }}">
            <button type="button" class="btn btn-primary"> < BACK</button>
        </a>
        <div class="row">
            <div class="col-6">
                <h1 class="text-danger">Trash Products List</h1>
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
                    <td>
                        <form class="col-md-8" method="post"
                              action="{{ route('products.destroyPermanently', $product->id)}}">
                            @csrf
                            @method('DELETE')
                            <a class="btn btn-warning btn-sm" href="{{ route('products.restore',$product->id) }}">
                                Restore
                            </a>

                            <button class="btn btn-danger btn-sm"
                                    onclick="return confirm('Are you sure you want delete?')">Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $products->links() }}
    </div>
@endsection


