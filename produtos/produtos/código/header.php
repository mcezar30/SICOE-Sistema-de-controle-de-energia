<div id="lnwrap">
    <header id="main-header" class="container_12 clearfix">
        <h1 id="logo" class="grid_2 suffix_4"><a href="#">Sicoe Energia</a></h1>
        <nav id="main-nav" class="grid_6">
            <h1>Menu de Navegação</h1>
            <ul>
                <?php
                if (!isset($_SESSION['USUARIOLOGADO'])){
                    echo "<li class='index.php'><a href='index.php'>Home</a></li>";
                    echo "<li><a href='Produtos.php'>Produtos</a></li>";
                    echo "<li><a href='#'>Contact</a></li>";
                    echo "<li><a href='login.php'>Login</a></li>";
                }else{
                    echo "<li class='index.php'><a href='index.php'>Home</a></li>";
                    echo "<li><a href='Produto.php'>Produtos</a></li>";
                    echo "<li><a href='Administrativa.php'>Gerencial</a></li>";
                    echo "<li><a href='perfilConsumo.php'>Perfil</a></li>";
                    echo "<li><a href='sair.php'>Sair</a></li>";
                }
                ?>
            </ul>
        </nav>
    </header>
</div>
