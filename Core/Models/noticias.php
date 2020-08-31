<?php
/*
*	Clase para manejar la tabla categorias de la base de datos. Es clase hija de Validator.
*/
class Noticias extends Validator
{
    // Declaración de atributos (propiedades).
    private $id = null;
    private $titulo = null;
    private $imagen = null;
    private $archivo = null;
    private $descripcion = null;
    private $ruta = '../../../Resources/Img/noticias/';

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

    public function setTitulo($value)
    {
        if($this->validateAlphanumeric($value, 1, 50)) {
            $this->titulo = $value;
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

    public function getTitulo()
    {
        return $this->titulo;
    }

    public function getImagen()
    {
        return $this->imagen;
    }

    public function getDescripcion()
    {
        return $this->descripcion;
    }

    public function getRuta()
    {
        return $this->ruta;
    }

    /*
    *   Métodos para realizar las operaciones SCRUD (search, create, read, update, delete).
    */
    public function searchNoticia($value)
    {
        $sql = 'SELECT id_noticia, titulo_noticia, imagen_noticia, descripcion_noticia
                FROM noticias
                WHERE titulo_noticia ILIKE ? OR descripcion_noticia ILIKE ?
                ORDER BY titulo_noticia';
        $params = array("%$value%", "%$value%");
        return Database::getRows($sql, $params);
    }

    public function createNoticia()
    {
        if ($this->saveFile($this->archivo, $this->ruta, $this->imagen)) {
            $sql = 'INSERT INTO noticias(titulo_noticia, imagen_noticia, descripcion_noticia)
                    VALUES(?, ?, ?)';
            $params = array($this->titulo, $this->imagen, $this->descripcion);
            return Database::executeRow($sql, $params);
        } else {
            return false;
        }
    }

    public function readAllNoticias()
    {
        $sql = 'SELECT id_noticia, titulo_noticia, imagen_noticia, descripcion_noticia
                FROM noticias
                ORDER BY titulo_noticia';
        $params = null;
        return Database::getRows($sql, $params);
    }

    public function readOneNoticia()
    {
        $sql = 'SELECT id_noticia, titulo_noticia, imagen_noticia, descripcion_noticia
                FROM noticias
                WHERE id_noticia = ?';
        $params = array($this->id);
        return Database::getRow($sql, $params);
    }

    public function updateNoticia()
    {
        if ($this->saveFile($this->archivo, $this->ruta, $this->imagen)) {
            $sql = 'UPDATE noticias
                    SET imagen_noticia = ?, titulo_noticia = ?, descripcion_noticia = ?
                    WHERE id_noticia = ?';
            $params = array($this->imagen, $this->titulo, $this->descripcion, $this->id);
        } else {
            $sql = 'UPDATE noticias
                    SET titulo_noticia = ?, descripcion_noticia = ?
                    WHERE id_noticia = ?';
            $params = array($this->titulo, $this->descripcion, $this->id);
        }
        return Database::executeRow($sql, $params);
    }

    public function deleteNoticia()
    {
        $sql = 'DELETE FROM noticias
                WHERE id_noticia = ?';
        $params = array($this->id);
        return Database::executeRow($sql, $params);
    }
}
?>