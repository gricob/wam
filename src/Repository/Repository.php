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
}