<!-- Footer -->

<footer class="bg6 p-t-45 p-b-43 p-l-45 p-r-45">
	<div class="flex-w p-b-90">
		<div class="w-size6 p-t-30 p-l-15 p-r-15 respon3">
			<h4 class="s-text12 p-b-30">
				{{ __('footer.contact') }}
			</h4>

			<div>
				<p class="s-text7 w-size27">
					{{ __('footer.contact_text') }}
				</p>

				<div class="flex-m p-t-30">
					@if (isset($socials))
              @foreach ($socials as $key => $item)
                  <a href="{{ $item }}" class="{{ 'fs-18 color1 p-r-20 fa fa-' . $key }}" ></a>
              @endforeach
          @endif
				</div>
			</div>
		</div>

		<div class="w-size7 p-t-30 p-l-15 p-r-15 respon4">
			<h4 class="s-text12 p-b-30">
				{{ __('footer.categories') }}
			</h4>

			<ul>
				@foreach (__('footer.categories_data') as $name => $path)
				<li class="p-b-9">
					<a href="{{ $path }}" class="s-text7">
						{{ $name }}
					</a>
				</li>
				@endforeach
			</ul>
		</div>

		<div class="w-size7 p-t-30 p-l-15 p-r-15 respon4">
			<h4 class="s-text12 p-b-30">
				{{ __('footer.links') }}
			</h4>

			<ul>
				@foreach (__('footer.categories_data') as $name => $path)
				<li class="p-b-9">
					<a href="{{ $path }}" class="s-text7">
						{{ $name }}
					</a>
				</li>
				@endforeach
			</ul>
		</div>

		<div class="w-size7 p-t-30 p-l-15 p-r-15 respon4">
			<h4 class="s-text12 p-b-30">
				{{ __('footer.help') }}
			</h4>

			<ul>
				@foreach (__('footer.help_data') as $name => $path)
				<li class="p-b-9">
					<a href="{{ $path }}" class="s-text7">
						{{ $name }}
					</a>
				</li>
				@endforeach
			</ul>
		</div>

		<div class="w-size8 p-t-30 p-l-15 p-r-15 respon3">
			<h4 class="s-text12 p-b-30">
				{{ __('footer.newsletter') }}
			</h4>

			<form>
				<div class="effect1 w-size9">
					<input class="s-text7 bg6 w-full p-b-5" type="text" name="email" placeholder="email@example.com">
					<span class="effect1-line"></span>
				</div>

				<div class="w-size2 p-t-20">
					<!-- Button -->
					<button class="flex-c-m size2 bg4 bo-rad-23 hov1 m-text3 trans-0-4">
						{{ __('footer.form_button_name') }}
					</button>
				</div>
			</form>
		</div>
	</div>

	<div class="t-center p-l-15 p-r-15">
		@foreach ($paymentSystem as $name => $href)
			<a href="{{ $href }}">
				<img class="h-size2" src="{{ $preview(public_path(str_replace('name', $name,'storage/images/icons/name.png')), 34, 22) }}" alt="img-{{$name}}">
			</a>
		@endforeach

		<div class="t-center s-text8 p-t-20">
			{!! __('footer.copyright') !!}
		</div>
	</div>
</footer>

<!-- Back to top -->
<div class="btn-back-to-top bg0-hov" id="myBtn" style="display: flex">
	<span class="symbol-btn-back-to-top">
		<i class="fa fa-angle-double-up" aria-hidden="true"></i>
	</span>
</div>

<!-- Container Selection1 -->
<div id="dropDownSelect1"></div>
<div id="dropDownSelect2"></div>

@include('base.css')
@include('base.js')


<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="storage/images/icons/favicon.png"/>
