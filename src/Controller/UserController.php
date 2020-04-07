<?php

namespace App\Controller;

use App\Document\Userss;
use Doctrine\ODM\MongoDB\DocumentManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    /**
     * @Route("/register", name="registration")
     */
    public function register(DocumentManager $dm)
    {
        $user = new Userss();
        $user->setName('MOhamed');
        $user->setEmail('akrem.boussaha@gmail.com');
        $user->setPassword(sha1('akrem'));
        $dm->persist($user);
        $dm->flush();
        return new JsonResponse(array('success' => true));
    }

    /**
     * @Route("/list", name="user_list")
     */
    public function getUsers(DocumentManager $dm)
    {
        $users = $dm->getRepository(Userss::class)->findAll();
        dump($users);
        die;
    }
}