@extends('layouts.master')

@section('title')
Contact Us
@stop


@section('content')

			<!-- site content -->
			<div id="main">
				<div class="content-wrapper container" id="page-info">
					<div class="row">
						<div class="col-xs-12 col-sm-6 contact-form">
							<div id="map-canvas"></div>
						</div>
						<div class="col-xs-12 col-sm-5 col-sm-offset-1 contact-address">
							<h2>Get in touch</h2>
							<address>
								<span> <strong>E-Mail :</strong>   <span><a href="mailto:info@getoboli.com">info@getoboli.com</a></span> </span>
								<span> <strong>FB: :</strong> <span><a href="https://www.facebook.com/getoboli" target="_blank">/getoboli</a></span> </span>
								<span> <strong>Twitter :</strong>  <span><a href="https://twitter.com/getoboli" target="_blank">@getoboli</a></span> </span>
							</address>
						</div>
					</div>
				</div>
			</div>
			<!-- site content ends -->


@stop



@section('scripts')
<style>
  #map-canvas {
    height: auto;
  }
</style>

<script src="https://maps.googleapis.com/maps/api/js"></script>
<script>
  function initialize() {
    var mapCanvas = document.getElementById('map-canvas');
    var mapOptions = {
      center: new google.maps.LatLng(51.5286416,-0.1015987 ),
      zoom: 8,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    }
    var map = new google.maps.Map(mapCanvas, mapOptions)
  }
  google.maps.event.addDomListener(window, 'load', initialize);
</script>
@stop
			
