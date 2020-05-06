<?php

namespace App\Controller;

use App\Document\Course;
use App\Document\User;
use Doctrine\ODM\MongoDB\DocumentManager;
use Doctrine\ODM\MongoDB\Repository\DocumentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class CourseController
 */
class CourseController extends AbstractController
{
    /**
     * @Route("/admin/courses/{page}", name="courses")
     */
    public function coursesList(DocumentManager $dm, $page=0)
    {
        $limit = 10;
        $courses = $dm->getRepository(Course::class)->getAllClasses($page, $limit);
        return $this->render("courses/list_courses.html.twig", [
            'courses' => $courses
        ]);
    }
}