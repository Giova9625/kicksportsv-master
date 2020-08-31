<?php
/*
*	Clase para manejar la tabla tallas de la base de datos. Es clase hija de Validator.
*/
class Tallas extends Validator
{
    // Declaración de atributos (propiedades).
    private $id = null;
    private $talla = null;
    private $descripcion = null;
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

    public function setTalla($value)
    {
        if($this->validateAlphanumeric($value, 1, 50)) {
            $this->talla = $value;
            return true;
        } else {
            return false;
        }
    }


    public function setDescripcion($value)
    {
        if ($value) {
            if ($this->validateString($value, 1, 250)) {
                $this->descripcion = $value;
                return true;
            } else {
                return false;
            }
        } else {
            $this->descripcion = null;
            return true;
        }
    }

    /*
    *   Métodos para obtener valores de los atributos.
    */
    public function getId()
    {
        return $this->id;
    }

    public function getTalla()
    {
        return $this->talla;
    }

    public function getDescripcion()
    {
        return $this->descripcion;
    }



    /*
    *   Métodos para realizar las operaciones SCRUD (search, create, read, update, delete).
    */
    public function searchTalla($value)
    {
        $sql = 'SELECT id_talla, talla, descripcion
                FROM talla
                WHERE talla ILIKE ? OR descripcion ILIKE ?
                ORDER BY talla';
        $params = array("%$value%", "%$value%");
        return Database::getRows($sql, $params);
    }

    public function createTalla()
    {
            $sql = 'INSERT INTO talla(talla, descripcion)
                    VALUES(?, ?)';
            $params = array($this->talla, $this->descripcion);
            return Database::executeRow($sql, $params);
    } 

    public function readAllTallas()
    {
        $sql = 'SELECT id_talla, talla, descripcion
                FROM talla
                ORDER BY talla';
        $params = null;
        return Database::getRows($sql, $params);
    }

    public function readOneTalla()
    {
        $sql = 'SELECT id_talla, talla, descripcion
                FROM talla
                WHERE id_talla = ?';
        $params = array($this->id);
        return Database::getRow($sql, $params);
    }




    public function updateTalla()
    {
      
         $sql = 'UPDATE talla
                 SET  talla = ?, descripcion = ?
                WHERE id_talla = ?';
         $params = array($this->talla, $this->descripcion, $this->id);
        return Database::executeRow($sql, $params);
     } 

    public function deleteTalla()
    {
        $sql = 'DELETE FROM talla
                WHERE id_talla = ?';
        $params = array($this->id);
        return Database::executeRow($sql, $params);
    }
}
?>