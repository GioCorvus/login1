<?php

require_once __DIR__ . '/../models/mConexion.php';


//Ésta es la clase del Modelo que he utilizado para simular la instalación, donde gestionan las consultas de la creación del admin.
class MSuperadmin
{
    private $conexion;

    public function __construct()
    {
        $conexionObj = new MConexion();
        $this->conexion = $conexionObj->getConexion();
    }

    
    /*Ésta funcion se encarga de hashear la contraseña que nos llega desde el formulario y el controlador, para con consultas preparadas insertar 
    la línea en la base de datos.
    */
    public function crearSuperadmin($nombre_usuario, $password)
    {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $tipo_usuario = 1;

        $sql = "INSERT INTO Usuario (nombre_usuario, password, tipo_usuario) VALUES (:nombre_usuario, :hashed_password, :tipo_usuario)";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':nombre_usuario', $nombre_usuario, PDO::PARAM_STR);
        $stmt->bindParam(':hashed_password', $hashed_password, PDO::PARAM_STR);
        $stmt->bindParam(':tipo_usuario', $tipo_usuario, PDO::PARAM_INT);
        $stmt->execute();
    }


    /*
    Ésta función se encarga de comprobar si hay un superadmin. La utilizo para que si se intenta acceder al formulario de creación de admin y 
    ya existe uno, no nos permita realizar otra alta.
    */
    public function superadminExists()
    {
        $sql = "SELECT COUNT(*) as count FROM Usuario WHERE tipo_usuario = 1";
        $stmt = $this->conexion->query($sql);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result['count'] > 0;
    }


}

?>
