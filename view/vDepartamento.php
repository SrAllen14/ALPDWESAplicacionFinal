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
                        <td>Estado</td>
                        <td>Editar</td>
                        <td>Borrar</td>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($avDepartamentos['aDepartamentos']) > 0): ?>
                        <?php foreach ($avDepartamentos['aDepartamentos'] as $oDepartamento): ?>
                            <tr>
                                <td><?php echo $oDepartamento->getCodDepartamento(); ?></td>
                                <td><?php echo $oDepartamento->getDescDepartamento(); ?></td>
                                <td>
                                    <?php
                                    $fechaA = new DateTime($oDepartamento->getFechaCreacionDepartamento());
                                    echo $fechaA->format('d-m-Y');
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    if ($oDepartamento->getFechaBajaDepartamento() != null) {
                                        $fechaB = new DateTime($oDepartamento->getFechaBajaDepartamento());
                                        echo $fechaB->format('d-m-Y');
                                    } else {
                                        echo "-";
                                    }
                                    ?>
                                </td>
                                <td><?php echo number_format($oDepartamento->getVolumenNegocio(), 2, ',', '.')." €"; ?></td>
                                <td class="iconosDpto"><form method="post"><button type="submit" name="bVer" value="<?php echo $oDepartamento->getCodDepartamento()?>"><i class="fa-solid fa-eye"></i></button></form></td>
                                <td class="iconosAltaBaja">
                                    <?php if ($oDepartamento->getFechaBajaDepartamento() === null): ?>
                                        <span class="activo" ><i class="fa-regular fa-flag"></i></span>
                                    <?php else: ?>
                                        <span class="baja" ><i class="fa-regular fa-flag"></i></span>
                                    <?php endif; ?>
                                </td>
                                <td class="iconosDpto"><form method="post"><button type="submit" name="bEditar" value="<?php echo $oDepartamento->getCodDepartamento()?>"><i class="fa-regular fa-pen-to-square"></i></button></form></td>
                                <td class="iconosDpto"><form method="post"><button type="submit" name="bBorrar" value="<?php echo $oDepartamento->getCodDepartamento()?>"><i class="fa-regular fa-trash-can"></i></button></form></td>
                            </tr>
                        <?php endforeach; ?>

                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</main>