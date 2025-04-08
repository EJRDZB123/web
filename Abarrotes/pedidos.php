<?php
// Datos de productos de Sabritas
$productos_sabritas = [
    ['id' => 1, 'nombre' => 'Sabritas Original 240g', 'precio' => '$48.50', 'cantidad' => 62],
    ['id' => 2, 'nombre' => 'Sabritas Adobadas 240g', 'precio' => '$48.50', 'cantidad' => 45],
    ['id' => 3, 'nombre' => 'Sabritas Sal y Limón 240g', 'precio' => '$48.50', 'cantidad' => 38],
    ['id' => 4, 'nombre' => 'Doritos Nacho 246g', 'precio' => '$52.00', 'cantidad' => 51],
    ['id' => 5, 'nombre' => 'Doritos Diablo 246g', 'precio' => '$52.00', 'cantidad' => 29],
    ['id' => 6, 'nombre' => 'Cheetos Torciditos 240g', 'precio' => '$48.00', 'cantidad' => 34],
    ['id' => 7, 'nombre' => 'Ruffles Queso 290g', 'precio' => '$54.50', 'cantidad' => 41],
    ['id' => 8, 'nombre' => 'Sabritas Original 58g', 'precio' => '$13.50', 'cantidad' => 87]
];
// Datos de productos de Coca-Cola
$productos_cocacola = [
    ['id' => 1, 'nombre' => 'Coca-Cola Original 600ml', 'precio' => '$18.50', 'cantidad' => 56],
    ['id' => 2, 'nombre' => 'Coca-Cola Light 600ml', 'precio' => '$18.50', 'cantidad' => 42],
    ['id' => 3, 'nombre' => 'Coca-Cola Sin Azúcar 600ml', 'precio' => '$18.50', 'cantidad' => 38],
    ['id' => 4, 'nombre' => 'Coca-Cola Original 2L', 'precio' => '$32.00', 'cantidad' => 45],
    ['id' => 5, 'nombre' => 'Coca-Cola Light 2L', 'precio' => '$32.00', 'cantidad' => 23],
    ['id' => 6, 'nombre' => 'Coca-Cola Sin Azúcar 2L', 'precio' => '$32.00', 'cantidad' => 19],
    ['id' => 7, 'nombre' => 'Coca-Cola Lata 355ml', 'precio' => '$14.00', 'cantidad' => 78],
    ['id' => 8, 'nombre' => 'Coca-Cola Light Lata 355ml', 'precio' => '$14.00', 'cantidad' => 51]
];
// Datos de productos de Frutas y Verduras
$productos_frutas = [
    ['id' => 1, 'nombre' => 'Manzana', 'precio' => '$42.90', 'cantidad' => 85],
    ['id' => 2, 'nombre' => 'Plátano', 'precio' => '$19.90', 'cantidad' => 120],
    ['id' => 3, 'nombre' => 'Naranja', 'precio' => '$24.50', 'cantidad' => 95],
    ['id' => 4, 'nombre' => 'Tomate', 'precio' => '$31.90', 'cantidad' => 65],
    ['id' => 5, 'nombre' => 'Cebolla', 'precio' => '$27.50', 'cantidad' => 78],
    ['id' => 6, 'nombre' => 'Papa', 'precio' => '$29.90', 'cantidad' => 110],
    ['id' => 7, 'nombre' => 'Aguacate', 'precio' => '$69.90', 'cantidad' => 55],
    ['id' => 8, 'nombre' => 'Zanahoria', 'precio' => '$18.50', 'cantidad' => 90]
];

// Iniciar sesión
session_start();
 
// Verificar si el usuario inició sesión, si no, redirigir a la página de inicio de sesión
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
    exit;
}

// Inicializar carrito si no existe
if(!isset($_SESSION["carrito"])) {
    $_SESSION["carrito"] = [];
}

