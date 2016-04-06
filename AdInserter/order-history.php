<?php

$user_id = get_current_user_id();
$entries_query = "SELECT * FROM wp_frm_items WHERE user_id = $user_id";
$all_user_submissions = mysql_query($entries_query);

echo '<table class="orders-table">';

// Legende
echo '<tr class="orders-table-header-footer">';
echo '<td class="big-cell">Date</td><td class="small-cell">Type</td><td class="small-cell">Débits</td><td class="small-cell">Crédits</td>';
echo '</tr>';

// Lignes de data
while ($a_user_submission = mysql_fetch_object($all_user_submissions))
{
    // Date
    $created_at = $a_user_submission->created_at;
    $cut_created_at = substr($created_at, 0, 10);
    $created_at_with_slashes = str_replace('-', '/', $cut_created_at);
    $date_parts = explode('/', $created_at_with_slashes);
    $reversed_date_parts = array_reverse($date_parts);
    $formatted_created_at = $date_parts[2] . '/' . $date_parts[1] . '/' . $date_parts[0];

    // Type
    $type = null;
    switch ($a_user_submission->form_id) {
        case 2:
        $type = "note";
        break;

        case 3:
        $type = "screening";
        break;

        case 4:
        $type = "multiples";
        break;

        case 12:
        $type = "credit";
        break;
    }

    // Skipping all not "money related" entries
    if ($type == null) {
        continue;
    }

    // Cost
    // Getting metas
    $meta_query = "SELECT * FROM wp_frm_item_metas WHERE item_id = $a_user_submission->id";
    $meta_result = mysql_query($meta_query);
    $debit = "";
    $credit = "";
    while ($meta = mysql_fetch_object($meta_result))
    {

        if ($meta->field_id == 116 || $meta->field_id == 117 || $meta->field_id == 120 || $meta->field_id == 121) {
            // Note d'information
            $debit = $meta->meta_value;
        } else if ($meta->field_id == 169) {
            // Credit
            $credit = $meta->meta_value;
        }
    }
    
    echo '<tr>';
    echo '<td>' . $formatted_created_at . '</td><td>' . $type . '</td><td>' . $debit . '</td><td>' . $credit . '</td>';
    echo '</tr>';
}

$solde = get_user_meta($user_id, 'credits', 'true');
echo '<tr class="orders-table-header-footer">';
echo "<td>Solde de votre compte</td><td></td><td></td><td>$solde Crédits</td>";
echo '</tr>';

echo '</table>';

?>