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
require_once("conexaoBD.php");

$sql = "SELECT ROUND(((POTPRO/1000) * (TEMESTPRO/60)), 2) AS CONSUMO, POTPRO, TEMESTPRO, NOMUSU
        FROM (
        SELECT 0 AS CONSUMO, SUM(POTPRO) AS POTPRO, SUM(TEMESTPRO) AS TEMESTPRO, U.NOMUSU
        FROM ESTIMATIVAPRODUTO E, USUARIO U
        WHERE E.EMAUSU = U.EMAUSU
        GROUP BY U.EMAUSU) AS CSM
        ORDER BY CONSUMO DESC;";

$result = $conn->query($sql);
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
        <h1 style="text-align: center; font-size: large">Usuarios de Maior Consumo de Energia</h1>
    <div class="container">

        <div class="wrapper">
            <div class="preenchimentoFormulario">
                <div class="full">
                    <div class="linha">
                        <table class="table table-striped table-bordered table-condensed table-hover">
                            <thead>
                            <tr role="row">
                                <th>Usuario</th>
                                <th>Consumo KWh</th>
                                <th>Tempo Total de Consumo</th>
                                <th>Potência Total Consumida</th>

                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                        <?php
                        if ($result->num_rows >0){
                            while($row = $result->fetch_assoc()){
                                echo "<td style='vertical-align: middle;' class=' '>". $row['NOMUSU']. "</td>";
                                echo "<td style='vertical-align: middle;' class=' '>". $row['CONSUMO']. "</td>";
                                echo "<td style='vertical-align: middle;' class=' '>". $row['TEMESTPRO']. "</td>";
                                echo "<td style='vertical-align: middle;' class=' '>". $row['POTPRO']. "</td>";
                                echo "&nbsp;&nbsp;</tr>";
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