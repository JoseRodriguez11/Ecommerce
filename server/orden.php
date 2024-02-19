<?php 

session_start();
include('connection.php');

if(!isset($_SESSION['inicio_sesion'])){
    header('location: ../pago.php?message= Inicia sesión para realizar el pedido');
    exit;
    
}else{

    if(isset($_POST['realizar_pedido'])){

        //obtener informacion cliente
        $nombre = $_POST['nombre'];
        $correo = $_POST['correo'];
        $celular = $_POST['celular'];
        $direccion = $_POST['direccion'];
        $ciudad =$_POST['ciudad'];
        $pedido_costo =$_SESSION['total'];
        $pedido_estado ="Sin pagar";
        $usuario_id = $_SESSION['usuario_id'];
        $pedido_fecha = date('Y-m-d H:i:s');
    
    
        $stmt = $conn->prepare("INSERT INTO pedidos (pedido_costo,pedido_estado,usuario_id,usuario_tel,usuario_ciudad,usuario_direccion,pedido_fecha)
                        VALUES (?,?,?,?,?,?,?);");
        $stmt-> bind_param('isiisss',$pedido_costo,$pedido_estado,$usuario_id,$celular,$ciudad,$direccion,$pedido_fecha);
    
        $stmt_estado = $stmt->execute();
    
        if(!$stmt_estado){
            header('location: index.php');
            exit;
        }
    
        $pedido_id = $stmt-> insert_id;//se obtine la orden desde la base de datos 
    
    
        //obtener productos de carro de compras 
        foreach($_SESSION['carro'] as $key => $value){
    
            $producto = $_SESSION['carro'][$key];
            $producto_id = $producto['producto_id'];
            $producto_nombre = $producto['producto_nombre'];
            $producto_precio = $producto['producto_precio'];
            $producto_imagen = $producto['producto_imagen'];
            $producto_cantidad = $producto['producto_cantidad'];
    
            $stmt1 = $conn->prepare("INSERT INTO pedido_items (pedido_id,producto_id,producto_nombre,producto_imagen,producto_precio,producto_cantidad,usuario_id,pedido_fecha)
                        VALUES (?,?,?,?,?,?,?,?);");
    
            $stmt1 ->bind_param('iissiiis',$pedido_id,$producto_id,$producto_nombre,$producto_imagen,$producto_precio,$producto_cantidad,$usuario_id,$pedido_fecha);
    
            $stmt1->execute();
    
        }
    
        //unset($_SESSION['carro']);
    
        header('location: ../informacion_pago.php?pedido_estado=Pedio Realizado Exitosamente');
    }
}




?>