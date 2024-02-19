<?php

include('connection.php');

$stmt =  $conn->prepare("SELECT * FROM productos WHERE producto_oferta > 0 LIMIT 4");

$stmt->execute();

$presentacion_productos = $stmt->get_result();



?>