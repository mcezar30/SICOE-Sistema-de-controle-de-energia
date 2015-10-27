<?php

use sicoe_tek\repositorio\Produto;

class Facade{
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
       // $this->foto = $_POST["foto"];
    }
   /* public function insereProduto(){
        try{
          //  Produto::insereProduto($this->nome, $this->descricao, $this->voltagem,
           //     $this->potencia, $this->standby, $this->foto);
           // require_once("conexaoBD.php");
           // die();
            $bdhost = "localhost";
            $bdusuario = "root";
            $bdsenha = "";
            $baseDados = "sicoe";

            // Cria a conexão
            //mySQLi, ORIENTADA A OBJETOS
            $conn = new mysqli($bdhost, $bdusuario, $bdsenha, $baseDados);
            $conn->set_charset('utf8');
            // Verifica conexão
            if ($conn->connect_error) {
                die("Conexão ao MySQL falhou: " . $conn->connect_error);
            }

            $sql = "INSERT INTO PRODUTO (NOMPRO, DESPRO, POTPRO, POTSBYPRO, VOLPRO)
                    VALUES (?, ?, ?, ?, ?)";

            $stmt = $conn->prepare($sql);
            echo $stmt;
            if ($stmt) {
                $stmt->bind_param('ssddd', $this->nome, $this->descricao, $this->potencia, $this->standby, $this->voltagem);
                $stmt->execute();
                $conn->close();
            }

        }catch(\Exception $e){

        }
    }*/
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
            //  Produto::insereProduto($this->nome, $this->descricao, $this->voltagem,
            //     $this->potencia, $this->standby, $this->foto);
             /*require_once("../conexaoBD.php");
             die();*/
            $conn = self::abreConexao();

            $sql = "INSERT INTO PRODUTO (NOMPRO, DESPRO, POTPRO, POTSBYPRO, VOLPRO)
                    VALUES (?, ?, ?, ?, ?)";

            $stmt = $conn->prepare($sql);
            if (!($stmt = $conn->prepare($sql))) {
                echo "Prepare failed: (" . $conn->errno . ") " . $conn->error;
            }

            if (!$stmt->bind_param("ssddd", $this->nome, $this->descricao, $this->potencia, $this->standby, $this->voltagem)) {
                echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
            }

            if (!$stmt->execute()) {
                echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
            }

            $stmt->close();
            header("Location:../Administrativa.php");

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
$adm->insereProduto();
?>