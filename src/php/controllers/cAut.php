<?php

require_once __DIR__ . '/../models/mUsuario.php';

/*
    clase del controlador que se encargará de la gestión de sesiones y los iniciones de éstas mismas
*/
class cAut
{
    public $nombrePagina;
    public $view;
    public $mensaje;
    public $objModelo;

    public function __construct()
    {
        $this->objModelo = new MUsuario();
    }

    /*
        Función que se encarga de mostrar la vista del login
     */
    public function mostrarLogin(){
        $this->nombrePagina = 'Menú de Administracion';
        $this->view = 'vLogin';
    }

    /*
        funcion que se encarga de mostrar la vista del menú
    */
    public function mostrarMenu()
    {
        $this->nombrePagina = 'Menú de Administracion';
        $this->view = 'vMostrarMenuAdmin';
    }

    /*
        función que llama al modelo y se encarga de comprobar si las credenciales son correctas
    */
    public function procesarLogin()
    {
        $this->nombrePagina = 'Error de Login';
        $this->view = 'vLogin';

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['nombre_usuario'];
            $password = $_POST['password'];

            $user = $this->objModelo->login($username, $password);

            if ($user) {
                session_start();
                $_SESSION['user_id'] = $user['id']; 
                $_SESSION['username'] = $user['nombre_usuario'];

                header('Location: index.php?c=cAut&m=mostrarMenu');
                exit();
            } else {
                $this->mensaje = 'Login failed. Please check your username and password.';
            }
        }
    }

    /*
        Función que se encarga de comprobar si hay una sesión activa para evitar la navegación por urls
    */
    public function checkSession()
    {
        session_start();

        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?c=cAut&m=mostrarLogin'); // redireccion al login
            exit();
        }
    }

    /*
        Función que se encarga de cerrar la sesión que tenemos activa
    */
    public function cerrarSesion()
    {
        session_start();


        $_SESSION = array(); //vacio el array 
        // destruyo la sesion
        session_destroy();
        // devuelvo al login
        header('Location: index.php?c=cAut&m=mostrarLogin');
        exit();
    }

}
