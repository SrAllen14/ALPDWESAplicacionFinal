<div class="cabecera2">
        <h2>Borrar Departamento</h2>
    </div>
</header>
<main>
    <div class="container">
        <div class="formulario">
            <form method="post" action="">
                <h1>Información del departamento</h1><br>
                <label><b>Código de departamento</b></label><br>
                <input class="lectura" type="text" name="codDepartamento" id="desc" value="<?php echo $avEliminarDepartamento['codDepartamento'] ?>" readonly/><br><br>
                <label><b>Descripción del departamento</b></label><br>
                <input type="text" name="descDepartamento" id="desc" value="<?php echo $avEliminarDepartamento['descDepartamento'] ?>"readonly class="lectura"/><br><br>
                <label><b>Fecha de creación</b></label><br>
                <input class="lectura" type="date" name="fechaAlta" id="desc" value="<?php echo $avEliminarDepartamento['fechaCreacionDepartamento'] ?>" readonly/><br><br>
                <label><b>Volumen de negocio</b></label><br>
                <input type="text" name="volumenNegocio" id="desc" value="<?php echo $avEliminarDepartamento['volumenNegocio']?>" readonly class="lectura"/><br><br>
                <label><b>Fecha de baja</b> (Estado: <?php echo ($avEliminarDepartamento['fechaBajaDepartamento']) ? 'Inactivo' :  'Activo'?>)</label><br>
                <input class="lectura" type="date" name="fechaBaja" id="desc" value="<?php echo $avEliminarDepartamento['fechaBajaDepartamento']?>" readonly/><br><br>
                <h3>¿Seguro que quiere eliminar el departamento y todos sus datos?</h3>
                <button type="submit" name="aceptar" id="aceptar">Aceptar</button>
                <button type="submit" name="cancelar" id="cancelar">Cancelar</button>
            </form>
        </div>
    </div>
</main>