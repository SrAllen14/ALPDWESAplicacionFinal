<div class="cabecera2">
        <h2>Alta departamento</h2>
    </div>
</header>
<main>
    <div class="container">
        <div class="formulario">
            <form method="post" action="">
                <h1>Registro</h1>
                <p style='color:red'><?php echo $avAltaDepartamento['aErrores']['codDepartamento']?></p>
                <input class="obligatorio" name="codDepartamento" id="desc" type="text" placeholder="Código departamento..." value=''><br><br>
                <p style='color:red'><?php echo $avAltaDepartamento['aErrores']['descDepartamento']?></p>
                <input class="obligatorio" name="descDepartamento" id="nombre" type="text" placeholder="Descripción departamento..."><br><br>
                <p style='color:red'><?php echo $avAltaDepartamento['aErrores']['volumenNegocio']?></p>
                <input class="obligatorio" name="volumenNegocio" id="passR" type="text" placeholder="Volumen de negocio..."><br><br>
                <button type="submit" name="registrar" id="registrar">Registrar</button> 
                <button type="submit" name="cancelar" id="cancelar">Cancelar</button>
            </form>
        </div>
    </div>
</main>