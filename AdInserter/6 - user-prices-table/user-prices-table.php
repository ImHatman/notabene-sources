<?php
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

if ($data_retrieved == false) {
    $note_full_format = "N/A";
    $note_one_pager = "N/A";
    $note_bandeau = "N/A";
    $screening_listing = "N/A";
    $screening_advanced = "N/A";
    $multiples = "N/A";
}

?>

<table class="orders-table">
<tr class="orders-table-row">
  	<td colspan="2" class="user-rates-table-title">
  		<div class="orders-table-header-footer">
  			Note d'information
  		</div>
  	</td>
</tr>
<tr class="orders-table-row">
	<td class="user-rates-table-subtitle">
		Full format
	</td>
	<td class="user-rates-table-dynamic-value-cell">
		<span class="user-rates-table-dynamic-value"><?php echo $note_full_format ?></span>
	</td>
</tr>
<tr class="orders-table-row">
	<td class="user-rates-table-subtitle">
		One pager
	</td>
	<td class="user-rates-table-dynamic-value-cell">
		<span class="user-rates-table-dynamic-value"><?php echo $note_one_pager ?></span>
	</td>
</tr>
<tr class="orders-table-row">
	<td class="user-rates-table-subtitle">
		Bandeau
	</td>
	<td class="user-rates-table-dynamic-value-cell">
		<span class="user-rates-table-dynamic-value"><?php echo $note_bandeau ?></span>
	</td>
</tr>
<tr class="orders-table-row">
  	<td colspan="2" class="user-rates-table-title">
  		<div class="orders-table-header-footer">
  			Screening
  		</div>
  	</td>
</tr>
<tr class="orders-table-row">
	<td class="user-rates-table-subtitle">
		Listing
	</td>
	<td class="user-rates-table-dynamic-value-cell">
		<span class="user-rates-table-dynamic-value"><?php echo $screening_listing ?></span>
	</td>
</tr>
<tr class="orders-table-row">
	<td class="user-rates-table-subtitle">
		Qualifié
	</td>
	<td class="user-rates-table-dynamic-value-cell">
		<span class="user-rates-table-dynamic-value"><?php echo $screening_advanced ?></span>
	</td>
</tr>
<tr class="orders-table-row">
  	<td colspan="2" class="user-rates-table-title">
  		<div class="orders-table-header-footer">
  			Multiples de référence
  		</div>
  	</td>
</tr>
<tr class="orders-table-row">
	<td class="user-rates-table-subtitle">
		Multiples
	</td>
	<td class="user-rates-table-dynamic-value-cell">
		<span class="user-rates-table-dynamic-value"><?php echo $multiples ?></span>
	</td>
</tr>
</table>