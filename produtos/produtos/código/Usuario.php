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
    <div class="main-box">
    <div class="container">
        <div class="wrapper">
            <div class="flat-form">
                <div id="login" class="form-action show">
                    <h2>Cadastro Usuário</h2>

                    <form action="Controle/Usuario.php" method="post" name="cadUsu">
                        <div class="linha">
                            <input class="formTag show size10" name="nome" type="text" placeholder="Nome completo" required="required"/>
                            <input class="formTag show size10" name="cpf" type="text" placeholder="CPF" required="required" onblur="validaCPF(this.value)" onkeypress="mascara(this, cpf_mask);"  maxlength="14" />
                            <input class="formTag show size10" name="email" type="text" placeholder="Email" required="required"/>
                            <input class="formTag show size10" name="senha" type="password" placeholder="Senha" required="required"/>
                            <input class="formTag show size10" name="confirmar" type="password" placeholder="Confirmar senha" required="required"/>
                            <input type="submit" value="Entrar" class="button" style="cursor: pointer;" onClick="validarSenha();"/>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
    include("footer.php");
?>

<script src="js/usuario.js"></script>
</body>
</html>    