<?php

// Comprobamos si el botón "iniciar" ha sido pulsado.
if(isset($_REQUEST['salir'])){
    // Si ha sido pulsado le damos el valor de la página solicitada a la variable $_SESSION.
    $_SESSION['paginaEnCurso'] = 'inicioPrivado';
    header('Location: indexLoginLogoff.php');
    exit;
}

require_once $view['layout'];