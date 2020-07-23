<?php

namespace App\Controller;

use App\Document\Classroom;
use App\Form\Type\ClassroomType;
use Doctrine\ODM\MongoDB\DocumentManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ClassroomController extends AbstractController
{
    /**
     * @Route("/admin/classrooms/{page}", name="classrooms")
     */
    public function classroomsList(DocumentManager $dm, $page=0)
    {
        $limit = 10;
        $classrooms = $dm->getRepository(Classroom::class)->getAllClassrooms($page, $limit);
        return $this->render("classrooms/list_classrooms.html.twig", [
            'classrooms' => $classrooms
        ]);
    }

    /**
     * @Route("/admin/classroom/new", name="new_classroom")
     */
    public function newClassroom(DocumentManager $dm, $page = 0, Request $request)
    {
        $classroom = new Classroom();
        $form = $this->createForm(ClassroomType::class, $classroom);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $dm->persist($classroom);
            $dm->flush();
            $this->addFlash('success', 'la salle a été bien ajoutée avec succès !');
            return $this->redirectToRoute('classrooms');
        }

        return $this->render("classrooms/new_classroom.html.twig", [
            'form' => $form->createView()
        ]);
    }
}