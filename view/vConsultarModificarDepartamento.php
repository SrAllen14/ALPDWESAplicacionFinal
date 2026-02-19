<div class="cabecera2">
    <h2><?php echo ($avEditarDepartamento['accion']!="editar") ? 'Consultar departamento' : 'Editar departamento'?></h2>
</div>
<div class="cabecera3">
    <?php if ($avEditarDepartamento['accion']!="editar"):?>
        <form method="post">
            <button type="submit" name="volver" id="volver">Volver</button>
        </form>
    <?php endif ?>
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
                <input type="text" name="descDepartamento" id="desc" value="<?php echo $avEditarDepartamento['descDepartamento'] ?>" <?php echo ($avEditarDepartamento['accion']!="editar") ? 'readonly class="lectura"' : ""?>/><br>
                <p style='color:red'><?php echo $avEditarDepartamento['errores']['descDepartamento']?></p><br>
                <label><b>Fecha de creación</b></label><br>
                <input class="lectura" type="date" name="fechaAlta" id="desc" value="<?php echo $avEditarDepartamento['fechaCreacionDepartamento'] ?>" readonly/><br><br>
                <label><b>Volumen de negocio</b></label><br>
                <input type="text" name="volumenNegocio" id="desc" value="<?php echo $avEditarDepartamento['volumenNegocio']?>" <?php echo ($avEditarDepartamento['accion']!="editar") ? 'readonly class="lectura"' : ""?>/>€<br>
                <p style='color:red'><?php echo $avEditarDepartamento['errores']['volumenNegocio']?></p><br>
                <label><b>Fecha de baja</b> (Estado: <?php echo ($avEditarDepartamento['fechaBajaDepartamento']) ? 'Inactivo' :  'Activo'?>)</label><br>
                <input class="lectura" type="date" name="fechaBaja" id="desc" value="<?php echo $avEditarDepartamento['fechaBajaDepartamento']?>" readonly/><br>
                <?php if($avEditarDepartamento['accion'] == 'editar') :?>
                    <button type="submit" name="bAplicar">Aplicar Cambios</button>
                    <button type="submit" name="bCancelar" id="cancelar">Cancelar</button>
                <?php endif; ?>
            </form>
        </div>
    </div>
</main>