<div class="cabecera2">
    
</div>
<div class="cabecera3">
    <form>
        <button type="submit" name="volver" id="volver">Volver</button>
    </form>
</div>
</header>
<main>
    <div class="container">
        <h2>Página REST</h2>
        <div class="subcontainer">
            <div class="api1">
                <div class="fecha">
                    <form method="post" class="form-fecha">
                        <input type="date" name="inFecha" class="inFecha" value="<?php echo $avRest['fechaNasa']?>">
                        <button type="submit" name="btnFecha" class="btnFecha">Buscar</button>
                    </form>
                </div>
                <div class="tit">
                    <?php if (!$avRest['errorNasa']): ?>
                        <?php echo $avRest['tituloNasa']; ?>
                    <?php else :?>
                    <p>No hay información con esta fecha</p>
                    <p>Introduzca otra fecha</p>
                    <?php endif; ?>
                </div>
                <div class="foto">
                    <?php if (!$avRest['errorNasa']): ?>
                        <img src="<?php echo $avRest['fotoNasa']?>" alt="">
                    <?php endif; ?>
                </div> 
                <div class="infoApi">
                    <p><b>Instrucciones de uso:</b> <a target="blank" href=" https://api.nasa.gov" id="urlNasa"> https://api.nasa.gov</a></p>
                    <p><b>Parámetros:</b> Fecha</p>
                    <p><b>Método:</b> GET</p>
                </div>
                <?php if (!$avRest['errorNasa']): ?>
                <div class="divDetalles">
                    <form method="post" class="form-detalles">
                        <button type="submit" name="detalles" class="btnDetalles">Detalles</button>
                    </form>
                </div>
                <?php endif; ?>
            </div>
            <div class="api2">
                <div class="tit">
                    
                </div>
                <div class="foto">
                    
                </div>
            </div>
            <div class="api3">
                <div class="cod">
                    <form method="post" class="form-codigo">
                        <label><b>Codigo de departamento:</b></label>
                        <select name="codDepartamento" >
                            <?php foreach ($avRest['aCodDepartamentos'] as $codigo) {
                                $selected = (!empty($_SESSION['oDepartamento']) && $_SESSION['oDepartamento']->getCodDepartamento() == $codigo)
                                            ? 'selected'
                                            : '';
                                echo '<option value="'.$codigo.'" '.$selected.'>'.$codigo.'</option>';
                            }?>
                        </select>
                        <button type="submit" name="btnCodDepartamento" class="btnCodDepartamento">Buscar</button>
                    </form>
                </div>
                <div class="tit">
                    <h3>Volumen de negocio:</h3>
                    <?php echo $avRest['volumenNegocio']?>
                </div>
            </div>
            
        </div>
    </div>
</main>
