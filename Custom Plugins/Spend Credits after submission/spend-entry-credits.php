<?php
/*
Plugin Name: [Custom] Spend Credits after submission
*/

add_action('frm_after_create_entry', 'spend_credits', 30, 2);
function spend_credits( $entry_id, $form_id ) {
	if ($form_id == 2) {
		$entry = FrmEntry::getOne($entry_id);
		$user = wp_get_current_user();
		if ($entry->user_id && $entry->user_id == $user->id) {

		    // Getting metas
		    $meta_query = "SELECT * FROM wp_frm_item_metas WHERE item_id = $entry->id";
		    $meta_result = mysql_query($meta_query);
		    $cost_in_credits = "0";
		    while ($meta = mysql_fetch_object($meta_result))
		    {
		        if ($meta->field_id == 116 || $meta->field_id == 117 || $meta->field_id == 120 || $meta->field_id == 121) {
		            $cost_in_credits = $meta->meta_value;
		            break;
		        }
		    }

			// Updating credits
			$user_credits = get_user_meta($user->id, 'credits', 'true');
			update_user_meta( $user->id, 'credits', $user_credits - $cost_in_credits, $user_credits );
		}
	}
}