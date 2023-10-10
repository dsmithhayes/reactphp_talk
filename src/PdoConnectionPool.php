<?php

namespace Dave\ReactDemo;

use Dave\ReactDemo\Api\ConnectionPool;
use Exception;
use PDO;

class PdoConnectionPool implements ConnectionPool
{
    private ConnectionPoolConfiguration $config;
    private array $connections;

    public function __construct(ConnectionPoolConfiguration $config)
    {
        $this->config = $config;

        for ($i = 0; $i < $this->config->connections; $i++) {
            $this->connections[$i] = new PDO(
                $this->config->getPdoDsn(),
                $this->config->user,
                $this->config->password
            );
        }
    }

    /**
     * @return mixed
     * @throws Exception
     */
    public function getConnection(): mixed
    {
        $connection = array_pop($this->connections);

        if (!$connection) {
            throw new Exception("No available connections");
        }

        return $connection;
    }

    /**
     * Send the Connection _back_ to the Pool
     *
     * @param $connection
     * @return void
     */
    public function releaseConnection($connection): void
    {
        array_push($this->connections, $connection);
    }
}
