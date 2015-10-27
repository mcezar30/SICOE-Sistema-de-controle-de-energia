<?php

class Facade{
    private $nome;
    private $cpf;
    private $email;
    private $senha;
    private $confirmar;
    private $tipousuario;
    function __construct(){
        $this->nome = $_POST["nome"];
        $this->cpf = substr($_POST["cpf"], 0, 3).substr($_POST["cpf"], 4, 3).substr($_POST["cpf"], 8, 3).substr($_POST["cpf"], 12, 2);
        $this->email = $_POST["email"];
        $this->senha = $_POST["senha"];
        $this->confirmar = $_POST["confirmar"];
        $this->tipousuario = 2;
    }

    public function abreConexao(){
        $bdhost = "localhost";
        $bdusuario = "root";
        $bdsenha = "";
        $baseDados = "sicoe";
        $conn = new mysqli($bdhost, $bdusuario, $bdsenha, $baseDados);
        $conn->set_charset('utf8');
        if ($conn->connect_error) {
            die("Conex�o ao MySQL falhou: " . $conn->connect_error);
        }else{
            return $conn;
        }
    }

    public function insereUsuario(){
        try{
            $conn = self::abreConexao();

            $sql = "INSERT INTO USUARIO (NOMUSU, CPFUSU, EMAUSU, PASUSU, TIPUSU)
                    VALUES (?, ?, ?, ?, ?)";

            $stmt = $conn->prepare($sql);
            if (!($stmt = $conn->prepare($sql))) {
               echo "Prepare failed: (" . $conn->errno . ") " . $conn->error;
            }

            if (!$stmt->bind_param("sisss", $this->nome, $this->cpf, $this->email, $this->senha, $this->tipousuario)) {
               echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
            }

            if (!$stmt->execute()) {
               echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
            }

            $stmt->close();

            header("Location:../index.php");

        }catch(\Exception $e){

        }
    }

    public static function popupJs($imprime){
        echo"<script type='text/javascript'>";
        echo "alert('O valor passado foi ' + " . $imprime . ")";
        echo "</script>";
    }
}

$usuario = new Facade();
$usuario->insereUsuario();
?>