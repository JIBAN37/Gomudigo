<!DOCTYPE html>
<html>
<head>
    <title></title>
    <link rel="stylesheet" href="{{ static_asset('assets/css/vendors.css') }}">
    <link rel="stylesheet" href="{{ static_asset('assets/css/aiz-core.css') }}">
    <link rel="stylesheet" href="{{ static_asset('assets/css/custom-style.css') }}">
</head>
<body>
      <!-- main body content / start -->
  <main id="main">
    <section class="py-4 mb-4 bg-light">
        <div class="container text-center">
            <div class="row">
                <div class="col-lg-6 text-center mx-auto">
                    <h1 class="fw-600 h4">{{ $page->getTranslation('title') }}</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="mb-4">
    	<div class="container-fluid">
    		{!! $page->getTranslation('content') !!}
    	</div>
    </section>
    @include('frontend.inc.footer-top')
    
</main>
<!-- main body content / end -->
</body>
</html>