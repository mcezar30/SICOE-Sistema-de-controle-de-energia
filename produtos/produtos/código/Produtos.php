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
//$conn = self::abreConexao();
$sql = "SELECT CODPRO, NOMPRO, DESPRO, VOLPRO, POTPRO, POTSBYPRO FROM PRODUTO";
//Uso da função query (sem parametrização - prepared statment)
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
    <div class="container">
        <h4>Descrição dos Produtos</h4>

        <div class="wrapper">
            <div class="preenchimentoFormulario">
                <div class="full">
                    <div class="linha">
                        <input type="button" value="FILTRAR" class="button size1"
                               style="cursor: pointer; float: right;"/>
                        <input class="formAdm size3" name="filtro" type="text" placeholder="Filtro"
                               style="float: right;"/>
                    </div>
                    <div class="linha">
                        <table class="table table-striped table-bordered table-condensed table-hover">
                            <thead>
                            <tr role="row">
                                <th>Foto</th>
                                <th>Aparelho</th>
                                <th>Descrição</th>
                                <th>Voltagem</th>
                                <th>Potênncia em uso</th>
                                <th>Potência em standby</th>
                                <th></th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <?php
                                if ($result->num_rows >0){
                                    while($row = $result->fetch_assoc()){
                                        echo "<td style='vertical-align: middle;' class=' '>". "". "</td>";
                                        echo "<td style='vertical-align: middle;' class=' '>". $row['NOMPRO']. "</td>";
                                        echo "<td style='vertical-align: middle;' class=' '>". $row['DESPRO']. "</td>";
                                        echo "<td style='vertical-align: middle;' class=' '>". $row['VOLPRO']. "</td>";
                                        echo "<td style='vertical-align: middle;' class=' '>". $row['POTPRO']. "</td>";
                                        echo "<td style='vertical-align: middle;' class=' '>". $row['POTSBYPRO']. "</td>";
                                        echo "</tr>";
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