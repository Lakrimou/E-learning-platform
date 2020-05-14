<?php

namespace App\Controller;

use App\Document\Classe;
use App\Document\Course;
use App\Document\User;
use App\Form\Type\ClasseType;
use App\Form\Type\CourseType;
use Doctrine\ODM\MongoDB\DocumentManager;
use Doctrine\ODM\MongoDB\Repository\DocumentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ClasseController
 */
class ClasseController extends AbstractController
{
    /**
     * @Route("/admin/classes/{page}", name="classes")
     */
    public function classeManagement(DocumentManager $dm, $page=0)
    {
        $limit = 10;
        $classes = $dm->getRepository(Classe::class)->getAllClasses($page, $limit);
        return $this->render("admin/classes.html.twig", [
            'classes' => $classes
        ]);
    }

    /**
     * @Route("/admin/classe/new", name="new_classe")
     */
    public function newClasse(DocumentManager $dm, $page = 0, Request $request)
    {
        $classe = new Classe();
        $form = $this->createForm(ClasseType::class, $classe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $dm->persist($classe);
            $dm->flush();
            $this->addFlash('success', 'la classe a été bien ajoutée avec succès !');
            return $this->redirectToRoute('classes');
        }

        return $this->render("classes/new_classe.html.twig", [
            'form' => $form->createView()
        ]);
    }
}