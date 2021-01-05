<?php

namespace App\Controller;

use App\Document\Schedule;
use App\Document\GlobalSchedule;
use App\Form\Type\GlobalScheduleType;
use Doctrine\ODM\MongoDB\DocumentManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GlobalScheduleController extends AbstractController
{
    /**
     * @param DocumentManager $dm
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route('/admin/global-schedule-list', name="global_schedule_list")
     */
    public function index(DocumentManager $dm, $pages = 0)
    {
        $limit = 10;
        $globalSchedules = $dm->getRepository(GlobalSchedule::class)->getAllGlobalSchedules($page, $limit);

        return $this->render('global_schedule/index.html.twig', ['globalSchedules' => $globalSchedules]);
    }

    /**
     * @param GlobalSchedule $globalSchedule
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route('admin/global-schedule-show', name='global_schedule_show')
     */
    public function show(GlobalSchedule $globalSchedule)
    {
        return $this->render('global_schedule/show.html.twig', ['globalSchedule' => $globalSchedule]);
    }

    /**
     * @param DocumentManager $dm
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Doctrine\ODM\MongoDB\MongoDBException
     * @Route('/admin/new-global-schedule', name='new_global_schedule')
     */
    public function new(DocumentManager $dm, Request $request)
    {
        $globalSchedule = new GlobalSchedule();
        $form = $this->createForm(GlobalScheduleType::class, $globalSchedule);
        $form->handleRequest($request);

        if ($form->isValid() && $form->isSubmitted()) {
            $dm->persist($globalSchedule);
            $dm->flush();
        }

        return $this->render('global_schedule/new.html.twig', ['form'=>$form->createView()]);
    }

    /**
     * @param DocumentManager $dm
     * @param Request $request
     * @param GlobalSchedule $globalSchedule
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Doctrine\ODM\MongoDB\MongoDBException
     * @Route('/admin/{id}/global-schedule-edit', name='global_schedule_edit')
     */
    public function edit(DocumentManager $dm, Request $request, GlobalSchedule $globalSchedule)
    {
        $editForm = $this->createForm(GlobalScheduleType::class, $globalSchedule);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $dm->flush();
            $this->addFlash('success', 'Schedule updated successfully !');
        }

        return $this->render('global_schedule/edit.html.twig', ['editForm' => $editForm->createView()]);
    }

    /**
     * Deletes a global schedule document.
     * @param Request $request
     * @param GlobalSchedule $globalSchedule
     * @return Response
     * @Route('/admin/{id}/global-schedule-delete', name='global_schedule_delete')
     */
    public function deleteAction(Request $request, GlobalSchedule $globalSchedule)
    {
        $form = $this->createDeleteForm($globalSchedule);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($globalSchedule);
            $em->flush();
        }

        return $this->redirectToRoute('global_schedule_list');
    }

    /**
     * Creates a form to delete a schedule document.
     *
     * @param GlobalSchedule $globalSchedule The schedule document
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(GlobalSchedule $globalSchedule)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('global_schedule_delete', array('id' => $globalSchedule->getId())))
            ->setMethod('DELETE')
            ->getForm()
            ;
    }
}