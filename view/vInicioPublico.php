<div class="cabecera2">
        <h2>Login</h2>
    </div>
    <div class="cabecera3">
        <form method="post" class="inicio-publico">
            <button type="submit" name="idioma" id="francia" value="FR"><?php /* En caso de que la cookie sea FR el boton será marcado con una cruz if($_COOKIE['idioma']==='FR'){echo "\u{2714}";}*/?></button>
            <button type="submit" name="idioma" id="portugal" value="PT"><?php /* En caso de que la cookie sea PT el boton será marcado con una cruz  if($_COOKIE['idioma']==='PT'){echo "\u{2714}";}*/?></button>
            <button type="submit" name="idioma" id="espana" value="ES"><?php /* En caso de que la cookie sea ES el boton será marcado con una cruz  if($_COOKIE['idioma']==='ES'){echo "\u{2714}";}*/?></button>
            <button type="submit" name="login" id="login">Login</button>
        </form>
    </div>
</header>
<div class="cabecera3">
        </div>
    </header>
    <main>
        <div class="container">
            <div class="cIP">
                <input type="radio" name="btn" id="btn1"checked>
                <input type="radio" name="btn" id="btn2">
                <input type="radio" name="btn" id="btn3">
                <input type="radio" name="btn" id="btn4">
                <input type="radio" name="btn" id="btn5">
                <input type="radio" name="btn" id="btn6">
                <input type="radio" name="btn" id="btn7">
                <input type="radio" name="btn" id="btn8">
                <div class="menu">
                    <label for="btn1">Arbol de navegación</label>
                    <label for="btn2">Catálogo de requisitos</label>
                    <label for="btn3">Diagrama de casos de uso</label>
                    <label for="btn4">Relación ficheros</label>
                    <label for="btn5">Uso de sesión</label>
                    <label for="btn6">Modelo Físico de Datos</label>
                    <label for="btn7">Estructura de almacenamiento</label>
                    <label for="btn8">Diagrama de clases</label>

                </div>
                <div class="apartados">
                    <iframe id="vInicioPublico01" src="doc/ArbolDeNavegacion.pdf"></iframe>
                    <iframe id="vInicioPublico02" src="doc/CatalogoDeRequisitos.pdf"></iframe>
                    <iframe id="vInicioPublico03" src="doc/DiagramaDeCasosDeUso.pdf"></iframe>
                    <iframe id="vInicioPublico04" src="doc/RelacionDeFicheros.pdf"></iframe>
                    <iframe id="vInicioPublico05" src="doc/UsoDeSesion.pdf"></iframe>
                    <img id="vInicioPublico06" src="webroot/images/modeloFisicoDatos.jpg"/>
                    <iframe id="vInicioPublico07" src="doc/estructuraDeAlmacenamiento.pdf"></iframe>
                    <img id="vInicioPublico08" src="webroot/images/diagramaClases.png"/>
                </div>
            </div>
        </div>
    </main>