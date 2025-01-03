@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">{{ __('Orders: ') }}</h5>
                </div>
                <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        @if(session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                        @if($order->isEmpty())
                            <p>No orders.</p>
                        @else
                            <table class="custom-table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name & Surname</th>
                                        <th>Adres</th>
                                        <th>Status</th>
                                        <th>Products</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($order as $orders)
                                        <tr class="status-{{ str_replace(' ', '-', strtolower($orders->status)) }}">
                                            <td>{{ $orders->id }}</td>
                                            <td>{{ $orders->customer_name }}</td>
                                            <td>{{ $orders->address }}</td>
                                            <td>
                                                <form action="{{ route('orders.updateStatus', $orders->id) }}" method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <select name="status" class="form-select" onchange="this.form.submit()">
                                                        <option value="pending" {{ $orders->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                                        <option value="in progress" {{ $orders->status == 'in progress' ? 'selected' : '' }}>In Progress</option>
                                                        <option value="shipped" {{ $orders->status == 'shipped' ? 'selected' : '' }}>Shipped</option>
                                                        <option value="completed" {{ $orders->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                                    </select>
                                                </form>
                                            </td>
                                            <td>
                                                <ul>
                                                    @foreach($orders->items as $item)
                                                        <li>{{ $item->product->name }} - {{ $item->quantity }} x {{ $item->price }} PLN</li>
                                                    @endforeach
                                                </ul>
                                            </td>
                                            <td>
                                                @if($orders->status === 'completed')
                                                    <form action="{{ route('orders.destroy', $orders->id) }}" method="POST" onsubmit="return confirm('Are you sure you want delete this order?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                                    </form>
                                                @else
                                                    <span class="text-muted">-</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                         
                    <div class="d-flex justify-content-center">
                        {{$order->links() }}
                    </div>
                   
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