// Procesar acción de agregar al carrito
if(isset($_POST['agregar_producto']) && isset($_POST['producto_id']) && isset($_POST['categoria'])) {
    $producto_id = intval($_POST['producto_id']);
    $categoria = $_POST['categoria'];
    $cantidad = isset($_POST['cantidad']) ? intval($_POST['cantidad']) : 1;
    
    // Obtener datos del producto según la categoría
    $producto_data = null;
    foreach(${"productos_" . $categoria} as $prod) {
        if($prod['id'] == $producto_id) {
            $producto_data = $prod;
            break;
        }
    }
    
    if($producto_data) {
        $precio_limpio = str_replace(['$', ','], '', $producto_data['precio']);
        $precio_numero = floatval($precio_limpio);
        
        $item = [
            'id' => $producto_id,
            'nombre' => $producto_data['nombre'],
            'precio_unitario' => $precio_numero,
            'cantidad' => $cantidad,
            'categoria' => $categoria,
            'subtotal' => $precio_numero * $cantidad
        ];
        
        // Generar ID único para el item del carrito
        $cart_item_id = uniqid();
        $_SESSION["carrito"][$cart_item_id] = $item;
    }
}

// Procesar acción de eliminar del carrito
if(isset($_POST['eliminar_producto']) && isset($_POST['cart_item_id'])) {
    $cart_item_id = $_POST['cart_item_id'];
    if(isset($_SESSION["carrito"][$cart_item_id])) {
        unset($_SESSION["carrito"][$cart_item_id]);
    }
}

// Vaciar carrito completo
if(isset($_POST['vaciar_carrito'])) {
    $_SESSION["carrito"] = [];
}

// Datos de productos de Coca-Cola
$productos_cocacola = [
    ['id' => 1, 'nombre' => 'Coca-Cola Original 600ml', 'precio' => '$18.50', 'cantidad' => 56],
    ['id' => 2, 'nombre' => 'Coca-Cola Light 600ml', 'precio' => '$18.50', 'cantidad' => 42],
    ['id' => 3, 'nombre' => 'Coca-Cola Sin Azúcar 600ml', 'precio' => '$18.50', 'cantidad' => 38],
    ['id' => 4, 'nombre' => 'Coca-Cola Original 2L', 'precio' => '$32.00', 'cantidad' => 45],
    ['id' => 5, 'nombre' => 'Coca-Cola Light 2L', 'precio' => '$32.00', 'cantidad' => 23],
    ['id' => 6, 'nombre' => 'Coca-Cola Sin Azúcar 2L', 'precio' => '$32.00', 'cantidad' => 19],
    ['id' => 7, 'nombre' => 'Coca-Cola Lata 355ml', 'precio' => '$14.00', 'cantidad' => 78],
    ['id' => 8, 'nombre' => 'Coca-Cola Light Lata 355ml', 'precio' => '$14.00', 'cantidad' => 51]
];

// Datos de productos de Sabritas
$productos_sabritas = [
    ['id' => 1, 'nombre' => 'Sabritas Original 240g', 'precio' => '$48.50', 'cantidad' => 62],
    ['id' => 2, 'nombre' => 'Sabritas Adobadas 240g', 'precio' => '$48.50', 'cantidad' => 45],
    ['id' => 3, 'nombre' => 'Sabritas Sal y Limón 240g', 'precio' => '$48.50', 'cantidad' => 38],
    ['id' => 4, 'nombre' => 'Doritos Nacho 246g', 'precio' => '$52.00', 'cantidad' => 51],
    ['id' => 5, 'nombre' => 'Doritos Diablo 246g', 'precio' => '$52.00', 'cantidad' => 29],
    ['id' => 6, 'nombre' => 'Cheetos Torciditos 240g', 'precio' => '$48.00', 'cantidad' => 34],
    ['id' => 7, 'nombre' => 'Ruffles Queso 290g', 'precio' => '$54.50', 'cantidad' => 41],
    ['id' => 8, 'nombre' => 'Sabritas Original 58g', 'precio' => '$13.50', 'cantidad' => 87]
];

// Datos de productos de Frutas y Verduras
$productos_frutas = [
    ['id' => 1, 'nombre' => 'Manzana', 'precio' => '$42.90', 'cantidad' => 85],
    ['id' => 2, 'nombre' => 'Plátano', 'precio' => '$19.90', 'cantidad' => 120],
    ['id' => 3, 'nombre' => 'Naranja', 'precio' => '$24.50', 'cantidad' => 95],
    ['id' => 4, 'nombre' => 'Tomate', 'precio' => '$31.90', 'cantidad' => 65],
    ['id' => 5, 'nombre' => 'Cebolla', 'precio' => '$27.50', 'cantidad' => 78],
    ['id' => 6, 'nombre' => 'Papa', 'precio' => '$29.90', 'cantidad' => 110],
    ['id' => 7, 'nombre' => 'Aguacate', 'precio' => '$69.90', 'cantidad' => 55],
    ['id' => 8, 'nombre' => 'Zanahoria', 'precio' => '$18.50', 'cantidad' => 90]
];

