</header>
<main>
    <div class="container">
        <div class="nasa">
            <div class="tit">
                <h2><?php echo $avRest['oFotoNasa']->getTitulo(); ?></h2>
            </div>
            <div class="foto">
                <img src="<?php echo $avRest['oFotoNasa']->getUrl(); ?>" alt="fotoNasa"/>
            </div> 
            <div class="textDetalles">
                <p><?php echo $avRest['oFotoNasa']->getExplicacion(); ?></p>
            </div>
        </div>
        <form>
            <button type="submit" name="volver" id="volver">Volver</button>
        </form>
    </div>
</main>