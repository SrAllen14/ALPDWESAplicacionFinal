    <div class="cabecera2">
        <h2>Mantenimiento de Usuarios</h2>
    </div>
    <div class="cabecera3">
        <form>
            <button type="submit" name="volver" id="volver">Volver</button>
        </form>
    </div>
</header>
<main>
    <div class="container">
        <div class="formulario">
            <form>
                <input type="text" name="codDepartamento" id="codDepartamento" placeholder="Código de departamento..." value="">
                <button type="submit" name="buscar" id="buscar">Buscar</button>
            </form>
        </div>
        <div class="tabla">
            <table id="tabla">
                <thead>
                    <th>
                        <td>Cod Usuario</td>
                        <td>Desc Usuario</td>
                        <td>Nº Conexiones</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </th>
                </thead>
                <tbody>
                    
                </tbody>
            </table>
        </div>
        <script>
            /**
             * Función mostrarUsuarios
             * 
             * Muestra todos los usuarios de la base de datos en una tabla.
             * 
             * @param {Array} usuarios Array con contiene los usuarios de la base de datos.
             * @returns {undefined}
             */
            function mostrarUsuarios(usuarios){
                var table = document.getElementById("tabla");
                for (i = 0; i < usuarios.length; i++){
                    var fila = document.createElement("tr");
                    var celda = document.createElement("td");
                    
                    // Introducimos el dato codUsuario.
                    celda.textContent = usuarios[i].codUsuario;
                    fila.appendChild(celda);
                    
                    // Introducimos el dato descUsuario.
                    celda.textContent = usuarios[i].descUsuario;
                    fila.appendChild(celda);
                    
                }
            }
        </script>
    </div>
</main>