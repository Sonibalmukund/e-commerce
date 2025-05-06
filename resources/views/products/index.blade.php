@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Product Listing</h2>

    <!-- Filter Options -->
    <div class="row mb-4">
        <div class="col-md-4">
            <select id="category" class="form-control">
                <option value="">Select Category</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4">
            <select id="subcategory" class="form-control">
                <option value="">Select Subcategory</option>
            </select>
        </div>
    </div>

    <!-- Product List -->
    <div id="product-list">
        @include('products.partials.product_list', ['products' => $products])
    </div>
</div>
@endsection

@section('scripts')
<script>
  function updateCartCount(count) {
      $('#cart-count').text(`(${count})`);
  }

  $('.add-to-cart').click(function () {
      const productId = $(this).data('id');

      $.ajax({
          url: '{{ route("cart.add") }}',
          method: 'POST',
          data: {
              _token: '{{ csrf_token() }}',
              product_id: productId
          },
          success: function (res) {
              updateCartCount(res.count);
              alert('Added to cart!');
          }
      });
  });
</script>

<script>
    const allSubcategories = @json($categories->flatMap->subcategories);

    $('#category').change(function () {
        const catId = $(this).val();
        const subcats = allSubcategories.filter(sc => sc.category_id == catId);
        $('#subcategory').html('<option value="">Select Subcategory</option>');
        subcats.forEach(sc => {
            $('#subcategory').append(`<option value="${sc.id}">${sc.name}</option>`);
        });

        filterProducts();
    });

    $('#subcategory').change(function () {
        filterProducts();
    });

    function filterProducts() {
        $.ajax({
            url: '{{ route('products.filter') }}',
            method: 'GET',
            data: {
                category_id: $('#category').val(),
                subcategory_id: $('#subcategory').val(),
            },
            success: function (res) {
                $('#product-list').html(res.html);
            }
        });
    }
</script>
@endsection
