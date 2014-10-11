<?php

require('finder.class.php');
if (isset($_POST)) {
    $finder = new finder('products.csv');
    echo json_encode($finder->filter($_POST));
}
?>
