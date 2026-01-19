</header>
<main>
    <div class="container">
        <h2>Página REST</h2>
        <div class="subcontainer">
            <div class="api1">
                <div class="tit">
                    <?php echo $avRest['oFotoNasa']->getTitulo(); ?>
                </div>
                <div class="foto">
                    <img src="<?php echo $avRest['oFotoNasa']->getUrl(); ?>" alt="fotoNasa"/>
                </div> 
                <div class="textDetalles">
                    <?php echo $avRest['oFotoNasa']->getExplicacion(); ?>
                </div>
            </div>
            <div class="api2">
                <div class="tit">
                    fasdf
                </div>
                <div class="foto">
                    asdf
                </div>
            </div>
            <div class="api3">
                <div class="tit">
                    asfd
                </div>
                <div class="foto">
                    asdf
                </div>
            </div>
            
        </div>
        <form>
            <button type="submit" name="volver" id="volver">Volver</button>
        </form>
    </div>
</main>