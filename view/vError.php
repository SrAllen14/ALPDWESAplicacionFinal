</header>
<main>
    <div class="container">
        <div class="cuadro">
            <div class="codigoError">
                <h2>Código de error <?php echo $avError['codError']?></h2>
            </div>
            <div class="descError">
                <h3>Descripción del error <?php echo $avError['descError']?></h3>
            </div>
            <div class="archivoError">
                <p>Archivo con problemas <?php echo $avError['archivoError']?></p>
            </div>
            <div class="lineaError">
                <p>Linea de error <?php echo $avError['lineaError']?></p>
            </div>
            <div class="btn">
                <form>
                    <button type="submit" name="volver" id="volver">Volver</button>
                </form>
            </div>
        </div>
    </div>
</main>