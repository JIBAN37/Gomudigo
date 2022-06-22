@extends('frontend.layouts.app')

@if (isset($category_id))
    @php
        $meta_title = \App\Models\Category::find($category_id)->meta_title;
        $meta_description = \App\Models\Category::find($category_id)->meta_description;
    @endphp
@elseif (isset($brand_id))
    @php
        $meta_title = \App\Models\Brand::find($brand_id)->meta_title;
        $meta_description = \App\Models\Brand::find($brand_id)->meta_description;
    @endphp
@else
    @php
        $meta_title         = get_setting('meta_title');
        $meta_description   = get_setting('meta_description');
    @endphp
@endif

@section('meta_title'){{ $meta_title }}@stop
@section('meta_description'){{ $meta_description }}@stop

@section('meta')
    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name" content="{{ $meta_title }}">
    <meta itemprop="description" content="{{ $meta_description }}">

    <!-- Twitter Card data -->
    <meta name="twitter:title" content="{{ $meta_title }}">
    <meta name="twitter:description" content="{{ $meta_description }}">

    <!-- Open Graph data -->
    <meta property="og:title" content="{{ $meta_title }}" />
    <meta property="og:description" content="{{ $meta_description }}" />
@endsection

@section('content')

  <!-- main body content / start -->
  <main id="main">
    <!-- hero section -->
    @if(isset($category_id))
    @php
        $cat_img = \App\Models\Category::find($category_id); 
    @endphp
    @if(isset($cat_img))
    <section class="product-hero">
      <div class="container">
        <div class="card mb-1">
          <img src="{{ uploaded_asset($cat_img->banner) }}" alt="Category banner" class="card-img-top" />
        </div>
      </div>
    </section>
    @endif
    @endif

    <!-- products section -->
    <section class="prodcuts-section py-5">
      <div class="container">
        <h2 class="h3 section-heading text-capitalize text-center mb-5">
            @if(isset($category_id))
            {{ \App\Models\Category::find($category_id)->getTranslation('name') }}
            @elseif(isset($query))
                {{ translate('Search result for ') }}"{{ $query }}"
            @else
                {{ translate('All Products') }}
            @endif
        </h2>
        <div class="prodcuts-wrapper">
          <ul class="prodcuts" >
            @foreach ($products as $key => $product)
            @include('frontend.partials.product_box_1',['product' => $product])
            
            @endforeach
          </ul>
        </div>
        <div class="aiz-pagination aiz-pagination-center mt-4">
            {{ $products->appends(request()->input())->links() }}
        </div>
      </div>
    </section> 
    @include('frontend.inc.footer-top')
  </main>
  <!-- main body content / end -->

@endsection

@section('script')
    <script type="text/javascript">
        function filter(){
            $('#search-form').submit();
        }
        function rangefilter(arg){
            $('input[name=min_price]').val(arg[0]);
            $('input[name=max_price]').val(arg[1]);
            filter();
        }
    </script>
@endsection
