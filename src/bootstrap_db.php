<?php

$con = new PDO(
    'mysql:dbname=somedatabase;host=127.0.0.1',
    'someuser',
    'Password1!'
);

$create_table = 'CREATE TABLE IF NOT EXISTS test_table (
    `str`   VARCHAR(255),
    `num`   int
);';

$con->exec($create_table);
