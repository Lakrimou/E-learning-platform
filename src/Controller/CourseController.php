<?php

namespace App\Controller;

use App\Document\Course;
use App\Document\User;
use App\Form\Type\CourseType;
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

    /**
     * @Route("/admin/course/new", name="new_course")
     */
    public function newCourse(DocumentManager $dm, $page = 0, Request $request)
    {
        $course = new Course();
        $form = $this->createForm(CourseType::class, $course);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $dm->persist($course);
            $dm->flush();
            $this->addFlash('success', 'le cours a été bien ajouté avec succès !');
            return $this->redirectToRoute('courses');
        }

        return $this->render("courses/new_course.html.twig", [
            'form' => $form->createView()
        ]);
    }
}