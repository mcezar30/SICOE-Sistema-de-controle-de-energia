<?php

namespace sicoe_tek\repositorio;

class Produto{

    public static function insereProduto($nome, $descricao, $voltagem,
                $potencia, $standby, $foto){
        try {
            require_once("conexaoBD.php");
            die();
            $sql = "INSERT INTO PRODUTO (NOMPRO, DESPRO, POTPRO, POTSBYPRO, VOLPRO)
                    VALUES (?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            if ($stmt) {
                $stmt->bind_param('ssddd', $nome, $descricao, $potencia, $standby, $voltagem);
                $stmt->execute();
                $conn->close();
            }
        } catch (\Exception $e) {
            throw $e;
        }
    }

}

?>
