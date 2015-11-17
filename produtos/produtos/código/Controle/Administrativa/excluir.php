<?php

use sicoe_tek\repositorio\Produto;

class Facade{
    private $codigo;
    function __construct(){
        $this->codigo = utf8_encode(htmlspecialchars($_GET['CODPRO']));
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

    public function excluirProduto(){
        try{
            $conn = self::abreConexao();
            $sqlgrandeza = "DELETE FROM GRANDEZAPRODUTO WHERE CODPRO = ?";
            $sql = "DELETE FROM PRODUTO WHERE CODPRO = ?";

            $stmtgrandeza = $conn->prepare($sqlgrandeza);
            $stmt = $conn->prepare($sql);
            if ($stmt){
                $stmtgrandeza->bind_param('i', $this->codigo);
                $stmtgrandeza->execute();
                $stmt->bind_param('i', $this->codigo);
                $stmt->execute();
                if(!$stmt->errno){
                    echo "entrou";

                    if ($stmt->affected_rows == 0) {
                        $msg = "Nenhum registro foi excluído";
                        header("Location: ../../Administrativa.php?msg=$msg");
                    }else{
                        header("Location: ../../Administrativa.php");
                    }

                }else{
                    echo $stmt->error;
                    echo "<p><a href=\"./lista_usuarios.php\">Retornar</a></p>\n";
                }

                $stmt->close();
            }
            else{
                echo "Prepare falhou";
            }

        }catch(\Exception $e){

        }
    }

    public static function popupJs($imprime){
        echo"<script type='text/javascript'>";
        echo "alert('O valor passado foi ' + " . $imprime . ")";
        echo "</script>";
    }
}

$adm = new Facade();
$adm->excluirProduto();
?>