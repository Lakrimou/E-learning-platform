<?php

namespace App\DataFixtures\MongoDB;

use App\Document\Grade;
use App\Document\Stream;
use App\Document\User;
use Doctrine\Common\Persistence\ObjectManager;

class StreamFixtures extends AppFixtures
{
    public function loadData(ObjectManager $manager)
    {
        $this->createMany(5, 'basic_streams', function($i) use ($manager) {
            $stream = new Stream();
            $stream->setName($this->faker->firstName);
            $stream->setDescription($this->faker->firstName .' '.$this->faker->lastName);
            $user = $manager->find(User::class, 1);
            $stream->setSupervisor($user);
            $stream->setEnabled(true);
            return $stream;
        });

        $manager->flush();
    }
}