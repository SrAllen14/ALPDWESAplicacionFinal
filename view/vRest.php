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
                    <p>Se solicita la apiKey en el enlace de la Nasa
                        Se forma la url para solicitar la foto del día, 
                        con la url, la fecha($fecha) y la apiKey https://api.nasa.gov/planetary/apod?api_key=APINASA&date=$fecha
                        Gracias a la extensíon curl de php, se envía la 
                        petición a la nasa, que responde enviando un json 
                        que hay que pasar a array para poder usar la información</p>
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
                <div class="pais">
                    <h3>Selecione un país para saber más sobre él</h3><br>
                    <form method="post">
                        <input type="radio" name="pais" id="spain" value="spain"
                            <?php echo $avRest['nombrePais']=='España'?'checked':''?>>
                        <input type="radio" name="pais" id="france" value="france"
                            <?php echo $avRest['nombrePais']=='France'?'checked':''?>>
                        <input type="radio" name="pais" id="portugal" value="portugal"
                            <?php echo $avRest['nombrePais']=='Portugal'?'checked':''?>>
                        <div class="menu-paises">
                            <label for="spain">España</label>
                            <label for="france">Francia</label>
                            <label for="portugal">Portugal</label>
                        </div>
                        <button type="submit" name="btnBuscarPais" id="buscar">Buscar</button><br>
                    </form>
                </div>
                <div class="resultado">
                    <p>Nombre del pais en la lengua oficial: <b><?php echo $avRest['nombrePais']; ?></b></p><br>
                    <p>Población total: <b><?php echo $avRest['poblacion']; ?></b> habitantes</p><br>
                    <p>Capital: <b><?php echo $avRest['capital']; ?></b></p><br>
                    <p>Area: <b><?php echo $avRest['area']; ?></b></p>
                </div>
                <div class="infoApi">
                    <p><b>Instrucciones de uso:</b> <a target="blank" href="https://restcountries.com" id="urlPaises"> https://restcountries.com</a></p>
                    <p> Se forma la url para solicitar la info del pais, 
                        con la url y el nombre del pais en ingles ($nombrePais). No es necesario API key: "https://restcountries.com/v3.1/name/" . urlencode($nombrePais);
                        Gracias a la extensíon curl de php, se envía la 
                        petición al RestCountries, que responde enviando un json 
                        que hay que pasar a array para poder usar la información</p>
                    <p><b>Parámetros:</b> NombrePais (Ingles)</p>
                    <p><b>Método:</b> GET</p>
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
                <div class="volumenNegocio">
                    <h3>Volumen de negocio:</h3>
                    <?php echo "<p>".$avRest['volumenNegocio']."</p>"?>
                </div>
                <div class="infoApi">
                    <p><b>Instrucciones de uso:</b> <a target="blank" href="https://alvaroallper.ieslossauces.es/ALPDWESAplicacionFinal/api/wsVolumenDeDepartamentoPorCodigo.php" id="urlPaises"> API consultar volumen departamento</a></p>
                    <p> Se forma la url para solicitar el volumen de negocio del departamento en la base de datos, 
                        con la url y el codigo de departamento ($codDepartamento). La entrada de parámetros tiene validación.
                        No es necesario API key: 'http://alvaroallper.ieslossauces.es/ALPDWESAplicacionFinal/api/wsVolumenDeDepartamentoPorCodigo.php?codDepartamento=' . $codDepartamento
                        Gracias a la extensíon curl de php, se envía la 
                        petición a nuestra API guardada en /api, que responde enviando un json 
                        que hay que pasar a array para poder usar la información</p>
                    <p><b>Parámetros:</b> Código de Departamento</p>
                    <p><b>Método:</b> GET</p>
                </div>
            </div>
            
        </div>
    </div>
</main>
