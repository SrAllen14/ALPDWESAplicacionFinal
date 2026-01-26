<div class="cabecera2">
    <h2>Mantenimiento de Departamentos</h2>
</div>
</header>
<main>
    <div class="container">
        <div class="formulario">
            <form>
                <input type="text" name="codDepartamento" id="codDepartamento" placeholder="Código de departamento...">
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
                                <td><?php echo $oDepartamento->getVolumenNegocio(); ?></td>
                                <td class="iconosDpto"><i class="fa-solid fa-eye"></td>
                                <td class="iconosAltaBaja">
                                    <?php if ($oDepartamento->getFechaBajaDepartamento() === null): ?>
                                        <span id="activo" ><i class="fa-regular fa-flag"></i></span>
                                    <?php else: ?>
                                        <span id="baja" ><i class="fa-regular fa-flag"></i></span>
                                    <?php endif; ?>
                                </td>
                                <td class="iconosDpto"><i class="fa-regular fa-pen-to-square"></i></td>
                                <td class="iconosDpto"><i class="fa-regular fa-trash-can"></i></td>
                            </tr>
                        <?php endforeach; ?>

                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <form>
            <button type="submit" name="volver" id="volver">Volver</button>
        </form>
    </div>
</main>