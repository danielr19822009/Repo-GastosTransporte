<!DOCTYPE html>
	
    <head>
	
		<!-- it works the same with all jquery version from 1.x to 2.x -->
	<script src="jssor.carousel.slider/js/jquery-1.9.1.min"></script>
	<script src="jssor.carousel.slider/js/jssor.slider.mini.js"></script>
	<script>
		jQuery(document).ready(function ($) {
			var options = { $AutoPlay: true };
			var jssor_slider1 = new $JssorSlider$('slider1_container', options);
		});
	</script>
       
    </head>
	<body>
		
		<div id="slider1_container" style="position: relative; top: 0px; left: 10px; width: 300px; height: 100px;">
				<!-- Slides Container -->
				<div u="slides" style="cursor: move; position: absolute; overflow: hidden; left: 0px; top: 0px; width: 300px; height:100px;">
					<div><img u="image" src="imagenes\mvm.jpg"/></div>
					<div><img u="image" src="imagenes\jupiter.png" /></div>
					<div><img u="image" src="imagenes\solunion.jpg" /></div>
					<div><img u="image" src="imagenes\delivery42.png" /></div>
					<div><img u="image" src="imagenes\fuel14.png" /></div>
					<div><img u="image" src="imagenes\delivery42.png" /></div>
					<div><img u="image" src="imagenes\fuel14.png" /></div>
					<div><img u="image" src="imagenes\delivery42.png" /></div>
				</div>
		</div>
		
   
    </body>
</html>
