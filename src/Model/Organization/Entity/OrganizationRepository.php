<?php

declare(strict_types=1);

namespace App\Model\Organization\Entity;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityNotFoundException;
use Doctrine\ORM\EntityRepository;

final class OrganizationRepository
{
    private EntityRepository $repo;
    private EntityManagerInterface $em;
    
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
        $this->repo = $em->getRepository(Organization::class);
    }
    
    public function get(int $id): Organization
    {
        if (!$organization = $this->repo->find($id)){
            throw new EntityNotFoundException('Organization not found');
        }
        
        return $organization;
    }
    
    public function add(Organization $organization): void
    {
        $this->em->persist($organization);
    }
    
    /**
     * @param string $name
     *
     * @return Organization|null
     */
    public function findByName(string $name): ?Organization
    {
        return $this->repo->findOneBy(['name' => $name]);
    }
}
