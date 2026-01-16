<div class="cabecera2">
        <h2>Página de privada</h2>
    </div>
    <div class="cabecera3">
        <form method="post">
            <button type="submit" name="cerrarS" id="cerrarS">Cerrar Sesión</button>
        </form>
    </div>
</header>
<main>
    <div class="container">
        <div class="formulario">
            <?php
                // Guardamos el objeto Usuario actual en una variable.
                $oUsuarioActual = $_SESSION['usuarioDWESLoginLogoff'];
                
                // Guardamos los datos necesarios en variables para ser usados posteriormente.
                $nombreUsuario = $oUsuarioActual->getDescUsuario();
                $numConexiones = $oUsuarioActual->getContadorAccesos();
                $fechaUltimaConexion = $oUsuarioActual->getFechaHoraUltimaConexionAnterior();
                
                echo "<h2>Bienvenido ".$nombreUsuario."</h2><br>";
                
                // Comprobar cuantas veces se ha conectado el usuario.
                if($numConexiones <=1){
                    // En caso de ser la primera vez mostrar el siguiente mensaje.
                    echo "Esta es tu primera conexión";
                } else{
                    // En caso de haberse conectado más veces mostrar el siguiente mensaje.
                    
                    // Creamos un objeto de la clase IntlDateFormatter con el formato de "dia, de mes de año".
                    $oFormatoFecha = new IntlDateFormatter('es_ES', IntlDateFormatter::FULL, IntlDateFormatter::NONE);
                    
                    // Guardamos la fecha formateada en una variable usando el objeto creado y pasándole como parámetro la fecha recogida de la sesión.
                    $fecha = $oFormatoFecha->format($fechaUltimaConexion);
                    
                    // Guardamos en formato horas:minutos la hora de la variable fecha.
                    $hora = $fechaUltimaConexion->format('H:i');

                    echo "<h2>Te has conectado ".$numConexiones." veces. La última vez que te conectaste fue ".$fecha." a las ".$hora."</h2>";
                }
                
            ?>
            <form>
                <button type="submit" name="detalles" id="detalles">Detalles</button>
                <button type="submit" name="error" id="error">Error</button>
                <button type="submit" name="wip" id="wip">Work In Progress</button>
            </form>
        </div>
    </div>
</main>