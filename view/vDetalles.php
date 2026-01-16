<div class="cabecera2">
        <h2>Detalles</h2>
    </div>
    <div class="cabecera3">
        <form method="post">
            <button type="submit" name="cerrarS" id="cerrarS">Cerrar Sesión</button>
        </form>
    </div>
</header>
<main>
    <div class="container">
        <div class="tabla">
            <?php
                // Mostramos el contenido de la variable superglobal $_SESSION.
                echo '<h2>Valores de la variable superglobal: $_SESSION</h2>';
                echo "<table>";
                if(!empty($_SESSION)){
                    foreach ($_SESSION as $key => $value) {
                        echo "<tr>";
                        echo '<td class = nombre>'.$key.'</td>';
                        echo "<td class='valor'><pre> ". print_r($value, true) ."</pre></td>";
                        echo "</tr>";
                    }
                }  else{
                    echo "<tr>";
                    echo "<td class='nombre'>No hay variable</td>";
                    echo "<td class='valor'>No hay valor</td>";
                    echo "</tr>";
                }
                echo "</table>";

                // Mostramos el contenido de la variable superglobal $_COOKIE.
                echo '<h2>Valores de la variable superglobal: $_COOKIE</h2>';
                echo "<table>";
                if(!empty($_COOKIE)){
                    foreach ($_COOKIE as $key => $value) {
                        echo "<tr>";
                        echo "<td class='nombre'>{$key}</td>";
                        echo "<td class='valor'>{$value}</td>";
                        echo "</tr>";
                    }
                } else{
                    echo "<tr>";
                    echo "<td class='nombre'>No hay variable</td>";
                    echo "<td class='valor'>No hay valor</td>";
                    echo "</tr>";
                }
                echo "</table>";

                // Mostramos el contenido de la variable superglobal $_SERVER.
                echo '<h2>Valores de la variable superglobal: $_SERVER</h2>';
                echo "<table>";
                if(!empty($_SERVER)){
                    foreach ($_SERVER as $key => $value) {
                        echo "<tr>";
                        echo "<td class='nombre'>{$key}</td>";
                        echo "<td class='valor'>{$value}</td>";
                        echo "</tr>";
                    }
                } else{
                    echo "<tr>";
                    echo "<td class='nombre'>No hay variable</td>";
                    echo "<td class='valor'>No hay valor</td>";
                    echo "</tr>";
                }
                echo "</table>";
            ?>
        </div>
        <form>
            <button type="submit" name="salir" id="salir">Salir</button>
        </form>
    </div>
</main>