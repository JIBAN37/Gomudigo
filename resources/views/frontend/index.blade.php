@extends('frontend.layouts.app')

@section('content')
  <!-- main body content / start -->
  <main id="main">
    <!-- hero section -->
    <section class="hero">
      @if (get_setting('home_slider_images') != null)
          <div class="aiz-carousel dots-inside-bottom mobile-img-auto-height" data-arrows="true" data-dots="true" data-autoplay="true">
              @php $slider_images = json_decode(get_setting('home_slider_images'), true);  @endphp
              @foreach ($slider_images as $key => $value)
                  <div class="carousel-box">
                      <a href="{{ json_decode(get_setting('home_slider_links'), true)[$key] }}">
                          <img
                              class="d-block mw-100 img-fit rounded shadow-sm overflow-hidden"
                              src="{{ uploaded_asset($slider_images[$key]) }}"
                              alt="{{ env('APP_NAME')}} promo"
                              @if(count($featured_categories) == 0)
                              height="457"
                              @else
                              height="315"
                              @endif 
                              onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder-rect.jpg') }}';"
                          >
                      </a>
                  </div>
              @endforeach
          </div>
      @endif
    </section>

    <!-- gomudigo jumbotron section -->
    <section class="gmg-jumbotron bg-warning bg-opacity-10">
      <div class="container">
        <div class="p-4 p-md-5 text-center mb-3">
          <div class="px-0">
            <h1 class="fs-3">
              <span class="gmg-text-orange">Gomudigo.com</span> is you online
              supershop in <span style="color: #4285F4;">Dhaka City</span>.
            </h1>
            <p class="lead mt-3 mb-4">
              Express delivery at your door step within 90 minutes.
            </p>
            <div class="d-flex align-items-center justify-content-center">
              <form action="{{ route('search') }}" method="GET" class="col-12 col-md-8">
                <div class="input-group border shadow-sm mb-3 rounded-pill">
                  <input type="text" class="form-control fs-6 border-0 rounded-pill" name="keyword" placeholder="Search Product"
                    aria-label="Search Product" />
                  <button type="submit" class="btn rounded-circle gmg-bg-orange text-white">
                    <i class="fa-solid fa-magnifying-glass"></i>
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- home banner section -->
    @if (get_setting('home_banner1_images') != null)
    <section class="home-banner mb-3">
      <div class="container">
        <div class="row g-0 justify-content-center">
          @php $banner_1_imags = json_decode(get_setting('home_banner1_images')); @endphp
          @foreach ($banner_1_imags as $key => $value)
          <div class="col-md-6">
            <figure class="figure w-100 mb-0 pe-md-1 pb-2 pb-md-0">
              <a href="{{ json_decode(get_setting('home_banner1_links'), true)[$key] }}" class="d-block text-reset">
                <img src="{{ uploaded_asset($banner_1_imags[$key]) }}" alt="{{ env('APP_NAME') }}" class="figure-img img-fluid w-100 mb-0" alt="Home banner" />
              </a>
            </figure>
          </div> 
          @endforeach
        </div>
      </div>
    </section>
    @endif

    <!-- out product categories section -->
    <section class="product-categories py-4 py-lg-5">
      <div class="container">
        <h2 class="h3 section-heading text-capitalize text-center mb-5">
          Our Product Categories
        </h2>
        <div class="categories">
          
        @foreach (\App\Models\Category::where('level', 0)->orderBy('order_level', 'asc')->get()->take(11) as $key => $category)
          <a href="{{ route('products.category', $category->slug) }}" class="category-link">
            <div class="product-category border border-2">
              <div class="icon">
                <img src="{{ uploaded_asset($category->icon) }}" alt="{{ $category->getTranslation('name') }}" class="img-fluid" style="width: 40px">
              </div>

              <h2 class="category-name h6 mb-0">{{ $category->getTranslation('name') }}</h2>
            </div>
          </a> 
          
          @endforeach
        </div>
      </div>
    </section>

    <!-- delivery stpes section -->
    <section class="delivery-steps p-4 py-lg-5 bg-light">
      <div class="container">
        <h2 class="h3 section-heading text-capitalize text-center mb-5 px-3 px-lg-0">
          How to order from GOMUDIGO?
        </h2>
        <div class="row g-0">
          <div class="col-sm-6 col-xl-3">
            <div class="d-flex align-items-center justify-content-xl-center mb-3 mb-xl-0">
              <img src="{{ static_asset('frontend/assets/images/icon-order-step-0.png') }}" alt="Order step 0" class="step-img" />
              <div class="h4">
                <span>Steps</span>
                <br />
                <span>Order</span>
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-xl-3">
            <div class="d-flex align-items-center mb-3 mb-xl-0">
              <div class="step">1</div>
              <img src="{{ static_asset('frontend/assets/images/icon-order-step-1.png') }}" alt="Step 1" class="step-img" />
              <div class="text">Place your order!</div>
            </div>
          </div>
          <div class="col-sm-6 col-xl-3">
            <div class="d-flex align-items-center">
              <div class="step">2</div>
              <img src="{{ static_asset('frontend/assets/images/icon-order-step-2.png') }}" alt="Step 1" class="step-img" />
              <div class="text">Pay with cash or card or mobile banking</div>
            </div>
          </div>
          <div class="col-sm-6 col-xl-3">
            <div class="d-flex align-items-center">
              <div class="step">3</div>
              <img src="{{ static_asset('frontend/assets/images/icon-order-step-3.png') }}" alt="Step 1" class="step-img" />
              <div class="text">
                Receive order on your door step within 90 minutes
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    
      
    {{-- Flash Deal --}} 
      <section class="special-offers common-products-carousel py-8 px-2 px-xl-10" style="background: #FFFFFF;">
        <div class="container" >
          <h2 class="h3 section-heading text-capitalize text-center mb-5">
            Flash Sale
          </h2>
          <div class="see-all text-end mb-2" >
            <a href="{{ route('flash-deals') }}" class="gmg-text-red fw-bold">
              See All
              <i class="fa-solid fa-angle-right"></i>
            </a>
          </div>
          <div class="prodcuts-wrapper px-1 px-lg-5">
            <ul class="prodcuts" id="CarouselOne">
              @foreach ($todays_deal_products as $product)
              @include('frontend.partials.product_box_1',['product' => $product])
              @endforeach
            </ul>
          </div>
        </div>
      </section> 

 

    <!-- Featured products section -->
    <section class="popular-products common-products-carousel py-4 py-lg-5 px-3 px-xl-1"  style="background: #FFFFFF;">
      <div class="container">
        <h2 class="h3 section-heading text-capitalize text-center mb-5">
          Featured Products
        </h2>
        <div class="see-all text-end mb-2">
          <a href="{{ route('search') }}" class="gmg-text-red fw-bold">
            See All
            <i class="fa-solid fa-angle-right"></i>
          </a>
        </div>
        <div class="prodcuts-wrapper px-3 px-lg-5">
          <ul class="prodcuts" id="CarouselTwo">
            @foreach ($featured_products as $product)
            @include('frontend.partials.product_box_1',['product' => $product])
            @endforeach
          </ul>
        </div>
      </div>
    </section>
    <!-- New Arrivel products section -->
    <section class="popular-products common-products-carousel py-4 py-lg-5 px-3 px-xl-1" style="background: #FFFFFF;">
      <div class="container"  >
        <h2 class="h3 section-heading text-capitalize text-center mb-5">
          New Arrivel
        </h2>
        <div class="see-all text-end mb-2">
          <a href="{{ route('search') }}" class="gmg-text-red fw-bold">
            See All
            <i class="fa-solid fa-angle-right"></i>
          </a>
        </div>
        <div class="prodcuts-wrapper px-3 px-lg-5">
          <ul class="prodcuts" id="CarouselFoure">
            @foreach ($recent_products as $product)
            @include('frontend.partials.product_box_1',['product' => $product])
            @endforeach
          </ul>
        </div>
      </div>
    </section>

     {{-- Banner Section 2 --}}
     @if (get_setting('home_banner2_images') != null)
    <!-- special collection section -->
    <section class="special-collection py-4 py-lg-5">
      <div class="container">
        <h2 class="h3 section-heading text-capitalize text-center mb-5">
          Special Collections
        </h2>
        <div class="collection-banners d-flex align-items-center">
          @php $banner_2_imags = json_decode(get_setting('home_banner2_images')); @endphp
                @foreach ($banner_2_imags as $key => $value)
          <a href="{{ json_decode(get_setting('home_banner2_links'), true)[$key] }}" class="banner pe-2">
            <img src="{{ uploaded_asset($banner_2_imags[$key]) }}" alt="Special Product Banner" class="img-fluid" />
          </a>
          @endforeach 
        </div>
      </div>
    </section>
    @endif

  
    <!-- our top brnads -->
    @if (get_setting('top10_brands') != null)
    <section class="top-brands common-products-carousel py-4 py-lg-5 px-3 px-xl-5">
      <div class="container">
        <h2 class="h3 section-heading text-capitalize text-center mb-5">
          {{ translate('Our Top Brands') }}
        </h2>
        <div class="brands-wrapper px-3 px-lg-5">
          <ul class="brands" 
          style="
          display: -webkit-box;
          display: -ms-flexbox;
          display: flex;
          -ms-flex-wrap: wrap;
          flex-wrap: wrap;
          -webkit-box-align: center;
          -ms-flex-align: center;
          align-items: center;
          -webkit-box-pack: center;
          -ms-flex-pack: center;
          justify-content: center;
          gap: 0.75rem;
          margin: 0.5%;
          " 
          >
            @php $top10_brands = json_decode(get_setting('top10_brands')); @endphp
            @foreach ($top10_brands as $key => $value)
                @php $brand = \App\Models\Brand::find($value); @endphp
                @if ($brand != null)
              <li class="brand-reference">
                <a href="{{ route('products.brand', $brand->slug) }}">
                  <img src="{{ uploaded_asset($brand->logo) }}" alt="Brand logo" class="card-img" />
                </a>
              </li>
            
            @endif
            @endforeach
          </ul>
        </div>
      </div>
    </section> 
    @endif
    <!-- why people love section -->
    @if (get_setting('home_banner3_images') != null)
    <section class="reasons-to-love py-5">
      <div class="container-fluid">
        <h2 class="h3 section-heading text-capitalize text-center mb-5 px-3 px-lg-0">
          Why people ❤️ GoMudiGo?
        </h2>

        <div class="reasons">
          <div class="row g-0">
            @php $banner_3_imags = json_decode(get_setting('home_banner3_images')); @endphp
                @foreach ($banner_3_imags as $key => $value)
            <div class="col-lg-4">
              <div class="card overflow-hidden border-0 position-relative rounded-0">
                <img src="{{ uploaded_asset($banner_3_imags[$key]) }}" class="card-img rounded-0" alt="Feature image" />
              
                <div class="bg-success position-relative" style="height: 0.15rem; z-index: 0"></div>
              </div>
            </div>
            
            @endforeach
          </div>
        </div>
      </div>
    </section> 
    @endif



   

    <!-- home footer section -->
    <section class="help py-4 py-lg-5">
      <div class="container">
        <div class="row g-0">
          <div class="col-lg-6 order-1 order-lg-0 d-flex align-items-center justify-content-center">
            <div class="help-info text-center">
              <h2 class="mb-2 fw-bold gmg-text-red h1">Need Help?</h2>
              <p class="fs-3 mb-0">We are just a call away.</p>
              <p class="fs-4 fw-bold mb-0">+88 01313 737366</p>
              <p class="fs-4 fw-bold">+88 01752 528855</p>
              <img src="./assets/images/logo.png" alt="GoMudiGo" class="img-fluid" />
            </div>
          </div>
          <div class="col-lg-6 order-lg-0 text-center">
            <img src="./assets/images/need-help-girls.webp" alt="" class="img-fluid" />
          </div>
        </div>
      </div>
    </section>

    @include('frontend.inc.footer-top')
    
  </main>
  <!-- main body content / end -->

@endsection

@section('script')
    <script>
        $(document).ready(function(){
            $.post('{{ route('home.section.featured') }}', {_token:'{{ csrf_token() }}'}, function(data){
                $('#section_featured').html(data);
                AIZ.plugins.slickCarousel();
            });
            $.post('{{ route('home.section.best_selling') }}', {_token:'{{ csrf_token() }}'}, function(data){
                $('#section_best_selling').html(data);
                AIZ.plugins.slickCarousel();
            });
            $.post('{{ route('home.section.auction_products') }}', {_token:'{{ csrf_token() }}'}, function(data){
                $('#auction_products').html(data);
                AIZ.plugins.slickCarousel();
            });
            $.post('{{ route('home.section.home_categories') }}', {_token:'{{ csrf_token() }}'}, function(data){
                $('#section_home_categories').html(data);
                AIZ.plugins.slickCarousel();
            });
            $.post('{{ route('home.section.best_sellers') }}', {_token:'{{ csrf_token() }}'}, function(data){
                $('#section_best_sellers').html(data);
                AIZ.plugins.slickCarousel();
            });
        });
    </script>
@endsection
