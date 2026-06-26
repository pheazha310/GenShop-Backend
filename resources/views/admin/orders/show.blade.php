@extends('layouts.admin')

@section('content')
<div class="card">
    <h1>Order #{{ $order->id }}</h1>
    <p>User: {{ $order->user?->name }}</p>
    <p>Total: ${{ number_format($order->total_amount, 2) }}</p>
    <p>Status: {{ $order->status }}</p>
    <table>
        <thead><tr><th>Product</th><th>Qty</th><th>Price</th></tr></thead>
        <tbody>
            @foreach ($order->items as $item)
                <tr>
                    <td>{{ $item->product?->name }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>${{ number_format($item->price, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
