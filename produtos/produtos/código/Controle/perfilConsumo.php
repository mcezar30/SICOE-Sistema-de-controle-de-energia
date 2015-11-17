<?php
session_start();
class Estimativa{
    private $email;
    private $produto;
    function __construct(){
        $this->email = 'fkadosh@yahoo.com.br';
        $this->produto = $_SESSION[$this->email];
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

    public function insereEstimativa(){
        try{
            $conn = self::abreConexao();
            foreach($this->produto as $key => $value) {
                list($nome, $qtde, $potencia, $tempo, $codigo, $reducao) = array_values($value);
                $sql = "INSERT INTO ESTIMATIVAPRODUTO(EMAUSU, CODPRO, QTDEPRO, POTPRO, TEMESTPRO, ESTRED)
                    VALUES (?, ?, ?, ?, ?, ?);";

                $stmt = $conn->prepare($sql);
                if (!($stmt = $conn->prepare($sql))) {
                    echo "Prepare failed: (" . $conn->errno . ") " . $conn->error;
                }

                if (!$stmt->bind_param("siiiii", $this->email, $codigo, $qtde, $potencia, $tempo, $reducao)) {
                    echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
                }

                if (!$stmt->execute()) {
                    echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
                }

                $stmt->close();
            }

            header("Location:../perfilConsumo.php");

        }catch(\Exception $e){

        }
    }

    public function excluiEstimativa(){
        try{
            $conn = self::abreConexao();
            $sqlestimativa = "DELETE FROM ESTIMATIVAPRODUTO WHERE EMAUSU = ?";

            $stmtestimativa = $conn->prepare($sqlestimativa);
            if ($sqlestimativa){
                $stmtestimativa->bind_param('i', $this->email);
                $stmtestimativa->execute();
                $stmtestimativa->close();
            }
            else{
                echo "Prepare falhou";
            }

        }catch(\Exception $e){

        }
    }
}

$estimativa = new Estimativa();
$estimativa->excluiEstimativa();
$estimativa->insereEstimativa();
?>