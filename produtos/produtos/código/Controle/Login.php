<?php
session_start();
class Login{
    private $nome;
    private $cpf;
    private $email;
    private $senha;
    private $confirmar;
    private $tipousuario;
    function __construct(){
        $this->email = $_POST["email"];
        $this->senha = $_POST["senha"];
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

    public function validaUsuario(){
        try{
            $conn = self::abreConexao();
            $sql = "SELECT EMAUSU, PASUSU, TIPUSU  FROM USUARIO WHERE EMAUSU = ?";
            $stmt = $conn->prepare($sql);
            if ($stmt){

                $username = $this->email;

                $stmt->bind_param('s', $username);

                $stmt->execute();

                $result = $stmt->get_result();

                $linha = $result->fetch_assoc();

                if ($linha){
                    if ($this->senha == $linha['PASUSU']){
                        $_SESSION["USUARIOLOGADO"] = $linha['EMAUSU'];
                        header("Location:../index.php");
                    }
                    else {
                        $msg = "Nome de usuário ou senha incorretos.";
                        self::popupJs($msg);
                        header("Location:../login.php");
                    }
                }
                else {
                    $msg = "Esse usuário não está cadastrado";
                    self::popupJs($msg);
                    header("Location:../login.php");
                }
                $stmt->close();
            }

        }catch(\Exception $e){

        }
    }
    public static function popupJs($imprime){
        echo"<script type='text/javascript'>";
        echo "alert(" . $imprime . ")";
        echo "</script>";
    }

}
$usuario = new Login();
$usuario->validaUsuario();
?>