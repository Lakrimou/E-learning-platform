<?php

namespace App\DataFixtures\MongoDB;

use App\Document\Classe;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class ClasseFixtures extends AppFixtures
{
    public function loadData(ObjectManager $manager)
    {
        $this->createMany(3, 'basic_classes', function($i) {
            $classe = new Classe();
            $classe->setName($this->faker->firstName);
            $classe->setClassType("main class");
            $classe->setStudentLimit(10);
            $start = new \DateTime();
            $end = $start->add(new \DateInterval('P10D'));
            $classe->setStartDate($start);
            $classe->setEndDate($end);
            return $classe;
        });

        $manager->flush();
    }
}