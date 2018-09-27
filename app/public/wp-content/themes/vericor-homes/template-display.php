<?php
/*
    Template Name: Display Template
 *
 *
 * The template for community displays
 *
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Vericor_Homes
 */

get_header();
$community_id = get_field('community_id');
$community_logo = get_field('community_logo');
?>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/4.17.10/lodash.min.js"></script>
	<script src="<?php echo get_template_directory_uri(); ?>/js/hammer.min.js"></script>
	<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
	<!-- <script src="https://unpkg.com/vue/dist/vue.js"></script> -->
	<script src="https://unpkg.com/vue/dist/vue.min.js"></script>
	<script src="https://unpkg.com/vue-router/dist/vue-router.js"></script>
	<script src="<?php echo get_template_directory_uri(); ?>/js/vue-touch.min.js"></script>
	<script src="<?php echo get_template_directory_uri(); ?>/js/vue-google-maps.js"></script>

	<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/assets/display.css" />

	<div id="primary" class="content-area font-sans relative">

		<main id="display-body" class="display-body relative" v-bind:class="{ 'show-side-menu': $route.path != '/' }">

            <nav class="bg-yellow display-main-nav absolute pin-l flex flex-col shadow-inner">
				<div class="display-main-nav--top px-6 py-12 flex flex-col justify-center items-center">
					<!-- pull logo in dynamic -->
					<router-link to="/" exact class="display-home-button">
						<img src="<?php echo $community_logo; ?>" class="absolute w-2/3 community-logo"/>
					</router-link>
					<nav class="side-menu w-4/5 absolute">
						<ul class="list-reset text-blue text-3xl text-center">
							<li class="py-3 border-t-2 cursor-pointer border-b-2 hover:font-bold">
								<router-link to="/community">Community</router-link>
							</li>
							<li class="py-3 border-b-2 cursor-pointer hover:font-bold">
								<router-link to="/models">Models</router-link>
							</li>
							<li class="py-3 border-b-2 cursor-pointer hover:font-bold">
								<router-link to="/homes">Homes</router-link>
							</li>
							<li class="py-3 border-b-2 cursor-pointer hover:font-bold">
								<router-link to="/sitemaps">Sitemaps</router-link>
							</li>
							<li class="py-3 border-b-2 cursor-pointer hover:font-bold">
								<router-link to="/area">Area</router-link>
							</li>
							<li class="py-3 border-b-2 cursor-pointer hover:font-bold">
								<router-link to="/amenities">Amenities</router-link>
							</li>
						</ul>
					</nav>
				</div>
				<div class="display-main-nav--bottom bg-blue flex justify-center items-center p-4">
					<img src="<?php echo get_template_directory_uri(); ?>/assets/vericor-display-logo.svg"/>
				</div>
			</nav>

			<router-view :model_pages="model_pages" :loading="loading" :model="model" :inventory_pages="inventory_pages" :display_info="display_info"></router-view>

		</main><!-- #display-body -->
        
	</div><!-- #primary -->

