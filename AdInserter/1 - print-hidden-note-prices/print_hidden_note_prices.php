<?php 

?>

<div id="dom-target" style="display: none;">
    <?php 
        $output = "42"; //Again, do some operation, get the output.
        echo htmlspecialchars($output); /* You have to escape because the result
                                           will not be valid HTML otherwise. */
    ?>
</div>