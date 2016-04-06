<?php

add_filter('frm_get_default_value', 'my_custom_default_value', 10, 2);
function my_custom_default_value($new_value, $field) {

	$user = wp_get_current_user();
	$user_rank = get_user_meta($user->id, 'rank', 'true');

	// Getting all prices ranges
	$entries_query = "SELECT * FROM wp_frm_items WHERE form_id = 8";
	$all_prices_range = mysql_query($entries_query);
	while ($a_price_range = mysql_fetch_object($all_prices_range)) {

    	// Getting Meta for a price range
		$meta_query = "SELECT * FROM wp_frm_item_metas WHERE item_id = $a_price_range->id";
		$user_price_range_metas = mysql_query($meta_query);
		while ($meta = mysql_fetch_object($user_price_range_metas))
		{
        	// if this price range is the one for the user
			if ($meta->field_id == 122 && $meta->meta_value == $user_rank) {
				$data_retrieved = true;
			} else if ($meta->field_id == 123) {
				$note_full_format = $meta->meta_value;
			} else if ($meta->field_id == 125) {
				$note_one_pager = $meta->meta_value;
			} else if ($meta->field_id == 144) {
				$note_bandeau = $meta->meta_value;
			} else if ($meta->field_id == 142) {
				$screening_listing = $meta->meta_value;
			} else if ($meta->field_id == 149) {
				$screening_advanced = $meta->meta_value;
			} else if ($meta->field_id == 150) {
				$multiples = $meta->meta_value;
			}

		}

		if ($data_retrieved == true) {
			break;
		}
	}

  if ($field->id == 116) {  // Note - Credits standard
  	$new_value = 'default';
  } else ($field->id == 117) { // Note - Credits urgence


  } 
  return $new_value;
}

?>