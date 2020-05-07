<?php

namespace App\Repository;

use App\Document\Grade;
use Doctrine\ODM\MongoDB\DocumentManager;
use Doctrine\ODM\MongoDB\Repository\DocumentRepository;

class GradeRepository extends DocumentRepository
{
    public function __construct(DocumentManager $dm)
    {
        $uow = $dm->getUnitOfWork();
        $classMetaData = $dm->getClassMetadata(Grade::class);
        parent::__construct($dm, $uow, $classMetaData);
    }

    public function getAllGrades($page, $limit)
    {
        return $this->createQueryBuilder()->skip($page)->limit($limit)->getQuery()->execute();
    }
}