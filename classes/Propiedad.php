<?php

namespace App;

class Propiedad
{
    /* BASE de datos */
    protected static $db;
    protected static $columnasDB = ['id', 'titulo', 'precio', 'imagen', 'descripcion', 'habitaciones', 'wc', 'estacionamiento', 'creado', 'vendedorId'];

    /* ERRORES */
    protected static $errores = [];

    public $id;
    public $titulo;
    public $precio;
    public $imagen;
    public $descripcion;
    public $habitaciones;
    public $wc;
    public $estacionamiento;
    public $creado;
    public $vendedorId;

    /* DEFINIR la conexión a la BD */
    public static function setDB($database)
    {
        self::$db = $database;
    }

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? '';
        $this->titulo = $args['titulo'] ?? '';
        $this->precio = $args['precio'] ?? '';
        $this->imagen = $args['imagen'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->habitaciones = $args['habitaciones'] ?? '';
        $this->wc = $args['wc'] ?? '';
        $this->estacionamiento = $args['estacionamiento'] ?? '';
        $this->creado = date('Y/m/d');
        $this->vendedorId = $args['vendedorId'] ?? '';
    }
    public function guardar()
    {
        /* SANITIZAR los datos */
        $atributos = $this->sanitizarAtributos();

        // GENERANDO VARIABLE PARA LA INSERCIÓN A LA BASE DE DATOS
        $query = " INSERT INTO propiedades ( ";
        $query .= join(', ', array_keys($atributos));
        $query .= " ) VALUES ( ' ";
        $query .= join("', '", array_values($atributos));
        $query .= " ') ";

        $resultado = self::$db->query($query);

        return $resultado;
    }

    /* IDENTIFICA y une los atributos de la BD */
    public function atributos()
    {
        $atributos = [];
        foreach (self::$columnasDB as $columna) {
            if ($columna === 'id') continue; /* SE salta la comprobación del id */
            $atributos[$columna] = $this->$columna; /* SE escribe son el signo "$" porque es una variable dentro del foreach */
        }
        return $atributos;
    }

    public function sanitizarAtributos()
    {
        $atributos =  $this->atributos();
        $sanitizado = [];
        foreach ($atributos as $key => $value) {
            $sanitizado[$key] = self::$db->escape_string($value);
        }
        return $sanitizado;
    }
    /* SUBIDA de archivos (imagenes) */
    public function setImagen($imagen) {
        // ASIGNAR a atributo de imagenel nombre de la imagen
        if($imagen) {
            $this->imagen = $imagen;
        }
    }

    /* VALIDACIÓN */
    public static function getErrores()
    {
        return self::$errores;
    }
    public function validar()
    {
        if (!$this->titulo) { /* CON this pq forma parte de la instancia dentro de un constructor */
                self::$errores[] = "Dale un título a tu propiedad"; /* SELF pq es un método estático */
        }         
            if (!$this->precio) {
                self::$errores[] = "Falta el precio";
            }
            if (strlen($this->descripcion) < 50) {
                self::$errores[] = "Dinos más sobre la propiedad, no menos de 50 caracteres";
            }
            if (!$this->habitaciones) {
                self::$errores[] = "El número de habitaciones es obligatorio";
            }
            if (!$this->wc) {
                self::$errores[] = "El número de baños es obligatorio";
            }
            if (!$this->estacionamiento) {
                self::$errores[] = "La cantidad de estacionamientos es obligatorio";
            }
            if (!$this->vendedorId) {
                self::$errores[] = "Elige a tu vendedor";
            }
            if (!$this->imagen) {
                self::$errores[] = "La imagen es obligatoria";
            }
                        
            return self::$errores;
        }
    }