@extends('layouts.admin')

@section('content')
<div class="card">
    <h1>Orders</h1>
    <table>
        <thead>
            <tr><th>ID</th><th>User</th><th>Total</th><th>Status</th><th></th></tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr>
                    <td>#{{ $order->id }}</td>
                    <td>{{ $order->user?->name }}</td>
                    <td>${{ number_format($order->total_amount, 2) }}</td>
                    <td>{{ $order->status }}</td>
                    <td><a href="{{ route('admin.orders.show', $order) }}">View</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
