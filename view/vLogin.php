<div class="cabecera2">
        <h2>Login</h2>
    </div>
    <div class="cabecera3">
        <form method="post">

        </form>
    </div>
</header>
<main>
    <div class="container">
        <div class="formulario">
            <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
                <h1>Inicio de sesión</h1>
                <input class="obligatorio" name="codUsuario" id="nombre" type="text" placeholder="Usuario..." value="<?php echo $_REQUEST['codUsuario']??''?>"><br><br>
                <input class='obligatorio' name="password" id="pass" type="password" placeholder="Contraseña..."><br><br>
                <button type="submit" name="iniciar" id="iniciar">Entrar</button>
                <button type="submit" name="registrar" id="registrar">Registrarse</button>
                <button type="submit" name="cancelar" id="cancelar">Cancelar</button>
            </form>
        </div>
    </div>
</main>

