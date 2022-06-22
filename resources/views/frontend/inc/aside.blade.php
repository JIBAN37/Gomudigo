@php
if(auth()->user() != null) {
    $user_id = Auth::user()->id;
    $cart = \App\Models\Cart::where('user_id', $user_id)->get();
} else {
    $temp_user_id = Session()->get('temp_user_id');
    if($temp_user_id) {
        $cart = \App\Models\Cart::where('temp_user_id', $temp_user_id)->get();
    }
}

@endphp
  
  
  
  <!-- sidebar - cart -->
  <aside id="sidebar">
    <button type="button"
      class="btn p-0 position-fixed top-50 end-0 translate-middle-y   d-md-inline-block bg-secondary bg-opacity-75 rounded-0 rounded-start fs-13 fw-bold text-center shadow"
      style="z-index: 1040" id="cartView">
      <i class="fa-solid fa-basket-shopping fa-2x p-1 px-2 gmg-text-light-orange"></i>
      <div class="item-count text-uppercase p-1 px-3 gmg-text-light-orange">
        @if(isset($cart) && count($cart) > 0)
        <span class="quantity cart-count">{{ count($cart)}}</span>
        @else 
          <span class="quantity cart-count">0</span>
          @endif
          Items
      </div>
    </button>
    <div class="offcanvas offcanvas-end shadow" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1"
      id="sidebar-cart" aria-labelledby="sidebarCartLabel"> 
      <div class="offcanvas-header border-bottom">
        <h2 class="offcanvas-title h6 text-uppercase" id="sidebarCartLabel">
          <i class="fa-solid fa-bag-shopping fa-lg me-2 text-secondary"></i>
          @if(isset($cart) && count($cart) > 0)
          <span class="product-count cart-count">{{ count($cart)}}</span>
          @else
          <span class="product-count cart-count">0</span>
          @endif
          Items
        </h2>
        <button type="button" class="btn-close text-reset" id="cartClose"></button>
      </div>
      <div class="offcanvas-body p-0" >
        <div class="item-type disabled mb-3">
          @if(isset($cart) && count($cart) > 0) 
          <h2 class="fs-14 fw-bold px-3 py-2 gmg-bg-muted">
            {{translate('Cart Items')}}
          </h2>
          <ul class="h-250px overflow-auto c-scrollbar-light list-group list-group-flush">
              @php
                  $total = 0;
              @endphp
              @foreach($cart as $key => $cartItem)
                  @php
                      $product = \App\Models\Product::find($cartItem['product_id']);
                      $total = $total + $cartItem['price'] * $cartItem['quantity'];
                  @endphp
                  @if ($product != null)
                      <li class="list-group-item">
                          <span class="d-flex align-items-center">
                              <a href="{{ route('product', $product->slug) }}" class="text-reset d-flex align-items-center flex-grow-1">
                                  <img
                                      src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                      data-src="{{ uploaded_asset($product->thumbnail_img) }}"
                                      class="img-fit lazyload size-60px rounded"
                                      alt="{{  $product->getTranslation('name')  }}"
                                  >
                                  <span class="minw-0 pl-2 flex-grow-1">
                                      <span class="fw-600 mb-1 text-truncate-2">
                                              {{  $product->getTranslation('name')  }}
                                      </span>
                                      <span class="">{{ $cartItem['quantity'] }}x</span>
                                      <span class="">{{ single_price($cartItem['price']) }}</span>
                                  </span>
                              </a>
                              <span class="">
                                  <button onclick="removeFromCart({{ $cartItem['id'] }})" class="btn btn-sm btn-icon stop-propagation">
                                      <i class="la la-close"></i>
                                  </button>
                              </span>
                          </span>
                      </li>
                  @endif
              @endforeach
          </ul>
          <div class="px-3 py-2 fs-15 border-top d-flex justify-content-between">
              <span class="opacity-60">{{translate('Subtotal')}}</span>
              <span class="fw-600">{{ single_price($total) }}</span>
          </div>
          <div class="offcanvas-footer pb-5"> 
            <a href="{{ route('cart') }}" class="btn gmg-bg-orange text-capitalize w-100 rounded-0 rounded-start text-white d-block py-2 mt-4">
              {{translate('View cart')}}
            </a>
            <a href="{{ route('checkout.shipping_info') }}" class="btn btn-danger text-capitalize w-100 rounded-0 rounded-start text-white d-block py-2 mt-2">
              {{translate('Checkout')}}
            </a>
          </div>
      @else
          <div class="text-center p-3">
              <i class="las la-frown la-3x opacity-60 mb-3"></i>
              <h3 class="h6 fw-700">{{translate('Your Cart is empty')}}</h3>
          </div>
      @endif
      </div>
    </div>
  </aside>