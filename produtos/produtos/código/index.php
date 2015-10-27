<!DOCTYPE HTML>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Slick Web Layout</title>

<!--[if lt IE 9]>
<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]>-->
<link rel="stylesheet" href="css/style.css" >
<?php
    include("css/style2.css")
?>
</head>

<body>

<?php
    include("header_index.php")
?>

    <section id="more-products" class="container_12 clearfix">
        <h1>Vantagens do aplicativo</h1>
            <div class="product grid_4">
                        <h3>Redução de custos</h3>
                        <p>Com o objetivo de reduzir o valor unitário pago pelo kWh, é feita uma análise da
                           conta  de energia, onde simulamos o histórico de  consumo da empresa em todas as
                           tarifas disponíveis pela ANEEL (Agência Nacional de Energia Elétrica).</p>
            </div>
            
            <div class="product grid_4">
                <h3>Economia</h3>
                        <p>Após a realização deste estudo preliminar, a simulação é apresentada ao cliente, onde
                           constata-se quanto a empresa está pagando e quanto irá pagar com a realização de nosso
                           serviço.</a></p>
            </div>

		<span class="clearfix"></span>
    </section>


<?php
include("footer.php");
?>

</body>
</html>    