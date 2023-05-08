<!DOCTYPE HTML>  
<html>
<head>
<style>
.error {color: #FF0000;}
</style>
</head>
<body>  

<?php
// Definir las variables con vadenas vacias
$nameErr = $emailErr = $mensajeErr =  "";
$nombre = $email = $asunto = $mensaje = "";
	
//Auntenticarse en la BD
$servername = "p-6.mysql.database.azure.com";
$username = "emanuel";
$password = "Hola123456";
$dbname = "datos_db";
 
// Create connection
$conn = new mysqli($servername,
    $username, $password, $dbname);
 
// Check connection
if ($conn->connect_error) {
    die("Connection failed: "
        . $conn->connect_error);
}
 

if ($_SERVER["REQUEST_METHOD"] == "GET") {
  
  if (empty($_GET["nombre"])) {    
	  $nameErr = "El nombre es requerido";
  } else {
    $nombre = test_input($_GET["nombre"]);    
  }
  
  if (empty($_GET["email"])) {
    $emailErr = "El correo es requerido";
  } else {
    $email = test_input($_GET["email"]);
    // Verificar si es un correo correcto
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Formato de correo no válido";
    }
  }
    
  if (empty($_GET["asunto"])) {
    $asunto = "";
  } else {
    $asunto = test_input($_GET["asunto"]);    
    } 

  if (empty($_GET["mensaje"])) {
    $mensaje = "";
  } else {
    $mensaje = test_input($_GET["mensaje"]);
  }

#Ingresar los datos en la base de datos
	$sql = "INSERT INTO datos(nombre, email, asunto, mensaje) VALUES
    	('".$nombre."', '".$email."', '".$asunto."','".$mensaje."')";
 
	if ($conn->query($sql) === TRUE) {
    	echo "<h2>Tus comentarios fueron enviados correctamente</h2>";
	} else {
    	echo "Error: " . $sql . "<br>" . $conn->error;
	}

// Cerrar la conexión.
$conn->close();
}


	
	
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

<?php
echo "";
echo $nombre;
echo "<br>";
echo $email;
echo "<br>";
echo $asunto;
echo "<br>";
echo $mensaje;
?>

</body>
</html>
