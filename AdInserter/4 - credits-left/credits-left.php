<?php
$user = wp_get_current_user();
$credits = get_user_meta($user->id, 'credits', 'true');
echo "<span class='my-account-credits-text'>Vous disposez de </span><span class='my-account-credits-value'>$credits</span><span class='my-account-credits-text'> crédits.</span>";
?>