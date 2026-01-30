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
                <h1>Información del departamento</h1>
                <label>Código de departamento</label><br>
                <input class="lectura" type="text" name="codDepartamento" id="desc" value="<?php echo $avVerDepartamento['codDepartamento'] ?>" readonly/><br><br>
                <label>Descripción del departamento</label><br>
                <input class="lectura" type="text" name="descDepartamento" id="desc" value="<?php echo $avVerDepartamento['descDepartamento'] ?>" readonly/><br><br>
                <label>Fecha de creación</label><br>
                <input class="lectura" type="date" name="fechaAlta" id="desc" value="<?php echo $avVerDepartamento['fechaCreacionDepartamento'] ?>" readonly/><br><br>
                <label>Volumen de negocio</label><br>
                <input class="lectura" type="text" name="volumenNegocio" id="desc" value="<?php echo $avVerDepartamento['volumenNegocio']?>" readonly/><br><br>
                <label>Fecha de baja</label><br>
                <input class="lectura" type="date" name="fechaBaja" id="desc" value="<?php echo $avVerDepartamento['fechaBajaDepartamento']?>" readonly/><br><br>
            </form>
        </div>
    </div>
</main>