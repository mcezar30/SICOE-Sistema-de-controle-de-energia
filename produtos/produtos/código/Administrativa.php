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
$sql = "SELECT DISTINCT(P.CODPRO), P.NOMPRO, P.DESPRO, P.VOLPRO, GP.POTPRO, GP.POTSBYPRO
          FROM PRODUTO P, GRANDEZAPRODUTO GP
         WHERE P.CODPRO = GP.CODPRO
         AND GP.POTPRO = (SELECT MAX(G.POTPRO) AS POTPRO
         FROM GRANDEZAPRODUTO G
         WHERE G.CODPRO = P.CODPRO)";
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
        <h2>Administração</h2>

        <div class="wrapper">
            <div class="preenchimentoFormulario">
                <div class="full">
                    <input type="button" value="INSERIR NOVO PRODUTO" class="button" style="cursor: pointer;"/>
                </div>
            </div>
        </div>
        <div class="wrapper">
            <div class="preenchimentoFormulario">
                <div class="full">
                    <form action="Controle/Administrativa.php" method="post" >
                        <div>
                            <input class="formAdm size3" name="nome" type="text" placeholder="Nome" required="required"/>
                            <input class="formAdm size3" name="descricao" type="text" placeholder="Descrição" required="required"/>
                            <input class="formAdm size3" name="voltagem" type="text" placeholder="Voltagem" required="required"/>
                        </div>
                        <input class="formAdm size3" name="potencia" type="text" placeholder="Potência em uso" required="required"/>
                        <input class="formAdm size3" name="standby" type="text" placeholder="Potência em Standby" required="required"/>
                        <input class="formAdm size3" name="foto" type="file" placeholder="Foto do produto" />
                        <input type="submit" value="SALVAR" class="button" style="cursor: pointer;" />
                    </form>
                </div>
            </div>
        </div>
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
                                echo "<td style='vertical-align: middle;' class=' '>". $row['NOMPRO']. "</td>";
                                echo "<td style='vertical-align: middle;' class=' '>". $row['DESPRO']. "</td>";
                                echo "<td style='vertical-align: middle;' class=' '>". $row['VOLPRO']. "</td>";
                                echo "<td style='vertical-align: middle;' class=' '>". $row['POTPRO']. "</td>";
                                echo "<td style='vertical-align: middle;' class=' '>". $row['POTSBYPRO']. "</td>";
                                echo "<td><a href='./Controle/Administrativa/excluir.php?CODPRO=".htmlspecialchars($row['CODPRO'])."'><button type=\button\>Excluir</button></a>";
                                echo "&nbsp;&nbsp;<td><a href='./Controle/Administrativa/editar.php?CODPRO=".htmlspecialchars($row['CODPRO'])."'><button type=\button\>Editar</button></a></td></tr>";
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