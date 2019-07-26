<?php 

namespace App\Repository;

interface Repository
{
    /**
     * Get all repository resources
     *
     * @return array
     */
    public function all(): array;

    /**
     * Get resources that fit the query
     *
     * @param string $query
     * @return array
     */
    public function find(string $query): array;
}