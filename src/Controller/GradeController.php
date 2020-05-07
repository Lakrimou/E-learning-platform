<?php

namespace App\Controller;

use App\Document\Grade;
use App\Document\User;
use App\Form\Type\GradeType;
use Doctrine\ODM\MongoDB\DocumentManager;
use Doctrine\ODM\MongoDB\Repository\DocumentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class GradeController
 */
class GradeController extends AbstractController
{
    /**
     * @Route("/admin/grades/{page}", name="grades")
     */
    public function listGrades(DocumentManager $dm, $page = 0)
    {
        $limit = 10;
        $grades = $dm->getRepository(Grade::class)->getAllGrades($page, $limit);
        return $this->render("grades/list_grades.html.twig", [
            'grades' => $grades
        ]);
    }

    /**
     * @Route("/admin/grade/new", name="new_grade")
     */
    public function newGrade(DocumentManager $dm, $page = 0, Request $request)
    {
        $grade = new Grade();
        $form = $this->createForm(GradeType::class, $grade);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $grade = $form->getData();
            $dm->persist($grade);
            $dm->flush();
            $this->addFlash('info', 'le grade a été bien ajouté avec succès !');
            return $this->redirectToRoute('grades');
        }

        return $this->render("grades/new_grade.html.twig", [
            'form' => $form->createView()
        ]);
    }
}