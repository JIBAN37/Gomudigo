<li class="prodcut">
    <div style="height: 30.188rem; "  class="card text-center hover_card">
      <div class="card-header ">
        <a href="{{ route('product', $product->slug) }}">
          <img src="{{ uploaded_asset($product->thumbnail_img) }}" class="card-img-top"
            alt="Product image" />
        </a> 
      </div>

      <div class="card-body">
        <h3 class="card-title h6" style="height:60px !important;">
          <a href="{{ route('product', $product->slug) }}">{{  $product->getTranslation('name')  }}</a>
        </h3> 
        <p class="card-text">
          <span class="current-price fs-5 fw-bold gmg-text-orange">
            {{ home_discounted_base_price($product) }}
          </span>
          @if(home_base_price($product) != home_discounted_base_price($product))
          <del class="prev-price fs-13">{{ home_base_price($product) }}</del>
          @endif
        </p>
        <select class="form-select" aria-label="Default select example">
           <option selected>1Kg</option>
           <option value="1">2Kg</option>
           <option value="2">5Kg</option>
           <option value="3">10Kg</option>
        </select>
        <div class="cart-btns d-grid" style="padding:15px;">
          <button style="margin-bottom:1px;" class="btn bg-orange" id="addToCartbtn" href="javascript:void(0)" onclick="showAddToCartModal({{ $product->id }})" data-toggle="tooltip">
            <i class="fa fa-bolt me-2"></i>
            Add to cart
          </button>
        </div>
      </div>
    </div>
  </li> 