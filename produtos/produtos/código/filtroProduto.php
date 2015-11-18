<!DOCTYPE HTML>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Slick Web Layout</title>

<!--[if lt IE 9]>
<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]>-->
<link rel="stylesheet" href="css/style1.css" >
<link rel="stylesheet" href="css/style.css" >

<?php

?>

<?php

    include("css/style_adm.css")
?>

</head>

<body>
<?php
    include("header.php")
?>
    <div class="main-box">
    <div class="container">
        <h2>Usuarios de Maior Consumo</h2>

       
        <div class="wrapper">
            <div class="preenchimentoFormulario">
                <form action='filtroProduto.php' method='get'  class="full">
                    <div class="linha">
                        <input type="submit" value="FILTRAR" name="FILTRAR" class="button size1"
                               style="cursor: pointer; float: right;"/>
                        <input class="formAdm size3" name="filtro" type="text" placeholder="Filtro"
                               style="float: right;"/>
                        <div class="linha">
                    </form>

                        <table class="table table-striped table-bordered table-condensed table-hover">
                            <thead>
                            <tr role="row">
                                <th>Usuario</th>
                                <th>Produto</th>
                                <th>Consumo KWh</th>
                                <th>Tempo Total de Consumo</th>
                                <th>Potência Total Consumida</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                        <?php
                        require_once("conexaoBD.php");
                        if (isset($_GET['filtro'])){
                            $filtro = $_GET['filtro'];
                        if ($filtro) {
                            $sql = "SELECT ROUND(((POTPRO/1000) * (TEMESTPRO/60)), 2) AS CONSUMO, POTPRO, TEMESTPRO, U.NOMUSU, P.NOMPRO
                            FROM ESTIMATIVAPRODUTO E, USUARIO U, PRODUTO P
                            WHERE E.EMAUSU = U.EMAUSU
                              AND E.CODPRO = P.CODPRO
                              AND P.NOMPRO LIKE '%" . $filtro . "%'
                            GROUP BY U.EMAUSU
                            ORDER BY CONSUMO DESC;";
                        }
                        }else{
                            $sql = "SELECT ROUND(((POTPRO/1000) * (TEMESTPRO/60)), 2) AS CONSUMO, POTPRO, TEMESTPRO, U.NOMUSU, P.NOMPRO
                            FROM ESTIMATIVAPRODUTO E, USUARIO U, PRODUTO P
                            WHERE E.EMAUSU = U.EMAUSU
                              AND E.CODPRO = P.CODPRO
                            GROUP BY U.EMAUSU
                            ORDER BY CONSUMO DESC;";
                        }
                        if (!empty($sql)) {
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<td style='vertical-align: middle;' class=' '>" . $row['NOMUSU'] . "</td>";
                                    echo "<td style='vertical-align: middle;' class=' '>" . $row['NOMPRO'] . "</td>";
                                    echo "<td style='vertical-align: middle;' class=' '>" . $row['CONSUMO'] . "</td>";
                                    echo "<td style='vertical-align: middle;' class=' '>" . $row['TEMESTPRO'] . "</td>";
                                    echo "<td style='vertical-align: middle;' class=' '>" . $row['POTPRO'] . "</td>";
                                    echo "&nbsp;&nbsp;</tr>";
                                }
                            }
                        }
                        ?>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include("footer.php");
?>

</body>
</html>    