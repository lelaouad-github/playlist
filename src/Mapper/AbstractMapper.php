<?php

namespace App\Mapper;

use Doctrine\DBAL\Connection;

abstract class AbstractMapper
{
    /**
     * @var Connection
     */
    protected $connection;

    protected $entityClass;

    protected $table;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function find(string $uuid)
    {
        $qb = $this->connection->createQueryBuilder();

        $qb
            ->select('*')
            ->from($this->table)
            ->where('uuid = :uuid')
            ->setParameter('uuid', $uuid);

        $stm =  $qb->execute();

        $data = $stm->fetch(\PDO::FETCH_ASSOC);

        return $data ? $this->createEntity($data) : null;
    }

    public function findAll()
    {
        $qb = $this->connection->createQueryBuilder();

        $qb
            ->select('*')
            ->from($this->table)
        ;

        $stm =  $qb->execute();

        return array_map(function (array $row) {
            return $this->createEntity($row);
        }, $stm->fetchAll(\PDO::FETCH_ASSOC));
    }

    public function insert(array $data)
    {
        ['uuid' => $uuid] = $data;

        $data = array_intersect_key($data, (new $this->entityClass)->toArray());

        $this->connection->insert($this->table, $data + ['uuid' => $uuid]);
    }

    public function update(array $data)
    {
        ['uuid' => $uuid] = $data;

        $data = array_intersect_key($data, (new $this->entityClass)->toArray());

        unset($data['id']);

        return (bool)$this->connection->update($this->table, $data, ['uuid' => $uuid]);
    }

    public function delete(string $uuid)
    {
        return (bool)$this->connection->delete($this->table, ['uuid' => $uuid]);
    }

    abstract protected function createEntity(array $data);


}