<div class="row">
  @forelse($products as $product)
      <div class="col-md-3 mb-4">
          <div class="card h-100">
            <img src="{{ asset('storage/' . $product->images->first()->image_path ?? 'no-image.jpg') }}" class="card-img-top" alt="{{ $product->name }}" style="width: 100px; height: 100px; object-fit: cover;">

              <div class="card-body">
                  <h5 class="card-title">{{ $product->name }}</h5>
                  <p class="card-text">₹{{ $product->price }}</p>
                  <button class="btn btn-primary add-to-cart" data-id="{{ $product->id }}">Add to Cart</button>
              </div>
          </div>
      </div>
  @empty
      <div class="col-12">
          <p>No products found.</p>
      </div>
  @endforelse
  </div>
  