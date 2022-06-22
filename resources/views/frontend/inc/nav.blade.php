  <!-- header / start -->
  <header id="header" class="fixed-top">
    <nav class="navbar navbar-expand top-navbar navbar-gmg py-0 px-3 pe-md-0" >
      <button class="navbar-nav-toggler btn fs-4 d-none d-md-inline-block" aria-label="Toggle navigation" type="button">
        <i class="fa-solid fa-bars"></i>
      </button>
      <button class="navbar-nav-toggler-sm btn fs-4 d-md-none" aria-label="Toggle navigation" type="button"
        data-bs-toggle="offcanvas" data-bs-target="#mainMenuOffcanvas" aria-controls="mainMenuOffcanvas">
        <span class="bar"></span>
      </button>
      <a class="navbar-brand d-none d-md-block px-3 py-0" href="{{ route('home') }}">
        @php
            $header_logo = get_setting('header_logo');
        @endphp
        <img src="{{ uploaded_asset($header_logo) }}" alt="{{ env('APP_NAME') }}" class="img-fluid" />
      </a>
      <form action="{{ route('search') }}" method="GET" class="w-100 px-2 py-2 py-md-0">
        <div class="input-group">
          <input type="text" class="form-control rounded-0" name="keyword" @isset($query) value="{{ $query }}" @endisset placeholder="{{translate('I am shopping for...')}}" />
          <button type="submit" class="input-group-text btn gmg-bg-orange text-white rounded-0" id="product-search">
            <i class="fa-solid fa-magnifying-glass"></i>
          </button>
        </div>
      </form>
      <ul class="navbar-nav d-none d-md-flex">
        <li class="nav-item d-none d-lg-inline-block">
          <a class="nav-link fw-bold" href="#">
            Request Product
            <i class="fa-solid fa-phone"></i>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link fw-bold" href="{{ route('orders.track') }}"> Track Order </a>
        </li>
        @if(get_setting('show_language_switcher') == 'on')
        <li class="list-inline-item dropdown mt-2" id="lang-change">
            @php
                if(Session::has('locale')){
                    $locale = Session::get('locale', Config::get('app.locale'));
                }
                else{
                    $locale = 'en';
                }
            @endphp
            <a href="javascript:void(0)" class="dropdown-toggle fw-bold py-2" data-toggle="dropdown" data-display="static">
                <img src="{{ static_asset('assets/img/placeholder.jpg') }}" data-src="{{ static_asset('assets/img/flags/'.$locale.'.png') }}" class="mr-2 lazyload" alt="{{ \App\Models\Language::where('code', $locale)->first()->name }}" height="11">
                <span class="opacity-60">{{ \App\Models\Language::where('code', $locale)->first()->name }}</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-left">
                @foreach (\App\Models\Language::all() as $key => $language)
                    <li>
                        <a href="javascript:void(0)" data-flag="{{ $language->code }}" class="dropdown-item @if($locale == $language) active @endif">
                            <img src="{{ static_asset('assets/img/placeholder.jpg') }}" data-src="{{ static_asset('assets/img/flags/'.$language->code.'.png') }}" class="mr-1 lazyload" alt="{{ $language->name }}" height="11">
                            <span class="language">{{ $language->name }}</span>
                        </a>
                    </li>
                @endforeach
            </ul>
        </li>
        @endif
        @auth
        <li class="nav-item">
          <a class="nav-link sign-in d-none d-md-inline-block fw-bold" href="{{ route('dashboard') }}" data-bs-toggle="modal">
            My Account
          </a>
        </li>
        @else
        <li class="nav-item">
          <a class="nav-link sign-in d-none d-md-inline-block fw-bold" href="{{ route('user.login') }}" data-bs-toggle="modal">
            Sign in
          </a>
        </li>
        @endauth
      </ul>
      <div class="dot-menu d-md-none">
        <a href="#signin-up-sm" onclick="mobileA()" class="fs-4 p-2">
          <i class="fa-solid fa-ellipsis-vertical"></i>
        </a>
      </div>
    </nav>
    <nav class="bottom-nav d-md-none navbar-gmg shadow ps-3 pe-2">
      <a class="d-flex align-items-center fw-bold px-3 py-2" href="{{ route('orders.track') }}" style="gap: 1rem">
        Track Order
        <i class="fa-solid fa-angle-right ms-auto"></i>
      </a>
    </nav>
    <nav
      class="main-navbar offcanvas offcanvas-start overflow-auto shadow-sm border-end position-absolute start-0 top-100 bg-white"
      data-bs-scroll="true" tabindex="-1" id="mainMenuOffcanvas">

     <ul class="nav flex-column py-2">
        @foreach (\App\Models\Category::where('level', 0)->orderBy('order_level', 'asc')->get()->take(25) as $key => $category)
        <li class="nav-item gmg-accordion search_bar">
          <div class="nav-link link-dark " onclick="menuCollapseOne('menuCollapseOne{{ $category->id }}')" style="font-size: 11px;">
               @php
           $result123=App\Models\Category::where('level', 1)->where('parent_id', $category->id)->count();
           @endphp
            <img src="{{ uploaded_asset($category->icon) }}" alt="{{ $category->getTranslation('name') }}" class="img-fluid">
           @if($result123==0)
            <a href="{{ route('products.category', $category->slug) }}">{{ $category->getTranslation('name') }}</a>
            @else
    <a href="#">{{ $category->getTranslation('name') }}</a>
            @endif
           @if($result123>0) <i class="fa-solid fa-angle-right ms-auto arrow" onclick="menuCollapseOne('menuCollapseOne{{ $category->id }}')"
              role="button" aria-expanded="false" aria-controls="menuCollapseOne{{ $category->id }}"></i>
            @endif
          </div>
          <div class="d-none" id="menuCollapseOne{{ $category->id }}">
            <ul class="gmg-accordion-menu">
              @foreach (\App\Models\Category::where('level', 1)->where('parent_id', $category->id)->orderBy('order_level', 'asc')->get()->take(11) as $key => $subCategory)
              <li class="gmg-accordion-item">
                <a href="{{ route('products.category', $subCategory->slug) }}" class="gmg-accordion-link text-capitalize">
                  {{ $subCategory->getTranslation('name') }}
                </a>
              </li>
              @endforeach
            </ul>
          </div>
        </li>
        @endforeach

      </ul>
    </nav>
  </header>

  <!-- small screen menu -->
  <div class="modal show fade" id="signin-up-sm" tabindex="-1" aria-labelledby="signinUpSmLabel" aria-hidden="true" >
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="signinUpSmLabel">gomudigo.com</h5>
          <button type="button" class="btn-close" onclick="signinUpClose()" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <ul class="menu-list">
            @auth
            <li class="list-item">
              <a href="{{ route('logout') }}" class="btn w-100 text-start mb-3" data-bs-toggle="modal"
                data-bs-target="#loginModal">
                <i class="fa-solid fa-right-to-bracket fa-lg me-2"></i>
                Logout
            </a>
            </li>
            <li class="list-item">
              <a href="{{ route('dashboard') }}" class="btn w-100 text-start mb-3" data-bs-toggle="modal"
                data-bs-target="#loginModal">
                <i class="fa-solid fa-user-plus fa-lg me-2"></i>
                My Account
            </a>
            </li>
            @else
            <li class="list-item">
              <a href="{{ route('user.login') }}" class="btn w-100 text-start mb-3" data-bs-toggle="modal"
                data-bs-target="#loginModal">
                <i class="fa-solid fa-right-to-bracket fa-lg me-2"></i>
                Login
            </a>
            </li>
            <li class="list-item">
              <a href="{{ route('user.registration') }}" class="btn w-100 text-start mb-3" data-bs-toggle="modal"
                data-bs-target="#loginModal">
                <i class="fa-solid fa-user-plus fa-lg me-2"></i>
                Sign Up
            </a>
            </li>
            @endauth
          </ul>
        </div>
      </div>
    </div>
  </div>

  <!-- login/registration modal -->
  <div class="modal fade" id="signinModal" tabindex="-1" aria-labelledby="signinModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen-sm-down">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="signinModalLabel">Login</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="login-methods d-grid mb-3">
            <button class="btn btn-lg btn-primary bg-opacity-75 border mb-2">
              <i class="fa-brands fa-facebook-f fa-lg me-2"></i>
              Sign Up or Login with Facebook
            </button>
            <button class="btn btn-lg btn-light border">
              <i class="fa-solid fa-envelope fa-lg me-2"></i>
              Login with Email
            </button>
          </div>
          <div class="other-login-options">
            <div class="divider">
              <span class="or">or</span>
            </div>
            <p class="text-uppercase text-center my-5">
              Please enter your phone number
            </p>

            <div class="input-group">
              <span class="input-group-text fs-5 ps-2 pe-0" id="get-out-app">
                <img src="./assets/images/flag-bd.gif" alt="flag of bangladesh" class="img-fluid me-1"
                  style="width: 1.75rem" />
                +
              </span>
              <input type="text" class="form-control py-lg-3 ps-1 fs-6 border" value="88" aria-label="phone"
                aria-describedby="get-out-app" />
            </div>
            <button class="btn py-3 mt-3 w-100 gmg-bg-orange text-white text-uppercase" data-bs-toggle="modal"
              data-bs-target="#verify-login">
              Sign up / login
            </button>
          </div>
        </div>
        <div class="modal-footer">
          <p class="text-center">
            This site is protected by reCAPTCHA and the Google
            <a href="#" class="link-primary">Privacy Policy</a> and
            <a href="#" class="link-primary">Terms of Service</a> apply.
          </p>
        </div>
      </div>
    </div>
  </div>

  <!-- Verification Modal -->
  <div class="modal fade" id="verify-login" tabindex="-1" data-bs-backdrop="static" aria-labelledby="verifyLoginLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-fullscreen-sm-down">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="verifyLoginLabel">
            Login Verification
          </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="login-methods d-grid mb-3">
            <button class="btn btn-lg btn-light border">
              <i class="fa-solid fa-envelope fa-lg me-2"></i>
              Login with Email
            </button>
          </div>
          <div class="other-login-options">
            <div class="divider">
              <span class="or">or</span>
            </div>
            <p class="text-uppercase text-center my-5">
              We've sent a 4-digit OTP in our phone
              <span class="d-block">+8801245876952</span>
            </p>

            <input type="text" class="form-control border-0 border-bottom py-3"
              placeholder="Please enter 4-digit OTP" />

            <div class="row my-3">
              <div class="col-4 text-center">
                <button type="button" class="btn gmg-bg-orange text-white text-uppercase w-100">
                  Enter
                </button>
              </div>
              <div class="col-8">
                <button type="button" class="btn gmg-text-orange text-uppercase">
                  Request pin again
                </button>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <p class="text-center">
            This site is protected by reCAPTCHA and the Google
            <a href="#" class="link-primary">Privacy Policy</a> and
            <a href="#" class="link-primary">Terms of Service</a> apply.
          </p>
        </div>
      </div>
    </div>
  </div>
  <!-- header / end -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script type="text/javascript">
      $( document ).ready(function() {
          getProduct()
      });

      function getProduct()
      {
          let searchedData = 'Aarong'
          let url = "{{route('product-search')}}";
          $.ajax({
              type: "get",
              url: url,
              data: {
                  "search": searchedData,
              },
              dataType: "json",
              success: function (response) {
                  console.log(response)
              },
          });
      }
  </script>
