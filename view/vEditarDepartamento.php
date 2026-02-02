<div class="cabecera2">
    <h2>Consultar departamento</h2>
</div>
<div class="cabecera3">
    <form method="post">
        <form method="post">
            <button type="submit" name="volver" id="volver">Volver</button>
        </form>
    </form>
</div>
</header>
<main>
    <div class="container">
        <div class="formulario">
            <form method="post" action="">
                <h1>Información del departamento</h1><br>
                <label><b>Código de departamento</b></label><br>
                <input class="lectura" type="text" name="codDepartamento" id="desc" value="<?php echo $avEditarDepartamento['codDepartamento'] ?>" readonly/><br><br>
                <label><b>Descripción del departamento</b></label><br>
                <input type="text" name="descDepartamento" id="desc" value="<?php echo $avEditarDepartamento['descDepartamento'] ?>"/><br><br>
                <label><b>Fecha de creación</b></label><br>
                <input class="lectura" type="date" name="fechaAlta" id="desc" value="<?php echo $avEditarDepartamento['fechaCreacionDepartamento'] ?>" readonly/><br><br>
                <label><b>Volumen de negocio</b></label><br>
                <input type="text" name="volumenNegocio" id="desc" value="<?php echo $avEditarDepartamento['volumenNegocio']?>"/><br><br>
                <label><b>Fecha de baja</b> (Estado: <?php echo ($avEditarDepartamento['fechaBajaDepartamento']) ? 'Inactivo' :  'Activo'?>)</label><br>
                <input class="lectura" type="date" name="fechaBaja" id="desc" value="<?php echo $avEditarDepartamento['fechaBajaDepartamento']?>" readonly/><br>
                <button type="submit" name="bAplicar">Aplicar Cambios</button>
            </form>
        </div>
    </div>
</main>