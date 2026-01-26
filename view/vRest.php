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
                        <button type="submit" name="btnFecha" class="btnFecha">Validar</button>
                    </form>
                </div>
                <div class="tit">
                    <?php echo $avRest['tituloNasa']; ?>
                </div>
                <div class="foto">
                    <img src="<?php echo $avRest['fotoNasa']; ?>" alt="fotoNasa"/>
                </div> 
                <div class="infoApi">
                    <p><b>Instrucciones de uso:</b> <a target="blank" href=" https://api.nasa.gov" id="urlNasa"> https://api.nasa.gov</a></p>
                    <p><b>Parámetros:</b> Fecha</p>
                    <p><b>Método:</b> GET</p>
                </div>
                <div class="divDetalles">
                    <form method="post" class="form-detalles">
                        <button type="submit" name="detalles" class="btnDetalles">Detalles</button>
                    </form>
                </div>
            </div>
            <div class="api2">
                <div class="tit">
                    
                </div>
                <div class="foto">
                    
                </div>
            </div>
            <div class="api3">
                <div class="tit">
                    
                </div>
                <div class="foto">
                    
                </div>
            </div>
            
        </div>
    </div>
</main>