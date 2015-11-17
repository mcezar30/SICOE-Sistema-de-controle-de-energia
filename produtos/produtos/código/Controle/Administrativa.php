<?php

use sicoe_tek\repositorio\Produto;

class Administrativa{
    private $nome;
    private $descricao;
    private $voltagem;
    private $potencia;
    private $standby;
    private $foto;
    function __construct(){
        $this->nome = $_POST["nome"];
        $this->descricao = $_POST["descricao"];
        $this->voltagem = $_POST["voltagem"];
        $this->potencia = $_POST["potencia"];
        $this->standby = $_POST["standby"];
        $this->foto = "img/produto/".$_POST["foto"];
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

    public function insereProduto(){
        try{

            $conn = self::abreConexao();

            $sql = "INSERT INTO PRODUTO (NOMPRO, DESPRO, IMGPRO,  VOLPRO)
                    VALUES (?, ?, ?, ?)";

            $stmt = $conn->prepare($sql);
            if (!($stmt = $conn->prepare($sql))) {
                echo "Prepare failed: (" . $conn->errno . ") " . $conn->error;
            }

            if (!$stmt->bind_param("sssd", $this->nome, $this->descricao, $this->foto, $this->voltagem)) {
                echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
            }

            if (!$stmt->execute()) {
                echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
            }
//--------------------
            $sqlpro = "SELECT MAX(CODPRO) AS CODPRO FROM PRODUTO;";
            $resultpro = $conn->query($sqlpro);
            $codigo = 0;
            while($row = $resultpro->fetch_assoc()){
                $codigo = $row['CODPRO'];
            }
            $sqlgra = "INSERT INTO GRANDEZAPRODUTO (POTPRO, POTSBYPRO, CODPRO)
                    VALUES (?, ?, ?)";

            $stmtgra = $conn->prepare($sqlgra);
            if (!($stmtgra = $conn->prepare($sqlgra))) {
                echo "Prepare failed: (" . $conn->errno . ") " . $conn->error;
            }

            if (!$stmtgra->bind_param("ddi", $this->potencia, $this->standby, $codigo)) {
                echo "Binding parameters failed: (" . $stmtgra->errno . ") " . $stmtgra->error;
            }

            if (!$stmtgra->execute()) {
                echo "Execute failed: (" . $stmtgra->errno . ") " . $stmtgra->error;
            }
            $stmtgra->close();
            $stmt->close();
            header("Location:../Administrativa.php");

        }catch(\Exception $e){

        }
    }


}

$adm = new Administrativa();
$adm->insereProduto();
?>