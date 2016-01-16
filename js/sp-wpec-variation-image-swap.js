jQuery(document).ready(function($) { 
	$.sp_variation_swap_scripts = {
		init: function() {
			// variation image swap function
			$("div.wpsc_variation_forms select.wpsc_select_variation").change(function() {
				var productForm = $(this).parents("form.product_form"),
					productCol = $(this).parents(".productcol"),
					imageCol = productCol.prev(),
					allSelected,
					var_ids = new Array(),
					i = 0; //counter
				
				// loops through all selections and check if all has been selected to proceed (also captures all variation ids)
				$(productForm).find("select.wpsc_select_variation").each(function() {
					if ( $("option:selected", this).val() == 0) {
						allSelected = false;
						return false;
					} else {
						var_ids[i] = $("option:selected", this).val();
						allSelected = true;
						i++;	
					}
				});
				// if all selections have been made continue
				if (allSelected) {
					// get the product id
					var product_id = $("input[name=product_id]", productForm).val(),
						image_element = $("img#product_image_" + product_id, imageCol),				
						image_src = image_element.attr('src'),
						$data = {
							action: "sp_wpec_variation_image_swap",
							product_id: product_id,
							var_ids: var_ids,
							image_src: image_src,
							ajaxCustomNonce : sp_image_swap_ajax.ajaxCustomNonce
						};
					$.post(sp_image_swap_ajax.ajaxurl, $data, function(response) { 
						if (response) {
							response = $.parseJSON(response);
							image_element.parent('a.preview_link').attr('href', response.full);
							image_element.fadeTo('fast', 0, function() {
								var newImage = $('<img src="' + response.thumb + '">');
								$( newImage ).load( function() {
									image_element.attr("src", response.thumb).fadeTo('fast', 1);
								});
							});
						} else {
							image_element.fadeTo('fast', 1);	
						}
					}); 
				}
			});
		}
	}; // close namespace
	$.sp_variation_swap_scripts.init();

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// end jquery on load
});
