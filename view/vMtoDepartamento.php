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
                <button type="submit" name="exportarDepartamentos" id="exportarDepartamentos">Exportar departamentos</button>
                <button type="submit" name="importarDepartamentos" id="importarDepartamentos">Importar departamentos</button>
            </form>
        </div>
        <div class="formulario">
            <form>
                <input type="text" name="codDepartamento" id="codDepartamento" placeholder="Código de departamento..." value="<?php echo $_SESSION['descDptoBuscado'] ?>">
                <button type="submit" name="buscar" id="buscar">Buscar</button>
            </form>
        </div>
        <div class="tabla">
            <table>
                <thead>
                    <tr class="titulo">
                        <td>Código</td>
                        <td>Descripcion</td>
                        <td>Fecha de Creación</td>
                        <td>Fecha de Baja</td>
                        <td>Volumen de Negocio</td>
                        <td>Ver</td>
                        <td>Borrar</td>
                        <td>Editar</td>
                        <td>Estado</td>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($avDepartamentos): ?>
                        <?php foreach ($avDepartamentos as $dto): ?>
                            <tr>
                                <td <?php echo ($dto['fechaBajaDepartamento']) ? 'class="baja"' : ""?>><?php echo $dto['codDepartamento']; ?></td>
                                <td <?php echo ($dto['fechaBajaDepartamento']) ? 'class="baja"' : ""?>><?php echo $dto['descDepartamento']; ?></td>
                                <td <?php echo ($dto['fechaBajaDepartamento']) ? 'class="baja"' : ""?>>
                                    <?php
                                    echo $dto['fechaCreacionDepartamento'];
                                    ?>
                                </td>
                                <td <?php echo ($dto['fechaBajaDepartamento']) ? 'class="baja"' : ""?>>
                                    <?php
                                    if ($dto['fechaBajaDepartamento'] != null) {
                                        echo $dto['fechaBajaDepartamento'];
                                    } else {
                                        echo "-";
                                    }
                                    ?>
                                </td>
                                <td class="<?php echo ($dto['fechaBajaDepartamento']) ? 'baja' : ''?> volumen"><?php echo $dto['volumenDeNegocio']; ?></td>
                                <td <?php echo ($dto['fechaBajaDepartamento']) ? 'class="baja"' : ""?> class="iconosDpto"><form method="post"><button type="submit" name="bVer" value="<?php echo $dto['codDepartamento']?>"><i class="fa-solid fa-eye"></i></button></form></td>
                                <td class="<?php echo ($dto['fechaBajaDepartamento']) ? 'baja' : ""?> iconosDpto"><form method="post"><button type="submit" name="bEditar" value="<?php echo $dto['codDepartamento']?>"><i class="fa-regular fa-pen-to-square"></i></button></form></td>
                                <td class="<?php echo ($dto['fechaBajaDepartamento']) ? 'baja"' : ""?> iconosDpto"><form method="post"><button type="submit" name="bBorrar" value="<?php echo $dto['codDepartamento']?>"><i class="fa-regular fa-trash-can"></i></button></form></td>
                                <td <?php echo ($dto['fechaBajaDepartamento']) ? 'class="baja"' : ""?>><form method="post"><button type="submit" <?php echo ($dto['fechaBajaDepartamento']) ? 'class="baja" name="bAltaLogica"' : 'class="alta" name="bBajaLogica"'?> value="<?php echo $dto['codDepartamento']?>"><i class="fas fa-arrow-down"></i></button></form></td>
                            </tr>
                        <?php endforeach; ?>

                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</main>