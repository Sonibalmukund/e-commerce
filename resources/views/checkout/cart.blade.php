@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Cart Overview</h2>

    @if(count($cart) > 0)
        <form method="POST" action="{{ route('checkout.place') }}">
            @csrf

            <table class="table">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Image</th>
                        <th>Price</th>
                        <th>Qty</th>
                        <th>Subtotal</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php $total = 0; @endphp
                    @foreach($cart as $id => $item)
                        @php $subtotal = $item['price'] * $item['quantity']; $total += $subtotal; @endphp
                        <tr>
                            <td>{{ $item['name'] }}</td>
                            <td>
                              <img src="{{ asset('storage/' . ($item['image_path'] ?? 'no-image.jpg')) }}" 
                                   alt="{{ $item['name'] }}" 
                                   style="width: 50px; height: 50px; object-fit: cover;">
                          </td>
          
                            <td>₹{{ $item['price'] }}</td>
                            <td>{{ $item['quantity'] }}</td>
                            <td>₹{{ $subtotal }}</td>
                            <td>
                              <button type="button" class="btn btn-danger btn-sm remove-from-cart" data-id="{{ $id }}">
                                  Remove
                              </button>
                          </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <h5>Total: ₹{{ $total }}</h5>

            <hr>
            <h4>Customer Info</h4>
            <div class="mb-2">
                <input type="text" name="name" class="form-control" placeholder="Name" required>
            </div>
            <div class="mb-2">
                <input type="email" name="email" class="form-control" placeholder="Email" required>
            </div>
            <div class="mb-2">
                <input type="text" name="phone" class="form-control" placeholder="Phone" required>
            </div>
            
          
            <button class="btn btn-success">Place Order</button>
        </form>
    @else
        <p>Your cart is empty.</p>
    @endif
</div>
@endsection
@section('scripts')
<script>
  $('.remove-from-cart').click(function () {
      const id = $(this).data('id');

      $.ajax({
          url: '{{ route("cart.remove") }}',
          method: 'POST',
          data: {
              _token: '{{ csrf_token() }}',
              product_id: id
          },
          success: function (res) {
              location.reload(); // Reload page after removal
          }
      });
  });
</script>

@endsection
