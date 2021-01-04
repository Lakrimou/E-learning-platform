<?php

namespace App\Repository;

use App\Document\GlobalSchedule;
use Doctrine\ODM\MongoDB\DocumentManager;
use Doctrine\ODM\MongoDB\Repository\DocumentRepository;

class GlobalScheduleRepository extends DocumentRepository
{
    public function __construct(DocumentManager $dm)
    {
        $uow = $dm->getUnitOfWork();
        $classMetaData = $dm->getClassMetadata(GlobalSchedule::class);
        parent::__construct($dm, $uow, $classMetaData);
    }

    public function getAllGlobalSchedules($page, $limit)
    {
        return $this->createQueryBuilder()->skip($page)->limit($limit)->getQuery()->execute();
    }
}