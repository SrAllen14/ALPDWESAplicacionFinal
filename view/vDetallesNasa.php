<div class="cabecera2"></div>
<div class="cabecera3">
    <form>
        <button type="submit" name="volver" id="volver">Volver</button>
    </form>
</div>
</header>
<main>
    <div class="container">
        <div class="nasa">
            <div class="tit">
                <h2><?php echo $avRest['tituloNasa']; ?></h2>
                <p><?php echo $avRest['fechaNasa']; ?></p>
            </div>
            <div class="foto">
                <img src="<?php echo $avRest['fotoNasaHD']; ?>" alt="fotoNasaHD"/>
            </div> 
            <div class="textDetalles">
                <p><?php echo $avRest['explicacionNasa']; ?></p>
            </div>
        </div>
    </div>
</main>