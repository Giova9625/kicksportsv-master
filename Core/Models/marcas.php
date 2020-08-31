<?php
/*
*	Clase para manejar la tabla categorias de la base de datos. Es clase hija de Validator.
*/
class Marcas extends Validator
{
    // Declaración de atributos (propiedades).
    private $id = null;
    private $nombre = null;
    private $imagen = null;
    private $archivo = null;
    private $ruta = '../../../Resources/Img/marcas/';

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

    public function setNombre($value)
    {
        if($this->validateAlphanumeric($value, 1, 20)) {
            $this->nombre = $value;
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

    /*
    *   Métodos para obtener valores de los atributos.
    */
    public function getId()
    {
        return $this->id;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function getImagen()
    {
        return $this->imagen;
    }

    public function getRuta()
    {
        return $this->ruta;
    }

    /*
    *   Métodos para realizar las operaciones SCRUD (search, create, read, update, delete).
    */
    public function searchMarca($value)
    {
        $sql = 'SELECT id_marca, nombre, imagen_marca
                FROM marca
                WHERE nombre ILIKE ? OR nombre ILIKE ?
                ORDER BY nombre';
        $params = array("%$value%", "%$value%");
        return Database::getRows($sql, $params);
    }

    public function createMarca()
    {
        if ($this->saveFile($this->archivo, $this->ruta, $this->imagen)) {
            $sql = 'INSERT INTO marca(nombre, imagen_marca)
                    VALUES(?, ?)';
            $params = array($this->nombre, $this->imagen);
            return Database::executeRow($sql, $params);
        } else {
            return false;
        }
    }

    public function readAllMarcas()
    {
        $sql = 'SELECT id_marca, nombre, imagen_marca
                FROM marca
                ORDER BY nombre';
        $params = null;
        return Database::getRows($sql, $params);
    }
    //Combobox de talla en detalle producto
    public function readAllTalla()
    {
        $sql = 'SELECT id_talla, talla, descripcion
                FROM talla
                ORDER BY talla';
        $params = null;
        return Database::getRows($sql, $params);
    }

    public function readOneMarca()
    {
        $sql = 'SELECT id_marca, nombre, imagen_marca
                FROM marca
                WHERE id_marca = ?';
        $params = array($this->id);
        return Database::getRow($sql, $params);
    }

    public function updateMarca()
    {
        if ($this->saveFile($this->archivo, $this->ruta, $this->imagen)) {
            $sql = 'UPDATE marca
                    SET imagen_marca = ?, nombre = ?
                    WHERE id_marca = ?';
            $params = array($this->imagen, $this->nombre, $this->id);
        } else {
            $sql = 'UPDATE marca
                    SET nombre = ?
                    WHERE id_marca = ?';
            $params = array($this->nombre, $this->id);
        }
        return Database::executeRow($sql, $params);
    }

    public function deleteMarca()
    {
        $sql = 'DELETE FROM marca
                WHERE id_marca = ?';
        $params = array($this->id);
        return Database::executeRow($sql, $params);
    }

    // Hecho por Juan, Query para el readAll de la api para la filtracion de los productos por marca.
    public function readAll()
    {
        $sql = 'SELECT id_marca, nombre, imagen_marca from marca';
        $params = null;
        return Database::getRows($sql, $params);
    }
}
?>