<?php

namespace App\DataFixtures\MongoDB;

use App\Document\Grade;
use App\Document\Stream;
use App\Document\User;
use Doctrine\Common\Persistence\ObjectManager;

class GradeFixtures extends AppFixtures
{
    public function loadData(ObjectManager $manager)
    {
        $this->createMany(8, 'basic_grades', function($i) use ($manager) {
            $grade = new Grade();
            $grade->setName($i.' année');
            $grade->setDescription($this->faker->firstName .' '.$this->faker->lastName);
            $start = new \DateTime();
            $end = $start->add(new \DateInterval('P10D'));
            $grade->setStartDate($start);
            $grade->setEndDate($end);
            $grade->setLanguage('Français');
            $stream = $manager->find(Stream::class, 1);
            $grade->addStream($stream);
            $grade->setEnabled(true);
            return $grade;
        });

        $manager->flush();
    }
}