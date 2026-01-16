<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

require_once 'core/iValidacionFormularios.php';

// Cargamos las clases.
require_once 'model/Usuario.php';
require_once 'model/UsuarioPDO.php';
require_once 'model/AppError.php';

$controller = [
    'inicioPublico' => 'controller/cInicioPublico.php',
    'login' => 'controller/cLogin.php',
    'inicioPrivado' => 'controller/cInicioPrivado.php',
    'detalles' => 'controller/cDetalles.php',
    'error' => 'controller/cError.php',
    'wip' => 'controller/cWIP.php'
];

$view = [
    'layout' => 'view/Layout.php',
    'inicioPublico' => 'view/vInicioPublico.php',
    'login' => 'view/vLogin.php',
    'inicioPrivado' => 'view/vInicioPrivado.php',
    'detalles' => 'view/vDetalles.php',
    'error' => 'view/vError.php',
    'wip' => 'view/vWIP.php'
];