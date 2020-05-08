# Register2

Es un software realizado en PHP enfocado a la verificación de los datos enviados por el  componente "Coodinador" donde se responderá "verdadero" o "falso" según la información recibida.

url:  http://register.local/recibirdata.php

Esta información recibida debe contener 3 datos:

+ Hash 1: Dirección pública de la "Wallet".
+ Hash 2: Dirección privada de la "Wallet".
+ Monto: Corresponde a la cantidad de dinero a ingresar.

```bash
$hash_1 = $_POST["h1"];
$hash_2 = $_POST["h2"];
(float) $dinero = $_POST["dinero"];
```

## Recepción de información
Se recibe la información en un archivo Json para la lectura de datos.

```bash
<?php
require "validarHash.php";

if(isset($_POST["h1"], $_POST["h2"], $_POST["dinero"])){

    $validador=new validarHash("","","" );
    $resp=$validador->validarInfo($_POST["h1"],$_POST["h2"], $_POST["dinero"]);

    echo json_encode($resp);
}

?>

```

## Validación Hash

Metodo donde se realiza la verificación de los hash recibidos ademas del monto.

```bash
    <?php 
class validarHash{
    private $hash_1;
    private $hash_2;
    private $dinero;

public function __construct($hash_1, $hash_2, $dinero)
    {
        $this->hash_1 = $hash_1;
        $this->hash_2 = $hash_2;
        $this->dinero = $dinero;
    }
    //Metodos de validar información
public function validarInfo($h1, $h2, $d){
    // VALIDAMOS EL TAMAÑO DE LOS HASH
    if (strlen ($h1) == 40 && strlen ($h2) == 40) { 
        $mensaje = "Sus dos llaves HASH son correctas "."<br />";
    } else {
        if (strlen ($h1) != 40) {
            $mensaje = 'Hash 2 valido-------- Hash1 no tiene la longitud adecuada - tiene '.strlen ($h1).' caracteres'."<br />";
        } else if (strlen ($h2) != 40) {
            $mensaje = 'Hash 1 valido-------- Hash2 no tiene la longitud adecuada -tiene '.strlen ($h2).' caracteres'."<br />";
        } 
    }
    //VALIDAR QUE LO INGRESADO EN DINERO SOLO SEAN NUMEROS
    if($d === 0){
        $mensaje1 = "El monto ingresado no corresponde a un valor númerico"."<br />";
    }else{
        $mensaje1 = "El monto ingresado esta correcto";
    }
   
}
}
$Informacion = json_encode($mensaje, $mensaje1);
return $Informacion;
?>
 
```
