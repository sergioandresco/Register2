<?php
require "validarHash.php";

if(isset($_POST["h1"], $_POST["h2"], $_POST["dinero"])){

    $validador=new validarHash("","","" );
    $resp=$validador->validarInfo($_POST["h1"],$_POST["h2"], $_POST["dinero"]);

    echo json_encode($resp);
}


?>
