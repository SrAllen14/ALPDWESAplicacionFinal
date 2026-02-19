<div class="cabecera2">
        <h2>Registro</h2>
    </div>
    <div class="cabecera3">
        <form method="post">

        </form>
    </div>
</header>
<main>
    <div class="container">
        <div class="formulario">
            <form method="post" action="">
                <h1>Registro</h1>
                <input class="obligatorio" name="descUsuario" id="desc" type="text" placeholder="Nombre..." value='<?php echo $_REQUEST['descUsuario'] ?? ''?>'><br><br>
                <p style='color:red'><?php echo $avRegistro['aErrores']['usuario']?></p>
                <input class="obligatorio" name="codUsuario" id="nombre" type="text" placeholder="Usuario..." value='<?php echo $_REQUEST['codUsuario'] ?? ''?>'><br><br>
                <p style='color:red'><?php echo $avRegistro['aErrores']['password']?></p>
                <input class="obligatorio" name="password" id="pass" type="password" placeholder="Contraseña..." value='<?php echo $_REQUEST['password'] ?? ''?>'><br><br>
                <p style='color:red'><?php echo $avRegistro['aErrores']['passwordRep']?></p>
                <input class="obligatorio" name="passwordRep" id="passR" type="password" placeholder="Repita contraseña..." value='<?php echo $_REQUEST['passwordRep'] ?? ''?>'><br><br>
                <p style='color:red'><?php echo $avRegistro['aErrores']['respSeguridad']?></p>
                <input class="obligatorio" name="respSeguridad" id="respS" type="text" placeholder="Respuesta de seguridad..." value='<?php echo $_REQUEST['respSeguridad'] ?? ''?>'><br><br>
                <button type="submit" name="registrar" id="registrar">Registrar</button> 
                <button type="submit" name="cancelar" id="cancelar">Cancelar</button>
            </form>
        </div>
    </div>
</main>