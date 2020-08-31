<?php
/*
*	Clase para manejar la tabla productos de la base de datos. Es clase hija de Validator.
*/
class Inventario extends Validator
{
    // Declaración de atributos (propiedades).
    private $id = null;
    private $producto = null;
    private $talla = null;
    private $genero = null;
    private $cantidad = null;

    /*
    *   Métodos para asignar valores a los atributos.
    */
    public function setId($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->id = $value;
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

    public function setGenero($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->genero = $value;
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


    /*
    *   Métodos para obtener valores de los atributos.
    */
    public function getId()
    {
        return $this->id;
    }


    public function getProducto()
    {
        return $this->producto;
    }

    public function getTalla()
    {
        return $this->talla;
    }

    public function getGenero()
    {
        return $this->genero;
    }

    public function getCantidad()
    {
        return $this->cantidad;
    }

    




    /*
    *   Métodos para realizar las operaciones SCRUD (search, create, read, update, delete).
    */
    public function searchInventario($value)
    {
        $sql = 'SELECT id_existencia, producto, imagen_producto, precio, producto.descripcion, talla, genero, cantidad FROM existencia
                INNER JOIN Producto 
                ON existencia.id_producto=Producto.id_producto
                INNER JOIN talla  ON
                existencia.id_talla=talla.id_talla
                INNER JOIN genero  ON
                existencia.id_genero = genero.id_genero
                WHERE producto ILIKE ? OR genero ILIKE ?';
                
            $params = array("%$value%", "%$value%");
            return Database::getRows($sql, $params);
    }

    public function createInventario()
    {
        
            $sql = 'insert into existencia(id_producto,id_talla,id_genero,cantidad)
                    VALUES(?, ?, ?, ?)';
            $params = array($this->producto, $this->talla, $this->genero, $this->cantidad);
            return Database::executeRow($sql, $params);
    }

    public function readAllInventario()
    {
        $sql = 'SELECT id_existencia,  producto, imagen_producto, precio, producto.descripcion, talla, genero, cantidad FROM existencia
                INNER JOIN Producto 
                ON existencia.id_producto=Producto.id_producto
                INNER JOIN talla  ON
                existencia.id_talla=talla.id_talla
                INNER JOIN genero  ON
                existencia.id_genero = genero.id_genero
                order by producto';
            $params = null;
            return Database::getRows($sql, $params);
    }

    public function readProductosMarca()
    {
        $sql = 'SELECT nombre, id_producto, imagen_producto, producto, descripcion, precio
                FROM producto INNER JOIN marca USING(id_marca)
                WHERE id_marca = ? 
                ORDER BY producto';
        $params = array($this->nombre);
        return Database::getRows($sql, $params);
    }

    public function readOneInventario()
    {
        $sql = 'SELECT id_existencia,  producto, imagen_producto, precio, producto.descripcion, talla, genero, cantidad FROM existencia
        INNER JOIN Producto 
        ON existencia.id_producto=Producto.id_producto
        INNER JOIN talla  ON
        existencia.id_talla=talla.id_talla
        INNER JOIN genero  ON
        existencia.id_genero = genero.id_genero
        where id_existencia = ?';
        $params = array($this->id);
        return Database::getRow($sql, $params);
    }


    public function updateInventario()
    {
      
         $sql = 'UPDATE existencia
                 SET  id_producto = ?, id_talla = ?, id_genero = ?, cantidad = ?
                WHERE id_existencia = ?';
         $params = array($this->producto, $this->talla, $this->genero, $this->cantidad, $this->id);
        return Database::executeRow($sql, $params);
     } 

    public function deleteProducto()
    {
        $sql = 'DELETE FROM wxistencia
                WHERE id_existencia = ?';
        $params = array($this->id);
        return Database::executeRow($sql, $params);
    }

    /*
    *   Métodos para generar gráficas.
    */
    public function cantidadProductosMarca()
    {
        $sql = 'SELECT nombre, COUNT(id_marca) cantidad
                FROM producto INNER JOIN marca USING(id_marca)
                GROUP BY id_marca, nombre';
        $params = null;
        return Database::getRows($sql, $params);
    }
}
?>