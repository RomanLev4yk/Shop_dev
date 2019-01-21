<header class="header1">
  <!-- Header desktop  -->
  <div class="container-menu-header">
    <div class="topbar">
      <div class="topbar-social">
          @if (isset($socials))
              @foreach ($socials as $key => $item)
                  <a href="{{ $item }}" class="{{ 'topbar-social-item fa fa-' . $key }}" ></a>
              @endforeach
          @endif
      </div>

      <span class="topbar-child1">
          {{ __('header.promo_text')}}
      </span>

      <div class="topbar-child2">
        <span class="topbar-email">
            {{ __('header.promo_email')}}
        </span>

        <div class="topbar-language rs1-select2">
          <select class="selection-1" name="time">
              @if (isset($currencies))
                  @foreach ($currencies as $item)
                      <option>{{ $item }}</option>
                  @endforeach
              @endif
          </select>
        </div>
      </div>
    </div>


    <div class="wrap_header">
      <!-- Logo -->
      <a href="index.html" class="logo">
        <img src="{{ $preview(public_path('storage/images/icons/logo.png'), 120, 27) }}" alt="{{ 'logo' }}">
      </a>

      <!-- Menu -->
      <div class="wrap_menu">
    		@if (isset($menu))
    		<nav class="menu">
    			<ul class="main_menu">
        			@foreach ($menu as $item)
          				<li>
            					<a href="{{ $item['link'] }}">{{ $item['title'] }}</a>

              				@if (isset($item['childs'][0]) && $item['childs'][0])
                						<ul class="sub_menu">
                    						@foreach ($item['childs'][0] as $child)
                                    @if (isset($child['link']))
                      							<li>
                        							<a href="{{ $child['link'] }}">{{ $child['title'] }}</a>
                      							</li>
                                    @endif
                    						@endforeach
                						</ul>
              				@endif
          				</li>
        			@endforeach
    			</ul>
    		</nav>
    		@endif
    	</div>

      <!-- Header Icon -->
      <div class="header-icons">
		      <a href="#" class="header-wrapicon1 dis-block">
		          <img src="{{ $preview(public_path('storage/images/icons/icon-header-01.png'), 27, 27) }}" class="header-icon1" alt="{{ htmlentities('icon') }}">
		      </a>

        <span class="linedivide1"></span>

        <div class="header-wrapicon2">
          <img src="{{ $preview(public_path('storage/images/icons/icon-header-02.png'), 21, 27) }}" alt="{{ htmlentities('icon') }} " class="header-icon1 js-show-header-dropdown">

          <span class="header-icons-noti">0</span>

          <!-- Header cart noti -->
          <div class="header-cart header-dropdown">
            @if(isset($orderProducts))
            <ul class="header-cart-wrapitem">
              @foreach($orderProducts as $item)
              <li class="header-cart-item">
                <div class="header-cart-item-img">

                  <img src="{{ $preview(public_path('storage/images/item-cart-01.jpg'), 80, 80) }}" alt="{{ $item['alt'] }}">
                </div>

                <div class="header-cart-item-txt">
                  <a href="{{ $item['link'] }}" class="header-cart-item-name">
                    {{ $item['name']}}
                  </a>

                  <span class="header-cart-item-info">
                    {{ $item['info'] }}
                  </span>
                </div>
              </li>
              @endforeach
            </ul>
            @endif

            <div class="header-cart-total">0</div>

            <div class="header-cart-buttons">
              <div class="header-cart-wrapbtn">
                <!-- Button -->
                <a href="{{ __('order_href_left') }}" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
                {{ __('header.order_button_left') }}
                </a>
              </div>

              <div class="header-cart-wrapbtn">
                <!-- Button -->
                <a href="{{ __('order_href_right') }}" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
                  {{__('header.order_button_right') }}
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Header Mobile -->
  <div class="wrap_header_mobile">
    <!-- Logo moblie -->
    <a href="index.html" class="logo-mobile">
      <img src="{{ $preview(public_path('storage/images/icons/logo.png'), 120, 27) }}" alt="{{ htmlentities('img-logo') }}">
    </a>

    <!-- Button show menu -->
    <div class="btn-show-menu">
      <!-- Header Icon mobile -->
      <div class="header-icons-mobile">
        <!-- ???????? -->
        <a href="  " class="header-wrapicon1 dis-block">
          <img src="{{ preview(public_path('storage/images/icons/icon-header-01.png'), 27, 27) }}" class="header-icon1" alt="{{ htmlentities('icon') }}">
        </a>

        <span class="linedivide2"></span>

        <div class="header-wrapicon2">
          <img src="{{ preview(public_path('storage/images/icons/icon-header-02.png'), 27, 27) }}" alt="{{ htmlentities('icon') }}">

          <span class="header-icons-noti">0</span>

          <!-- Header cart noti -->
          <div class="header-cart header-dropdown">
            @if(isset($orderProducts))
            <ul class="header-cart-wrapitem">
              @foreach($orderProducts as $item)
              <li class="header-cart-item">
                <div class="header-cart-item-img">

                  <img src="{{ $item['src'] }}" alt="{{ $item['alt'] }}">
                </div>

                <div class="header-cart-item-txt">
                  <a href="{{ $item['link'] }}" class="header-cart-item-name">
                    {{ $item['name']}}
                  </a>

                  <span class="header-cart-item-info">
                    {{ $item['info'] }}
                  </span>
                </div>
              </li>
              @endforeach
            </ul>
            @endif

            <div class="header-cart-total">0</div>

            <div class="header-cart-buttons">
              <div class="header-cart-wrapbtn">
                <!-- Button -->
                <a href="{{ __('order_href_left') }}" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
                {{ __('order_button_left') }}
                </a>
              </div>

              <div class="header-cart-wrapbtn">
                <!-- Button -->
                <a href="{{ __('order_href_right') }}" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
                  {{__('order_button_right') }}
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="btn-show-menu-mobile hamburger hamburger--squeeze">
        <span class="hamburger-box">
          <span class="hamburger-inner"></span>
        </span>
      </div>

    </div>
  </div>

  <!-- Menu Mobile -->
  <div class="wrap-side-menu" >
    <nav class="side-menu">
      <ul class="main-menu">

        <li class="item-topbar-mobile p-l-20 p-t-8 p-b-8">
          <span class="topbar-child1">
            {{ __('header.promo_text')}}
          </span>
        </li>

        <li class="item-topbar-mobile p-l-20 p-t-8 p-b-8">
          <div class="topbar-child2-mobile">
            <span class="topbar-email">
              {{ __('header.promo_email')}}
            </span>

            @if (isset($currencies))
            <div class="topbar-language rs1-select2">
              <select class="selection-1" name="time">
                <!-- @if (isset($currencies)) -->
                    @foreach ($currencies as $item)
                        <option>{{ $item }}</option>
                    @endforeach
                <!-- @endif -->
              </select>
            </div>
            @endif
          </div>
        </li>

        @if (isset($socials))
        <li class="item-topbar-mobile p-l-10">
          <div class="topbar-social-mobile">
            <!-- @if (isset($socials)) -->
                @foreach ($socials as $key => $item)
                    <a href="{{ $item }}" class="{{ 'topbar-social-item fa fa-' . $key }}" ></a>
                @endforeach
            <!-- @endif -->
          </div>
        </li>
        @endif


        @if (isset($menu))
        			@foreach ($menu as $item)
          				<li class="item-menu-mobile">
            					<a href="{{ $item['link'] }}">{{ $item['title'] }}</a>

              				@if (isset($item['childs'][0]) && $item['childs'][0])
                						<ul class="sub_menu">
                    						@foreach ($item['childs'][0] as $child)
                                    @if (isset($child['link']))
                      							<li>
                        							<a href="{{ $child['link'] }}">{{ $child['title'] }}</a>
                      							</li>
                                    @endif
                    						@endforeach
                						</ul>
              				@endif
          				</li>
        			@endforeach
    		@endif
      </ul>
    </nav>
  </div>

</header>

