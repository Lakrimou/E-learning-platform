<?php

namespace App\Repository;

use App\Document\Stream;
use Doctrine\ODM\MongoDB\DocumentManager;
use Doctrine\ODM\MongoDB\Repository\DocumentRepository;

class StreamRepository extends DocumentRepository
{
    public function __construct(DocumentManager $dm)
    {
        $uow = $dm->getUnitOfWork();
        $classMetaData = $dm->getClassMetadata(Stream::class);
        parent::__construct($dm, $uow, $classMetaData);
    }

    public function getAllClasses($page, $limit)
    {
        return $this->createQueryBuilder()->skip($page)->limit($limit)->getQuery()->execute();
    }
}