@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">{{ __('Product list') }}</h5>
                        <!--BUTTON DODAJĄCY PRODUKT-->
                        <a href="{{ route('productList.create') }}" class="btn btn-primary">Add Product</a>
                    </div>
                    <div class="card-body">
                    @if(session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
                        <table class="table table-striped table-hover mr-3">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Photo</th>
                                <th scope="col">Name</th>
                                <th scope="col">Price</th>
                                <th scope="col">Date of creation</th>
                                <th scope="col">Date of update</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr>
                                    <td>{{ $product->id }}</td>
                                    <td>
                                        @if($product->image)
                                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" style="width: 50px; height: 50px; object-fit: cover;">
                                        @else
                                            <span>No image</span>
                                        @endif
                                    </td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->price }}</td>
                                    <td>{{ $product->created_at }}</td>
                                    <td>{{ $product->updated_at }}</td>
                                    <td>
                                        
                                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger shadow-none btn-sm" type="submit" onclick="return confirm('Are you sure you want to delete this PRODUCT?')">
                                                <i class="fa fa-trash" aria-hidden="true"></i>
                                            </button>
                                        </form>

                                        <a style="margin-left: 10px;" href="{{ route('products.edit', $product->id) }}"><i class="fas fa-edit"></i></a>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                        </table>

                        <div class="d-flex justify-content-center">
                            {{ $products->links() }}
                        </div>

                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
@endsection