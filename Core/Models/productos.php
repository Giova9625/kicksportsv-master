<?php
/*
*	Clase para manejar la tabla productos de la base de datos. Es clase hija de Validator.
*/
class Productos extends Validator
{
    // Declaración de atributos (propiedades).
    private $id = null;
    private $producto = null;
    private $descripcion = null;
    private $precio = null;
    private $imagen = null;
    private $archivo = null;
    private $nombre = null;
    private $ruta = '../../../Resources/Img/productos/';

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
        if ($this->validateAlphanumeric($value, 1, 50)) {
            $this->producto = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setDescripcion($value)
    {
        if ($this->validateString($value, 1, 250)) {
            $this->descripcion = $value;
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

    public function setImagen($file)
    {
        if ($this->validateImageFile($file, 500, 500)) {
            $this->imagen = $this->getImageName();
            $this->archivo = $file;
            return true;
        } else {
            return false;
        }
    }

    public function setNombre($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->nombre = $value;
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
        return $this->nombre;
    }

    public function getDescripcion()
    {
        return $this->descripcion;
    }

    public function getPrecio()
    {
        return $this->precio;
    }

    public function getImagen()
    {
        return $this->imagen;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function getIdMarca()
    {
        return $this->id_marca;
    }

    public function getRuta()
    {
        return $this->ruta;
    }

    /*
    *   Métodos para realizar las operaciones SCRUD (search, create, read, update, delete).
    */
    public function searchProductos($value)
    {
        $sql = 'SELECT id_producto, imagen_producto, producto, descripcion, precio, nombre
                FROM producto INNER JOIN marca USING(id_marca)
                WHERE producto ILIKE ? OR descripcion ILIKE ?
                ORDER BY producto';
                
            $params = array("%$value%", "%$value%");
            return Database::getRows($sql, $params);
    }

    public function createProducto()
    {
        if ($this->saveFile($this->archivo, $this->ruta, $this->imagen)) {
            $sql = 'INSERT INTO producto(producto, descripcion, precio, imagen_producto, id_marca)
                    VALUES(?, ?, ?, ?, ?)';
            $params = array($this->producto, $this->descripcion, $this->precio, $this->imagen,  $this->nombre);
            return Database::executeRow($sql, $params);
        } else {
            return false;
        }
    }

    public function readAllProductos()
    {
        $sql = 'SELECT id_producto, imagen_producto, producto, descripcion, precio, nombre 
                FROM producto INNER JOIN marca USING(id_marca)
                ORDER BY producto';
        $params = null;
        return Database::getRows($sql, $params);
    }
//Funcion para mostrar los productos por su marca respectiva
    public function readProductosMarcas()
    {
        $sql = 'SELECT nombre, id_producto, imagen_producto,producto, descripcion, precio
                FROM producto INNER JOIN marca USING(id_marca)
                WHERE id_marca = ? 
                ORDER BY producto';
        $params = array($this->nombre);
        return Database::getRows($sql, $params);
    }

    //Consulta para el reporte
    public function readProductosMarca()
    {
        $sql = 'SELECT nombre, id_producto, imagen_producto, producto, descripcion, precio
                FROM producto INNER JOIN marca USING(id_marca)
                WHERE id_marca = ? 
                ORDER BY producto';
        $params = array($this->nombre);
        return Database::getRows($sql, $params);
    }


    public function readOneProducto()
    {
        $sql = 'SELECT id_producto,producto,descripcion,precio,imagen_producto,id_marca
                FROM producto
                WHERE id_producto = ?';
        $params = array($this->id);
        return Database::getRow($sql, $params);
    }

    public function updateProducto()
    {
        if ($this->saveFile($this->archivo, $this->ruta, $this->imagen)) {
            $sql = 'UPDATE producto
                    SET imagen_producto = ?, producto = ?, descripcion = ?, precio = ?, id_marca = ?
                    WHERE id_producto = ?';
            $params = array($this->imagen, $this->producto, $this->descripcion, $this->precio, $this->nombre, $this->id);
        } else {
            $sql = 'UPDATE producto
                    SET producto = ?, descripcion = ?, precio = ?, id_marca = ?
                    WHERE id_producto = ?';
            $params = array($this->producto, $this->descripcion, $this->precio, $this->nombre, $this->id);
        }
        return Database::executeRow($sql, $params);
    }

    public function deleteProducto()
    {
        $sql = 'DELETE FROM producto
                WHERE id_producto = ?';
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

    public function cantidadProductosTalla()
    {
        $sql = 'SELECT COUNT (id_producto) as productos, talla from producto inner join existencia using (id_producto)
        inner join talla using (id_talla)
        group by talla';
        $params = null;
        return Database::getRows($sql, $params);
    }
}
?>