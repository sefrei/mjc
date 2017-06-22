<?php

namespace AppBundle\Controller;
use AppBundle\Entity\Notification;
use AppBundle\Entity\Reading_notification;
use AppBundle\Entity\Lesson;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

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
            /**
            * Instanciation de mes variables
            */
            $userId = $this->getUser()->getId();
            // Je crée une notification d'absence
            $specification = 'absence';
            $entityType = "lesson";
            $lessonId = $lesson->getId();
            $entityTypeId = $lessonId;
            //Je récupère la requete et ses attributs
            $message = "";
            $typeUser = $request->get('type_user');
            $presence = $request->get('presence');
            $presenceBoolean = $presence === 'true' ? true : false;
            // Je récupère la subscription pour les Users
            $teacher = $lesson->getSubscription()->getTeacher();
            $student = $lesson->getSubscription()->getStudent();
            dump($entityType);
            dump($entityTypeId);
            dump($specification);
            dump($userId);

            // Si il y a déjà une notification pour la lesson avec spécification absence,
            // je ne change que le message

            $em = $this->getDoctrine()->getManager();

            // Test pour voir si une notif existe déjà
            $oldNotification =  $em->getRepository('AppBundle:Notification')->findNotificationByEntityTypeIdAndSpecification($entityType, $entityTypeId, $specification, $userId);
            // Si une notif existe déjà
            if ($oldNotification == true) {
                //Je récupère cette notif et change la date et le message
                // $old = $oldNotification[0]->getCreatedAt();
                // dump($old);
                // exit;
                $oldNotification[0]->setCreatedAt(new \DateTime);

                $em->persist($oldNotification[0]);
                $messageExist="ça existe";
            }else {
                //Autrement, je crée une nouvelle notification
                $messageExist="ça n'existe pas";
                $notification = new Notification();

                $notification->setEntityType($entityType);
                // Je prends l'id de la Lesson
                $notification->setIdEntityType($lessonId);
                // Message
                // $notification->setMessage($messageNotif);
                // Date de création de la notif : current date
                $notification->setCreatedAt(new \DateTime());
                // Je note le type de la notif, ici lesson
                $notification->setSpecification($specification);
                $readingNotification = new Reading_notification();
                $readingNotification->setIsRead(false);
                $readingNotification->setNotification($notification);
                $readingNotification->setIdNotifiedUser($teacher);
                $readingNotification->setIdNotifiedUser($student);
                // Je rajoute le reading_notification
                $notification->addReadingNotification($readingNotification);

            }


            //Si la requête concerne le teacher
            if ($typeUser == "ROLE_TEACHER") {
                //Je récupère l'id du prof et le nomme en instigateur de la notif
                $user = $teacher;
                // Je crée le message de notification en fonction de la présence du prof
                if ($presenceBoolean == false) {
                    $messageNotif = "Prof absent";
                }else{
                    $messageNotif = "Prof présent";
                }
                if ($oldNotification == false) {
                    $notification->setMessage($messageNotif);
                    $notification->setUserId($user);
                    $em->persist($notification);
                } elseif ($oldNotification == true) {
                    $oldNotification[0]->setMessage($messageNotif);
                    $em->persist($oldNotification[0]);
                }

                    // $em = $this->getDoctrine()->getManager();
                //Je modifie $teacherIsPresent
                $lesson->setTeacherIsPresent($presenceBoolean);
                // Je récupère l'id de celui qui crée la notif

                // J'enregistre dans la base

                $em->persist($lesson);
                $em->flush();
                $message ="modification effectuée";
            }
            elseif ($typeUser == "ROLE_STUDENT") {
                //Je récupère l'id de l'élève et le nomme en instigateur de la notif
                $user = $student;
            // Je crée le message de notification en fonction de la présence de l'élève
            if ($presenceBoolean == false) {
                $messageNotif = "Elève absent";
            }else{
                $messageNotif = "Elève présent";
            }
            if ($oldNotification == false) {
                $notification->setMessage($messageNotif);
                $notification->setUserId($user);
                $em->persist($notification);
            } elseif ($oldNotification == true) {
                $oldNotification[0]->setMessage($messageNotif);
                $em->persist($oldNotification[0]);
            }

            // $em = $this->getDoctrine()->getManager();
            //Je modifie $teacherIsPresent
            $lesson->setStudentIsPresent($presenceBoolean);
            // Je récupère l'id de celui qui crée la notif
            $notification->setUserId($user);
            // $em->persist($notification);
            $em->persist($lesson);
            $em->flush();
            $message ="modification effectuée";

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
