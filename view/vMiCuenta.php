<div class="cabecera2">
        <h2>Editar</h2>
    </div>
    <div class="cabecera3">
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
                <div class="cPassword">
                    <label>Contraseña</label><br>
                    <input class="lectura" type="text" name="password" id="desc" value="*****" readonly/><button type="submit" name="cambiarC" id="cambiarC">Cambiar contraseña</button><br><br>
                </div>
                <label>Perfil</label><br>
                <input class="lectura" type="text" name="perfil" id="desc" value="<?php echo $avEditar['perfil']?>" readonly/><br><br>
                <label>Número de accesos</label><br>
                <input class="lectura" type="text" name="numeroAccesos" id="desc" value="<?php echo $avEditar['numeroAccesos']?>" readonly/><br><br>
                <label>Última conexión</label><br>
                <input class="lectura" type="datetime-local" name="fechaUltimaConexion" id="desc" value="<?php echo $avEditar['fechaUltimaConexion']?>" readonly/><br><br>
                <label>Última conexión anterior</label><br>
                <input class="lectura" type="datetime-local" name="fechaUltimaConexionAnterior" id="desc" value="<?php echo $avEditar['fechaUltimaConexionAnterior']?>" readonly/><br>
                <button type="submit" name="aplicarC" id="aplicarC">Aceptar</button>
                <button type="submit" name="cancelar" id="cancelar">Cancelar</button>
                <button type="submit" name="borrarC" id="borrarC">Borrar cuenta</button>
            </form>
        </div>
    </div>
</main>