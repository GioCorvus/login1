<?php

require_once __DIR__ . '/../models/mCrearAdmin.php';

/*
Ésta es la clase del controlador de la creación del superadmin.
*/
class CSuperadmin
{
    public $nombrePagina;

    public $view;

    public $mensaje;

    public $objModelo;

    public function __construct()
    {
        $this->view = 'vCrearSuperAdmin';
        $this->nombrePagina = '';
        $this->objModelo = new MSuperadmin();
    }

    /*
        Ésta función se encarga de comprobar si hay una linea para el superadmin en la BBDD. Si el modelo devuelve true, nos redirije a 
        la vista de error, para evitar que se acceda al formulario de alta de superadmin.
    */
    public function verificarSuperadminExistente()
    {
        $superadminExists = $this->objModelo->superadminExists();

        if ($superadminExists) {

            $this->mensaje = "A superadmin already exists.";
            $this->view = 'vError'; 
        }
    }

    /*
        Ésta función se encarga de mostrar la vista del formulario del alta. 
    */
    public function mostrarFormSuperadmin()
    {
        $this->nombrePagina = 'Create Superadmin'; 

        $this->verificarSuperadminExistente(); //Primero, compruebo si ya hay un superadmin

        //si no obtengo la vista de error de verificarSuperadminExistente, significa que no existe un superadmin, así que me redirige al form.
        if ($this->view !== 'vError') {
            $this->view = 'vCreateAdmin';
        }
    }


    /*
        ésta función se encarga de recibir los datos del formulario para llamar el método del modelo para insertar los datos en la BBDD.
    */
    public function procesarFormularioCrearSuperadmin()
    {
        $nombre_usuario = $_POST['nombre_usuario'];
        $password = $_POST['password'];

        $this->objModelo->crearSuperadmin($nombre_usuario, $password);

        // header("Location: index.php?c=cInicio&m=vMostrarMenuAdmin"); Aquí redireccionaría según fuese conveniente
        exit();
    }

}

?>
