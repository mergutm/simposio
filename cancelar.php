<?php 
    $partes =  explode("/", base64_decode($_GET['clave']));
    
    try {

        $host = 'localhost';
        $dbname = '';
        $username = '';
        $password = '';


        $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8",
        $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // echo "conexion exitosa";

    } catch (PDOException $e) {
        die("Error de conexión: " . $e->getMessage());
    }   
    
    
    
    $stmt = $pdo->prepare("DELETE FROM asistentes WHERE  correo = '". $partes[0] . "' AND taller=".$partes[1]);

    $stmt->execute();

    echo '
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmación de inscripción</title>
</head>
<body>
    <script type="text/javascript">        
        alert("Se ha confirmado la eliminación de su inscripción al taller.  Al hacer click en Aceptar, serás redirigido a la página de talleres y podrás visualizar el cambio. ");        
        window.location.href = "https://simposio.utm.mx/inscripciones.php";
    </script>
</body>
</html>
';

?>
