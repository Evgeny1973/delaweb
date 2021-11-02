<?php

declare(strict_types=1);

namespace App\ReadModel\Organization;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Exception;

final class OrganizationFetcher
{
    private Connection $connection;
    
    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }
    
    /**
     * @throws Exception
     * @return array
     */
    public function all(): array
    {
        return $this->connection->createQueryBuilder()
            ->select('id', 'name')
            ->from('organizations')
            ->fetchAllKeyValue();
    }
}
