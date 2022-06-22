<!-- home footer nav links  -->
<section class="footer-nav py-4 py-lg-5">
    <div class="container">
      <div class="row g-0">
        <div class="col-sm-6 col-lg-3 mb-4 mb-lg-0 px-3">
          <h2 class="h5">Customer Services</h2>
          <ul class="nav flex-column">
            <li class="nav-item">
              <a href="{{ url('/faq') }}" class="nav-link link-dark ps-0"> FAQs </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('returnpolicy') }}" class="nav-link link-dark ps-0">
                Return Policy
              </a>
            </li>
          </ul>
        </div>
        <div class="col-sm-6 col-lg-3 mb-4 mb-lg-0 px-3">
          <h2 class="h5">About GoMudiGo</h2>
          <ul class="nav flex-column">
            <li class="nav-item">
              <a href="{{ route('aboutUs') }}" class="nav-link link-dark ps-0"> About Us </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('privacypolicy') }}" class="nav-link link-dark ps-0">
                Privacy Policy
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('terms') }}" class="nav-link link-dark ps-0"> {{ translate('Terms & conditions') }} </a>
            </li>
          </ul>
        </div>
        <div class="col-sm-6 col-lg-3 mb-4 mb-lg-0 px-3">
          <h2 class="h5">For Business</h2>
          <ul class="nav flex-column">
            <li class="nav-item">
              <a href="#" class="nav-link link-dark ps-0"> Corporate </a>
            </li>
          </ul>
        </div>
        <div class="col-sm-6 col-lg-3 mb-4 mb-lg-0 px-3">
          <h2 class="h5">Contact Us</h2>
          <ul class="nav flex-column">
            <li class="nav-item d-flex align-items-center py-2">
              <i class="fa-solid fa-map-location-dot fa-lg me-3"></i>
              {{ get_setting('contact_address',null,App::getLocale()) }}
            </li>
            <li class="nav-item d-flex align-items-center py-2">
              <i class="fa-solid fa-phone fa-lg me-3"></i>
              {{ get_setting('contact_phone') }}
            </li>
            <li class="nav-item d-flex align-items-center py-2">
              <i class="fa-solid fa-envelope fa-lg me-3"></i>
              <a href="mailto:{{ get_setting('contact_email') }}" class="text-reset">{{ get_setting('contact_email')  }}</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </section>

  <!-- contact section -->
  <section class="contact p-3 py-lg-5">
    <div class="container">
      <div class="row g-0">
        <div class="col-md-6 col-lg-4 text-center px-3">
          <h2 class="h5 mb-3">Connect with us</h2>
          <div class="socials pt-2">
            @if ( get_setting('show_social_links') )
            <ul class="list-inline my-3 my-md-0 social colored text-center">
                @if ( get_setting('facebook_link') !=  null )
                <li class="list-inline-item">
                    <a href="{{ get_setting('facebook_link') }}" target="_blank" class="facebook"><i class="lab la-facebook-f"></i></a>
                </li>
                @endif
                @if ( get_setting('twitter_link') !=  null )
                <li class="list-inline-item">
                    <a href="{{ get_setting('twitter_link') }}" target="_blank" class="twitter"><i class="lab la-twitter"></i></a>
                </li>
                @endif
                @if ( get_setting('instagram_link') !=  null )
                <li class="list-inline-item">
                    <a href="{{ get_setting('instagram_link') }}" target="_blank" class="instagram"><i class="lab la-instagram"></i></a>
                </li>
                @endif
                @if ( get_setting('youtube_link') !=  null )
                <li class="list-inline-item">
                    <a href="{{ get_setting('youtube_link') }}" target="_blank" class="youtube"><i class="lab la-youtube"></i></a>
                </li>
                @endif
                @if ( get_setting('linkedin_link') !=  null )
                <li class="list-inline-item">
                    <a href="{{ get_setting('linkedin_link') }}" target="_blank" class="linkedin"><i class="lab la-linkedin-in"></i></a>
                </li>
                @endif
            </ul>
            @endif
          </div>
        </div>
        <div class="col-md-6 col-lg-4 text-center px-3">
          <h2 class="h5 mb-3">Download our apps</h2>
          <div class="row">
            @if(get_setting('play_store_link') != null)
              <div class="col-6">
                <a href="{{ get_setting('play_store_link') }}" target="_blank">
                  <img src="{{ static_asset('assets/img/play.png') }}" alt="Play Store" class="img-fluid" />
                </a>
              </div>
            @endif
            @if(get_setting('app_store_link') != null)
              <div class="col-6">
                <a href="{{ get_setting('app_store_link') }}" target="_blank">
                  <img src="{{ static_asset('assets/img/app.png') }}" alt="App Store" class="img-fluid" />
                </a>
              </div>
            @endif
            
           
          </div>
        </div>
        <div class="col-lg-4 px-3 pt-5">
          <form method="POST" action="{{ route('subscribers.store') }} class="d-flex align-items-center justify-content-center">
            <div class="input-group" style="max-width: 310px">
              <input type="email" class="form-control fs-6 py-3" name="email" placeholder="Your Email Address" required />
              <button class="btn btn-warning gmg-bg-orange text-white">
                Subscribe
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>

  <!-- copyright section -->
  <section class="copyright bg-dark text-white p-4">
    <div class="container">
      <div class="row g-0">
        <div class="col-md-6">
          <p class="mb-0 text-center text-md-end text-white">
            {!! get_setting('frontend_copyright_text',null,App::getLocale()) !!}
          </p>
        </div>
        <div class="col-md-6">
          <div class="text-center text-md-right">
            <ul class="list-inline mb-0">
                @if ( get_setting('payment_method_images') !=  null )
                    @foreach (explode(',', get_setting('payment_method_images')) as $key => $value)
                        <li class="list-inline-item">
                            <img src="{{ uploaded_asset($value) }}" height="50" class="mw-100 h-auto" style="max-height: 50px">
                        </li>
                    @endforeach
                @endif
            </ul>
        </div>
        </div>
      </div>
    </div>
  </section>

