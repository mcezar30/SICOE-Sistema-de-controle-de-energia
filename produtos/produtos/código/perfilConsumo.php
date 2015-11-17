<?php
session_start();
?>
<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Slick Web Layout</title>

    <link rel="stylesheet" href="css/style1.css" >
    <link rel="stylesheet" href="css/style.css" >

    <?php
    include("css/style_adm.css")
    ?>
    <?php
    require_once("conexaoBD.php");
    $sql = "SELECT CODPRO, NOMPRO, DESPRO, IMGPRO FROM PRODUTO";
    $result = $conn->query($sql);
    ?>

</head>

<body>
<?php
include("header.php")
?>
<div class="main-box">

    <section id="more-products" class="cont clearfix">
        <h1>Produtos Cadastrados</h1>
        <?php
        if ($result->num_rows >0){

            while($row = $result->fetch_assoc()){
                echo "<form action='Controle/Carrinho.php?CODPRO=".htmlspecialchars($row['CODPRO'])."&NOMPRO=".htmlspecialchars($row['NOMPRO'])."' method='post' class='product grid_4'>";
                echo "<h3 ALIGN='center'>". $row['NOMPRO']. "</h3>";
                echo "<figure>";
                echo "<img src='". $row['IMGPRO']. "' width='300' height='150'>";
                echo "<figcaption>";
                ?>
                <div id="listaProd">

                        <p>
                            Quantidade
                            <select class="lista" name="QTDE" id="QTDE" >
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                            </select>
                        </p>
                        <p>
                            Potencia
                            <select class="lista" name="POT" id="POTENCIA">
                                <?php

                                $sqlgrandeza = "SELECT POTPRO, VOLPRO
                                                  FROM GRANDEZAPRODUTO GP, PRODUTO P
                                                 WHERE GP.CODPRO = ".$row['CODPRO']."
                                                   AND GP.CODPRO = P.CODPRO";
                                $resultgrandeza = $conn->query($sqlgrandeza);
                                if ($resultgrandeza->num_rows > 0) {
                                    while($rowgra = $resultgrandeza->fetch_assoc()){
                                        echo "<option >" . $rowgra['POTPRO'] .  "</option>";
                                    }
                                }
                                ?>
                            </select>
                        </p>
                        <p>
                            Tempo
                            <select class="lista" name="TEMPO" id="TEMPO" >
                                <?php
                                for ($i = 0; $i < 4; $i++) {
                                    for ($j = 0; $j < 60; $j += 10) {
                                        if ($j == 0)
                                            echo "<option>"."0".$i.":"."00"."</option>";
                                        else
                                            echo "<option>"."0".$i.":".$j."</option>";
                                    }
                                }
                                for ($i = 4; $i < 24; $i++) {
                                    if ($i < 10)
                                        echo "<option>"."0".$i.":"."00"."</option>";
                                    else
                                        echo "<option>".$i.":"."00"."</option>";
                                }
                                ?>
                            </select>
                        </p>
                    <p>
                        Meta de economia (%)
                        <select class="lista" name="ECO" id="ECO" >
                            <?php
                            for ($i = 0; $i <= 100; $i++) {
                                echo "<option>".$i."</option>";
                            }
                            ?>
                        </select>
                    </p>

                </div>

                <?php
                echo "<p>";
                echo "<input  class='button Carrinho' style='cursor: pointer; float: right;' value='Adicionar' type='submit'>";
                echo "</p>";
                echo "</figcaption>";
                echo "</figure>";
                echo "</form>";
            }
        }
        else{
            echo("Não existem produtos cadastrados.");
        }
        ?>
        <span class="clearfix"></span><br>
        <div>
        <a href='perfilUsuario.php'><input class='button Carrinho' style='cursor: pointer; float: right;' value='Visualizar Perfil de Consumo' type='button'></a>
        </div>
        <div>
            <a href='estimativaConta.php'><input class='button Carrinho' style='cursor: pointer; float: right;' value='Visualizar Estimativa de Conta' type='button'></a>
        </div>
        <div>
            <a href='Controle/perfilConsumo.php'><input class='button Carrinho' style='cursor: pointer; float: right;' value='Confirmar Perfil' type='button'></a>
        </div>


    </section>
</div>




<?php
include("footer.php");
?>

</body>
</html>