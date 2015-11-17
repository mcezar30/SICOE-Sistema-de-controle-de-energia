<?php
session_start();

class popup{
    private $codigo;
    private $nome;
    private $stmt;
    function __construct(){
        $this->codigo = utf8_encode(htmlspecialchars($_GET['CODPRO']));
        $this->nome = utf8_encode(htmlspecialchars($_GET['NOMPRO']));
    }

    public function abreConexao(){
        $bdhost = "localhost";
        $bdusuario = "root";
        $bdsenha = "";
        $baseDados = "sicoe";
        $conn = new mysqli($bdhost, $bdusuario, $bdsenha, $baseDados);
        $conn->set_charset('utf8');
        if ($conn->connect_error) {
            die("Conexão ao MySQL falhou: " . $conn->connect_error);
        }else{
            return $conn;
        }
    }

    public function carregaPopup(){
        try{
            $conn = self::abreConexao();
            $sql = "SELECT POTPRO, P.NOMPRO
                    FROM GRANDEZAPRODUTO GP, PRODUTO P
                    WHERE GP.CODPRO = ?
                      AND GP.CODPRO = P.CODPRO";
            $stmt = $conn->prepare($sql);
            if ($stmt) {
                $stmt->bind_param('i', $this->codigo);
                $stmt->execute();
                $array = $stmt->get_result()->fetch_all();
                //var_dump($array[0][1]);
                $potencia = array();
                for($i = 0; $i < count($array); $i++){
                        $potencia [] = $array[$i][0];
                }
                $produto = $array[0][1];
                self::setSession("POTENCIA", $potencia);
                self::setSession("NOME", $produto);
            }
            else{
                echo "Prepare falhou";
            }
            return $stmt;
        }catch(\Exception $e){

        }
    }

    public function opemPopup($stmt){
        if(!$stmt->errno){
          //  echo "entrou";

            if ($stmt->affected_rows == 0) {
                $msg = "Nenhum registro foi excluído";
                header("Location: ../../Administrativa.php?msg=$msg");
            }else{
                ?>

                <script language="JavaScript"> window.open('../popup.php', '', 'STATUS=NO, TITLEBAR = 1, TOOLBAR=NO, LOCATION=NO, MENUBAR=0, DIRECTORIES=NO, RESIZABLE=NO, SCROLLBARS=0, width=250,height=200,left=' + (screen.width - 250) / 2 + ',top=' + (screen.height - 200) / 2);</script>

                <!--a href="#" onclick="window.open('../popup.php', '', 'STATUS=NO, TITLEBAR = 1, TOOLBAR=NO, LOCATION=NO, MENUBAR=0, DIRECTORIES=NO, RESIZABLE=NO, SCROLLBARS=0, width=250,height=200,left=' + (screen.width - 250) / 2 + ',top=' + (screen.height - 200) / 2);">Clique para abrir a janela POP-up</a>
                <?php
               // header("Location: ../teste.php");
            }

        }else{
            //echo $stmt->error;
            //echo "<p><a href=\"./lista_usuarios.php\">Retornar</a></p>\n";
        }

    }

    public static function setSession($varsession, $valor){
        $_SESSION[$varsession] = $valor;
    }

    public static function getSession($varsession){
        return $_SESSION[$varsession];
    }
}

$adm = new popup();
$stmt = $adm->carregaPopup();
if ($stmt)
    $adm->opemPopup($stmt);
?>
