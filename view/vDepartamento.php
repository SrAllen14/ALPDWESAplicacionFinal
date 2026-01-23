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
            <?php 
                echo "<table>";
                echo '<tr class="titulo">';
                echo '<td>Código</td>';
                echo '<td>Descripcion</td>';
                echo '<td>Fecha de Creación</td>';
                echo '<td>Fecha de Baja</td>';
                echo '<td>Volumen de Negocio</td>';
                echo '</tr>';
                if(!empty($avDepartamentos['aDepartamentos'])){
                    foreach ($avDepartamentos['aDepartamentos'] as $oDepartamento) {
                        echo "<tr>";
                        echo "<td class='valor'>".$oDepartamento->getCodDepartamento()."</td>";
                        echo "</tr>";
                    }
                }
                echo "</table>";
            ?>
        </div>
        <form>
            <button type="submit" name="volver" id="volver">Volver</button>
        </form>
    </div>
</main>