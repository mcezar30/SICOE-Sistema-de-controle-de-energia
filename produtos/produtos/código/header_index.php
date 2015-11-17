	<div id="hfwrap">
    	<div id="hfwrap2">
        	<div id="hfwrap3">
                <div id="lnwrap">    
                    <header id="main-header" class="container_12 clearfix">
                        <h1 id="logo" class="grid_2 suffix_4"><a href="#">Design Revisions</a></h1>
                        <nav id="main-nav" class="grid_6">
                            <h1>Main page navigation</h1>
                            <ul>
                                <?php
                                $login = isset($_SESSION['USUARIOLOGADO']) ? 0: 1;
                                if ($login == 0) {
                                    echo "<li class='index.php'><a href='index.php'>Home</a></li>";
                                    echo "<li><a href='Produtos.php'>Produtos</a></li>";
                                    echo "<li><a href='#'>Descrição</a></li>";
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
                </div><!--lnwrap-->
                        
                <section id="featured" class="container_12 clearfix">
                    <div id="descrp" class="grid_6 suffix_6">
                        <h1>Redução de Custos <span>e do Consumo de Energia Elétrica</span></h1>

                        <span></span>             
                    </div><!--#descrp-->   
                </section>
            </div><!--#hfwrap3-->
        </div><!--hfwrap2-->
    </div><!--hfwrap-->