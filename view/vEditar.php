<div class="cabecera2">
        <h2>Editar</h2>
    </div>
    <div class="cabecera3">
        <form method="post">
            <form method="post">
                <button type="submit" name="volver" id="volver">Volver</button>
                <button type="submit" name="cerrarS" id="cerrarS">Cerrar Sesión</button>
            </form>
        </form>
    </div>
</header>
<main>
    <div class="container">
        <div class="formulario">
            <form method="post" action="">
                <h1>Información de <?php echo $avEditar['nombre']?></h1>
                <label>Nombre de Usuario</label><br>
                <input class="obligatorio" type="text" name="descUsuario" id="desc" value="<?php echo $avEditar['nombre']?>"/><br><br>
                <label>Código de Usuario</label><br>
                <input class="lectura" type="text" name="codUsuario" id="desc" value="<?php echo $avEditar['codUsuario']?>" readonly/><br><br>
                <label>Contraseña</label><br>
                <input class="lectura" type="password" name="password" id="desc" value="<?php echo $avEditar['password']?>" readonly/><br><br>
                <label>Perfil</label><br>
                <input class="lectura" type="text" name="perfil" id="desc" value="<?php echo $avEditar['perfil']?>" readonly/><br><br>
                <label>Número de accesos</label><br>
                <input class="lectura" type="text" name="numeroAccesos" id="desc" value="<?php echo $avEditar['numeroAccesos']?>" readonly/><br><br>
                <label>Última conexión</label><br>
                <input class="lectura" type="datetime-local" name="fechaUltimaConexion" id="desc" value="<?php echo $avEditar['fechaUltimaConexion']?>" readonly/><br><br>
                <label>Última conexión anterior</label><br>
                <input class="lectura" type="datetime-local" name="fechaUltimaConexionAnterior" id="desc" value="<?php echo $avEditar['fechaUltimaConexionAnterior']?>" readonly/><br>
                <button type="submit" name="aplicarC" id="aplicarC">Aplicar Cambios</button> 
            </form>
        </div>
        <div class="formulario2">
            <form method="post" action="">
                <button type="submit" name="cambiarC" id="cambiarC">Cambiar contraseña</button> 
                <button type="submit" name="borrarC" id="borrarC">Borrar cuenta</button>
            </form>
        </div>
    </div>
</main>