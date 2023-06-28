<?php

class Empregados{
    private $db;
    private $tabela_db = "empregados";

    public $id;
    public $nome;
    public $email;
    public $setor;
    public $criado;
    public $modificado;
    public $resultado;

    public function __construct($db){
        $this->db = $db;
    }

    public function getEmpregados(){
        $sql = "SELECT * From ".$this->tabela_db. " ";
        $this->resultado = $this->db->query($sql);
        return $this->resultado;
    }


    public function getUmEmpregado(){

        $sql = "SELECT * FROM ".$this->tabela_db." WHERE id = ".$this->id;
        $consulta_empregado = $this->db->query($sql);
        $data = $consulta_empregado->fetch_assoc();
        $this->nome = $data['nome'];
        $this->email = $data['email'];
        $this->setor = $data['setor'];
        $this->criado = $data['criado'];
        $this->modificado = $data['modificado'];

    }

    public function createEmpregados(){
        $this->nome=htmlspecialchars(strip_tags($this->nome));
        $this->setor=htmlspecialchars(strip_tags($this->setor));
        $this->email=htmlspecialchars(strip_tags($this->email));
        $this->criado=htmlspecialchars(strip_tags($this->criado));

        $sql = "INSERT INTO ". $this->tabela_db ." SET nome = '".$this->nome."',  email = '".$this->email."', setor = '".$this->setor."',criado = '".$this->criado."'";
        $this->db->query($sql);
        // echo $sql;
        if($this->db->affected_rows > 0){
            return true;
        }else{
            return false;
        }

    }

    public function updateEmpregados()
    {
        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->nome = htmlspecialchars(strip_tags($this->nome));
        $this->setor = htmlspecialchars(strip_tags($this->setor));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->criado = htmlspecialchars(strip_tags($this->criado));
        $this->modificado = htmlspecialchars(strip_tags($this->modificado));

        $sql = "UPDATE " . $this->tabela_db . " SET nome = '" . $this->nome . "', email = '" . $this->email . "', setor = '" . $this->setor . "', modificado = '" . $this->modificado . "'  WHERE id = " . $this->id;

        $this->db->query($sql);

        if ($this->db->affected_rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    //FUTURA IMPLEMENTAÇÃO PARA O METODO PATCH
/*    public function updateParcialEmpregados()
    {
        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->nome = htmlspecialchars(strip_tags($this->nome));
        $this->setor = htmlspecialchars(strip_tags($this->setor));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->criado = htmlspecialchars(strip_tags($this->criado));
        $this->modificado = htmlspecialchars(strip_tags($this->modificado));


        $sql = "UPDATE " . $this->tabela_db . " SET nome = '" . $this->nome . "', email = '" . $this->email . "', setor = '" . $this->setor . "', modificado = '" . $this->modificado . "'  WHERE id = " . $this->id;

        $this->db->query($sql);

        if ($this->db->affected_rows > 0) {
            return true;
        } else {
            return false;
        }
    }*/

        function deleteEmpregado(){
            $sql = "DELETE FROM ". $this->tabela_db . " WHERE id = ".$this->id;
            $this->db->query($sql);

            if ($this->db->affected_rows > 0){
                return true;
            }else{
                return false;
            }
        }
}