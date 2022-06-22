@extends('frontend.layouts.app')
@section('content')
<!-- main body content / start -->
<main id="main">
<section class="py-5">
    <div class="container">
        <div class="d-flex align-items-start">
			@include('frontend.inc.user_side_nav')
			<div class="aiz-user-panel">
				@yield('panel_content')
            </div>
        </div>
    </div>
</section>
</main>
<!-- main body content / end -->
@endsection