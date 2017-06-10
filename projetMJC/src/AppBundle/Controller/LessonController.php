<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Lesson;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Lesson controller.
 *
 * @Route("lesson")
 */
class LessonController extends Controller
{
    /**
     * Lists all lesson entities.
     *
     * @Route("/", name="lesson_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $lessons = $em->getRepository('AppBundle:Lesson')->findAll();

        return $this->render('lesson/index.html.twig', array(
            'lessons' => $lessons,
        ));
    }

    /**
     * Creates a new lesson entity.
     *
     * @Route("/new", name="lesson_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $lesson = new Lesson();
        $form = $this->createForm('AppBundle\Form\LessonType', $lesson);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($lesson);
            $em->flush();

            return $this->redirectToRoute('lesson_show', array('id' => $lesson->getId()));
        }

        return $this->render('lesson/new.html.twig', array(
            'lesson' => $lesson,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a lesson entity.
     *
     * @Route("/{id}", name="lesson_show")
     * @Method("GET")
     */
    public function showAction(Lesson $lesson)
    {
        $deleteForm = $this->createDeleteForm($lesson);

        return $this->render('lesson/show.html.twig', array(
            'lesson' => $lesson,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing lesson entity.
     *
     * @Route("/{id}/edit", name="lesson_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Lesson $lesson)
    {
        $deleteForm = $this->createDeleteForm($lesson);
        $editForm = $this->createForm('AppBundle\Form\LessonType', $lesson);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('lesson_edit', array('id' => $lesson->getId()));
        }
    }

    /**
     * Update the presence of one teacher one student for one lesson.
     *
     * @Route("/{id}/presence/edit", name="lesson_presence_edit")
     * @Method({"GET", "POST"})
     */
    public function presenceEditAction(Request $request, Lesson $lesson)
    {
        //Je récupère la requete et ses attributs
        $message = "";
        $typeUser = $request->get('type_user');
        $presence = $request->get('presence');
        $presenceBoolean = $presence === 'true' ? true : false;
        //Si la requête concerne le teacher
        if ($typeUser == "ROLE_TEACHER") {
            //Je récupère l'état de $teacherIsPresent actuel (facultatif);
            // $lesson->getTeacherIsPresent();
            //     dump($typeUser);
            //
            //     dump($presence);
            // dump($presenceBoolean);
            //     dump($lesson);

                $em = $this->getDoctrine()->getManager();

            //Je modifie $teacherIsPresent
            $lesson->setTeacherIsPresent($presenceBoolean);
            // J'enregistre dans la base
            $em->persist($lesson);
            $em->flush();
            $message ="modification effectuée";
        }
        elseif ($typeUser == "ROLE_STUDENT") {
            $em = $this->getDoctrine()->getManager();

        //Je modifie $teacherIsPresent
        $lesson->setStudentIsPresent($presenceBoolean);
        $em->persist($lesson);
        $em->flush();
        $message ="modification effectuée";
            // dump($typeUser);
            //
            // dump($presence);
            // dump($presenceBoolean);
            // dump($lesson);
            // exit;
        }
        else {
            $message ="Erreur lors de la modification";
 }
        return $this->render('default/presence.html.twig', [
    'message' => 'modification effectuée',
    'lesson' => $lesson
]);

}


    /**
     * Update an observation for one lesson.
     *
     * @Route("/{id}/observation/edit", name="lesson_observation_edit")
     * @Method({"GET", "POST"})
     */
    public function observationEditAction(Request $request, Lesson $lesson)
    {
        //Je récupère la requete et ses attributs
        $observation = $request->get('appreciation');
        $em = $this->getDoctrine()->getManager();

        //Je modifie l'observation
        $lesson->setAppreciation($observation);
        // J'enregistre dans la base
        $em->persist($lesson);
        $em->flush();


        return $this->render('default/presence.html.twig', [
        'message' => 'modification de l\'observation effectuée',
        'lesson' => $lesson
        ]);
}

    /**
     * Deletes a lesson entity.
     *
     * @Route("/{id}", name="lesson_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Lesson $lesson)
    {
        $form = $this->createDeleteForm($lesson);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($lesson);
            $em->flush();
        }

        return $this->redirectToRoute('lesson_index');
    }

    /**
     * Creates a form to delete a lesson entity.
     *
     * @param Lesson $lesson The lesson entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Lesson $lesson)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('lesson_delete', array('id' => $lesson->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }


}
