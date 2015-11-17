<?php
session_start();
class Sessao{
    private $nome;
    private $email;
    private $potencia;
    private $tempo;
    private $qtde;
    private $codpro;
    private $reducao;

    function __construct(){
        $this->nome = utf8_encode(htmlspecialchars($_GET['NOMPRO']));
        $this->qtde = $_POST["QTDE"];
        $this->potencia = $_POST["POT"];
        $this->tempo = $_POST["TEMPO"];
        $this->reducao = $_POST["ECO"];
        $this->email = $_SESSION["USUARIOLOGADO"];
        $this->codpro = utf8_encode(htmlspecialchars($_GET['CODPRO']));
    }

    public function setProdutoEstimado(){
        $sessao = array(
            "NOME" => $this->nome,
            "QTDE" => $this->qtde,
            "POTENCIA" => $this->potencia,
            "TEMPO" => $this->tempo,
            "CODIGO" => $this->codpro,
            "REDUCAO" => $this->reducao
        );
        $_SESSION[$this->email][$this->nome] = $sessao;
    }

    public function calculaTempo(){
        $tempo = explode(":", $this->tempo);
        $horas = $tempo[0];
        $minutos = $tempo[1];
        $totalminutos = $minutos + ($horas * 60);
        $this->tempo = $totalminutos;
    }

}
$sessao = new Sessao();
$sessao->calculaTempo();
$sessao->setProdutoEstimado();
header("Location:../perfilConsumo.php");



?>