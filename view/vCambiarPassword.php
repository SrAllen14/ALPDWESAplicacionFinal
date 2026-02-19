<div class="cabecera2">
    <h2>Cambiar Contraseña</h2>
</div>
</header>
<main>
    <div class="container">
        <div class="formulario">
            <form method="post" action="">
                <label>Contraseña actual</label><br>
                <input class="obligatorio" type="password" name="passwordActual" id="passA" value="<?php echo $_REQUEST['passwordActual']??''?>"/><br><br>
                <p style='color:red'><?php echo $avCambiarContraseña['errores']['passwordActual']?></p>
                <label>Contraseña nueva</label><br>
                <input class="obligatorio" type="password" name="passwordNueva" id="passN" value="<?php echo $_REQUEST['passwordNueva']??''?>"/><br><br>
                <p style='color:red'><?php echo $avCambiarContraseña['errores']['passwordNueva']?></p>
                <label>Repita contraseña nueva</label><br>
                <input class="obligatorio" type="password" name="passwordNuevaRepetir" id="passNR" value="<?php echo $_REQUEST['passwordNuevaRepetir']??''?>"/><br><br>
                <p style='color:red'><?php echo $avCambiarContraseña['errores']['passwordNuevaRepetir']?></p>
                <button type="submit" name="aplicarC" id="aplicarC">Aplicar Cambios</button> 
                <button type="submit" name="cancelar" id="cancelar">Cancelar</button>
            </form>
        </div>
    </div>
</main>