<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="../css/estiloAdmin.css">
</head>
<body>
<?php

// Compruebo si hay una sesión iniciada
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['user_id'])) {
    //Muestro el menu solo si hay una sesión activa con used_id. Lo dejo así para ampliarlo con fistintos tipos de usuario, donde necesitaría dos parámetros:
    //el id del usuario, y el rol del usuario. Según el rol, se mostrarían distintos tipos de opciones en el menú/una vista distinta.
?>
    <div>
        <nav>
            <ul>
                <li><a href="../../src/php/index.php?c=cPreguntasRespuestas&m=mostrarFormPregunta">Añadir Pregunta</a></li>
                <li><a href="../../src/php/index.php?c=cPreguntasRespuestas&m=listarPreguntas">Listar Preguntas</a></li>
                <li><a href="../../src/php/index.php?c=cAut&m=cerrarSesion">Cerrar Sesión</a></li>

            </ul>
        </nav>
        <header class="mb-5">
            <div>
                <h1><?php echo $controlador->nombrePagina; ?></h1>
            </div>
        </header>
    </div>
<?php
} else {
   //no hay sesion iniciada, no se muestra el menú
   echo("<h1>Inicio Panel de administración</a>");
}
?>
</body>
</html>
