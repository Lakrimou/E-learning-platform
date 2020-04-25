<?php

namespace App\DataFixtures\MongoDB;

use App\Document\User;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends AppFixtures
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function loadData(ObjectManager $manager)
    {
        $this->createMany(3, 'admin_users', function($i) {
            $user = new User();
            $user->setEmail(sprintf('admin%d@admin.com', $i));
            $user->setFirstName($this->faker->firstName);
            $user->setRoles(['ROLE_ADMIN']);

            $user->setPassword($this->passwordEncoder->encodePassword(
                $user,
                'admin'
            ));

            return $user;
        });

        $this->createMany(12, 'student_users', function($i) {
            $user = new User();
            $user->setEmail(sprintf('student%d@admin.com', $i));
            $user->setFirstName($this->faker->firstName);
            $user->setRoles(['ROLE_STUDENT']);

            $user->setPassword($this->passwordEncoder->encodePassword(
                $user,
                'student'
            ));

            return $user;
        });

        $this->createMany(5, 'teacher_users', function($i) {
            $user = new User();
            $user->setEmail(sprintf('teacher%d@admin.com', $i));
            $user->setFirstName($this->faker->firstName);
            $user->setRoles(['ROLE_TEACHER']);

            $user->setPassword($this->passwordEncoder->encodePassword(
                $user,
                'teacher'
            ));

            return $user;
        });

        $manager->flush();
    }
}