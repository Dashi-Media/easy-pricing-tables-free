/* jshint asi: true */
var $ = jQuery
jQuery(document).ready(function($){

	// LAYOUT2
	$('.fca-ept-period-toggle').change( function(){
		
		var $parent_wrapper = $(this).closest('.fca-ept-main')

		if( this.checked ){

			$parent_wrapper.find('.wp-block-fatcatapps-pricing-table-blocks').addClass('toggle-active')

			$parent_wrapper.find('.fca-ept-button').each( function(){
				this.href = this.dataset.url2
			})

		} else {

			$parent_wrapper.find('.wp-block-fatcatapps-pricing-table-blocks').removeClass('toggle-active')

			$parent_wrapper.find('.fca-ept-button').each( function(){
				this.href = this.dataset.url1
			})

		}
	})

})