<?php

namespace Dave\ReactDemo;

class ConnectionPoolConfiguration
{
    private function __construct(
        public readonly string $host,
        public readonly string $database,
        public readonly string $user,
        public readonly string $password,
        public readonly ?int $port = 3306,
        public readonly ?int $connections = 10
    ) { }

    /**
     * @param array $config
     * @return self
     */
    public static function fromArray(array $config): self
    {
        return new self(
            $config['host'],
            $config['database'],
            $config['user'],
            $config['password'],
            $config['port'] ?? null,
            $config['connections'] ?? null
        );
    }

    public function getPdoDsn(): string
    {
        return printf("mysql:%s=;host=%s", $this->database, $this->host);
    }
}
