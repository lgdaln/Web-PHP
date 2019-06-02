<?php
require('../conexaoBanco/Database.php');

class Atendente
{
    /**
     * Estanciando a conexão
     * @var Database $connection
     */
    private $connection;

    /**
     * Iniciando a conexão
     * @return
     */
    public function_construct()
    {
        this->connection = (new Database())->connect();
    }

    /**
     * Listando todos os atendentes
     * @return array
     */
    public function findAll()
    {
        $sql = 'SELECT * FROM atendente';
        $atendente = $this->connection->prepare($sql);
        $atendente->execute();
        return $atendente->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * retornando um atendente especifico.
     * @param int
     * @return object
     */
    public function findOne($pk_matricula)
    {
        $sql = 'SELECT * FROM atendente WHERE pk_matricula = :cod';
        $atendente = $this->connection->prepare($sql);
        $atendente->bindValue(':cod', $pk_matricula, PDO::PARAM_INT);
        $atendente->execute();
        return $atendente->fetch(PDO::FETCH_OBJ);
    }

    /**
     * inserindo um atendente
     * @param array $data
     * @return int
     */
    public function store($data)
    {
        $sql = 'INSERT INTO atendente ( nome, senha )';
        $sql .= 'VALUES ( :nome, :senha)';

        $atendente = $this->connection->prepare($sql);

        $atendente->bindValue(':nome', $data['nome'], PDO:PARAM_STR);
        $atendente->bindValue(':senha', password_hash($data['senha'], PASSWORD_DEFAULT), PDO::PARAM_STR);
        $atendente->execute();
        return $this->connection->lastInsertID();
    }

    /**
     * atualizar atendente
     * @param array $data
     * @return object
     */
    public function update($data)
    {
        $sql = 'UPDATE atendente SET nome = :nome, senha = :senha WHERE pk_matricula = :cod';
        $atendente = $this->connection->prepare($sql);
        $atendente->bindValue(':nome', $data['nome'], PDO::PARAM_STR);
        $atendente->bindValue(':senha', $data['senha'], PDO::PARAM_STR);
        return $atendente->execute();
    }

    public function destroy($pk_matricula)
    {
        $sql = 'DELETE FROM atendente WHERE pk_matricula = :cod';
        $atendente = $this->connection->prepare($sql);
        $atendente->bindValue(':cod', $pk_matricula, PDO::PARAM_INT);
        return $atendente->execute();
    }
    
}
