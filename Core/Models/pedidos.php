<?php
/*
*	Clase para manejar la tabla usuarios de la base de datos. Es clase hija de Validator. xd
*	Clase para manejar la tabla usuarios de la base de datos. Es clase hija de Validator prueba 3 subir.
*/
class Pedidos extends Validator
{
    // Declaración de atributos (propiedades).

    private $id_pedido = null;
    private $id_detalle = null;
    private $cliente = null;
    private $producto = null;
    private $marca = null;
    private $talla = null;
    private $cantidad = null;
    private $precio = null;
    private $estado = null;

 
    

    /*
    *   Métodos para asignar valores a los atributos.
    */
    public function setIdPedido($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->id_pedido = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setIdDetalle($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->id_detalle = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setCliente($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->cliente = $value;
            return true;
        } else {
            return false;
        }
    }


    public function setProducto($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->producto = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setTalla($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->talla = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setMarca($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->marca = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setCantidad($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->cantidad = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setPrecio($value)
    {
        if ($this->validateMoney($value)) {
            $this->precio = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setEstado($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->estado = $value;
            return true;
        } else {
            return false;
        }
    }
    /*
    *   Métodos para obtener valores de los atributos.
    */
    public function getIdPedido()
    {
        return $this->id_pedido;
    }

    /*
    *   Métodos para realizar las operaciones SCRUD (search, create, read, update, delete).
    */

   
    //Metodo para commerce (crea un pedido para poder agregar detalles)
    public function readOrder()
    {
        $sql = 'SELECT id_pedido
                FROM pedido
                WHERE id_estado = 3 AND id_cliente = ?';
        $params = array($this->cliente);
        if ($data = Database::getRow($sql, $params)) {
            $this->id_pedido = $data['id_pedido'];
            return true;
        } else {
            $sql = 'INSERT INTO pedido (id_cliente, id_estado)
                    VALUES(?, 3)';
            $params = array($this->cliente);
            if (Database::executeRow($sql, $params)) {
                // Se obtiene el último valor insertado en la llave primaria de la tabla pedidos.
                $this->id_pedido = Database::getLastRowId();
                return true;
            } else {
                return false;
            }
        }
    }
    //Metodo para commerce(consulta para crear detalles )
    public function createDetail()
    {
        $sql = 'INSERT INTO detalle_pedido (id_producto,cantidad,precio,id_pedido,fecha_pedido,id_talla)
                VALUES (?,?,?,?,getdate(),?)'; 
        $params = array($this->producto, $this->cantidad, $this->precio, $this->id_pedido, $this->talla);
        return Database::executeRow($sql, $params);
    }

    public function searchPedidos($value)
    {
        $sql = 'SELECT detalle_pedido.id_detalle,producto.producto,marca.nombre as marca, talla.talla,
                detalle_pedido.precio,detalle_pedido.cantidad,estado_pedido.estado, cliente.apodo
                from pedido 
                inner join detalle_pedido using (id_pedido)
                Join producto using (id_producto)
                Join marca using (id_marca)
                Join talla using(id_talla)
                join estado_pedido using (id_estado)
                join cliente using(id_cliente)
                WHERE apodo ILIKE ? OR estado_pedido ILIKE ?
                ORDER BY apodo';
        $params = array("%$value%", "%$value%");
        return Database::getRows($sql, $params);
    }
    

    public function readAllPedidos()
    {
        $sql = 'SELECT id_pedido,estado_pedido.estado, cliente.apodo
                from pedido 
                Inner join estado_pedido using (id_estado)
                join cliente using(id_cliente)';
        $params = null;
        return Database::getRows($sql, $params);
    }

    // Método para obtener los productos que se encuentran en el carrito de compras.
    public function readCart()
    {
        $sql = 'SELECT detalle_pedido.id_detalle,producto.producto,marca.nombre AS marca,talla.talla,
                detalle_pedido.precio,detalle_pedido.cantidad
                FROM pedido INNER JOIN detalle_pedido USING (id_pedido)
                JOIN producto USING (id_producto)
                JOIN marca USING (id_marca)
                JOIN talla USING (id_talla)
                WHERE id_pedido = ?';
        $params = array($this->id_pedido);
        return Database::getRows($sql, $params);
    }
    //Metodo para commerce(Actualizar un detalle en el carrito)
    public function readOnePedido()
    {
        $sql = 'SELECT detalle_pedido.id_detalle,producto.producto,marca.nombre as marca, talla.talla,
                detalle_pedido.precio,detalle_pedido.cantidad,estado_pedido.estado, cliente.apodo
                from pedido 
                inner join detalle_pedido using (id_pedido)
                Join producto using (id_producto)
                Join marca using (id_marca)
                Join talla using(id_talla)
                join estado_pedido using (id_estado)
                join cliente using(id_cliente)
                WHERE id_detalle = ?';
        $params = array($this->id_detalle);
        return Database::getRow($sql, $params);
    }
    //Metodo para commerce(verifica el estado del pedido)
    public function updateOrderStatus()
    {
        $sql = 'UPDATE pedido
                SET id_estado = ?
                WHERE id_pedido = ?';
        $params = array($this->estado, $this->id_pedido);
        return Database::executeRow($sql, $params);
    }

    // Método para actualizar la cantidad de un producto agregado al carrito de compras.
    public function updateDetail()
    {
        $sql = 'UPDATE detalle_pedido
                SET cantidad = ?, id_talla = ?
                WHERE id_pedido = ? AND id_detalle = ?';
        $params = array($this->cantidad,$this->talla, $this->id_pedido, $this->id_detalle);
        return Database::executeRow($sql, $params);
    }

    //Consulta para reporte pedidos de un cliente
    public function readPedidoCliente()
    {
        $sql = 'SELECT apodo,count(apodo)AS Pedidos 
        FROM cliente INNER JOIN pedido 
        USING(id_cliente) 
        GROUP BY apodo
        ORDER BY Pedidos DESC';
        $params = null;
        return Database::getRows($sql, $params);
    }

     /*
    *   Métodos para generar gráficas.
    */
    public function cantidadEstadoPedido()
    {
        $sql = 'SELECT COUNT (id_pedido) as pedido, estado FROM pedido 
                INNER JOIN estado_pedido using(id_estado) GROUP BY estado';
        $params = null;
        return Database::getRows($sql, $params);
    }

    public function deleteDetail()
    {
        $sql = 'DELETE FROM detalle_pedido
                WHERE id_pedido = ? AND id_detalle = ?';
        $params = array($this->id_pedido, $this->id_detalle);
        return Database::executeRow($sql, $params);
    }


    public function getEstadosCb()
    {
        $sql  = 'SELECT id_estado, estado FROM estado WHERE id_estado != 3';
        $params = null;
        return Database::getRows($sql, $params);
    }

    public function getTallaCb()
    {
        $sql  = 'SELECT id_talla, talla FROM talla';
        $params = null;
        return Database::getRows($sql, $params);
    }

    public function readPedidosFecha()
    {
        $sql = 'SELECT apodo, fecha_pedido , estado
        FROM pedido INNER JOIN cliente USING(id_cliente)
        ORDER BY fecha_pedido , apodo , estado';
        $params = null;
        return Database::getRows($sql, $params);
    }

}
?>