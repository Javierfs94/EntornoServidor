<?php
/*
* Titulo: Ejercicios de repaso 2
* Descripcion: 
* 1.Escribe una función recursiva que sume los dígitos de un número.
* 2.Una pila es una estructura de datos a la que se accede siguiendo el siguiente criterio. El primer elemento en entrar es el último elemento en salir. Crea una clase para implementar una pila y haz un script que la utilice.
* 3.Crea un archivo de texto llamado CARTA y otro con nombres y direcciones llamado LISTA. Escribe un programa para enviar cartas personalizadas a cada una de las personas del archivo LISTA. En el fichero CARTA aparecerá marcado con llaves el texto que debe ser reemplazado. Por ejemplo, Estimado,a {nombre}
* 
* Autor: Francisco Javier Frías Serrano
*/
?>

<?php
  include "funciones.php";
  include "./class/Pila.php";
  include "./class/Carta.php";
  session_start();

  $numero = 0;
  $suma = 0;
  
if (isset($_POST["recursivo"])) {
  $numeros = str_split(strval($_POST["recursivo"]));
  foreach ($numeros as $key => $numero) {
    $suma += $numero;
  }
}

if (!isset($_SESSION["pila"])) {
  $_SESSION["pila"] = array();
}

if (isset($_POST["annadir"])) {
  if (isset($_POST["pila"]) && $_POST["pila"] != "") {
    $pila = new Pila($_SESSION["pila"]);
    $pila->push($_POST["pila"]);
    $_SESSION["pila"] = $pila->getElementos();
  }
}

if (isset($_POST["sacar"])) {
    $pila = new Pila($_SESSION["pila"]);
    $pila->pop();
    $_SESSION["pila"] = $pila->getElementos();
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css">
    <title>Ejercicios básicos semana 3</title>
</head>

<body>

<?php

echo "<h2>Ejercicio 1 Suma de dígitos por recursividad</h2>";
echo "<form action='index.php' method='post'>
<p>Número<input type='text' name='recursivo'></p>
<input type='submit' name='enviarRecursivo' value='Enviar'>
</form>";

if ($suma > 0) {
  echo "<p>La suma de los dígitos es " . $suma . "</p>";
}

echo "<hr>";

echo "<h2>Ejercicio 2 Pila</h2>"
;
echo "<form action='index.php' method='post'>
<p>Añadir a la pila <input type='text' name='pila'></p>
<input type='submit' name='annadir' value='Añadir a la pila'>
<input type='submit' name='sacar' value='Sacar de la pila'>
</form>";

if (isset($pila)){
  echo $pila->mostrarPila();
}

echo "<p><button><a href='logout.php'>Limpiar</a></button></p>";

echo "<hr>";

echo "<h2>Ejercicio 3 Creación de cartas personalizadas</h2>";

$carta = new Carta();
$carta->escribirCartas();

$cartas = $carta->getCartas();
foreach ($cartas as $key => $datos) {
    echo "<br><a href=\"./archivos/carta".$datos[0].".txt\" download=\"./archivos/carta".$datos[0].".txt\">Descargar la carta de ".$datos[0]."</a>";
}
?>

<?php
  // Boton para ir al repositorio del ejercicio
    echo "<br/><a href='https://github.com/Javierfs94/Entorno-Servidor/tree/master/dwes/complementarios/repaso2'><button>Repositorio</button></a>";    
?>

</body>

</html>