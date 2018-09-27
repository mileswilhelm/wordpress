<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Vericor_Homes
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer bg-blue text-white font-sans">
		<section>
			<img id="footer-banner" class="w-full h-32 lg:h-auto object-cover lazyload bg-gray-lightest" />
		</section>
		<div class="container mx-auto px-3 text-center py-12">
			<a href="<?php echo get_home_url(); ?>">
				<img data-src="<?php echo get_template_directory_uri();?>/assets/vericor-horizontal-white.png" class="max-w-full footer-logo mb-10 lazyload">
			</a>
			<p class="uppercase mb-6">&copy; <?php echo date("Y"); ?> Vericor Homes</p>
			<div class="mb-6 text-white text-center text-3xl lg:text-4xl flex justify-center social-media lg:w-1/3 lg:mx-auto">
				<a href="https://www.facebook.com/Vericor-Homes-230820027617908/?modal=admin_todo_tour" class="hover:text-yellow"><i class="icon icon-facebook"></i></a>
				<a href="https://www.instagram.com/vericorhome/" class="hover:text-yellow"><i class="icon icon-instagram"></i></a>
				<a href="https://www.pinterest.com/vericorhomes/?eq=VERICOR%20HOMES&etslf=7976" class="hover:text-yellow"><i class="icon icon-pinterest"></i></a>
				<a href="https://plus.google.com/u/3/109286274534946114603" class="hover:text-yellow"><i class="icon icon-gplus"></i></a>
			</div>
			<div class="leading-normal mb-12">
				<p>All Rights Reserved. Contents are the exclusive property of Vericor Homes and can not be reproduced without written permission.</p>
				<p class="mb-10 leading-normal">All real estate advertising on this website is subject to the Fair Housing Act which makes it illegal to advertise any preference, limitation or discrimination based on race, color, religion, sex, handicap, familial status or national origin, or an intention, to make any such preference, limitation or discrimination.</p>
				<p>Builder reserves the right to change prices, plans, components and specifications and to withdraw or modify any plan without notice.</p>
				<p>Extra costs, options, and decorator items may be shown in model or in illustrations.</p>
				<p>Individual homes may vary from the models, or from each other, depending on field conditions.</p>
			</div>
			<div class="flex justify-center items-center">
				<div class="w-1/4 px-4 md:px-0">
					<img class="lazyload md:w-1/2" data-src="<?php echo get_template_directory_uri();?>/assets/HBAV-logo.png" />
				</div>
				<div class="w-1/4 px-4 md:px-0">
					<img class="lazyload md:w-1/2" data-src="<?php echo get_template_directory_uri();?>/assets/HERS-logo.png" />
				</div>
				<div class="w-1/4 px-4 md:px-0">
					<img class="lazyload md:w-1/2" data-src="<?php echo get_template_directory_uri();?>/assets/NAHB-logo.png" />			
				</div>
				<div class="w-1/4 px-4 md:px-0">
					<img class="lazyload w-1/2 md:w-1/4" data-src="<?php echo get_template_directory_uri();?>/assets/hbar-logo-footer.png" />			
				</div>
			</div>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