// Calcular total del carrito
$total_carrito = 0;
foreach($_SESSION["carrito"] as $item) {
    $total_carrito += $item['subtotal'];
}
?>
 
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Realizar Pedido</title>
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
            display: flex;
            flex-wrap: wrap;
            gap: 2rem;
        }
        
        .products-section {
            flex: 2;
            min-width: 300px;
        }
        
        .cart-section {
            flex: 1;
            min-width: 300px;
            position: sticky;
            top: 20px;
            align-self: flex-start;
        }
        
        .card {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 2rem;
            overflow: hidden;
        }
        
        .card-header {
            padding: 1.2rem;
            background-color: #1a2a3a;
            color: white;
        }
        
        .card-header h2 {
            margin: 0;
            font-size: 1.4rem;
            font-weight: 500;
        }
        
        .card-body {
            padding: 1.2rem;
        }
        
        .category-title {
            font-size: 1.3rem;
            margin: 0.5rem 0 1.5rem;
            border-bottom: 2px solid #eee;
            padding-bottom: 8px;
            font-weight: 500;
            color: #1a2a3a;
        }
        
        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
            gap: 1rem;
        }
        
        .product-card {
            border: 1px solid #eee;
            border-radius: 6px;
            padding: 1rem;
            transition: all 0.2s ease;
        }
        
        .product-card:hover {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transform: translateY(-2px);
        }
        
        .product-name {
            font-weight: 500;
            margin-bottom: 0.5rem;
        }
        
        .product-price {
            color: #1a2a3a;
            font-weight: 600;
            margin-bottom: 0.8rem;
        }
        
        .product-stock {
            font-size: 0.9rem;
            margin-bottom: 1rem;
        }
        
        .stock-high {
            color: #2e7d32;
        }
        
        .stock-medium {
            color: #f57c00;
        }
        
        .stock-low {
            color: #c62828;
        }
        
        .add-form {
            display: flex;
            align-items: center;
            margin-top: 0.5rem;
        }
        
        .quantity-input {
            width: 40px;
            padding: 5px;
            border: 1px solid #ddd;
            border-radius: 4px;
            margin-right: 8px;
            text-align: center;
        }
        
        .btn {
            display: inline-block;
            padding: 0.6rem 1rem;
            background-color: #1a2a3a;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            font-weight: 500;
            transition: all 0.3s;
            font-size: 0.85rem;
            border: none;
            cursor: pointer;
            text-align: center;
        }
        
        .btn:hover {
            background-color: #2c3e50;
        }
        
        .btn-add {
            background-color: #2e7d32;
            flex-grow: 1;
        }
        
        .btn-add:hover {
            background-color: #388e3c;
        }
        
        .btn-back {
            background-color: #4a5a6a;
            margin-top: 1.5rem;
            display: inline-block;
        }
        
        .btn-back:hover {
            background-color: #5a6a7a;
        }
        
        .btn-remove {
            background-color: #c62828;
            padding: 4px 8px;
            font-size: 0.75rem;
        }
        
        .btn-remove:hover {
            background-color: #d32f2f;
        }
        
        .btn-empty {
            background-color: #f44336;
            margin-top: 1rem;
        }
        
        .btn-empty:hover {
            background-color: #e53935;
        }
        
        .btn-order {
            background-color: #2e7d32;
            margin-top: 1rem;
            width: 100%;
            padding: 0.8rem;
            font-size: 1rem;
            text-transform: uppercase;
        }
        
        .btn-order:hover {
            background-color: #388e3c;
        }
        
        .cart-items {
            margin-bottom: 1.5rem;
        }
        
        .cart-item {
            padding: 0.8rem;
            border-bottom: 1px solid #eee;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .cart-item-details {
            flex-grow: 1;
        }
        
        .cart-item-name {
            font-weight: 500;
            margin-bottom: 4px;
        }
        
        .cart-item-price {
            font-size: 0.9rem;
            color: #666;
        }
        
        .cart-empty {
            padding: 2rem 1rem;
            text-align: center;
            color: #888;
            font-style: italic;
        }
        
        .cart-total {
            padding: 1rem;
            border-top: 2px solid #eee;
            display: flex;
            justify-content: space-between;
            font-weight: 700;
            font-size: 1.1rem;
        }
        
        .category-tabs {
            display: flex;
            margin-bottom: 1.5rem;
            overflow-x: auto;
            white-space: nowrap;
            border-bottom: 1px solid #ddd;
        }
        
        .category-tab {
            padding: 0.8rem 1.2rem;
            cursor: pointer;
            border-bottom: 3px solid transparent;
            transition: all 0.2s;
        }
        
        .category-tab.active {
            border-bottom-color: #1a2a3a;
            font-weight: 500;
        }
        
        .category-tab:hover:not(.active) {
            border-bottom-color: #bbb;
        }
        
        .category-content {
            display: none;
        }
        
        .category-content.active {
            display: block;
        }
        
        .actions {
            margin-top: 2rem;
            text-align: center;
        }
        
        .note {
            font-size: 0.85rem;
            color: #888;
            margin-top: 1rem;
            text-align: center;
            font-style: italic;
        }
        
        /* Estilos específicos por categoría */
        .cocacola-tab {
            color: #c62828;
        }
        
        .cocacola-tab.active {
            border-bottom-color: #c62828;
        }
        
        .sabritas-tab {
            color: #ffa000;
        }
        
        .sabritas-tab.active {
            border-bottom-color: #ffa000;
        }
        
        .frutas-tab {
            color: #2e7d32;
        }
        
        .frutas-tab.active {
            border-bottom-color: #2e7d32;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Realizar Pedido</h1>
    </div>
    
    <div class="container">
        <section class="products-section">
            <div class="card">
                <div class="card-header">
                    <h2>Productos Disponibles</h2>
                </div>
                <div class="card-body">
                    <div class="category-tabs">
                        <div class="category-tab cocacola-tab active" onclick="changeTab('cocacola')">Coca-Cola</div>
                        <div class="category-tab sabritas-tab" onclick="changeTab('sabritas')">Sabritas</div>
                        <div class="category-tab frutas-tab" onclick="changeTab('frutas')">Frutas y Verduras</div>
                    </div>
                    
                    <div class="category-content active" id="cocacola">
                        <h3 class="category-title">Productos de Coca-Cola</h3>
                        <div class="products-grid">
                            <?php foreach($productos_cocacola as $producto): ?>
                                <div class="product-card">
                                    <div class="product-name"><?php echo $producto['nombre']; ?></div>
                                    <div class="product-price"><?php echo $producto['precio']; ?></div>
                                    <div class="product-stock <?php 
                                        if($producto['cantidad'] > 30) echo 'stock-high';
                                        elseif($producto['cantidad'] > 15) echo 'stock-medium';
                                        else echo 'stock-low';
                                    ?>">
                                        Disponible: <?php echo $producto['cantidad']; ?> unidades
                                    </div>
                                    <form method="post" class="add-form">
                                        <input type="hidden" name="producto_id" value="<?php echo $producto['id']; ?>">
                                        <input type="hidden" name="categoria" value="cocacola">
                                        <input type="number" name="cantidad" value="1" min="1" max="<?php echo $producto['cantidad']; ?>" class="quantity-input">
                                        <button type="submit" name="agregar_producto" class="btn btn-add">Agregar</button>
                                    </form>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    
                    <div class="category-content" id="sabritas">
                        <h3 class="category-title">Productos de Sabritas</h3>
                        <div class="products-grid">
                            <?php foreach($productos_sabritas as $producto): ?>
                                <div class="product-card">
                                    <div class="product-name"><?php echo $producto['nombre']; ?></div>
                                    <div class="product-price"><?php echo $producto['precio']; ?></div>
                                    <div class="product-stock <?php 
                                        if($producto['cantidad'] > 30) echo 'stock-high';
                                        elseif($producto['cantidad'] > 15) echo 'stock-medium';
                                        else echo 'stock-low';
                                    ?>">
                                        Disponible: <?php echo $producto['cantidad']; ?> unidades
                                    </div>
                                    <form method="post" class="add-form">
                                        <input type="hidden" name="producto_id" value="<?php echo $producto['id']; ?>">
                                        <input type="hidden" name="categoria" value="sabritas">
                                        <input type="number" name="cantidad" value="1" min="1" max="<?php echo $producto['cantidad']; ?>" class="quantity-input">
                                        <button type="submit" name="agregar_producto" class="btn btn-add">Agregar</button>
                                    </form>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    
                    <div class="category-content" id="frutas">
                        <h3 class="category-title">Frutas y Verduras</h3>
                        <div class="note">Precios por kilogramo</div>
                        <div class="products-grid">
                            <?php foreach($productos_frutas as $producto): ?>
                                <div class="product-card">
                                    <div class="product-name"><?php echo $producto['nombre']; ?></div>
                                    <div class="product-price"><?php echo $producto['precio']; ?>/kg</div>
                                    <div class="product-stock <?php 
                                        if($producto['cantidad'] > 80) echo 'stock-high';
                                        elseif($producto['cantidad'] > 50) echo 'stock-medium';
                                        else echo 'stock-low';
                                    ?>">
                                        Disponible: <?php echo $producto['cantidad']; ?> kg
                                    </div>
                                    <form method="post" class="add-form">
                                        <input type="hidden" name="producto_id" value="<?php echo $producto['id']; ?>">
                                        <input type="hidden" name="categoria" value="frutas">
                                        <input type="number" name="cantidad" value="1" min="0.5" max="<?php echo $producto['cantidad']; ?>" step="0.5" class="quantity-input">
                                        <button type="submit" name="agregar_producto" class="btn btn-add">Agregar</button>
                                    </form>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="actions">
                <a href="inicio.php" class="btn btn-back">Volver al Inicio</a>
            </div>
        </section>
        
        <section class="cart-section">
            <div class="card">
                <div class="card-header">
                    <h2>Tu Pedido</h2>
                </div>
                <div class="card-body">
                    <div class="cart-items">
                        <?php if(empty($_SESSION["carrito"])): ?>
                            <div class="cart-empty">
                                Tu carrito está vacío
                            </div>
                        <?php else: ?>
                            <?php foreach($_SESSION["carrito"] as $cart_item_id => $item): ?>
                                <div class="cart-item">
                                    <div class="cart-item-details">
                                        <div class="cart-item-name"><?php echo $item['nombre']; ?></div>
                                        <div class="cart-item-price">
                                            $<?php echo number_format($item['precio_unitario'], 2); ?> x 
                                            <?php echo $item['cantidad']; ?>
                                            <?php echo $item['categoria'] == 'frutas' ? 'kg' : 'unidades'; ?>
                                        </div>
                                    </div>
                                    <div class="cart-item-subtotal">
                                        $<?php echo number_format($item['subtotal'], 2); ?>
                                    </div>
                                    <form method="post" style="margin-left: 10px;">
                                        <input type="hidden" name="cart_item_id" value="<?php echo $cart_item_id; ?>">
                                        <button type="submit" name="eliminar_producto" class="btn btn-remove">X</button>
                                    </form>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                    
                    <div class="cart-total">
                        <span>Total:</span>
                        <span>$<?php echo number_format($total_carrito, 2); ?></span>
                    </div>
                    
                    <form method="post">
                        <button type="submit" name="vaciar_carrito" class="btn btn-empty">Vaciar Carrito</button>
                    </form>
                    
                    <button type="button" class="btn btn-order" onclick="finalizarPedido()">Finalizar Pedido</button>
                </div>
            </div>
        </section>
    </div>
    
    <script>
        function changeTab(category) {
            // Ocultar todos los contenidos
            document.querySelectorAll('.category-content').forEach(function(content) {
                content.classList.remove('active');
            });
            
            // Desactivar todas las pestañas
            document.querySelectorAll('.category-tab').forEach(function(tab) {
                tab.classList.remove('active');
            });
            
            // Mostrar el contenido seleccionado
            document.getElementById(category).classList.add('active');
            
            // Activar la pestaña seleccionada
            document.querySelectorAll('.' + category + '-tab').forEach(function(tab) {
                tab.classList.add('active');
            });
        }
        
        function finalizarPedido() {
            // En una aplicación real, aquí iría la lógica para procesar el pedido
            // Por ahora solo mostramos una alerta
            const total = <?php echo $total_carrito; ?>;
            
            if (total <= 0) {
                alert('Agrega productos a tu carrito antes de finalizar el pedido');
                return;
            }
            
            if (confirm('¿Confirmar pedido por $' + total.toFixed(2) + '?')) {
                alert('¡Pedido realizado con éxito!');
                // En una aplicación real, aquí podríamos redirigir a una página de confirmación
                window.location.href = 'pedidos.php?pedido_confirmado=1';
            }
        }
    </script>
</body>
</html>