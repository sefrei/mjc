<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Meeting;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;


/**
 * Meeting controller.
 *
 * @Route("meeting")
 * @Security("has_role('ROLE_ADMIN')")
 */
class MeetingController extends Controller
{
    /**
     * Lists all meeting entities.
     *
     * @Route("/", name="meeting_index")
     * @Method("GET")
     * @Security("has_role('ROLE_ADMIN') or has_role('ROLE_TEACHER')")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $meetings = $em->getRepository('AppBundle:Meeting')->findAll();

        return $this->render('meeting/index.html.twig', array(
            'meetings' => $meetings,
        ));
    }

    /**
     * Lists all next meetings.
     *
     * @Route("/next", name="meeting_next")
     * @Method("GET")
     * @Security("has_role('ROLE_ADMIN') or has_role('ROLE_TEACHER') or has_role('ROLE_STUDENT')")
     */
    public function nextAction()
    {
        $em = $this->getDoctrine()->getManager();
        $meeting = $em->getRepository('AppBundle:Meeting')->showNextMeetings();
        $shownext = "Voir les prochaines réunions";
        $showprevious = "Voir les réunions passées";
        $status = "next";
        $title = "Les prochaines réunions";
        $type = "meeting";

        return $this->render('event/next.html.twig', array(
            'type' => $type,
            'shownext' => $shownext,
            'showprevious' => $showprevious,
            'events' => $meeting,
            'title' => $title,
            'status' => $status,
        ));
    }

    /**
     * Lists all previous event entities.
     *
     * @Route("/previous", name="meeting_previous")
     * @Method("GET")
     * @Security("has_role('ROLE_ADMIN') or has_role('ROLE_TEACHER') or has_role('ROLE_STUDENT')")
     */
    public function previousAction()
    {
        $em = $this->getDoctrine()->getManager();
        $events = $em->getRepository('AppBundle:Meeting')->showPreviousMeetings();
        $title = "Les Réunions passées";
        $status = "previous";
        $shownext = "Voir les prochaines réunions";
        $showprevious = "Voir les réunions passées";
        $type = "meeting";
        
        return $this->render('event/next.html.twig', array(
            'type' => $type,
            'shownext' => $shownext,
            'showprevious' => $showprevious,
            'events' => $events,
            'title' => $title,
            'status' => $status,
        ));
    }
    /**
     * Creates a new meeting entity.
     *
     * @Route("/new", name="meeting_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $meeting = new Meeting();
        $form = $this->createForm('AppBundle\Form\MeetingType', $meeting);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($meeting);
            $em->flush();

            return $this->redirectToRoute('meeting_show', array('id' => $meeting->getId()));
        }

        return $this->render('meeting/new.html.twig', array(
            'meeting' => $meeting,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a meeting entity.
     *
     * @Route("/{id}", name="meeting_show")
     * @Security("has_role('ROLE_TEACHER') or has_role('ROLE_ADMIN')")
     * @Method("GET")
     */
    public function showAction(Meeting $meeting)
    {
        $deleteForm = $this->createDeleteForm($meeting);

        return $this->render('meeting/show.html.twig', array(
            'meeting' => $meeting,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing meeting entity.
     *
     * @Route("/{id}/edit", name="meeting_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Meeting $meeting)
    {
        $deleteForm = $this->createDeleteForm($meeting);
        $editForm = $this->createForm('AppBundle\Form\MeetingType', $meeting);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('meeting_edit', array('id' => $meeting->getId()));
        }

        return $this->render('meeting/edit.html.twig', array(
            'meeting' => $meeting,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a meeting entity.
     *
     * @Route("/{id}", name="meeting_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Meeting $meeting)
    {
        $form = $this->createDeleteForm($meeting);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($meeting);
            $em->flush();
        }

        return $this->redirectToRoute('meeting_index');
    }

    /**
     * Creates a form to delete a meeting entity.
     *
     * @param Meeting $meeting The meeting entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Meeting $meeting)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('meeting_delete', array('id' => $meeting->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
