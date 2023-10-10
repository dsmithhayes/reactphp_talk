<?php

namespace Dave\ReactDemo\Api;

interface ConnectionPool
{
    public function getConnection(): mixed;
    public function releaseConnection($connection);
}
