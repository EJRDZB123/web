<?php
// Iniciar sesión
session_start();
 
// Verificar si el usuario inició sesión, si no, redirigir a la página de inicio de sesión
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
    exit;
}
?>
 
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&family=Playfair+Display:wght@400;700&display=swap');
        
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f5f5f5;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
        }
        
        .welcome-container {
            background-color: #ffffff;
            border-radius: 4px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            padding: 40px;
            width: 500px;
            max-width: 90%;
            text-align: center;
        }
        
        h1 {
            color: #1a2a3a;
            margin-bottom: 20px;
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            font-size: 28px;
            position: relative;
            padding-bottom: 10px;
        }
        
        h1:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 50px;
            height: 2px;
            background-color: #1a2a3a;
        }
        
        p {
            color: #333;
            font-size: 16px;
            margin-bottom: 30px;
            line-height: 1.6;
        }
        
        .btn {
            background-color: #1a2a3a;
            color: white;
            border: none;
            border-radius: 4px;
            padding: 12px 20px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-block;
            margin: 0 10px 20px 10px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        .btn:hover {
            background-color: #2c3e50;
        }
        
        .btn-productos {
            background-color: #3a4a5a;
        }
        
        .btn-productos:hover {
            background-color: #4a5a6a;
        }
        
        .btn-departamentos {
            background-color: #4a5a6a;
        }
        
        .btn-departamentos:hover {
            background-color: #5a6a7a;
        }
        
        .buttons-container {
            margin-top: 20px;
        }
        
        .divider {
            height: 1px;
            background-color: #e0e0e0;
            margin: 30px 0;
        }
    </style>
</head>
<body>
    <div class="welcome-container">
        <h1>Bienvenido, <?php echo htmlspecialchars($_SESSION["username"]); ?></h1>
        <p>Ha iniciado sesión correctamente. Seleccione una opción para continuar:</p>
        
        <div class="buttons-container">
            <a href="productos.php" class="btn btn-productos">Productos</a>
        
            <a href="pedidos.php" class="btn" style="background-color: #2e7d32;">Hacer Pedido</a>
        </div>
        
        <div class="divider"></div>
        
        <div class="buttons-container">
            <a href="logout.php" class="btn">Cerrar Sesión</a>
        </div>
    </div>
</body>
</html>