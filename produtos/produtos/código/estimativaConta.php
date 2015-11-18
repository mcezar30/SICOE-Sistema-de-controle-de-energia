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
    include("css/style_adm.css");

    require_once("conexaoBD.php");
    $email = $_SESSION["USUARIOLOGADO"];
    $sql = "SELECT EMAUSU, CODPRO, QTDEPRO, POTPRO, TEMESTPRO, ESTRED
            FROM ESTIMATIVAPRODUTO
            WHERE EMAUSU = '".$email."';";
    $result = $conn->query($sql);
    ?>

</head>

<body>
<?php
include("header.php")
?>
<?php
$somaReducao = 0;
$kwh = 0;
$potencialTotal = 0;
$tempoTotal = 0;
$reducaoSol = 0;
if ($result->num_rows > 0){

    while($row = $result->fetch_assoc()){
        $potencialTotal += $row['POTPRO'];
        $tempoTotal += $row['TEMESTPRO'];
        $somaReducao += $row['ESTRED'];
    }
$qtdedias = date('t');
$metaReducao = $somaReducao/$result->num_rows;
$kwh = ($potencialTotal/1000) * ($tempoTotal/60);
$valorTotal = $kwh * 0.5098000 * $qtdedias;
$metaTotal = (($kwh * 0.5098000) * (100 - $metaReducao) )/100 * $qtdedias;
$metaPotencia = round(($potencialTotal * (100 - $metaReducao) )/100);
$sugestaoPotencia = round(($potencialTotal * 80 )/100);
$sugestaoTotal = (($kwh * 0.5098000) * 80 )/100 * $qtdedias;
}
?>
<div class="main-box">
    <section id="more-products" class="cont clearfix">
        <h1 align="center">Meta de Consumo</h1>
        <form method='post' class='product grid_4'>
            <h3 ALIGN='center'>Periodo da Estimativa</h3>
                <br>
                <div id="Meta de Consumo">
                    <p>
                        <input type="text" name="xx" id="campodisable" disabled="disabled" value="Periodo Inicial              <?php echo "01/".date('m/Y');?>">
                        <br>
                    </p>
                    <p>
                        <input type="text" name="xx" id="campodisable" disabled="disabled" value="Periodo Final               <?php echo date('t/m/Y');?>">
                        <br>
                    </p>

                </div>

            <br>
        </form>
        <form method='post' class='product grid_4'>
            <h3 ALIGN='center'>Sugestao de Consumo</h3>
            <br>
            <div id="listaProd estimativa">
                <p>
                    <input type="text" name="xx" id="campodisable" disabled="disabled" value="Consumo (KW)            <?php if ($result->num_rows > 0){echo $sugestaoPotencia;}?>">
                    <br>
                </p>
                <p>
                    <input type="text" name="xx" id="campodisable" disabled="disabled" value="Total a pagar               R$ <?php if ($result->num_rows > 0){echo round($sugestaoTotal, 2);}?>">
                    <br>
                </p>
            </div>

            <br>
        </form>
        <form method='post' class='product grid_4'>
            <h3 ALIGN='center'>Sugestao de Reducao</h3>
            <br>
            <div id="listaProd estimativa">
                <p>
                    <input type="text" name="xx" id="campodisable" disabled="disabled" value="Consumo (KW)              <?php if ($result->num_rows > 0){echo $metaPotencia;}?>">
                    <br>
                </p>
                <p>
                    <input type="text" name="xx" id="campodisable" disabled="disabled" value="Total a pagar                 R$ <?php if ($result->num_rows > 0){echo round($metaTotal);}?>">
                    <br>
                </p>
            </div>

            <br>
        </form>
        <form method='post' class='product grid_4'>
            <h3 ALIGN='center'>Valor a Pagar</h3>
            <br><br>
            <div id="listaProd estimativa">
                <p>
                    <input type="text" name="xx" id="campodisable" disabled="disabled" value="         R$ <?php if ($result->num_rows > 0){ echo round($valorTotal, 2);}?>">
                    <br>
                </p>
            </div>

            <br>
        </form>
        <span class="clearfix"></span><br>



    </section>
    <div class="container estima">
    <div class="wrapper">
        <div class="preenchimentoFormulario">
            <div class="full">
                <div class="linha">
                </div>
                <div class="linha">
                    <table class="table table-striped table-bordered table-condensed table-hover">
                        <thead>
                        <tr role="row">
                            <th>Usuario</th>
                            <th>Potencia Total</th>
                            <th>Consumo (KWh)</th>
                            <th>Sugestao de Consumo (KW)</th>
                            <th>Meta de Consumo (KW)</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <?php
                            if ($result->num_rows > 0) {
                                echo "<td style='vertical-align: middle;' class=' '>" . $email . "</td>";
                                echo "<td style='vertical-align: middle;' class=' '>" . $potencialTotal . "</td>";
                                echo "<td style='vertical-align: middle;' class=' '>" . $kwh . "</td>";
                                echo "<td style='vertical-align: middle;' class=' '>" . $sugestaoPotencia . "</td>";
                                echo "<td style='vertical-align: middle;' class=' '>" . $metaPotencia . "</td>";
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