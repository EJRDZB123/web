<?php
session_start();

// Verificar si ya hay una sesión activa
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    header("location: inicio.php");
    exit;
}

// Inicializar variables
$username = $password = "";
$username_err = $password_err = "";

// Procesar datos del formulario
if($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Validar usuario
    if(empty(trim($_POST["username"]))) {
        $username_err = "Por favor ingrese su usuario.";
    } else {
        $username = trim($_POST["username"]);
    }
    
    // Validar contraseña
    if(empty(trim($_POST["password"]))) {
        $password_err = "Por favor ingrese su contraseña.";
    } else {
        $password = trim($_POST["password"]);
    }
    
    // Validar credenciales
    if(empty($username_err) && empty($password_err)) {
        // Verificar si el usuario y contraseña coinciden con los valores esperados
        if($username === "Kike" && $password === "2486") {
            // Iniciar sesión
            $_SESSION["loggedin"] = true;
            $_SESSION["username"] = $username;
            
            // Redireccionar a la página de inicio
            header("location: inicio.php");
        } else {
            // Mostrar mensaje de error si las credenciales no son válidas
            $login_err = "Usuario o contraseña incorrectos.";
        }
    }
}
?>
 
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
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
        
        .login-container {
            background-color: #ffffff;
            border-radius: 4px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            padding: 40px;
            width: 400px;
            max-width: 90%;
            text-align: center;
        }
        
        h2 {
            color: #1a2a3a;
            margin-bottom: 30px;
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            font-size: 24px;
            position: relative;
            padding-bottom: 10px;
        }
        
        h2:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 50px;
            height: 2px;
            background-color: #1a2a3a;
        }
        
        .form-group {
            margin-bottom: 25px;
            text-align: left;
        }
        
        label {
            display: block;
            margin-bottom: 8px;
            color: #1a2a3a;
            font-weight: 500;
            font-size: 14px;
        }
        
        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #d1d1d1;
            border-radius: 4px;
            background-color: #f9f9f9;
            font-size: 14px;
            color: #333;
            transition: all 0.3s;
            box-sizing: border-box;
        }
        
        input[type="text"]:focus, input[type="password"]:focus {
            background-color: #fff;
            border-color: #1a2a3a;
            outline: none;
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
            width: 100%;
            transition: all 0.3s;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        .btn:hover {
            background-color: #2c3e50;
        }
        
        .error-message {
            color: #d32f2f;
            margin-bottom: 20px;
            font-size: 14px;
            padding: 10px;
            background-color: #fdf0f0;
            border-left: 3px solid #d32f2f;
            text-align: left;
        }
        
        .invalid-feedback {
            color: #d32f2f;
            font-size: 12px;
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Iniciar Sesión</h2>
        
        <?php if(!empty($login_err)): ?>
            <div class="error-message"><?php echo $login_err; ?></div>
        <?php endif; ?>
        
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>Usuario</label>
                <input type="text" name="username" class="<?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                <?php if(!empty($username_err)): ?>
                    <span class="invalid-feedback"><?php echo $username_err; ?></span>
                <?php endif; ?>
            </div>    
            <div class="form-group">
                <label>Contraseña</label>
                <input type="password" name="password" class="<?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
                <?php if(!empty($password_err)): ?>
                    <span class="invalid-feedback"><?php echo $password_err; ?></span>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <input type="submit" class="btn" value="Acceder">
            </div>
        </form>
    </div>
</body>
</html>