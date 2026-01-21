</header>
<main>
    <div class="container">
        <div class="nasa">
            <div class="tit">
                <h2><?php echo $avRest['tituloNasa']; ?></h2>
            </div>
            <div class="foto">
                <img src="<?php echo $avRest['fotoNasa']; ?>" alt="fotoNasa"/>
            </div> 
            <div class="textDetalles">
                <p><?php echo $avRest['explicacionNasa']; ?></p>
            </div>
        </div>
        <form>
            <button type="submit" name="volver" id="volver">Volver</button>
        </form>
    </div>
</main>