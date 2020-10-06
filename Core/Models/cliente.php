<?php
/*
*	Clase para manejar la tabla usuarios de la base de datos. Es clase hija de Validator. xd
*	Clase para manejar la tabla usuarios de la base de datos. Es clase hija de Validator prueba 3 subir.
*/
class Clientes extends Validator
{
    // Declaración de atributos (propiedades).
    private $id = null;
    private $nombre = null;
    private $apellido = null;
    private $apodo = null;
    private $correo = null;
    private $contra = null;
    private $direccion = null;
    private $departamento = null;
    private $telefono = null;
    private $genero = null;
    private $ciudad = null;
    private $fecha_registro = null;
    private $codigo_postal = null;
    private $imagen_cliente = null;
    

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
        if ($this->validateAlphabetic($value, 1, 50)) {
            $this->nombre = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setApellido($value)
    {
        if ($this->validateAlphabetic($value, 1, 50)) {
            $this->apellido = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setApodo($value)
    {
        if ($this->validateAlphanumeric($value, 1, 50)) {
            $this->apodo = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setCorreo($value)
    {
        if ($this->validateEmail($value)) {
            $this->correo = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setContra($value)
    {
        if ($this->validatePassword($value)) {
            $this->contra = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setDireccion($value)
    {
        if ($this->validateString($value, 1, 150)) {
            $this->direccion = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setDepartamento($value)
    {
        if ($this->validateString($value, 1, 20)) {
            $this->departamento = $value;
            return true;
        } else {
            return false;
        }
    }
   
    public function setTelefono($value)
    {
        if ($this->validatePhone($value)) {
            $this->telefono = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setGenero($value)
    {
        if ($this->validateString($value, 1, 10)) {
            $this->genero = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setCiudad($value)
    {
        if ($this->validateString($value, 1, 30)) {
            $this->ciudad = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setCodigo($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->codigo = $value;
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

    public function getApellido()
    {
        return $this->apellido;
    }

    public function getApodo()
    {
        return $this->apodo;
    }


    public function getCorreo()
    {
        return $this->correo;
    }


    public function getContra()
    {
        return $this->contra;
    }

    public function getDireccion()
    {
        return $this->direccion;
    }

    public function getDepartamento()
    {
        return $this->departamento;
    }

    public function getTelefono()
    {
        return $this->telefono;
    }

    public function getGenero()
    {
        return $this->genero;
    }

    public function getCiudad()
    {
        return $this->ciudad;
    }


    public function getCodigo()
    {
        return $this->codigo;
    }



     /*
    *   Hecho por Juan, esto son las querys para el login.
    */

    public function checkUser($correo)
    {
        $sql = 'SELECT id_cliente FROM cliente WHERE correo = ?';
        $params = array($correo);
        if ($data = Database::getRow($sql, $params)) {
            $this->id = $data['id_cliente'];
            $this->correo = $correo;
            return true;
        } else {
            return false;
        }
    }

    public function checkCorreo()
    {
        $sql = 'SELECT nombre, apellido, id_cliente FROM cliente WHERE correo = ?';
        $params = array($this->correo);
        if ( $data = Database::getRow($sql, $params)) {
            $this->nombre = $data['nombre'];
            $this->apellido = $data['apellido'];
            $this->id = $data['id_cliente'];
            return true;
        } else {
            return false;
        }
    }

    public function checkPassword($contra)
    {
        $sql = 'SELECT contra FROM cliente WHERE id_cliente = ?';
        $params = array($this->id);
        $data = Database::getRow($sql, $params);
        if (password_verify($contra, $data['contra'])) {
            return true;
        } else {
            return false;
        }
    }


    public function changePassword()
    {
        $hash = password_hash($this->contra, PASSWORD_DEFAULT);
        $sql = 'UPDATE cliente SET contra = ? WHERE id_cliente = ?';
        $params = array($hash, $this->id);
        return Database::executeRow($sql, $params);
    }

    public function editProfile()
    {
        $sql = 'UPDATE administrador 
                SET nombre_admin = ?, apel_admin = ?, usu_admin = ?, email_admin = ?, id_tipo_u =?
                WHERE id_admin = ?';
        $params = array($this->nombre, $this->apellido, $this->usuario, $this->correo, $this->tipo, $this->id);
        return Database::executeRow($sql, $params);
    }

    public function createCliente()
    {
        // Se encripta la clave por medio del algoritmo bcrypt que genera un string de 60 caracteres.
        $hash = password_hash($this->contra, PASSWORD_DEFAULT);
        $sql = 'INSERT INTO cliente (nombre,apellido,apodo,correo,contra,direccion,departamento,telefono,genero,ciudad,codigo_postal)
                VALUES(?,?,?,?,?,?,?,?,?,?,?)';
        $params = array($this->nombre, $this->apellido, $this->apodo, $this->correo, $hash, $this->direccion, $this->departamento, $this->telefono, $this->genero, $this->ciudad, $this->codigo);
        return Database::executeRow($sql, $params);
    }


    /*
    *   Métodos para realizar las operaciones SCRUD (search, create, read, update, delete).
    */
    public function searchCLientes($value)
    {
        $sql = 'SELECT id_cliente, nombre, apellido, correo, apodo, genero, departamento, codigo_postal, ciudad, direccion, telefono
                FROM cliente
                WHERE apellido ILIKE ? OR nombre ILIKE ?
                ORDER BY apellido';
        $params = array("%$value%", "%$value%");
        return Database::getRows($sql, $params);
    }

    public function createUsuario()
    {
        // Se encripta la clave por medio del algoritmo bcrypt que genera un string de 60 caracteres.
        $hash = password_hash($this->clave, PASSWORD_DEFAULT);
        $sql = 'INSERT INTO administrador(nombre_admin, apel_admin, usu_admin, email_admin, contrasenia, id_tipo_u)
                VALUES(?, ?, ?, ?, ?, ?)';
        $params = array($this->nombres, $this->apellidos, $this->usuario, $this->correo, $hash, $this->tipo);
        return Database::executeRow($sql, $params);
    }
    

    public function readAllClientes()
    {
        $sql = 'SELECT id_cliente, nombre, apellido, correo,  apodo, genero, departamento, codigo_postal, ciudad, direccion, telefono
                FROM cliente
                ORDER BY apellido';
        $params = null;
        return Database::getRows($sql, $params);
    }

    public function readOneCliente()
    {
        $sql = 'SELECT id_cliente, nombre, apellido, correo,  apodo, genero, departamento, codigo_postal, ciudad, direccion, telefono
                FROM cliente
                WHERE id_cliente = ?';
        $params = array($this->id);
        return Database::getRow($sql, $params);
    }

   

    public function deleteCliente()
    {
        $sql = 'DELETE FROM cliente
                WHERE id_cliente = ?';
        $params = array($this->id);
        return Database::executeRow($sql, $params);
    }


     /*
    *   Métodos para generar gráficas.
    */
    public function cantidadClienteGenero()
    {
        $sql = 'SELECT COUNT(id_cliente) cantidad , genero
        FROM cliente
        GROUP BY  genero';
        $params = null;
        return Database::getRows($sql, $params);
    }


    public function cantidadClienteDepartamento()
    {
        $sql = 'SELECT COUNT(id_cliente) as cliente, departamento
        FROM cliente GROUP BY departamento' ;
        $params = null;
        return Database::getRows($sql, $params);
    }



}
?>