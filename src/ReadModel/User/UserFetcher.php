<?php

declare(strict_types=1);

namespace App\ReadModel\User;

use Doctrine\DBAL\Connection;

final class UserFetcher
{
    private Connection $connection;
    
    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }
    
    public function all(): array
    {
        return $this->connection->createQueryBuilder()
            ->select(
                'id',
                'TRIM(CONCAT(first_name, \' \', last_name)) AS name',
            )
            ->from('users')
            ->fetchAllKeyValue();
    }
    
    public function findFullById(int $id): array
    {
        return $this->connection->createQueryBuilder()
            ->select(
                'u.id',
                'u.first_name AS firstName',
                'u.last_name AS lastName',
                'u.phone',
                'o.name AS organization',
                '(SELECT CONCAT(iu.first_name, \' \', iu.last_name)
                    FROM users iu WHERE u.host = iu.id) AS host'
            )
            ->from('users', 'u')
            ->where('u.id = :id')
            ->setParameter('id', $id)
            ->leftJoin('u', 'organizations', 'o', 'u.organization = o.id')
            ->fetchAssociative();
    }
}
