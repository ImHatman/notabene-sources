<?php
$user = wp_get_current_user();
echo "<span class='my-account-bonjour'>Bonjour, </span><span class='my-account-username'>$user->first_name</span>";
?>