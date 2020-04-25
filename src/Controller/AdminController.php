<?php

namespace App\Controller;

use App\Document\User;
use Doctrine\ODM\MongoDB\DocumentManager;
use Doctrine\ODM\MongoDB\Repository\DocumentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class AdminController
 * @Route("/admin")
 */
class AdminController extends AbstractController
{
    /**
     * @Route("/dashboard", name="admin_dashboard")
     */
    public function dashboard(Request $request, DocumentManager $dm)
    {
        $user = $this->getUser();
        $usersNumber = count($dm->getRepository(User::class)->findAll());
        //dd($user);
        return $this->render("admin/dashboard.html.twig", [
            'user' => $user,
            'usersNumber' => $usersNumber
        ]);
    }

    /**
     * @Route("/users/{page}", name="admin_users")
     */
    public function userManagement(DocumentManager $dm, $page=0)
    {
        $limit = 10;
        $users = $dm->getRepository(User::class)->getAllUsers($page, $limit);
        return $this->render("admin/users.html.twig", [
            'users' => $users
        ]);
    }
}