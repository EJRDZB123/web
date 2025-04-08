<?php
// Iniciar sesión
session_start();
 
// Verificar si el usuario inició sesión, si no, redirigir a la página de inicio de sesión
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
    exit;
}

// Datos de productos de Sabritas
$productos = [
    ['id' => 1, 'nombre' => 'Sabritas Original 240g', 'precio' => '$48.50', 'cantidad' => 62],
    ['id' => 2, 'nombre' => 'Sabritas Adobadas 240g', 'precio' => '$48.50', 'cantidad' => 45],
    ['id' => 3, 'nombre' => 'Sabritas Sal y Limón 240g', 'precio' => '$48.50', 'cantidad' => 38],
    ['id' => 4, 'nombre' => 'Doritos Nacho 246g', 'precio' => '$52.00', 'cantidad' => 51],
    ['id' => 5, 'nombre' => 'Doritos Diablo 246g', 'precio' => '$52.00', 'cantidad' => 29],
    ['id' => 6, 'nombre' => 'Cheetos Torciditos 240g', 'precio' => '$48.00', 'cantidad' => 34],
    ['id' => 7, 'nombre' => 'Ruffles Queso 290g', 'precio' => '$54.50', 'cantidad' => 41],
    ['id' => 8, 'nombre' => 'Sabritas Original 58g', 'precio' => '$13.50', 'cantidad' => 87]
];
?>
 
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos de Sabritas</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&family=Playfair+Display:wght@400;700&display=swap');
        
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
            color: #333;
        }
        
        .header {
            background-color: #1a2a3a;
            color: white;
            padding: 1.5rem 0;
            text-align: center;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        
        .header h1 {
            margin: 0;
            font-size: 2rem;
            font-weight: 700;
            font-family: 'Playfair Display', serif;
        }
        
        .container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 1.5rem;
        }
        
        .products-table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
            border-radius: 4px;
            overflow: hidden;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }
        
        .products-table th {
            background-color: #1a2a3a;
            color: white;
            padding: 1rem;
            text-align: left;
            font-weight: 500;
            font-size: 0.9rem;
        }
        
        .products-table tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        
        .products-table td {
            padding: 0.8rem 1rem;
            border-bottom: 1px solid #eee;
        }
        
        .products-table tbody tr:hover {
            background-color: #f0f0f0;
        }
        
        .btn {
            display: inline-block;
            padding: 0.7rem 1.2rem;
            margin: 1.5rem 0.5rem 0;
            background-color: #1a2a3a;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            font-weight: 500;
            transition: all 0.3s;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-size: 0.9rem;
        }
        
        .btn:hover {
            background-color: #2c3e50;
        }
        
        .btn-back {
            background-color: #4a5a6a;
        }
        
        .btn-back:hover {
            background-color: #5a6a7a;
        }
        
        .btn-prev {
            background-color: #5c5c5c;
        }
        
        .btn-prev:hover {
            background-color: #6e6e6e;
        }
        
        .btn-next {
            background-color: #2c5282;
        }
        
        .btn-next:hover {
            background-color: #3a6ea5;
        }
        
        .btn-category {
            background-color: #2e5e3a;
        }
        
        .btn-category:hover {
            background-color: #3a704a;
        }
        
        .actions {
            text-align: center;
            margin-top: 2rem;
        }
        
        .stock-high {
            color: #2e7d32;
            font-weight: 500;
        }
        
        .stock-medium {
            color: #f57c00;
            font-weight: 500;
        }
        
        .stock-low {
            color: #c62828;
            font-weight: 500;
        }
        
        .product-name {
            font-weight: 400;
        }
        
        .price {
            font-weight: 500;
            color: #1a2a3a;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Productos de Sabritas</h1>
    </div>
    
    <div class="container">
        <table class="products-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($productos as $producto): ?>
                    <tr>
                        <td><?php echo $producto['id']; ?></td>
                        <td class="product-name"><?php echo $producto['nombre']; ?></td>
                        <td class="price"><?php echo $producto['precio']; ?></td>
                        <td class="<?php 
                            if($producto['cantidad'] > 30) echo 'stock-high';
                            elseif($producto['cantidad'] > 15) echo 'stock-medium';
                            else echo 'stock-low';
                        ?>">
                            <?php echo $producto['cantidad']; ?> unidades
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        
        <div class="actions">
        <a href="pedidos.php" class="btn" style="background-color: #2e7d32;">Hacer Pedido</a>
            <a href="inicio.php" class="btn btn-back">Volver al Inicio</a>
            <a href="productos.php" class="btn btn-prev">Anterior: Coca-Cola</a>
            <a href="frutas_verduras.php" class="btn btn-category">Frutas y Verduras</a>
        </div>
    </div>
</body>
</html>
