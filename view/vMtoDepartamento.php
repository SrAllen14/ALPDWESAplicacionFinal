    <div class="cabecera2">
        <h2>Mantenimiento de Departamentos</h2>
    </div>
    <div class="cabecera3">
        <form>
            <button type="submit" name="volver" id="volver">Volver</button>
        </form>
    </div>
</header>
<main>
    <div class="container">
        <div class="botones">
            <form>
                <button type="submit" name="bAlta" id="altaDepartamento">Añadir departamento</button>
                <button type="submit" name="bExportarDptos" id="exportarDepartamentos">Exportar departamentos</button>
            </form>
        </div>
        <div>
            <form class="archivoImportar" action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post" 
                enctype="multipart/form-data"> 
            <!-- Propiedad imprescindible para enviar archivos al servidor -->
                <label for="archivoDptos" class="labelFoto">Busca un archivo a importar: </label>
                <input type="file" name="archivoDptos" id="archivoDptos" accept="application/json">
                <button type="submit" name="bImportarDptos" id="importarDepartamentos">Importar departamentos</button>
            </form>
        </div>
        <div class="formulario">
            <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
                <input type="text" name="codDepartamento" id="codDepartamento" placeholder="Código de departamento..." value="<?php echo $_SESSION['descDptoBuscado'] ?>">
                <button type="submit" name="buscar" id="buscar">Buscar</button><br>
                <span>
                    <label for="radioAlta">Alta</label>
                    <input type="radio" name="radio" id="radioAlta" value="radioAlta" <?php echo $avMtoDepartamentos['radioActual']=='radioAlta'?'checked':''?>>
                    <label for="radioBaja">Baja</label>
                    <input type="radio" name="radio" id="radioBaja" value="radioBaja" <?php echo $avMtoDepartamentos['radioActual']=='radioBaja'?'checked':''?>>
                    <label for="radioTodos">Todos</label>
                    <input type="radio" name="radio" id="radioTodos" value="radioTodos" <?php echo $avMtoDepartamentos['radioActual']=='radioTodos'?'checked':''?>>
                </span>                    
            </form>
        </div>
        <div class="tabla">
            <table>
                <thead class="titulo">
                    <th>Código</th>
                    <th>Descripcion</th>
                    <th>Fecha de Creación</th>
                    <th>Fecha de Baja</th>
                    <th>Volumen de Negocio</th>
                    <th colspan="4">Acciones</th>
                </thead>
                <tbody>
                    <?php if ($avDepartamentos): ?>
                        <?php foreach ($avDepartamentos as $dto): ?>
                            <tr>
                                <td class="<?php echo ($dto['fechaBajaDepartamento']) ? 'baja' : ""?>"><?php echo $dto['codDepartamento']; ?></td>
                                <td class="<?php echo ($dto['fechaBajaDepartamento']) ? 'baja' : ""?>"><?php echo $dto['descDepartamento']; ?></td>
                                <td class="<?php echo ($dto['fechaBajaDepartamento']) ? 'baja' : ""?> anchoFijo">
                                    <?php
                                    echo $dto['fechaCreacionDepartamento'];
                                    ?>
                                </td>
                                <td class="<?php echo ($dto['fechaBajaDepartamento']) ? 'baja' : ""?> anchoFijo">
                                    <?php
                                    if ($dto['fechaBajaDepartamento'] != null) {
                                        echo $dto['fechaBajaDepartamento'];
                                    } else {
                                        echo "-";
                                    }
                                    ?>
                                </td>
                                <td class="<?php echo ($dto['fechaBajaDepartamento']) ? 'baja' : ''?> volumen"><?php echo $dto['volumenDeNegocio']; ?></td>
                                <td class="<?php echo ($dto['fechaBajaDepartamento']) ? 'baja' : ""?> iconosDpto"><form method="post"><button type="submit" name="bVer" value="<?php echo $dto['codDepartamento']?>"><i class="fa-solid fa-eye"></i></button></form></td>
                                <td class="<?php echo ($dto['fechaBajaDepartamento']) ? 'baja' : ""?> iconosDpto"><form method="post"><button type="submit" name="bEditar" value="<?php echo $dto['codDepartamento']?>"><i class="fa-regular fa-pen-to-square"></i></button></form></td>
                                <td class="<?php echo ($dto['fechaBajaDepartamento']) ? 'baja' : ""?> iconosDpto"><form method="post"><button type="submit" name="bBorrar" value="<?php echo $dto['codDepartamento']?>"><i class="fa-regular fa-trash-can"></i></button></form></td>
                                <td class="<?php echo ($dto['fechaBajaDepartamento']) ? 'baja' : ""?> iconosBajaAlta"><form method="post"><button type="submit" <?php echo ($dto['fechaBajaDepartamento']) ? 'class="baja" name="bAltaLogica"' : 'class="alta" name="bBajaLogica"'?> value="<?php echo $dto['codDepartamento']?>"><i <?php echo ($dto['fechaBajaDepartamento']) ? 'class="fas fa-arrow-up"' : 'class="fas fa-arrow-down"'?>></i></button></form></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <div class="paginacion">
            <form id="paginacionTabla" action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
                <button name="paginaInicial" class="boton" id="paginaInicial">|<</button>
                <button name="paginaAnterior" class="boton" id="paginaAnterior"><</button>
                <p><?php echo $paginaActual ?></p>
                <p>de</p>
                <p><?php echo $totalPaginas ?></p>
                <button name="paginaSiguiente" class="boton" id="paginaSiguiente">></button>
                <button name="paginaFinal" class="boton" id="paginaFinal">>|</button>
            </form>
        </div>
        
    </div>
</main>