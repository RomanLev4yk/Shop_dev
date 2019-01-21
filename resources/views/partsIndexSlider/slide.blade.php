<div class="item-slick1 item2-slick1" style="background-image: url({{ $image }});">
  <div class="wrap-content-slide1 sizefull flex-col-c-m p-l-15 p-r-15 p-t-150 p-b-170">
    <span class="caption1-slide1 m-text1 t-center animated visible-false m-b-15" data-appear="rollIn">
      {{ $title }}
    </span>

    <h2 class="caption2-slide1 xl-text1 t-center animated visible-false m-b-37" data-appear="lightSpeedIn">
      {{ $description }}
    </h2>

    <div class="wrap-btn-slide1 w-size1 animated visible-false" data-appear="slideInUp">
      <a href="{{ $link }}" class="flex-c-m size2 bo-rad-23 s-text2 bgwhite hov1 trans-0-4">
        {{ __('slider.button_text') }}
      </a>
    </div>
  </div>
</div>

     