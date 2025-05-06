<h2>Thanks for your order!</h2>
<p>Order ID: {{ $order->id }}</p>
<p>Total: ₹{{ $order->total }}</p> 

 <table border="1" cellpadding="5">
    <thead>
        <tr><th>Product</th><th>Qty</th><th>Price</th></tr>
    </thead>
    <tbody>
        @foreach($order->items as $item)
            <tr>
                <td>{{ $item->product->name ?? 'Deleted Product' }}</td>
                <td>{{ $item->quantity }}</td>
                <td>₹{{ $item->price }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
