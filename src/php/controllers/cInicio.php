<?php

/* 
    Controlador para las páginas de inicio. Lo uso para centralizar las distintas vistas de inicio:
        -Login
        -Inicio de superadmin
        -Posibles otros inicios de más tipos de usuario
*/
    class CInicio {

        public $nombrePagina;

        public $view;

        public function __construct() {
            $this->view = '';
            $this->nombrePagina ='';
        }

        /* función para mostrar el menu de login si no hay sesion*/
        public function mostrarMenuAdmin(){
            $this->nombrePagina = 'Login';
            $this->view = 'vLogin';
        }

        /*funcion para mostrar el menu normal cuando haya sesion */
        public function mostrarMenu(){
            $this->nombrePagina = 'Menú de Administracion';
        $this->view = 'vMostrarMenuAdmin';
        }

    }
?>