<?php if (is_front_page()) { ?>
	<script>
		function initMap() {
			var lat = 37.393380;
			var lng = -77.724136;

			var communities = [
				["Magnolia Green", "37.393664", "-77.732466"],
				["Harpers Mill", "37.383018", "-77.708589"],
			];

			var cmap = new google.maps.Map(document.getElementById('community-page-map'), {
				center: new google.maps.LatLng(lat, lng),
				zoom: 13,
				scrollwheel: false,
				navigationControl: false,
				mapTypeControl: false,
				scaleControl: false,
				mapTypeId: google.maps.MapTypeId.ROADMAP
			});

			var infowindow = new google.maps.InfoWindow();
			var marker, i;
			var markers = new Array();
			for (i = 0; i < communities.length; i++) {  
				marker = new google.maps.Marker({
					position: new google.maps.LatLng(communities[i][1], communities[i][2]),
					map: cmap,
					icon: 'https://vericorstaging.eastonpreview.com/wp-content/themes/vericor-homes/assets/vericor-blue-logo-only.png',
					content: communities[i][0]
				});
				markers.push(marker);
				
				google.maps.event.addListener(marker, 'click', (function(marker, i) {

					return function() {
						infowindow.setContent("<h4 class='mb-5 text-2xl font-serif text-blue'>"+communities[i][0]+"</h4>");
						infowindow.open(cmap, marker);
					}
				})(marker, i));
			}
		}
	</script>
	<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAtq-bYRZRKw0UYjaeO6T9kKjPstI6Iguk&callback=initMap"></script>
<?php } ?>
<?php if (is_page_template( 'template-community.php' )) { 
	$community_map = get_field('community_map');
	$community_title = get_the_title();

?>
	<script>
		function initMap() {
			var lat = <?php echo $community_map['lat']; ?>;
			var lng = <?php echo $community_map['lng']; ?>;

			var communities = [
				["<?php echo $community_title; ?>", lat, lng]
			];

			var cmap = new google.maps.Map(document.getElementById('community-map'), {
				center: new google.maps.LatLng(lat, lng),
				zoom: 10,
				scrollwheel: false,
				navigationControl: false,
				mapTypeControl: false,
				scaleControl: false,
				mapTypeId: google.maps.MapTypeId.ROADMAP
			});

			// var infowindow = new google.maps.InfoWindow();
			var marker, i;
			var markers = new Array();
			for (i = 0; i < communities.length; i++) {  
				marker = new google.maps.Marker({
					position: new google.maps.LatLng(communities[i][1], communities[i][2]),
					map: cmap,
					icon: 'https://vericorstaging.eastonpreview.com/wp-content/themes/vericor-homes/assets/vericor-blue-logo-only.png',
					content: communities[i][0]
				});
				markers.push(marker);
			}
				
			// 	google.maps.event.addListener(marker, 'click', (function(marker, i) {

			// 		return function() {
			// 			infowindow.setContent("<h4 class='mb-5 text-2xl font-serif text-blue'>"+communities[i][0]+"</h4>");
			// 			infowindow.open(cmap, marker);
			// 		}
			// 	})(marker, i));
			// }
		}
	</script>
	<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAtq-bYRZRKw0UYjaeO6T9kKjPstI6Iguk&callback=initMap"></script>
<?php } ?>
<?php if (is_page_template( 'template-inventory.php' )) { 
	$inventory_map = get_field('inventory_map');
	// $inventory_title = get_the_title();
?>
	<script>
		function initMap() {
			var lat = <?php echo $inventory_map['lat']; ?>;
			var lng = <?php echo $inventory_map['lng']; ?>;

			var communities = [
				["<?php echo $inventory_map['address']; ?>", lat, lng]
			];

			var cmap = new google.maps.Map(document.getElementById('inventory-map'), {
				center: new google.maps.LatLng(lat, lng),
				zoom: 16,
				scrollwheel: false,
				navigationControl: false,
				mapTypeControl: false,
				scaleControl: false,
				mapTypeId: google.maps.MapTypeId.ROADMAP
			});

			// var infowindow = new google.maps.InfoWindow();
			var marker, i;
			var markers = new Array();
			for (i = 0; i < communities.length; i++) {  
				marker = new google.maps.Marker({
					position: new google.maps.LatLng(communities[i][1], communities[i][2]),
					map: cmap,
					// icon: 'https://harcrestnew.eastonpreview.com/wp-content/themes/harcrestroot/assets/img/harcrest-divider.png',
					content: communities[i][0]
				});
				markers.push(marker);
			}
				
			// 	google.maps.event.addListener(marker, 'click', (function(marker, i) {

			// 		return function() {
			// 			infowindow.setContent("<h4 class='mb-5 text-2xl font-serif text-blue'>"+communities[i][0]+"</h4>");
			// 			infowindow.open(cmap, marker);
			// 		}
			// 	})(marker, i));
			// }
		}
	</script>
	<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAtq-bYRZRKw0UYjaeO6T9kKjPstI6Iguk&callback=initMap"></script>
<?php } ?>

<script>
  (function(d) {
    var config = {
      kitId: 'uex0bxs',
      scriptTimeout: 3000,
      async: true
    },
    h=d.documentElement,t=setTimeout(function(){h.className=h.className.replace(/\bwf-loading\b/g,"")+" wf-inactive";},config.scriptTimeout),tk=d.createElement("script"),f=false,s=d.getElementsByTagName("script")[0],a;h.className+=" wf-loading";tk.src='https://use.typekit.net/'+config.kitId+'.js';tk.async=true;tk.onload=tk.onreadystatechange=function(){a=this.readyState;if(f||a&&a!="complete"&&a!="loaded")return;f=true;clearTimeout(t);try{Typekit.load(config)}catch(e){}};s.parentNode.insertBefore(tk,s)
  })(document);
</script>

</body>
</html>
