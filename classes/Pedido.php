<?php
require('../conexaoBanco/Database.php');

class Pedido
{
    /**
     * Estanciando conexão
     * @var Database $connection
     */
    private $connection

    /**
     * Iniciando uma conexão
     */
    public function__construct()
    {
        $this->connection = (new Database())->connect();        
    }

    /**
     * listando apenas um único pedido
     * @param int
     * @return object
     */
    public function findOne($pk_cod_pedido)
    {
        $sql = 'SELECT * FROM pedido WHERE pk_cod_pedido = :cod';
        $pedido = $this->connection->prepare($sql);
        $pedido->bindValue(':cod_pedido', $pk_cod_pedido, PDO::PARAM_INT);
        $pedido->execute();
        return $pedido->fetch(PDO::FETCH_OBJ);
    }

    /**
     * inserir um novo pedido
     * @param array $data
     * @return int
     */
    public function store($data)
    {
        $sql = 'INSERT INTO pedido (data, hora, statusp, observacao, valorAtual, quantidade)';
        $sql .= 'VALUES (:data, :hora, :statusp, :observacao, :valorAtual, :quantidade)';
        $pedido = $this->connection->prepare($sql);
        $pedido->bindValue(':data', $data['data'], PDO::PARAM_STR);
        $pedido->bindValue(':hora', $data['hora'], PDO::PARAM_STR);
        $pedido->bindValue(':statusp', $data['statusp'], PDO::PARAM_STR);
        $pedido->bindValue(':observacao', $data['observacao'], PDO::PARAM_STR);
        $pedido->bindValue('valorAtual', $data['valorAtual'], PDO::PARAM_STR);
        $pedido->bindValue(':quantidade', $data['quantidade'], PDO::PARAM_STR);
        $pedido->execute();
        return $this->connection->lastInsertId();
    }

    /**
     * atualizando pedido
     * @param array $data
     * @return object
     */
    public function update($data)
    {
        $sql = 'UPDATE pedido SET data = :data, hora = :hora, statusp = :stausp, observacao = :observacao,
                valorAtual = :valorAtual, quantidade = :quantidade
                WHERE pk_cod_pedido = :cod';
        $pedido = $this->connection->prepare($sql);
        $pedido->bindaValue(':data', $data['data'], PDO::PARAM_STR);
        $pedido->bindValue(':hora', $data['hora'], PDO::PARAM_STR);
        $pedido->bindValue(':statusp', $data['statusp'], PDO::PARAM_STR);
        $pedido->bindValue(':observacao', $data['observacao'], PDO::PARAM_STR);
        $pedido->bindValue(':valorAtual', $data['valorAtual'], PDO::PARAM_STR);
        $pedido->bindValue(':quantidade', $data['quantidade'], PDO::PARAM_STR);
        return $pedido->execute();
    }

    public function destroy($pk_cod_pedido)
    {
        $sql = 'DELETE FROM pedido WHERE pk_cod_pedido = :cod';
        $pedido = $this->connection->prepare($sql);
        $pedido->bindValue(':cod', $pk_cod_pedido, PDO::PARAM_INT);
        return $pedido->execute();
    }

}