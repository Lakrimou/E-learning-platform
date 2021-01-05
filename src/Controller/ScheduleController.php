<?php

namespace App\Controller;

use App\Document\Schedule;
use App\Form\Type\ScheduleType;
use Doctrine\ODM\MongoDB\DocumentManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ScheduleController extends AbstractController
{
    /**
     * @param DocumentManager $dm
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route('/admin/schedule-list', name="schedule_list")
     */
    public function index(DocumentManager $dm, $pages = 0)
    {
        $limit = 10;
        $schedules = $dm->getRepository(Schedule::class)->getAllSchedules($page, $limit);

        return $this->render('schedule/index.html.twig', ['schedules' => $schedules]);
    }

    /**
     * @param Schedule $schedule
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route('admin/schedule-show', name='schedule_show')
     */
    public function show(Schedule $schedule)
    {
        return $this->render('schedule/show.html.twig', ['schedule' => $schedule]);
    }

    /**
     * @param DocumentManager $dm
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Doctrine\ODM\MongoDB\MongoDBException
     * @Route('/admin/new-schedule', name='new_schedule')
     */
    public function new(DocumentManager $dm, Request $request)
    {
        $schedule = new Schedule();
        $form = $this->createForm(ScheduleType::class, $schedule);
        $form->handleRequest($request);

        if ($form->isValid() && $form->isSubmitted()) {
            $dm->persist($schedule);
            $dm->flush();
        }

        return $this->render('schedule/new.html.twig', ['form'=>$form->createView()]);
    }

    /**
     * @param DocumentManager $dm
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Doctrine\ODM\MongoDB\MongoDBException
     * @Route('/admin/{id}/schedule-edit', name='schedule_edit')
     */
    public function edit(DocumentManager $dm, Request $request, $schedule)
    {
        $editForm = $this->createForm(ScheduleType::class, $schedule);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $dm->flush();
            $this->addFlash('success', 'Schedule updated successfully !');
        }

        return $this->render('schedule/edit.html.twig', ['editForm' => $editForm->createView()]);
    }

    /**
     * Deletes a schedule document.
     * @param Request $request
     * @param Schedule $schedule
     * @return Response
     * @Route('/admin/{id}/schedule-delete', name='schedule_delete')
     */
    public function deleteAction(Request $request, Schedule $schedule)
    {
        $form = $this->createDeleteForm($schedule);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($schedule);
            $em->flush();
        }

        return $this->redirectToRoute('schedule_list');
    }

    /**
     * Creates a form to delete a schedule document.
     *
     * @param Schedule $schedule The schedule document
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Schedule $schedule)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('schedule_delete', array('id' => $schedule->getId())))
            ->setMethod('DELETE')
            ->getForm()
            ;
    }
}