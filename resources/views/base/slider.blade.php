<!-- Slide1 -->
<section class="slide1">

	<div class="wrap-slick1">
		<div class="slick1">
			@if (isset($slider))
				@foreach ($slider as $slide)
					@include('partsIndexSlider.slide', $slide)
				@endforeach
			@endif
		</div>
	</div>

</section>
