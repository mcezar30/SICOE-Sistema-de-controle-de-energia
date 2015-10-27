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
    include("css/style_adm.css")
    ?>

</head>

<body>

<?php
include("header.php")
?>
<header>
    <div class="containerHeader">
        <h1 class="descicaoLogo"><a href="index.html">Nome Empresa</a></h1>
    </div>
</header>
<div class="main-box">
    <div class="container">
        <div class="wrapper">
            <div class="flat-form">
                <ul class="tabs">
                    <li>
                        <a href="#usuarioComum" class="active" onclick="alterarTipoLogin(this);"
                            >Usuário</a>
                    </li>
                    <li>
                        <a href="#areaAdministrativa" class="" onclick="alterarTipoLogin(this);">Administrador</a>
                    </li>
                </ul>
                <h2 id="titulo">Login Usuário</h2>

                <form action="Controle/Login.php" method="post">
                    <div class="linha">
                        <input class="formTag" id="email" name="email" type="text" placeholder="Email"
                               style="width: 97%;" required="required"/>
                        <input class="formTag" id="senha" name="senha" type="password" placeholder="Senha"
                               style="width: 97%;" required="required"/>
                        <input type="submit" value="ENTRAR" class="button" style="cursor: pointer;"/>
                                    <span id="opcaoCadastrar" class="show">Ainda não possui cadastro? <a
                                            href="Usuario.php">Clique
                                        aqui</a></span>
                        <input type="hidden" id="tipoUsuario" name="tipoUsuario" value="1">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
include("footer.php");
?>

<script src="js/login.js"></script>
</body>
</html>