<script>
	const community_id = <?php echo $community_id; ?>;
	const display_id = <?php echo $post->ID; ?>;

	Vue.use(VueGoogleMaps, {
      load: {
        key: 'AIzaSyAtq-bYRZRKw0UYjaeO6T9kKjPstI6Iguk'
	  },
	  installComponents: false,
	  autobindAllEvents: false,
	});

	document.addEventListener('DOMContentLoaded', function() {
		Vue.component('google-map', VueGoogleMaps.Map);
		Vue.component('google-marker', VueGoogleMaps.Marker);
    });

	const DisplayHome = {
		template: `
			<transition name="fade">
				<!-- router with changing pages -->
				<div class="display-routed-page absolute pin-r">
					<router-link to="/community">
						<div class="display-home-block display-home-block-w-1/3 display-home-block-h-2/3 bg-blue-lightest absolute pin-l pin-t flex justify-center items-end pb-20 overflow-hidden cursor-pointer community-block">
							<!-- Community -->
							<!-- background image dynamic -->
							<div class="display-home-block-background absolute pin z-0" style="background-image: url('https://vericorstaging.eastonpreview.com/wp-content/themes/vericor-homes/assets/vericor-community-block-test.jpg');"></div>
							<!-- Title dynamic? -->
							<h1 class="leading-none text-5xl text-shadow-strong text-white tracking-wide uppercase mb-20 z-10">Community</h1>
						</div>
					</router-link>
					<router-link to="/models">
						<div class="display-home-block display-home-block-w-1/3 display-home-block-h-1/3 bg-blue-lightest absolute pin-t display-home-push-w-1/3 flex justify-center items-center overflow-hidden cursor-pointer models-block">
							<!-- Models -->
							<!-- background image dynamic -->
							<div class="display-home-block-background absolute pin z-0" style="background-image: url('https://vericorstaging.eastonpreview.com/wp-content/themes/vericor-homes/assets/vericor-models-block-test.jpg');"></div>
							<!-- Title dynamic? -->
							<h1 class="leading-none text-5xl text-shadow-strong text-white tracking-wide uppercase z-10">Models</h1>
						</div>
					</router-link>
					<router-link to="/homes">
						<div class="display-home-block display-home-block-w-1/3 display-home-block-h-1/3 bg-blue-lightest absolute pin-r pin-t flex justify-center items-center overflow-hidden cursor-pointer homes-block">
							<!-- Available Homes -->
							<!-- background image dynamic -->
							<div class="display-home-block-background absolute pin z-0" style="background-image: url('https://vericorstaging.eastonpreview.com/wp-content/themes/vericor-homes/assets/vericor-homes-block-test.jpg');"></div>
							<!-- Title dynamic? -->
							<h1 class="leading-none text-5xl text-shadow-strong text-white tracking-wide uppercase z-10">Available Homes</h1>
						</div>
					</router-link>
					<router-link to="/sitemaps">
						<div class="display-home-block display-home-block-w-2/3 display-home-block-h-1/3 bg-blue-lightest absolute pin-r display-home-push-h-1/3 flex justify-center items-center overflow-hidden cursor-pointer sitemap-block">
							<!-- Sitemaps -->
							<!-- background image dynamic -->
							<div class="display-home-block-background absolute pin z-0" style="background-image: url('https://vericorstaging.eastonpreview.com/wp-content/themes/vericor-homes/assets/vericor-sitemaps-block-test.jpg');"></div>
							<!-- Title dynamic? -->
							<h1 class="leading-none text-5xl text-shadow-strong text-white tracking-wide uppercase z-10">Site Maps</h1>
						</div>
					</router-link>
					<router-link to="/area">
						<div class="display-home-block display-home-block-w-2/3 display-home-block-h-1/3 bg-blue-lightest absolute pin-l pin-b flex justify-center items-center overflow-hidden cursor-pointer area-block">
							<!-- Area -->
							<!-- background image dynamic -->
							<div class="display-home-block-background absolute pin z-0" style="background-image: url('https://vericorstaging.eastonpreview.com/wp-content/themes/vericor-homes/assets/vericor-area-block-test.jpg');"></div>
							<!-- Title dynamic? -->
							<h1 class="leading-none text-5xl text-shadow-strong text-white tracking-wide uppercase z-10">Area</h1>
						</div>
					</router-link>
					<router-link to="/amenities">
						<div class="display-home-block display-home-block-w-1/3 display-home-block-h-1/3 bg-blue-lightest absolute pin-r pin-b flex justify-center items-center overflow-hidden cursor-pointer amenities-block">
							<!-- Amenities -->
							<!-- background image dynamic -->
							<div class="display-home-block-background absolute pin z-0" style="background-image: url('https://vericorstaging.eastonpreview.com/wp-content/themes/vericor-homes/assets/vericor-amenities-block-test.jpg');"></div>
							<!-- Title dynamic? -->
							<h1 class="leading-none text-5xl text-shadow-strong text-white tracking-wide uppercase z-10">Amenities</h1>
						</div>
					</router-link>
				</div>
			</transition>
		`
	}

	const DisplayCommunity = {
		props: ['display_info', 'loading'],
		data () {
			return {
				community_blocks: null,
				community_blocks_loading: true,
				community_blocks_empty: null
			}
		},
		mounted () {
			if ( this.display_info ) { //if the user starts at a page before the community page
				setTimeout(() => {
					this.community_blocks = this.display_info.community_blocks
					console.log(this.community_blocks)

					if ( this.community_blocks.length < 1 ) {
						this.community_blocks_empty = true
					}
					this.community_blocks_loading = false
				}, 240);
			} else { //this condition is if the page is reset on an community page
				setTimeout(() => {
					this.community_blocks = this.display_info.community_blocks
					console.log(this.community_blocks)
					
					if ( this.community_blocks.length < 1 ) {
						this.community_blocks_empty = true
					}
					this.community_blocks_loading = false
				}, 1750);
			}			
		},
		template: `
			<transition name="fade">
				<transition name="fade" v-if="community_blocks_loading">
					<div class="display-routed-page absolute pin-r grid-container pt-display pr-display overflow-scroll">
						<div class="bg-blue-lightest grid-item grid-item-h-2/3 grid-item-order-first"></div>
						<div class="bg-blue-lightest grid-item grid-item-w-2/3 grid-item-order-2"></div>
						<div class="bg-blue-lightest grid-item grid-item-w-2/3 grid-item-order-2"></div>
						<div class="bg-blue-lightest grid-item grid-item-order-1"></div>
						<div class="bg-blue-lightest grid-item grid-item-order-1"></div>
						<div class="bg-blue-lightest grid-item grid-item-order-last"></div>
					</div>
				</transition>
				<div class="display-routed-page absolute pin-r pt-display pr-display overflow-scroll" v-if="!community_blocks_loading">
					<div class="grid-container">
						<div 
							class="grid-item bg-blue-lightest flex items-end shadow hover:shadow-md relative bg-cover bg-center p-6"
							v-for="(block, index) in community_blocks" :key="block.community_block_title"
							v-bind:class="[block.community_block_size, block.community_block_order]"
							v-bind:style="{'background-image': 'url('+block.community_block_image.url+')'}"
						>
							<span
								class="absolute pin grid-item-hidden flex text-white text-xl font-light p-6"
								v-bind:class="block.community_block_color"
							>
								<img v-bind:src="block.community_block_icon.url"/>
								<span v-html="block.community_block_copy"></span>
							</span>
							<h1 class="text-white text-shadow-strong font-light">{{block.community_block_title}}</h1>
						</div>
					</div>
				</div>
			</transition>
		`
	}
	const DisplayArea = { 
		props: ['display_info', 'loading'],
		data () {
			return {
				map: null,
				center: null,
				area_latitude: 37.403548,
				area_longitude: -77.692105,
				map_center: {'lat': 37.466794, 'lng': -77.629605},
				show_reset: false,
				map_zoom: 12,
				area_loading: true,
				area_coords: {'lat': 37.466794, 'lng': -77.629605},
				scroll_position: 0,
				area_icon: 'https://vericorstaging.eastonpreview.com/wp-content/themes/vericor-homes/assets/vericor-blue-logo-only.png',
				area_schools: null,
				school_icon: 'https://vericorstaging.eastonpreview.com/wp-content/themes/vericor-homes/assets/university.svg',
				area_restaurants: null,
				restaurant_icon: 'https://vericorstaging.eastonpreview.com/wp-content/themes/vericor-homes/assets/restaurant.svg',
				area_grocery: null,
				grocery_icon: 'https://vericorstaging.eastonpreview.com/wp-content/themes/vericor-homes/assets/grocery.svg',
				area_shopping: null,
				shopping_icon: 'https://vericorstaging.eastonpreview.com/wp-content/themes/vericor-homes/assets/department.svg',
				area_entertainment: null,
				entertainment_icon: 'https://vericorstaging.eastonpreview.com/wp-content/themes/vericor-homes/assets/entertainment.svg',
				area_healthcare: null,
				healthcare_icon: 'https://vericorstaging.eastonpreview.com/wp-content/themes/vericor-homes/assets/health.svg',
			}
		},
		methods: {
			focusMapItem: function (lat, lng) {
				this.map_center = {'lat': lat*1, 'lng': lng*1}
				this.map_zoom = 17
				this.show_reset = true
			},
			resetMap: function () {
				this.map_center = this.area_coords
				this.map_zoom = 12
				this.show_reset = false
			},
			updateScroll() {
				this.scroll_position = document.getElementById('places-scroll').scrollTop
				console.log(this.scroll_position)
			}
		},
		mounted () {
			if ( this.display_info ) { //if the user starts at a page before the community page
				setTimeout(() => {
					if ( this.display_info.area_latitude && this.display_info.area_longitude) {
						this.area_latitude = this.display_info.area_latitude
						this.area_longitude = this.display_info.area_longitude
					}
					console.log(this.area_latitude)
					console.log(this.area_longitude)

					if ( this.display_info.area_nearby_schools ) {
						this.area_schools = this.display_info.area_nearby_schools
					}
					if ( this.display_info.area_nearby_restaurants ) {
						this.area_restaurants = this.display_info.area_nearby_restaurants
					}
					if ( this.display_info.area_nearby_grocery ) {
						this.area_grocery = this.display_info.area_nearby_grocery
					}
					if ( this.display_info.area_nearby_shopping ) {
						this.area_shopping = this.display_info.area_nearby_shopping
					}
					if ( this.display_info.area_nearby_entertainment ) {
						this.area_entertainment = this.display_info.area_nearby_entertainment
					}
					if ( this.display_info.area_nearby_healthcare ) {
						this.area_healthcare = this.display_info.area_nearby_healthcare
					}

					if ( this.display_info.area_custom_logo ) {
						this.area_icon = this.display_info.area_custom_logo
					}
					
					this.area_loading = false
				}, 240);
			} else { //this condition is if the page is reset on an community page
				setTimeout(() => {					  
					if ( this.display_info.area_latitude && this.display_info.area_longitude) {
						this.area_latitude = this.display_info.area_latitude
						this.area_longitude = this.display_info.area_longitude
					}
					console.log(this.area_latitude)
					console.log(this.area_longitude)

					if ( this.display_info.area_nearby_schools ) {
						this.area_schools = this.display_info.area_nearby_schools
					}
					if ( this.display_info.area_nearby_restaurants ) {
						this.area_restaurants = this.display_info.area_nearby_restaurants
					}
					if ( this.display_info.area_nearby_grocery ) {
						this.area_grocery = this.display_info.area_nearby_grocery
					}
					if ( this.display_info.area_nearby_shopping ) {
						this.area_shopping = this.display_info.area_nearby_shopping
					}
					if ( this.display_info.area_nearby_entertainment ) {
						this.area_entertainment = this.display_info.area_nearby_entertainment
					}
					if ( this.display_info.area_nearby_healthcare ) {
						this.area_healthcare = this.display_info.area_nearby_healthcare
					}

					if ( this.display_info.area_custom_logo ) {
						this.area_icon = this.display_info.area_custom_logo
					}

					this.area_loading = false
				}, 2250);
			}
			
		},
		template: `
			<transition name="fade">
				<div class="display-routed-page absolute pin-r pt-display mb-display shadow-inner" v-if="area_loading">
					<div class="relative">
						<div class="bg-gray-lightest" style="width: 1224px; height: 1060px;"></div>
						<div class="absolute mr-display pin-r pin-t shadow-inner h-full bg-blue-lightest" style="width: 378px"></div>
					</div>
				</div>
				<div class="display-routed-page absolute pin-r pt-display mb-display shadow-inner" v-if="!area_loading">
					<div class="relative">
						<google-map :center="map_center" :zoom="map_zoom" style="width: 1224px; height: 1060px" class="shadow-inner">
							<google-marker
								:key="map-center"
								:position="{'lat': area_latitude*1, 'lng': area_longitude*1}"
								:icon="area_icon"
							/>
							<google-marker
								v-for="(school, index) in area_schools"
								v-if="area_schools"
								:key="'area-school'+index"
								:position="{'lat': school.school_latitude*1, 'lng': school.school_longitude*1}"
								:icon="school_icon"
							/>
							<google-marker
								v-for="(restaurant, index) in area_restaurants"
								v-if="area_restaurants"
								:key="'area-restaurant'+index"
								:position="{'lat': restaurant.restaurant_latitude*1, 'lng': restaurant.restaurant_longitude*1}"
								:icon="restaurant_icon"
							/>
							<google-marker
								v-for="(grocery, index) in area_grocery"
								v-if="area_grocery"
								:key="'area-grocery'+index"
								:position="{'lat': grocery.grocery_latitude*1, 'lng': grocery.grocery_longitude*1}"
								:icon="grocery_icon"
							/>
							<google-marker
								v-for="(shopping, index) in area_shopping"
								v-if="shopping"
								:key="'area-shopping'+index"
								:position="{'lat': shopping.shopping_latitude*1, 'lng': shopping.shopping_longitude*1}"
								:icon="shopping_icon"
							/>
							<google-marker
								v-for="(entertainment, index) in area_entertainment"
								v-if="area_entertainment"
								:key="'area-entertainment'+index"
								:position="{'lat': entertainment.entertainment_latitude*1, 'lng': entertainment.entertainment_longitude*1}"
								:icon="entertainment_icon"
							/>
							<google-marker
								v-for="(healthcare, index) in area_healthcare"
								v-if="area_healthcare"
								:key="'area-healthcare'+index"
								:position="{'lat': healthcare.healthcare_latitude*1, 'lng': healthcare.healthcare_longitude*1}"
								:icon="healthcare_icon"
							/>
						</google-map>
						<button 
							class="bg-white btn flex font-bold h-12 items-center justify-center rounded shadow-md text-blue text-xl w-1/4 absolute mb-6 pin-b pin-l"
							style="left: 409.25px"
							v-if="show_reset"
							v-on:click="resetMap()"
						>Reset Map</button>
						<div class="absolute mr-display pin-r pin-t shadow-inner h-full bg-blue-lightest overflow-hidden places" style="width: 378px" :class="{ 'at-top': scroll_position === 0, 'at-bottom': scroll_position === 1760 }">
							<div 
								class="p-3 overflow-scroll" 
								style="height: 1070px" 
								id="places-scroll" 
								v-on:scroll="updateScroll"
							>
								<section class="mb-3 pb-3 border-b-2 border-dashed border-blue-lighter" v-if="area_schools">
									<h1 class="text-3xl text-blue text-center font-bold mb-3">Schools</h1>
									<div 
										class="shadow hover:shadow-md bg-white p-3 mb-3 rounded border-blue-lighter border-t-4 hover:border-blue flex items-center text-blue-lighter hover:text-blue"
										v-for="(school, index) in area_schools"
										v-on:click="focusMapItem(school.school_latitude, school.school_longitude)"
									>
										<div>
											<svg version="1.2" baseProfile="tiny" xmlns="http://www.w3.org/2000/svg" width="40" height="40" class="fill-current" viewBox="0 0 50 50" overflow="inherit"><path d="M24.999 27.381c-5.406 0-9.999 1.572-12.999 4.036v4.583h26v-4.583c-3-2.464-7.594-4.036-13.001-4.036zm23.871-2.352l-23.934-11.029-23.924 11.029 3.988 1.825v2.807c-1 .207-1.003.731-1.003 1.354 0 .368.122.799.354 1.057l-1.368 2.928h4.88l-1.356-2.93c.228-.258.415-.638.415-1.006 0-.622-.922-1.197-.922-1.404v-2.337l5 2.246v-.199c3-2.609 8.271-4.265 13.998-4.265 5.729 0 11.002 1.656 14.002 4.265v.199l9.87-4.54z"/></svg>
										</div>
										<div class="flex flex-col justify-center pl-3">
											<h1 class="text-lg mb-1 text-gray">{{school.school_name}}</h1>
											<p class="text-gray text-sm">School</p>
										</div>
									</div>
								</section>
								<section class="mb-3 pb-3 border-b-2 border-dashed border-blue-lighter" v-if="area_restaurants">
									<h1 class="text-3xl text-blue text-center font-bold mb-3">Restaurants</h1>
									<div 
										class="shadow hover:shadow-md bg-white p-3 mb-3 rounded border-blue-lighter border-t-4 hover:border-blue flex items-center text-blue-lighter hover:text-blue"
										v-for="(restaurant, index) in area_restaurants"
										v-on:click="focusMapItem(restaurant.restaurant_latitude, restaurant.restaurant_longitude)"
									>
										<div>
										<svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 25 25" width="40" height="40" class="fill-current"><title>restaurant</title><path d="M11,.73V6.38H10V.76a.51.51,0,0,0-1,0V6.38h-1V.74a.51.51,0,0,0-1,0V6.38h-1V.77a.51.51,0,0,0-1,0V8.12A1.93,1.93,0,0,0,6.89,9.89V23.22a1.53,1.53,0,0,0,3.06,0V9.89a2,2,0,0,0,2-1.64V.74A.51.51,0,0,0,11,.73Zm4.59,1.56V15.05h1v8.17c0,2,3.58,2,3.58,0V2.29C20.16-.26,15.56-.26,15.56,2.29Z"/></svg>
										</div>
										<div class="flex flex-col justify-center pl-3">
											<h1 class="text-lg mb-1 text-gray">{{restaurant.restaurant_name}}</h1>
											<p class="text-gray text-sm">Restaurant</p>
										</div>
									</div>
								</section>
								<section class="mb-3 pb-3 border-b-2 border-dashed border-blue-lighter" v-if="area_grocery">
									<h1 class="text-3xl text-blue text-center font-bold mb-3">Grocery</h1>
									<div 
										class="shadow hover:shadow-md bg-white p-3 mb-3 rounded border-blue-lighter border-t-4 hover:border-blue flex items-center text-blue-lighter hover:text-blue"
										v-for="(grocery, index) in area_grocery"
										v-on:click="focusMapItem(grocery.grocery_latitude, grocery.grocery_longitude)"
									>
										<div>
											<svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 25 25" width="40" height="40" class="fill-current"><title>grocery</title><circle cx="22.05" cy="20.34" r="1.96"/><circle cx="7.85" cy="20.34" r="1.96"/><path d="M23.52,15.93H8.22l.33-.53a1,1,0,0,0,.12-.76l-.32-1.23,14.19-.74a1,1,0,0,0,1-1V5.15a1,1,0,0,0-1-1H6l-.2-.73a1,1,0,0,0-.94-.74H1.48a1,1,0,0,0,0,2H4.05L6.66,14.73l-1,1.66a1,1,0,0,0,.83,1.5H23.52a1,1,0,0,0,0-2Z"/></svg>
										</div>
										<div class="flex flex-col justify-center pl-3">
											<h1 class="text-lg mb-1 text-gray">{{grocery.grocery_name}}</h1>
											<p class="text-gray text-sm">Grocery</p>
										</div>
									</div>
								</section>
								<section class="mb-3 pb-3 border-b-2 border-dashed border-blue-lighter" v-if="area_shopping">
									<h1 class="text-3xl text-blue text-center font-bold mb-3">Shopping</h1>
									<div 
										class="shadow hover:shadow-md bg-white p-3 mb-3 rounded border-blue-lighter border-t-4 hover:border-blue flex items-center text-blue-lighter hover:text-blue"
										v-for="(shopping, index) in area_shopping"
										v-on:click="focusMapItem(shopping.shopping_latitude, shopping.shopping_longitude)"
									>
										<div>
											<svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 25 25" width="40" height="40" class="fill-current"><title>department</title><path d="M17.42,5.05V3.37A2.77,2.77,0,0,0,14.88.63h-4.6a3,3,0,0,0-2.8,2.74V5.05H4.55L1.41,24.37H23.59L20.4,5.05ZM9.14,3.37a1.28,1.28,0,0,1,1.14-1.08h4.6a1,1,0,0,1,.88,1.08V5.05H9.14Z"/></svg>
										</div>
										<div class="flex flex-col justify-center pl-3">
											<h1 class="text-lg mb-1 text-gray">{{shopping.shopping_name}}</h1>
											<p class="text-gray text-sm">Shopping</p>
										</div>
									</div>
								</section>
								<section class="mb-3 pb-3 border-b-2 border-dashed border-blue-lighter" v-if="area_entertainment">
									<h1 class="text-3xl text-blue text-center font-bold mb-3">Shopping</h1>
									<div 
										class="shadow hover:shadow-md bg-white p-3 mb-3 rounded border-blue-lighter border-t-4 hover:border-blue flex items-center text-blue-lighter hover:text-blue"
										v-for="(entertainment, index) in area_entertainment"
										v-on:click="focusMapItem(entertainment.entertainment_latitude, entertainment.entertainment_longitude)"
									>
										<div>
											<svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 25 25" width="40" height="40" class="fill-current"><title>entertainment</title><path d="M5.73.5A1.24,1.24,0,0,0,4.5,1.76V23.24A1.34,1.34,0,0,0,5.73,24.5,1.34,1.34,0,0,0,7,23.24V10.29A3.21,3.21,0,0,1,8.19,10c2.46,0,6.1,3.16,8.62,3.16a6.61,6.61,0,0,0,3.69-1.26V3C19.28,4,18,4.92,16.81,4.92c-2.46,0-6.15-3.16-8.62-3.16A6.48,6.48,0,0,0,7,1.92V1.76A1.24,1.24,0,0,0,5.73.5Z"/></svg>
										</div>
										<div class="flex flex-col justify-center pl-3">
											<h1 class="text-lg mb-1 text-gray">{{entertainment.entertainment_name}}</h1>
											<p class="text-gray text-sm">Entertainment</p>
										</div>
									</div>
								</section>
								<section v-if="area_healthcare">
									<h1 class="text-3xl text-blue text-center font-bold mb-3">Healthcare</h1>
									<div 
										class="shadow hover:shadow-md bg-white p-3 mb-3 rounded border-blue-lighter border-t-4 hover:border-blue flex items-center text-blue-lighter hover:text-blue"
										v-for="(healthcare, index) in area_healthcare"
										v-on:click="focusMapItem(healthcare.healthcare_latitude, healthcare.healthcare_longitude)"
									>
										<div>
											<svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 25 25" width="40" height="40" class="fill-current"><title>health</title><path d="M25,8.33a.52.52,0,0,0-.52-.52H17.71a.52.52,0,0,1-.52-.52V.52A.52.52,0,0,0,16.67,0H8.33a.52.52,0,0,0-.52.52V7.29a.52.52,0,0,1-.52.52H.52A.52.52,0,0,0,0,8.33v8.34a.52.52,0,0,0,.52.52H7.29a.52.52,0,0,1,.52.52v6.77a.52.52,0,0,0,.52.52h8.34a.52.52,0,0,0,.52-.52V17.71a.52.52,0,0,1,.52-.52h6.77a.52.52,0,0,0,.52-.52Z"/></svg>
										</div>
										<div class="flex flex-col justify-center pl-3">
											<h1 class="text-lg mb-1 text-gray">{{healthcare.healthcare_name}}</h1>
											<p class="text-gray text-sm">Healthcare</p>
										</div>
									</div>
								</section>
							</div>
						</div>
					</div>
				</div>
			</transition>
		`
	}
	const DisplayAmenities = { 
		props: ['display_info', 'loading'],
		data () {
			return {
				amenities: null,
				amenity_header: null,
				amenity_copy: null,
				amenity_featured_image: null,
				amenity_image_two: null,
				amenity_image_three: null,
				amenities_loading: true
			}
		},
		mounted () {
			if ( this.display_info ) { //if the user starts at a page before the community page
				setTimeout(() => {
					if ( this.display_info.amenity_blocks) {
						this.amenities = this.display_info.amenity_blocks
					}
					console.log(this.amenities)

					if ( this.display_info.amenity_copy) {
						this.amenity_copy = this.display_info.amenity_copy
					}

					if ( this.display_info.amenity_featured_image) {
						this.amenity_featured_image = this.display_info.amenity_featured_image
					}

					if ( this.display_info.amenity_image_two) {
						this.amenity_image_two = this.display_info.amenity_image_two
					}

					if ( this.display_info.amenity_image_three) {
						this.amenity_image_three = this.display_info.amenity_image_three
					}
					
					this.amenities_loading = false
				}, 240);
			} else { //this condition is if the page is reset on an community page
				setTimeout(() => {					  
					if ( this.display_info.amenity_blocks) {
						this.amenities = this.display_info.amenity_blocks
					}
					console.log(this.amenities)
					
					if ( this.display_info.amenity_copy) {
						this.amenity_copy = this.display_info.amenity_copy
					}

					if ( this.display_info.amenity_featured_image) {
						this.amenity_featured_image = this.display_info.amenity_featured_image
					}

					if ( this.display_info.amenity_image_two) {
						this.amenity_image_two = this.display_info.amenity_image_two
					}

					if ( this.display_info.amenity_image_three) {
						this.amenity_image_three = this.display_info.amenity_image_three
					}

					this.amenities_loading = false
				}, 2000);
			}
			
		},
		template: `
			<transition name="fade">
				<div class="display-routed-page absolute pin-r br-display bt-display pb-display">
					<div class="flex h-full">
        				<div class="bg-yellow-lighter br-display shadow-inner text-blue" style="width: 552px;">
							<div class="flex flex-col">
								<img v-bind:src="amenity_featured_image.url" v-if="amenity_featured_image">
								<div class="flex flex-row" v-if="amenity_image_two && amenity_image_three">
									<img v-bind:src="amenity_image_two">
									<img v-bind:src="amenity_image_three">
								</div>
							</div>

							<div class="p-5 amenity-copy" v-html="amenity_copy" v-if="amenity_copy"></div>

						</div>
        				<div class="bg-blue-lightest flex flex-row flex-wrap shadow-inner" style="width: 1060px;">
							<div
								class="border border-blue p-3 flex flex-col justify-center items-center amenity-block w-1/3 h-1/3"
								v-for="(amenity, index) in amenities"
							>
								<div class="flex flex-col justify-center items-center h-full w-full border-2 border-transparent p-2">
									<img v-bind:src="amenity.amenity_block_icon.url" class="mb-5 w-1/6">
									<h3 class="border-b-2 font-serif mb-3 pb-3 text-3xl text-blue">{{amenity.amenity_block_title}}</h3>
									<p class="text-center leading-normal amenity-block-caption">{{amenity.amenity_block_caption}}</p>
									<p class="text-center leading-normal amenity-block-detail">{{amenity.amenity_block_detail}}</p>
								</div>
							</div>
						</div>
    				</div>
				</div>
			</transition>
		`
	}
	const DisplayModels = {
		props: ['model_pages', 'loading'],
		computed: {
			orderedModels: function () {
				return _.orderBy(this.model_pages, 'title.rendered')
			}
		},
		template: `
			<transition name="fade">
				<div class="display-routed-page pt-display absolute pin-r overflow-scroll">
					<div class="flex flex-row flex-wrap">
						<transition name="fade">
							<div class="flex flex-row flex-wrap" v-if="loading">
								<div class="display-model-block mr-display mb-display bg-blue-lightest loading-block"></div>
								<div class="display-model-block mr-display mb-display bg-blue-lightest loading-block"></div>
								<div class="display-model-block mr-display mb-display bg-blue-lightest loading-block"></div>
								<div class="display-model-block mr-display mb-display bg-blue-lightest loading-block"></div>
								<div class="display-model-block mr-display mb-display bg-blue-lightest loading-block"></div>
								<div class="display-model-block mr-display mb-display bg-blue-lightest loading-block"></div>
							</div>
						</transition>	
						<div class="display-model-block mr-display mb-display bg-blue-lightest relative shadow hover:shadow-lg" v-for="(model, index) in orderedModels" :key="model.id" v-if="!loading">
							<router-link :to="'/models/'+model.id">
								<span class="absolute pin mr-display mb-display"></span>
							</router-link>
							<img v-bind:src="model.acf.model_photo_gallery[0].url" v-if="model.acf.model_photo_gallery[0]"/>
							<img src="https://vericorstaging.eastonpreview.com/wp-content/uploads/2018/08/1920x1080.png" v-if="!model.acf.model_photo_gallery[0]" />
							<div class="model-block-title absolute pin-b w-full flex justify-center items-center py-4">
								<h2 class="mb-0 text-4xl text-blue">{{ model.title.rendered }}</h2>
							</div>
						</div>		
					</div>
				</div>
			</transition>
		`
	}
	const DisplayModelsCollection = { 
		template: `
			<transition name="fade">
				<div class="display-routed-page absolute pin-r">Models Collection</div>
			</transition>
		`
	}
	const DisplayModelsIndividual = {
		props: ['model_pages', 'loading'],
		data () {
			return {
				model: null,
				model_loading: true,
				model_empty: false,
				gallery_index: 0,
				gallery_max: 0,
				floor_plan_index: 0,
				floor_plan_max: 0,
				no_details: false
			}
		},
		methods: {
			changeFloorPlanImage: function (index) {
				this.floor_plan_index = index
			},
			galleryIndexIncrease: function () {
				console.log('gallery_max', this.gallery_max)
				this.gallery_index++
				console.log('gallery_index', this.gallery_index)
				if ( this.gallery_index >= this.gallery_max) {
					this.gallery_index = 0
					console.log('gallery_index', this.gallery_index)
				}
			},
			galleryIndexDecrease: function () {
				console.log('gallery_max', this.gallery_max)
				
				if ( this.gallery_index > 0 ) {
					this.gallery_index--
					console.log('gallery_index', this.gallery_index)
				} else {
					this.gallery_index = this.gallery_max - 1
					console.log('gallery_index', this.gallery_index)
				}
			},
			floorPlanIndexIncrease: function () {
				console.log('floor_plan_max', this.floor_plan_max)
				this.floor_plan_index++
				console.log('floor_plan_index', this.floor_plan_index)
				if ( this.floor_plan_index >= this.floor_plan_max) {
					this.floor_plan_index = 0
					console.log('floor_plan_index', this.floor_plan_index)
				}
			},
			floorPlanIndexDecrease: function () {
				console.log('floor_plan_max', this.floor_plan_max)
				
				if ( this.floor_plan_index > 0 ) {
					this.floor_plan_index--
					console.log('floor_plan_index', this.floor_plan_index)
				} else {
					this.floor_plan_index = this.floor_plan_max - 1
					console.log('floor_plan_index', this.floor_plan_index)
				}
			}
		},
		mounted () {
			this.model_id = this.$route.params.model_id
			if ( this.model_pages ) { //if the user starts at a page before the individual model page
				setTimeout(() => {
					this.model = this.model_pages.filter(m => m.id == this.model_id)
					console.log(this.model)
					if ( this.model[0].acf.model_photo_gallery ) {
						this.gallery_max = this.model[0].acf.model_photo_gallery.length
					}
					if ( this.model[0].acf.floor_plans ) {
						this.floor_plan_max = this.model[0].acf.floor_plans.length
					}

					if ( !this.model[0].acf.floor_plans && !this.model[0].acf.model_photo_gallery && !this.model[0].acf.color_picker ) {
						this.no_details = true
					}
					this.model_loading = false
				}, 240);
			} else { //this condition is if the page is reset on an individual model page
				setTimeout(() => {
					this.model = this.model_pages.filter(m => m.id == this.model_id)
					console.log(this.model)
					if ( this.model[0].acf.model_photo_gallery ) {
						this.gallery_max = this.model[0].acf.model_photo_gallery.length
					}
					if ( this.model[0].acf.floor_plans ) {
						this.floor_plan_max = this.model[0].acf.floor_plans.length
					}

					if ( !this.model[0].acf.floor_plans && !this.model[0].acf.model_photo_gallery && !this.model[0].acf.color_picker ) {
						this.no_details = true
					}
					this.model_loading = false
				}, 2000);
			}
						
		},
		
		template: `
			<transition name="fade">
					<div class="display-routed-page pt-display pr-display pb-display absolute pin-r" v-if="model_loading">
						<div class="display-sub-navigation flex justify-center items-center">
							<div class="bg-blue sub-navigation-item text-white text-3xl"><span class="block h-8"></span></div>
							<div class="bg-yellow-lighter sub-navigation-item text-blue font-bold text-3xl shadow-inner"><span class="block h-8"></span></div>
						</div>
						<div class="flex flex-row flex-wrap h-full" style="height: 968px">
							<div class="w-1/2 bg-gray-lightest br-display">
								<div class="skeleton-model-image bg-gray w-full"></div>
								<p class="text-5xl text-blue text-center font-serif my-2">Loading Model</p>
								<div class="bg-blue-lightest flex items-center justify-between py-2 shadow-inner">
									<div class="flex flex-col items-center justify-center px-3">
										<p class="font-bold mb-1 text-4xl text-blue">-</p>
										<p class="text-gray text-xl">Beds</p>
									</div>
									<div class="flex flex-col items-center justify-center px-3">
										<p class="font-bold mb-1 text-4xl text-blue">-</p>
										<p class="text-gray text-xl">Baths</p>
									</div>
									<div class="flex flex-col items-center justify-center px-3">
										<p class="font-bold mb-1 text-3xl text-center text-blue">-</p>
										<p class="text-gray text-xl">Garage</p>
									</div>
									<div class="flex flex-col items-center justify-center px-3">
										<p class="font-bold mb-1 text-4xl text-blue">-</p>
										<p class="text-gray text-xl">Stories</p>
									</div>
									<div class="flex flex-col items-center justify-center px-3">
										<p class="font-bold mb-1 text-3xl text-center text-blue">-</p>
										<p class="text-gray text-xl">Sq. Ft.</p>
									</div>
									<div class="flex flex-col items-center justify-center px-3">
										<p class="font-bold text-3xl text-5xl text-blue">\$---,---</p>
									</div>
								</div>
								<div 
									class="leading-tight overflow-scroll px-3 text-lg wp-content shadow-inner bt-display py-3 model-content no-detail"
								></div>
							</div>
							<div class="w-1/2 bg-gray-lightest">
								<div class="floor-plan-wrapper flex flex-col h-full">
									<div class="floor-plan-navigation py-4 bg-gray-lightest shadow-inner">
										<ul class="list-reset flex justify-center items-center">
											<li class="w-1/4">
												<p
													class="bg-blue btn flex font-bold h-12 hover:bg-blue-dark items-center justify-center rounded shadow text-white text-center text-xl mx-3"
												>
													First Floor
												</p>
											</li>
											<li class="w-1/4">
												<p
													class="bg-blue btn flex font-bold h-12 hover:bg-blue-dark items-center justify-center rounded shadow text-white text-center text-xl mx-3"
												>
													Second Floor
												</p>
											</li>
										</ul>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="display-routed-page pt-display pr-display pb-display absolute pin-r" v-if="!model_loading">
						<div class="display-sub-navigation flex justify-center items-center">
							<div class="bg-blue sub-navigation-item text-white text-3xl flex justify-center"><router-link to="/models" class="flex-grow">Models</router-link></div>
							<div class="bg-yellow-lighter sub-navigation-item text-blue font-bold text-3xl shadow-inner flex justify-center"><span>{{model[0].title.rendered}}</span></div>
						</div>
						<div class="flex flex-row flex-wrap h-full" style="height: 968px">
							<div class="w-1/2 bg-gray-lightest br-display">
								<v-touch 
									v-on:swipeleft="galleryIndexIncrease"
									v-on:swiperight="galleryIndexDecrease"
									v-if="model[0].acf.model_photo_gallery"
									class="overflow-hidden relative"
								>
									<img 
											v-for="(mpg, index) in model[0].acf.model_photo_gallery"
											:src="mpg.url"
											:class="{ 'active': index === gallery_index }"
											class="model-elevation-image"
									/>
									<p
										v-for="(mpg, index) in model[0].acf.model_photo_gallery"
										:class="{ 'active': index === gallery_index }"
										class="absolute gallery-caption mb-8 ml-5 pin-b pin-l text-xl text-shadow-strong"
									>
										{{mpg.caption}}
									</p>
									<div class="absolute gallery-prev h-12 m-auto pin-b pin-t text-white w-12" v-if="model[0].acf.model_photo_gallery && model[0].acf.model_photo_gallery.length > 1" v-on:click="galleryIndexDecrease">
										<svg viewBox="0 0 20 20" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="fill-current">
											<g id="Page-1" stroke="none" stroke-width="1" fill-rule="evenodd">
												<g id="icon-shape">
													<polygon id="Combined-Shape" points="7.05025253 9.29289322 6.34314575 10 12 15.6568542 13.4142136 14.2426407 9.17157288 10 13.4142136 5.75735931 12 4.34314575"></polygon>							</g>
											</g>
										</svg>
									</div>
									<div class="absolute gallery-next h-12 m-auto pin-b pin-r pin-t text-white w-12" v-if="model[0].acf.model_photo_gallery && model[0].acf.model_photo_gallery.length > 1" v-on:click="galleryIndexIncrease">
										<svg viewBox="0 0 20 20" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="fill-current">
											<g id="Page-1" stroke="none" stroke-width="1" fill-rule="evenodd">
												<g id="icon-shape">
													<polygon id="Combined-Shape" points="12.9497475 10.7071068 13.6568542 10 8 4.34314575 6.58578644 5.75735931 10.8284271 10 6.58578644 14.2426407 8 15.6568542 12.9497475 10.7071068"></polygon>
												</g>
											</g>
										</svg>
									</div>
								</v-touch>
								<img src="https://vericorstaging.eastonpreview.com/wp-content/uploads/2018/08/1920x1080.png" v-if="!model[0].acf.model_photo_gallery[0]" />
								<p class="text-5xl text-blue text-center font-serif my-2">{{model[0].title.rendered}}</p>
								<div class="bg-blue-lightest flex items-center justify-between py-2 shadow-inner">
									<div class="flex flex-col items-center justify-center px-3">
										<p class="font-bold mb-1 text-4xl text-blue" v-if="model[0].acf.bedrooms">{{model[0].acf.bedrooms}}</p>
										<p class="font-bold mb-1 text-3xl text-blue" v-if="!model[0].acf.bedrooms">N/A</p>
										<p class="text-gray text-xl">Beds</p>
									</div>
									<div class="flex flex-col items-center justify-center px-3">
										<p class="font-bold mb-1 text-4xl text-blue" v-if="model[0].acf.bathrooms">{{model[0].acf.bathrooms}}</p>
										<p class="font-bold mb-1 text-3xl text-blue" v-if="!model[0].acf.bathrooms">N/A</p>
										<p class="text-gray text-xl">Baths</p>
									</div>
									<div class="flex flex-col items-center justify-center px-3" v-bind:class="{'flex-basis-20': model[0].acf.starting_from_price}">
										<p class="font-bold mb-1 text-3xl text-center text-blue" v-if="model[0].acf.garage" style="line-height: 41px">{{model[0].acf.garage}}</p>
										<p class="font-bold mb-1 text-3xl text-blue" v-if="!model[0].acf.garage">N/A</p>
										<p class="text-gray text-xl">Garage</p>
									</div>
									<div class="flex flex-col items-center justify-center px-3">
										<p class="font-bold mb-1 text-4xl text-blue" v-if="model[0].acf.stories">{{model[0].acf.stories}}</p>
										<p class="font-bold mb-1 text-3xl text-blue" v-if="!model[0].acf.stories">N/A</p>
										<p class="text-gray text-xl">Stories</p>
									</div>
									<div class="flex flex-col items-center justify-center px-3" v-bind:class="{'flex-basis-45': model[0].acf.starting_from_price}">
										<p class="font-bold mb-1 text-3xl text-center text-blue" v-if="model[0].acf.square_feet" style="line-height: 41px">{{model[0].acf.square_feet}}</p>
										<p class="font-bold mb-1 text-3xl text-blue" v-if="!model[0].acf.square_feet">N/A</p>
										<p class="text-gray text-xl">Sq. Ft.</p>
									</div>
									<div class="flex flex-col items-center justify-center px-3">
										<p class="font-bold text-4xl text-blue" v-if="!model[0].acf.starting_from_price">\${{model[0].acf.price}}</p>
										<p class="font-bold text-3xl text-center text-blue" v-if="model[0].acf.starting_from_price">{{model[0].acf.starting_from_price}}</p>
									</div>
								</div>
								<div 
									v-html="model[0].content.rendered" 
									class="leading-tight overflow-scroll px-3 text-lg wp-content shadow-inner bt-display py-3 model-content"
									v-bind:class="{ 'no\-detail': no_details }"
								></div>
								<div 
									class="flex justify-center items-center bt-display shadow-inner" style="height: 78px"
									v-bind:class="{ 'details': !no_details }"
								>
									<router-link 
										:to="'/models/'+$route.params.model_id+'/virtual-tour'"
										class="bg-blue btn flex font-bold h-12 hover:bg-blue-dark hover:text-yellow items-center justify-center rounded shadow text-white text-xl w-1/4 mx-3"
										v-if="model[0].acf.virtual_tour"
									>
										Virtual Tour
									</router-link>
									<router-link 
										:to="'/models/'+$route.params.model_id+'/photo-gallery'"
										class="bg-blue btn flex font-bold h-12 hover:bg-blue-dark hover:text-yellow items-center justify-center rounded shadow text-white text-xl w-1/4 mx-3"
										v-if="model[0].acf.color_picker"
									>
										Color Picker
									</router-link>
									<router-link 
										:to="'/models/'+$route.params.model_id+'/photo-gallery'"
										class="bg-blue btn flex font-bold h-12 hover:bg-blue-dark hover:text-yellow items-center justify-center rounded shadow text-white text-xl w-1/4 mx-3"
										v-if="model[0].acf.model_photo_gallery && model[0].acf.model_photo_gallery.length > 0"
									>
										Photo Gallery
									</router-link>
								</div>
							</div>
							<div class="w-1/2 relative">
								<div class="floor-plan-wrapper flex flex-col h-full" v-if="model[0].acf.floor_plans[0]">
									<div class="floor-plan-navigation py-4 bg-gray-lightest shadow-inner">
										<ul class="list-reset flex justify-center items-center">
											<li class="w-1/4" v-for="(fp, index) in model[0].acf.floor_plans">
												<p
													class="bg-blue btn flex font-bold h-12 hover:bg-blue-dark items-center justify-center rounded shadow text-white text-center text-xl mx-3"
													:class="{ 'active': index === floor_plan_index }"
													v-on:click="changeFloorPlanImage(index)"
													role="button"
												>
													{{fp.caption}}
												</p>
											</li>
										</ul>
									</div>
									<div class="flex-grow flex items-center justify-center">
										<v-touch 
											v-on:swipeleft="floorPlanIndexIncrease"
											v-on:swiperight="floorPlanIndexDecrease"
											class="floor-plan-images overflow-hidden relative"
										>
											<img 
												v-for="(fp, index) in model[0].acf.floor_plans"
												:src="fp.url"
												:class="{ 'active': index === floor_plan_index }"
											/>
											<div class="absolute fp-prev h-12 m-auto pin-b pin-t w-12 text-blue" v-if="model[0].acf.floor_plans && model[0].acf.floor_plans.length > 1" v-on:click="floorPlanIndexDecrease">
												<svg viewBox="0 0 20 20" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="fill-current">
													<g id="Page-1" stroke="none" stroke-width="1" fill-rule="evenodd">
														<g id="icon-shape">
															<polygon id="Combined-Shape" points="7.05025253 9.29289322 6.34314575 10 12 15.6568542 13.4142136 14.2426407 9.17157288 10 13.4142136 5.75735931 12 4.34314575"></polygon>							</g>
													</g>
												</svg>
											</div>
											<div class="absolute fp-next h-12 m-auto pin-b pin-r pin-t w-12 text-blue" v-if="model[0].acf.floor_plans && model[0].acf.floor_plans.length > 1" v-on:click="floorPlanIndexIncrease">
												<svg viewBox="0 0 20 20" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="fill-current">
													<g id="Page-1" stroke="none" stroke-width="1" fill-rule="evenodd">
														<g id="icon-shape">
															<polygon id="Combined-Shape" points="12.9497475 10.7071068 13.6568542 10 8 4.34314575 6.58578644 5.75735931 10.8284271 10 6.58578644 14.2426407 8 15.6568542 12.9497475 10.7071068"></polygon>
														</g>
													</g>
												</svg>
											</div>
										</v-touch>
									</div>
								</div>
								<div class="absolute pin flex justify-center items-center bg-yellow-lighter" v-if="!model[0].acf.floor_plans[0]">
									<p class="text-5xl text-blue">Floor Plans Coming Soon!</p>
								</div>
							</div>
						</div>
					</div>
				</transition>
			`
		}
		

	const DisplayModelsIndividualDetail = {
		props: ['model_pages', 'loading'],
		data () {
			return {
				model: null,
				mpg_index: 0,
				mpg_max: 0,
				model_loading: true
			}
		},
		methods: {
			galleryIndexIncrease: function () {
				console.log('mpg_max', this.mpg_max)
				this.mpg_index++
				console.log('mpg_index', this.mpg_index)
				if ( this.mpg_index >= this.mpg_max) {
					this.mpg_index = 0
					console.log('mpg_index', this.mpg_index)
				}
			},
			galleryIndexDecrease: function () {
				console.log('mpg_max', this.mpg_max)
				
				if ( this.mpg_index > 0 ) {
					this.mpg_index--
					console.log('mpg_index', this.mpg_index)
				} else {
					this.mpg_index = this.mpg_max - 1
					console.log('mpg_index', this.mpg_index)
				}
			}
		},
		mounted () {
			this.model_id = this.$route.params.model_id
			if ( this.model_pages ) { //if the user starts at a page before the individual model page
				setTimeout(() => {
					this.model = this.model_pages.filter(m => m.id == this.model_id)

					if ( this.model[0].acf.model_photo_gallery ) {
						this.mpg_max = this.model[0].acf.model_photo_gallery.length
					}

					this.model_loading = false
					console.log(this.model)
				}, 240);
			} else { //this condition is if the page is reset on an individual model page
				setTimeout(() => {
					this.model = this.model_pages.filter(m => m.id == this.model_id)

					if ( this.model[0].acf.model_photo_gallery ) {
						this.mpg_max = this.model[0].acf.model_photo_gallery.length
					}

					this.model_loading = false
					console.log(this.model)
				}, 2000);
			}
						
		},
		template: `
			<transition name="fade">
				<div class="display-routed-page absolute pin-r pt-display pr-display pb-display" v-if="model_loading">
					<div class="display-sub-navigation flex justify-center items-center sub-navigation-three">
						<div class="bg-blue sub-navigation-item text-white text-3xl flex justify-center"><span class="block h-8"></span></div>
						<div class="bg-blue sub-navigation-item text-white text-3xl flex justify-center"><span class="block h-8"></span></div>
						<div class="bg-yellow-lighter sub-navigation-item text-blue font-bold text-3xl shadow-inner flex justify-center">
							<span class="block h-8"></span>
						</div>
					</div>
					<div style="height:968px" class="w-full bg-gray-lightest pb-display"></div>
				</div>
				<div class="display-routed-page absolute pin-r pt-display pr-display pb-display" v-if="!model_loading">
					<div class="display-sub-navigation flex justify-center items-center sub-navigation-three" v-if="!this.model">
						<div class="bg-blue sub-navigation-item text-white text-3xl flex justify-center"><span class="block h-8"></span></div>
						<div class="bg-blue sub-navigation-item text-white text-3xl flex justify-center"><span class="block h-8"></span></div>
						<div class="bg-yellow-lighter sub-navigation-item text-blue font-bold text-3xl shadow-inner flex justify-center">
							<span class="block h-8"></span>
						</div>
					</div>
					<div class="display-sub-navigation flex justify-center items-center sub-navigation-three" v-if="this.model">
						<div class="bg-blue sub-navigation-item text-white text-3xl flex justify-center"><router-link to="/models" class="flex-grow">Models</router-link></div>
						<div class="bg-blue sub-navigation-item text-white text-3xl flex justify-center"><a @click="$router.go(-1)" class="flex-grow">{{model[0].title.rendered}}</router-link></a></div>
						<div class="bg-yellow-lighter sub-navigation-item text-blue font-bold text-3xl shadow-inner flex justify-center">
							<span v-if="this.$route.params.detail == 'photo-gallery'">Photo Gallery</span>
							<span v-if="this.$route.params.detail == 'color-picker'">Color Picker</span>
							<span v-if="this.$route.params.detail == 'virtual-tour'">Virtual Tour</span>
						</div>
					</div>
					<v-touch 
						v-on:swipeleft="galleryIndexIncrease"
						v-on:swiperight="galleryIndexDecrease"
						class="pb-display shadow-inner relative"
						style="height: 978px;"
						v-if="this.$route.params.detail == 'photo-gallery'"	
					>
						<img 
							v-for="(mpg, index) in model[0].acf.model_photo_gallery" 
							v-if="model"
							v-bind:src="mpg.url" 
							class="gallery-full-image"
							:class="{ 'active': index === mpg_index }"
						>
						<div class="absolute gallery-prev h-24 m-auto pin-b pin-t text-white w-24" v-if="model[0].acf.model_photo_gallery && model[0].acf.model_photo_gallery.length > 1" v-on:click="galleryIndexDecrease">
							<svg viewBox="0 0 20 20" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="fill-current">
								<g id="Page-1" stroke="none" stroke-width="1" fill-rule="evenodd">
									<g id="icon-shape">
										<polygon id="Combined-Shape" points="7.05025253 9.29289322 6.34314575 10 12 15.6568542 13.4142136 14.2426407 9.17157288 10 13.4142136 5.75735931 12 4.34314575"></polygon>							</g>
								</g>
							</svg>
						</div>
						<div class="absolute gallery-next h-24 m-auto pin-b pin-r pin-t text-white w-24" v-if="model[0].acf.model_photo_gallery && model[0].acf.model_photo_gallery.length > 1" v-on:click="galleryIndexIncrease">
							<svg viewBox="0 0 20 20" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="fill-current">
								<g id="Page-1" stroke="none" stroke-width="1" fill-rule="evenodd">
									<g id="icon-shape">
										<polygon id="Combined-Shape" points="12.9497475 10.7071068 13.6568542 10 8 4.34314575 6.58578644 5.75735931 10.8284271 10 6.58578644 14.2426407 8 15.6568542 12.9497475 10.7071068"></polygon>
									</g>
								</g>
							</svg>
						</div>
					</v-touch>
					<p
						v-if="this.$route.params.detail == 'color-picker'"	
					>
						{{$route.params.detail}}
					</p>
					<p
						v-if="this.$route.params.detail == 'virtual-tour'"	
					>
						{{$route.params.detail}}
					</p>
				</div>
			</transition>
		`
	}
	const DisplayHomes = { 
		props: ['inventory_pages', 'loading'],
		template: `
			<transition name="fade">
				<div class="display-routed-page pt-display absolute pin-r overflow-scroll">
					<div class="flex flex-row flex-wrap">
						<transition name="fade">
							<div class="flex flex-row flex-wrap" v-if="loading">
								<div class="display-model-block mr-display mb-display bg-blue-lightest loading-block"></div>
								<div class="display-model-block mr-display mb-display bg-blue-lightest loading-block"></div>
								<div class="display-model-block mr-display mb-display bg-blue-lightest loading-block"></div>
								<div class="display-model-block mr-display mb-display bg-blue-lightest loading-block"></div>
								<div class="display-model-block mr-display mb-display bg-blue-lightest loading-block"></div>
								<div class="display-model-block mr-display mb-display bg-blue-lightest loading-block"></div>
							</div>
						</transition>	
						<div class="display-model-block mr-display mb-display bg-blue-lightest relative shadow hover:shadow-lg" v-for="(inv, index) in inventory_pages" v-if="!loading">
							<router-link :to="'/homes/'+inv.id">
								<span class="absolute pin mr-display mb-display"></span>
							</router-link>
							<img v-bind:src="inv.acf.inventory_photo_gallery[0].url" v-if="inv.acf.inventory_photo_gallery[0]"/>
							<img src="https://vericorstaging.eastonpreview.com/wp-content/uploads/2018/08/1920x1080.png" v-if="!inv.acf.inventory_photo_gallery[0]" />
							<div class="model-block-title absolute pin-b w-full flex justify-center items-center py-4 pointer-events-none">
								<h2 class="mb-0 text-4xl text-blue">{{ inv.title.rendered }}</h2>
							</div>
						</div>
						<div 
							class="display-model-block mr-display mb-display bg-gray-lightest flex justify-center items-center" 
							v-if="!loading && inventory_pages.length < 6"
							v-for="n in 6 - inventory_pages.length"
						>
							<h2 class="text-gray text-3xl">More Coming Soon</h2>
						</div>
					</div>
				</div>
			</transition>
		`
	}
	const DisplayHomesIndividual = {
		props: ['inventory_pages', 'loading'],
		data () {
			return {
				home: null,
				home_loading: true,
				home_empty: false,
				gallery_index: 0,
				gallery_max: 0,
				floor_plan_index: 0,
				floor_plan_max: 0,
				no_details: false,
				linked_model: null,
				error: false
			}
		},
		methods: {
			changeFloorPlanImage: function (index) {
				this.floor_plan_index = index
			},
			galleryIndexIncrease: function () {
				console.log('gallery_max', this.gallery_max)
				if ( this.gallery_max == 0 ) {
					return
				}
				this.gallery_index++
				console.log('gallery_index', this.gallery_index)
				if ( this.gallery_index >= this.gallery_max) {
					this.gallery_index = 0
					console.log('gallery_index', this.gallery_index)
				}
			},
			galleryIndexDecrease: function () {
				console.log('gallery_max', this.gallery_max)
				if ( this.gallery_max == 0 ) {
					return
				}
				if ( this.gallery_index > 0 ) {
					this.gallery_index--
					console.log('gallery_index', this.gallery_index)
				} else {
					this.gallery_index = this.gallery_max - 1
					console.log('gallery_index', this.gallery_index)
				}
			},
			floorPlanIndexIncrease: function () {
				console.log('floor_plan_max', this.floor_plan_max)
				this.floor_plan_index++
				console.log('floor_plan_index', this.floor_plan_index)
				if ( this.floor_plan_index >= this.floor_plan_max) {
					this.floor_plan_index = 0
					console.log('floor_plan_index', this.floor_plan_index)
				}
			},
			floorPlanIndexDecrease: function () {
				console.log('floor_plan_max', this.floor_plan_max)
				
				if ( this.floor_plan_index > 0 ) {
					this.floor_plan_index--
					console.log('floor_plan_index', this.floor_plan_index)
				} else {
					this.floor_plan_index = this.floor_plan_max - 1
					console.log('floor_plan_index', this.floor_plan_index)
				}
			},
			linked_model_request: function(model) {
				axios
					.get('https://vericorstaging.eastonpreview.com/wp-json/wp/v2/pages/'+model)
					.then(response => {
						this.linked_model = response.data
						console.log(this.linked_model)
					})
					.catch(error => {
						console.log(error)
						this.error = true
					})
			},
		},
		mounted () {
			this.home_id = this.$route.params.home_id
			if ( this.inventory_pages ) { //if the user starts at a page before the individual model page
				setTimeout(() => {
					this.home = this.inventory_pages.filter(m => m.id == this.home_id)
					console.log(this.home)
					

					if ( this.home[0].acf.floor_plans === false ) {
						this.linked_model_request(this.home[0].acf.model)
					}
					
					this.home_loading = false
				}, 240);
			} else { //this condition is if the page is reset on an individual model page
				setTimeout(() => {
					this.home = this.inventory_pages.filter(m => m.id == this.home_id)
					console.log(this.home)

					if ( this.home[0].acf.floor_plans === false ) {
						this.linked_model_request(this.home[0].acf.model)
					}
					
					this.home_loading = false
				}, 2000);
			}
						
		}, 
		template: `
			<transition name="fade">
				<div class="display-routed-page pt-display pr-display pb-display absolute pin-r" v-if="home_loading">
					<div class="display-sub-navigation flex justify-center items-center">
						<div class="bg-blue sub-navigation-item text-white text-3xl"><span class="block h-8"></span></div>
						<div class="bg-yellow-lighter sub-navigation-item text-blue font-bold text-3xl shadow-inner"><span class="block h-8"></span></div>
					</div>
					<div class="flex flex-row flex-wrap h-full" style="height: 968px">
						<div class="w-1/2 bg-gray-lightest br-display">
							<div class="skeleton-model-image bg-gray w-full"></div>
							<p class="text-5xl text-blue text-center font-serif my-2">Loading Home</p>
							<div class="bg-blue-lightest flex items-center justify-between py-2 shadow-inner">
								<div class="flex flex-col items-center justify-center px-3">
									<p class="font-bold mb-1 text-4xl text-blue">-</p>
									<p class="text-gray text-xl">Beds</p>
								</div>
								<div class="flex flex-col items-center justify-center px-3">
									<p class="font-bold mb-1 text-4xl text-blue">-</p>
									<p class="text-gray text-xl">Baths</p>
								</div>
								<div class="flex flex-col items-center justify-center px-3">
									<p class="font-bold mb-1 text-3xl text-center text-blue">-</p>
									<p class="text-gray text-xl">Garage</p>
								</div>
								<div class="flex flex-col items-center justify-center px-3">
									<p class="font-bold mb-1 text-4xl text-blue">-</p>
									<p class="text-gray text-xl">Stories</p>
								</div>
								<div class="flex flex-col items-center justify-center px-3">
									<p class="font-bold mb-1 text-3xl text-center text-blue">-</p>
									<p class="text-gray text-xl">Sq. Ft.</p>
								</div>
								<div class="flex flex-col items-center justify-center px-3">
									<p class="font-bold text-3xl text-5xl text-blue">\$---,---</p>
								</div>
							</div>
							<div 
								class="leading-tight overflow-scroll px-3 text-lg wp-content shadow-inner bt-display py-3 model-content no-detail"
							></div>
						</div>
						<div class="w-1/2 bg-gray-lightest">
							<div class="floor-plan-wrapper flex flex-col h-full">
								<div class="floor-plan-navigation py-4 bg-gray-lightest shadow-inner">
									<ul class="list-reset flex justify-center items-center">
										<li class="w-1/4">
											<p
												class="bg-blue btn flex font-bold h-12 hover:bg-blue-dark items-center justify-center rounded shadow text-white text-center text-xl mx-3"
											>
												First Floor
											</p>
										</li>
										<li class="w-1/4">
											<p
												class="bg-blue btn flex font-bold h-12 hover:bg-blue-dark items-center justify-center rounded shadow text-white text-center text-xl mx-3"
											>
												Second Floor
											</p>
										</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="display-routed-page pt-display pr-display pb-display absolute pin-r" v-if="!home_loading">
					<div class="display-sub-navigation flex justify-center items-center">
						<div class="bg-blue sub-navigation-item text-white text-3xl flex justify-center"><router-link to="/homes" class="flex-grow">Homes</router-link></div>
						<div class="bg-yellow-lighter sub-navigation-item text-blue font-bold text-3xl shadow-inner flex justify-center"><span>{{home[0].acf.street_address}}</span></div>
					</div>
					<div class="flex flex-row flex-wrap h-full" style="height: 968px">
						<div class="w-1/2 bg-gray-lightest br-display">
							<v-touch 
								v-on:swipeleft="galleryIndexIncrease"
								v-on:swiperight="galleryIndexDecrease"
								v-if="home[0].acf.inventory_photo_gallery"
								class="overflow-hidden relative"
							>
								<img 
									v-for="(ipg, index) in home[0].acf.inventory_photo_gallery"
									:src="ipg.url"
									:class="{ 'active': index === gallery_index }"
									class="mb-2 model-elevation-image"
								/>
								<!-- <p
									v-for="(ipg, index) in home[0].acf.inventory_photo_gallery"
									:class="{ 'active': index === gallery_index }"
									class="absolute gallery-caption mb-8 ml-5 pin-b pin-l text-xl text-shadow-strong"
								>
									{{ipg.caption}}
								</p> -->
								<div class="absolute gallery-prev h-12 m-auto pin-b pin-t text-white w-12" v-if="home[0].acf.inventory_photo_gallery && home[0].acf.inventory_photo_gallery.length > 1" v-on:click="galleryIndexDecrease">
									<svg viewBox="0 0 20 20" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="fill-current">
										<g id="Page-1" stroke="none" stroke-width="1" fill-rule="evenodd">
											<g id="icon-shape">
												<polygon id="Combined-Shape" points="7.05025253 9.29289322 6.34314575 10 12 15.6568542 13.4142136 14.2426407 9.17157288 10 13.4142136 5.75735931 12 4.34314575"></polygon>							</g>
										</g>
									</svg>
								</div>
								<div class="absolute gallery-next h-12 m-auto pin-b pin-r pin-t text-white w-12" v-if="home[0].acf.inventory_photo_gallery && home[0].acf.inventory_photo_gallery.length > 1" v-on:click="galleryIndexIncrease">
									<svg viewBox="0 0 20 20" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="fill-current">
										<g id="Page-1" stroke="none" stroke-width="1" fill-rule="evenodd">
											<g id="icon-shape">
												<polygon id="Combined-Shape" points="12.9497475 10.7071068 13.6568542 10 8 4.34314575 6.58578644 5.75735931 10.8284271 10 6.58578644 14.2426407 8 15.6568542 12.9497475 10.7071068"></polygon>
											</g>
										</g>
									</svg>
								</div>
							</v-touch>
							<img src="https://vericorstaging.eastonpreview.com/wp-content/uploads/2018/08/1920x1080.png" class="mb-2" v-if="!home[0].acf.inventory_photo_gallery[0]" />
							<p class="text-5xl text-blue text-center font-serif mb-2">{{home[0].title.rendered}}</p>
							<div class="bg-blue-lightest flex items-center justify-between py-2 shadow-inner">
								<div class="flex flex-col items-center justify-center px-3">
									<p class="font-bold mb-1 text-3xl text-4xl text-blue" v-if="home[0].acf.bedrooms">{{home[0].acf.bedrooms}}</p>
									<p class="font-bold mb-1 text-3xl text-3xl text-blue" v-if="!home[0].acf.bedrooms">N/A</p>
									<p class="text-gray text-xl">Beds</p>
								</div>
								<div class="flex flex-col items-center justify-center px-3">
									<p class="font-bold mb-1 text-3xl text-4xl text-blue" v-if="home[0].acf.bathrooms">{{home[0].acf.bathrooms}}</p>
									<p class="font-bold mb-1 text-3xl text-3xl text-blue" v-if="!home[0].acf.bathrooms">N/A</p>
									<p class="text-gray text-xl">Baths</p>
								</div>
								<div class="flex flex-col items-center justify-center px-3">
									<p class="font-bold mb-1 text-3xl text-4xl text-blue" v-if="home[0].acf.garage">{{home[0].acf.garage}}</p>
									<p class="font-bold mb-1 text-3xl text-3xl text-blue" v-if="!home[0].acf.garage">N/A</p>
									<p class="text-gray text-xl">Garage</p>
								</div>
								<div class="flex flex-col items-center justify-center px-3">
									<p class="font-bold mb-1 text-3xl text-4xl text-blue" v-if="home[0].acf.stories">{{home[0].acf.stories}}</p>
									<p class="font-bold mb-1 text-3xl text-3xl text-blue" v-if="!home[0].acf.stories">N/A</p>
									<p class="text-gray text-xl">Stories</p>
								</div>
								<div class="flex flex-col items-center justify-center px-3">
									<p class="font-bold mb-1 text-3xl text-4xl text-blue" v-if="home[0].acf.square_feet">{{home[0].acf.square_feet}}</p>
									<p class="font-bold mb-1 text-3xl text-3xl text-blue" v-if="!home[0].acf.square_feet">N/A</p>
									<p class="text-gray text-xl">Sq. Ft.</p>
								</div>
								<div class="flex flex-col items-center justify-center px-3">
									<p class="font-bold text-3xl text-5xl text-blue">\${{home[0].acf.price}}</p>
								</div>
							</div>
							<div 
								v-html="home[0].content.rendered" 
								class="leading-tight overflow-scroll px-3 text-lg wp-content shadow-inner bt-display py-3 home-content"
								v-bind:class="{ 'no\-detail': no_details }"
							></div>
							<div 
								class="flex justify-center items-center bt-display shadow-inner" style="height: 78px"
								v-bind:class="{ 'details': !no_details }"
							>
								<router-link 
									:to="'/homes/'+$route.params.home_id+'/virtual-tour'"
									class="bg-blue btn flex font-bold h-12 hover:bg-blue-dark hover:text-yellow items-center justify-center rounded shadow text-white text-xl w-1/4 mx-3"
									v-if="home[0].acf.virtual_tour"
								>
									Virtual Tour
								</router-link>
								<router-link 
									:to="'/homes/'+$route.params.home_id+'/color-picker'"
									class="bg-blue btn flex font-bold h-12 hover:bg-blue-dark hover:text-yellow items-center justify-center rounded shadow text-white text-xl w-1/4 mx-3"
									v-if="home[0].acf.color_picker"
								>
									Color Picker
								</router-link>
								<router-link 
									:to="'/homes/'+$route.params.home_id+'/photo-gallery'"
									class="bg-blue btn flex font-bold h-12 hover:bg-blue-dark hover:text-yellow items-center justify-center rounded shadow text-white text-xl w-1/4 mx-3"
									v-if="home[0].acf.inventory_photo_gallery && home[0].acf.inventory_photo_gallery.length > 0"
								>
									Photo Gallery
								</router-link>
							</div>
						</div>
						<div class="w-1/2 relative">
							<div class="floor-plan-wrapper flex flex-col h-full" v-if="home[0].acf.floor_plans[0]">
								<div class="floor-plan-navigation py-4 bg-gray-lightest shadow-inner">
									<ul class="list-reset flex justify-center items-center">
										<li class="w-1/4" v-for="(fp, index) in home[0].acf.floor_plans">
											<p
												class="bg-blue btn flex font-bold h-12 hover:bg-blue-dark items-center justify-center rounded shadow text-white text-center text-xl mx-3"
												:class="{ 'active': index === floor_plan_index }"
												v-on:click="changeFloorPlanImage(index)"
												role="button"
											>
												{{fp.caption}}
											</p>
										</li>
									</ul>
								</div>
								<div class="flex-grow flex items-center justify-center">
									<v-touch 
										v-on:swipeleft="floorPlanIndexIncrease"
										v-on:swiperight="floorPlanIndexDecrease"
										class="floor-plan-images overflow-hidden relative"
									>
										<img 
											v-for="(fp, index) in home[0].acf.floor_plans"
											:src="fp.url"
											:class="{ 'active': index === floor_plan_index }"
										/>
										<div class="absolute fp-prev h-12 m-auto pin-b pin-t text-white w-12 text-blue" v-if="home[0].acf.floor_plans && home[0].acf.floor_plans.length > 1" v-on:click="floorPlanIndexDecrease">
											<svg viewBox="0 0 20 20" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="fill-current">
												<g id="Page-1" stroke="none" stroke-width="1" fill-rule="evenodd">
													<g id="icon-shape">
														<polygon id="Combined-Shape" points="7.05025253 9.29289322 6.34314575 10 12 15.6568542 13.4142136 14.2426407 9.17157288 10 13.4142136 5.75735931 12 4.34314575"></polygon>							</g>
												</g>
											</svg>
										</div>
										<div class="absolute fp-next h-12 m-auto pin-b pin-r pin-t text-white w-12 text-blue" v-if="home[0].acf.floor_plans && home[0].acf.floor_plans.length > 1" v-on:click="floorPlanIndexIncrease">
											<svg viewBox="0 0 20 20" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="fill-current">
												<g id="Page-1" stroke="none" stroke-width="1" fill-rule="evenodd">
													<g id="icon-shape">
														<polygon id="Combined-Shape" points="12.9497475 10.7071068 13.6568542 10 8 4.34314575 6.58578644 5.75735931 10.8284271 10 6.58578644 14.2426407 8 15.6568542 12.9497475 10.7071068"></polygon>
													</g>
												</g>
											</svg>
										</div>
									</v-touch>
								</div>
							</div>
							<div class="floor-plan-wrapper flex flex-col h-full" v-if="linked_model" v-bind:class="{ 'hidden': !linked_model.acf.floor_plans }">
								<div class="floor-plan-navigation py-4 bg-gray-lightest shadow-inner" v-if="linked_model.acf.floor_plans">
									<ul class="list-reset flex justify-center items-center">
										<li class="w-1/4" v-for="(fp, index) in linked_model.acf.floor_plans">
											<p
												class="bg-blue btn flex font-bold h-12 hover:bg-blue-dark items-center justify-center rounded shadow text-white text-center text-xl mx-3"
												:class="{ 'active': index === floor_plan_index }"
												v-on:click="changeFloorPlanImage(index)"
												role="button"
											>
												{{fp.caption}}
											</p>
										</li>
									</ul>
								</div>
								<div class="flex-grow flex items-center justify-center" v-if="linked_model.acf.floor_plans">
									<v-touch 
										v-on:swipeleft="floorPlanIndexIncrease"
										v-on:swiperight="floorPlanIndexDecrease"
										class="floor-plan-images overflow-hidden relative"
									>
										<img 
											v-for="(fp, index) in linked_model.acf.floor_plans"
											:src="fp.url"
											:class="{ 'active': index === floor_plan_index }"
										/>
										<div class="absolute fp-prev h-12 m-auto pin-b pin-t text-white w-12 text-blue" v-if="linked_model.acf.floor_plans && linked_model.acf.floor_plans.length > 1" v-on:click="floorPlanIndexDecrease">
											<svg viewBox="0 0 20 20" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="fill-current">
												<g id="Page-1" stroke="none" stroke-width="1" fill-rule="evenodd">
													<g id="icon-shape">
														<polygon id="Combined-Shape" points="7.05025253 9.29289322 6.34314575 10 12 15.6568542 13.4142136 14.2426407 9.17157288 10 13.4142136 5.75735931 12 4.34314575"></polygon>							</g>
												</g>
											</svg>
										</div>
										<div class="absolute fp-next h-12 m-auto pin-b pin-r pin-t text-white w-12 text-blue" v-if="linked_model.acf.floor_plans && linked_model.acf.floor_plans.length > 1" v-on:click="floorPlanIndexIncrease">
											<svg viewBox="0 0 20 20" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="fill-current">
												<g id="Page-1" stroke="none" stroke-width="1" fill-rule="evenodd">
													<g id="icon-shape">
														<polygon id="Combined-Shape" points="12.9497475 10.7071068 13.6568542 10 8 4.34314575 6.58578644 5.75735931 10.8284271 10 6.58578644 14.2426407 8 15.6568542 12.9497475 10.7071068"></polygon>
													</g>
												</g>
											</svg>
										</div>
									</v-touch>
								</div>
							</div>
							<div class="absolute pin flex justify-center items-center bg-yellow-lighter" v-if="!home[0].acf.floor_plans[0] && !linked_model">
								<p class="text-5xl text-blue">Floor Plans Coming Soon!</p>
							</div>
						</div>
					</div>
				</div>
			</transition>
		`
	}
	const DisplayHomesIndividualDetail = {
		props: ['inventory_pages', 'loading'],
		data () {
			return {
				home: null,
				ipg_index: 0,
				ipg_max: 0,
				home_loading: true
			}
		},
		methods: {
			galleryIndexIncrease: function () {
				this.ipg_index++
				if ( this.ipg_index >= this.ipg_max) {
					this.ipg_index = 0
				}
			},
			galleryIndexDecrease: function () {
				
				if ( this.ipg_index > 0 ) {
					this.ipg_index--
				} else {
					this.ipg_index = this.ipg_max - 1
				}
			}
		},
		mounted () {
			this.home_id = this.$route.params.home_id
			if ( this.inventory_pages ) { //if the user starts at a page before the individual model page
				setTimeout(() => {
					this.home = this.inventory_pages.filter(m => m.id == this.home_id)

					if ( this.home[0].acf.inventory_photo_gallery ) {
						this.ipg_max = this.home[0].acf.inventory_photo_gallery.length
					}

					this.home_loading = false
					console.log(this.home)
				}, 240);
			} else { //this condition is if the page is reset on an individual model page
				setTimeout(() => {
					this.home = this.inventory_pages.filter(m => m.id == this.home_id)

					if ( this.home[0].acf.inventory_photo_gallery ) {
						this.ipg_max = this.home[0].acf.inventory_photo_gallery.length
					}

					this.home_loading = false
					console.log(this.home)
				}, 2000);
			}
						
		}, 
		template: `
			<transition name="fade">
				<div class="display-routed-page absolute pin-r pt-display pr-display pb-display" v-if="home_loading">
					<div class="display-sub-navigation flex justify-center items-center sub-navigation-three">
						<div class="bg-blue sub-navigation-item text-white text-3xl flex justify-center"><span class="block h-8"></span></div>
						<div class="bg-blue sub-navigation-item text-white text-3xl flex justify-center"><span class="block h-8"></span></div>
						<div class="bg-yellow-lighter sub-navigation-item text-blue font-bold text-3xl shadow-inner flex justify-center">
							<span class="block h-8"></span>
						</div>
					</div>
					<div style="height:968px" class="w-full bg-gray-lightest pb-display"></div>
				</div>
				<div class="display-routed-page absolute pin-r pt-display pr-display pb-display" v-if="!home_loading">
					<div class="display-sub-navigation flex justify-center items-center sub-navigation-three" v-if="this.home">
						<div class="bg-blue sub-navigation-item text-white text-3xl flex justify-center"><router-link to="/homes" class="flex-grow">Homes</router-link></div>
						<div class="bg-blue sub-navigation-item text-white text-3xl flex justify-center"><a @click="$router.go(-1)" class="flex-grow">{{home[0].acf.street_address}}</router-link></a></div>
						<div class="bg-yellow-lighter sub-navigation-item text-blue font-bold text-3xl shadow-inner flex justify-center">
							<span v-if="this.$route.params.detail == 'photo-gallery'">Photo Gallery</span>
							<span v-if="this.$route.params.detail == 'color-picker'">Color Picker</span>
							<span v-if="this.$route.params.detail == 'virtual-tour'">Virtual Tour</span>
						</div>
					</div>
					<v-touch 
						v-on:swipeleft="galleryIndexIncrease"
						v-on:swiperight="galleryIndexDecrease"
						class="pb-display shadow-inner relative"
						style="height: 978px;"
						v-if="this.$route.params.detail == 'photo-gallery'"	
					>
						<img 
							v-for="(ipg, index) in home[0].acf.inventory_photo_gallery" 
							v-if="home"
							v-bind:src="ipg.url" 
							class="gallery-full-image"
							:class="{ 'active': index === ipg_index }"
						>
						<div class="absolute gallery-prev h-24 m-auto pin-b pin-t text-white w-24" v-if="home[0].acf.inventory_photo_gallery && home[0].acf.inventory_photo_gallery.length > 1" v-on:click="galleryIndexDecrease">
							<svg viewBox="0 0 20 20" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="fill-current">
								<g id="Page-1" stroke="none" stroke-width="1" fill-rule="evenodd">
									<g id="icon-shape">
										<polygon id="Combined-Shape" points="7.05025253 9.29289322 6.34314575 10 12 15.6568542 13.4142136 14.2426407 9.17157288 10 13.4142136 5.75735931 12 4.34314575"></polygon>							</g>
								</g>
							</svg>
						</div>
						<div class="absolute gallery-next h-24 m-auto pin-b pin-r pin-t text-white w-24" v-if="home[0].acf.inventory_photo_gallery && home[0].acf.inventory_photo_gallery.length > 1" v-on:click="galleryIndexIncrease">
							<svg viewBox="0 0 20 20" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="fill-current">
								<g id="Page-1" stroke="none" stroke-width="1" fill-rule="evenodd">
									<g id="icon-shape">
										<polygon id="Combined-Shape" points="12.9497475 10.7071068 13.6568542 10 8 4.34314575 6.58578644 5.75735931 10.8284271 10 6.58578644 14.2426407 8 15.6568542 12.9497475 10.7071068"></polygon>
									</g>
								</g>
							</svg>
						</div>
					</v-touch>
					<p
						v-if="this.$route.params.detail == 'color-picker'"	
					>
						{{$route.params.detail}}
					</p>
					<p
						v-if="this.$route.params.detail == 'virtual-tour'"	
					>
						{{$route.params.detail}}
					</p>
				</div>
			</transition>
		`
	}
	const DisplaySitemaps = {
		props: ['display_info', 'loading'],
		data () {
			return {
				sitemap_blocks: null,
				sitemap_blocks_loading: true,
				sitemap_blocks_empty: null,
				sitemap_index: 0,
				requested_inventory: null,
				requested_inventory_error: false,
				requested_models: null,
				requested_models_error: false
			}
		},
		methods: {
			changeSitemapImage: function (index) {
				this.sitemap_index = index
			},
			requestInventory: function (id) {
				if ( id ) {
					axios
						.get(`https://vericorstaging.eastonpreview.com/wp-json/wp/v2/pages/${id}`)
						.then(response => {
							this.requested_inventory = response.data.acf
							console.log(this.requested_inventory)
						})
						.catch(error => {
							console.log(error)
							this.requested_inventory_error = true
						})
				} else {
					return
				}
			}
		},
		mounted () {
			if ( this.display_info ) { //if the user starts at a page before the community page
				setTimeout(() => {
					this.sitemap_blocks = this.display_info.sitemap_blocks
					console.log(this.sitemap_blocks)

					if ( !this.sitemap_blocks.length ) {
						this.sitemap_blocks_empty = true
					}
					this.sitemap_blocks_loading = false
				}, 240);
			} else { //this condition is if the page is reset on an community page
				setTimeout(() => {
					this.sitemap_blocks = this.display_info.sitemap_blocks
					console.log(this.sitemap_blocks)

					if ( !this.sitemap_blocks.length ) {
						this.sitemap_blocks_empty = true
					}
					this.sitemap_blocks_loading = false
				}, 1750);
			}			
		},
		template: `
			<transition name="fade">
				<div class="display-routed-page absolute pin-r pt-display overflow-scroll sitemaps" v-if="sitemap_blocks_loading">
					<!-- put top navigation -->
					<div class="display-sub-navigation flex relative mr-display">
						<div 
							class="bg-blue sub-navigation-item text-white text-3xl flex justify-center items-center flex-grow bg-yellow-lighter font-bold shadow-inner text-blue"
						>
							<span class="flex-grow"></span>
						</div>
						<div 
							class="bg-blue sub-navigation-item text-white text-3xl flex justify-center items-center flex-grow"
						>
							<span class="flex-grow"></span>
						</div>
					</div>
					<!-- put fake map -->
					<img src="https://vericorstaging.eastonpreview.com/wp-content/uploads/2018/09/1622x988.jpg" class="relative sitemap-image active">
				</div>
				<div class="display-routed-page absolute pin-r pt-display overflow-scroll sitemaps" v-if="!sitemap_blocks_loading">
					<!-- put top navigation -->
					<div class="display-sub-navigation flex relative mr-display" v-if="this.sitemap_blocks">
						<div 
							class="bg-blue sub-navigation-item text-white text-3xl flex justify-center items-center flex-grow"
							v-for="(block, index) in sitemap_blocks"
							:key="block.sitemap_title"
							v-on:click="changeSitemapImage(index)"
							:class="{ 'bg-yellow-lighter font-bold shadow-inner text-blue': index === sitemap_index }"
						>
							<span class="flex-grow">{{block.sitemap_title}}</span>
						</div>
					</div>
					<img 
						class="relative sitemap-image"
						v-for="(block, index) in sitemap_blocks"
						v-bind:src="block.sitemap_image.url"
						:class="{ 'active': index === sitemap_index }"
					>
					<div class="sitemap-data-wrapper absolute pin"
						v-for="(block, index) in sitemap_blocks"
						:class="{ 'active': index === sitemap_index }"
					>
						<div class="sitemap-data-item absolute h-10 w-10 shadow-md hover:shadow rounded-full text-white flex justify-center items-center"
							v-for="(item, index) in block.sitemap_lot_data"
							v-bind:style="{ top: item.top_position + '%', left: item.left_position + '%' }"
							v-bind:class="['bg-'+item.status]"
							v-if="block.sitemap_lot_data"
							v-on:click="requestInventory(item.linked_inventory)"
						>
							{{item.lot_label}}
						</div>
					</div>
				</div>
			</transition>
		`
	}
	const DisplaySitemapsIndividual = { 
		template: `
			<transition name="fade">
				<div class="display-routed-page absolute pin-r">Sitemaps Individual</div>
			</transition>
		`
	}

	const router = new VueRouter({
		routes: [
			{ path: '', component: DisplayHome },
			{ path: '/community', component: DisplayCommunity },
			{ path: '/area', component: DisplayArea },
			{ path: '/amenities', component: DisplayAmenities },
			{ path: '/models', component: DisplayModels },
			{ path: '/models/:model_id', component: DisplayModelsIndividual },
			{ path: '/models/collection/:collection_name', component: DisplayModelsCollection },
			{ path: '/models/collection/:collection_name/:model_id', component: DisplayModelsIndividual, props: true },
			{ path: '/models/collection/:collection_name/:model_id/:detail', component: DisplayModelsIndividualDetail },
			{ path: '/models/:model_id/:detail', component: DisplayModelsIndividualDetail },
			{ path: '/homes', component: DisplayHomes },
			{ path: '/homes/:home_id', component: DisplayHomesIndividual },
			{ path: '/homes/:home_id/:detail', component: DisplayHomesIndividualDetail },
			{ path: '/sitemaps', component: DisplaySitemaps },
			{ path: '/sitemaps/:sitemap_name', component: DisplaySitemapsIndividual }
		]
	})

	const app = new Vue({
		el: '#display-body',
		router,
		data () {
			return {
				community_info: null,
				display_info: null,
				model_pages: null,
				inventory_pages: null,
				model: null,
				error: false,
				loading: true
			}
		},
		methods: {
			make_requests: function() {
				console.log('Calling API in make_requests')
				axios.all([
					this.community_request(),
					this.display_request(),
					this.child_pages_request()
				])
			},
			community_request: function() {
				axios
					.get(`https://vericorstaging.eastonpreview.com/wp-json/wp/v2/pages/${community_id}`)
					.then(response => {
						this.community_info = response.data
						console.log(this.community_info)
					})
					.catch(error => {
						console.log(error)
						this.error = true
					})
			},
			display_request: function() {
				axios
					.get(`https://vericorstaging.eastonpreview.com/wp-json/wp/v2/pages/${display_id}`)
					.then(response => {
						this.display_info = response.data.acf
						console.log(this.display_info)
					})
					.catch(error => {
						console.log(error)
						this.error = true
					})
			},
			child_pages_request: function() {
				axios
					.get(`https://vericorstaging.eastonpreview.com/wp-json/wp/v2/pages/?parent=${community_id}`)
					.then(response => {
						this.model_pages = response.data.filter(item => item.template == 'template-model.php');
						this.inventory_pages = response.data.filter(item => item.template == 'template-inventory.php');
						console.log(this.model_pages)
						console.log(this.inventory_pages)
					})
					.catch(error => {
						console.log(error)
						this.error = true
					})
					.finally(() => this.loading = false)
			},
		},
		created () {
			this.make_requests()
		}
	})
  
</script>