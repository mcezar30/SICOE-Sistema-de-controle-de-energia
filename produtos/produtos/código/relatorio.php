<?php
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

</head>

<body>
<?php
include("header.php")
?>
<div class="main-box">

    <section id="more-products" class="cont clearfix">
        <h1>Relatorios Administrativos</h1><br><br>
        <?php

                echo "<form action='maiorConsumo.php' method='post' class='product grid_4'>";
                echo "<h3 ALIGN='center'>Maio Consumo (Usuarios)</h3>";
                echo "<figure>";
                echo "<img src='img/produto/maiorConsumo.jpg' width='300' height='150'>";
                echo "<figcaption>";
                echo "<p>";
                echo "<input  class='button Carrinho' style='cursor: pointer; float: right;' value='Visualizar' type='submit'>";
                echo "</p>";
                echo "</figcaption>";
                echo "</figure>";
                echo "</form>";

        ?>
        <?php

        echo "<form action='filtroProduto.php' method='post' class='product grid_4'>";
        echo "<h3 ALIGN='center'>Maio Consumo (Usuarios)</h3>";
        echo "<figure>";
        echo "<img src='img/produto/nadaver.jpg' width='300' height='150'>";
        echo "<figcaption>";
        echo "<p>";
        echo "<input  class='button Carrinho' style='cursor: pointer; float: right;' value='Visualizar' type='submit'>";
        echo "</p>";
        echo "</figcaption>";
        echo "</figure>";
        echo "</form>";

        ?>
        <span class="clearfix"></span><br>

    </section>
</div>




<?php
include("footer.php");
?>

</body>
</html>