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
            <form method="post">
                <label for="desUsuario"><b>Descripción:</b></label>
                <input type="text" name="descUsuario" id="descUsuario" placeholder="Código de departamento...">
            </form>
        </div>
        <div class="tabla">
            <table id="tabla">
                
            </table>
        </div>
        <script>
            var table = document.getElementById("tabla");
            /**
             * Función mostrarUsuarios
             * 
             * Muestra todos los usuarios de la base de datos en una tabla.
             * 
             * @param {Array} usuarios Array con contiene los usuarios de la base de datos.
             * @returns {undefined}
             */
            function mostrarUsuarios(usuarios){
                
                table.innerHTML = `<thead class="titulo">
                    <th>Código</th>
                    <th>Descripción</th>
                    <th>Nº Conexiones</th>
                    <th>Última Conexión</th>
                    <th>Perfil</th>
                    <th colspan="2">Opciones</th>
                </thead>`;
                for (i = 0; i < usuarios.length; i++){
                    var fila = document.createElement("tr");

                    // Introducimos el dato codUsuario.
                    var celda1 = document.createElement("td");
                    celda1.textContent = usuarios[i].codUsuario;
                    fila.appendChild(celda1);
                    
                    // Introducimos el dato descUsuario.
                    var celda2 = document.createElement("td");
                    celda2.textContent = usuarios[i].descUsuario;
                    fila.appendChild(celda2);
                    
                    // Introducimos el dato contadorAccesos.
                    var celda3 = document.createElement("td");
                    celda3.textContent = usuarios[i].contadorAccesos;
                    fila.appendChild(celda3);
                    
                    // Introducimos el dato fechaHoraUltimaConexion
                    var celda4 = document.createElement("td");
                    // Comprobamos que la fecha no es nula.
                    if(usuarios[i].fechaHoraUltimaConexion !== null){
                        // En caso de que no sea nula formateamos la fecha.
                        var fecha = new Date(usuarios[i].fechaHoraUltimaConexion);
                        var dia = String(fecha.getDate()).padStart(2,'0');
                        var mes = String(fecha.getMonth()+1).padStart(2, '0');
                        var anio = String(fecha.getFullYear());
                        
                        var fechaFormateada = `${dia}-${mes}-${anio}`;
                    } else{
                        // En caso de que sea nula dejamos vacia la celda.
                        var fechaFormateada = "";
                    }

                    celda4.textContent = fechaFormateada;
                    fila.appendChild(celda4);
                    
                    // Introducimos el dato perfil.
                    var celda5 = document.createElement("td");
                    celda5.textContent = usuarios[i].perfil;
                    fila.appendChild(celda5);
                    
                    // Introducimos el icono consultar.
                    var celda6 = document.createElement("td");
                    celda6.innerHTML = '<form method="post"><button type="submit" name="bVer" value="'+usuarios[i].codUsuario+'"><i class="fa-solid fa-eye"></i></button></form>';
                    fila.appendChild(celda6);
                    
                    // Introducimos el icono borrar.
                    var celda7 = document.createElement("td");
                    celda7.innerHTML = '<form method="post"><button type="submit" name="bBorrar" value="'+usuarios[i].codUsuario+'"><i class="fa-regular fa-trash-can"></i></i></button></form>';
                    fila.appendChild(celda7);
                    
                    table.appendChild(fila);
                }
            }
            var urlApi = "http://192.168.1.240/ALPDWESAplicacionFinal/api/wsBuscarUsuariosPorDescripcion.php";
            
            fetch(urlApi)
                .then((response)=>{
                    return response.json();
                })
                .then((datos)=>{
                    mostrarUsuarios(datos);
                });
            var cBuscarDesc = document.getElementById("descUsuario");
            cBuscarDesc.addEventListener("input", ()=>{
                
                fetch(urlApi + "?descUsuario=" + cBuscarDesc.value)
                    .then((response)=>{
                        return response.json();
                    })
                    .then((datos)=>{
                        mostrarUsuarios(datos);
                    });
            });
            
        </script>
    </div>
</main>