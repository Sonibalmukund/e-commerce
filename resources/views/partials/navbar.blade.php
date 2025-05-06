<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
      <a class="navbar-brand" href="{{ route('products.index') }}">Shop</a>
      <ul class="navbar-nav ms-auto">
          <li class="nav-item">
              <a href="{{ route('checkout.cart') }}" class="nav-link">
                  Cart <span id="cart-count">(0)</span>
              </a>
          </li>
      </ul>
  </div>
</nav>
