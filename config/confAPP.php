<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

const RESP_SEGURIDAD = "pimentel";
const API_KEY_NASA = 'uzpJUwOHnBD391Xblgeh1wiMDprUWeP91FRkajuI';

require_once 'core/iValidacionFormularios.php';

// Cargamos las clases.
require_once 'model/Usuario.php';
require_once 'model/UsuarioPDO.php';
require_once 'model/AppError.php';
require_once 'model/REST.php';
require_once 'model/FotoNasa.php';
require_once 'model/Departamento.php';
require_once 'model/DepartamentoPDO.php';

$controller = [
    'inicioPublico' => 'controller/cInicioPublico.php',
    'login' => 'controller/cLogin.php',
    'inicioPrivado' => 'controller/cInicioPrivado.php',
    'detalles' => 'controller/cDetalles.php',
    'error' => 'controller/cError.php',
    'wip' => 'controller/cWIP.php',
    'rest' => 'controller/cRest.php',
    'detallesNasa' => 'controller/cDetallesNasa.php',
    'registro' => 'controller/cRegistro.php',
    'departamento' => 'controller/cDepartamento.php',
    'editar' => 'controller/cEditar.php',
    'cambiarContraseña' => 'controller/cCambiarContraseña.php',
    'borrarCuenta' => 'controller/cBorrarCuenta.php',
    'verDepartamento' => 'controller/cVerDepartamento.php',
    'editarDepartamento' => 'controller/cEditarDepartamento.php'
];

$view = [
    'layout' => 'view/Layout.php',
    'inicioPublico' => 'view/vInicioPublico.php',
    'login' => 'view/vLogin.php',
    'inicioPrivado' => 'view/vInicioPrivado.php',
    'detalles' => 'view/vDetalles.php',
    'error' => 'view/vError.php',
    'wip' => 'view/vWIP.php',
    'rest' => 'view/vRest.php',
    'detallesNasa' => 'view/vDetallesNasa.php',
    'registro' => 'view/vRegistro.php',
    'departamento' => 'view/vDepartamento.php',
    'editar' => 'view/vEditar.php',
    'cambiarContraseña' => 'view/vCambiarContraseña.php',
    'borrarCuenta' => 'view/vBorrarCuenta.php',
    'verDepartamento' => 'view/vVerDepartamento.php',
    'editarDepartamento' => 'view/vEditarDepartamento.php'
];