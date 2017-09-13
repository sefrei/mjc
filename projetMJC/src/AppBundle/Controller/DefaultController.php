<?php

namespace AppBundle\Controller;
use Symfony\Component\HttpFoundation\ParameterBag;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use AppBundle\Entity\Subscription;
use AppBundle\Entity\Lesson;
use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Component\HttpFoundation\RequestStack;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
         ]);
    }

    /**
    * Pour prof ou eleve, montre toutes les leçons qu'il a pour une date donnée
    * @Route("planning/{date}", name="planning_date")
    */
    public function userDateAction(Request $request)
    {
        $dateRequest = $request->get('date');
        $id = $this->getUser()->getId();

        $date = new \DateTime($dateRequest);
        $em = $this->getDoctrine()->getManager();
        $lessons = $em->getRepository('AppBundle:Lesson')->getLessonsFromDateAndId($date, $id);

        return $this->render('default/planning.json.twig', [
            'lessons' => $lessons,
        ],
        new JsonResponse()
          );
    }

    /**
    * Pour l'administrateur, montre toutes les lessons d'une journée
    * @Route("/date/{date}", name="date")
    */
    public function dateAction(Request $request)
    {
        $dateRequest = $request->get('date');

        $date = new \DateTime($dateRequest);
        $em = $this->getDoctrine()->getManager();
        $lessons = $em->getRepository('AppBundle:Lesson')->getLessonsFromDate($date);

        return $this->render('default/date.json.twig', [
            'lessons' => $lessons,
        ],
        new JsonResponse()
          );
    }


    /**
    * @Route("/next", name="next")
    */
    public function nextAction()
    {
       $em = $this->getDoctrine()->getManager();
       $id = $this->getUser()->getId();
       $result = $em->getRepository('AppBundle:Lesson')->lessonsNowAfter($id);

       return $this->render('default/next.json.twig', [
           'result' => $result,
       ],
       new JsonResponse()
         );
    }

    /**
    * @Route("notifications", name="notifications")
    **/
    public function notificationsAction(){
        $em = $this->getDoctrine()->getManager();
        $id = $this->getUser()->getId();
        $result = $em->getRepository('AppBundle:Notification')->findAllNotificationsForOneUser2($id);
    //     print_r($result);s
    //     for ($ligne=0 ; $ligne < ; $ligne++) {
    //     $n = $ligne +1
    //     echo "Enregistrement N°". $n ."<br>"
    // }
    // for ($col=0; $col < ; $col++) {
    //     echo $result[$ligne][$col];
    // }
// foreach ($result as $number =>$key) {
//     echo $number['entityType'];
//     // echo $number['entityType'];
//     // $this->$result[$entityType]->name();
//     // foreach ($number as $subkey =>$value) {
//     //     echo $subkey['entityType'];
//     // }
// }
    dump($result);
        exit;

        return $this->render('default/notifications.json.twig', [
            'result' => $result,
            // 'type' => $type,
        ],
        new JsonResponse()
          );
    }


    /**
     * @Route("/activity/{id}", name="activity")
     */
    public function showActivityAction(Request $request, Lesson $lesson)
    {
       return $this->redirectToRoute('homepage');
    }

    /**
     * Finds and displays a subscription entity.
     *
     * @Route("/test", name="test")
     * @Method("GET")
     */
    public function testAction()
    {
        $em = $this->getDoctrine()->getManager();
        $subscriptions = $em->getRepository('AppBundle:Subscription')->showAllAction();

        return $this->render('default/test.html.twig', [
            'inscriptions' => $subscriptions,
        ]);
    }

    /**
     * @Route("/test/lesson", name="test_lesson")
     * @Method("GET")
     */
    public function LessonAction()
    {
        $em = $this->getDoctrine()->getManager();
        $lessons = $em->getRepository('AppBundle:Lesson')->showAllAction();
        return $this->render('default/lesson.json.twig', [
            'lessons' => $lessons,
        ]);
    }

        /**
     * @Route("/ajax", name="ajax")
     *
     */
    public function ajaxAction(Request $request)
    {
        $userId = $this->getUser()->getId();
        // dump($userId);
        // exit;
        $em = $this->getDoctrine()->getManager();
        $lessons = $em->getRepository('AppBundle:Lesson')->showAllAction();

        $date = $request->request->get('date');

        return $this->render('admin/today.json.twig', [
            'lessons' => $lessons,
            'date'=> $date,
        ],
        new JsonResponse()
                );
    }

    /**
    * @Route("/ajax/date/{id}", name="ajax_Date")
    *
    */
    public function ajaxDateAction(Request $request)
    {
        if ($request->isXMLHttpRequest()) {
            // $id = $request->get('id');
            $teacherId = $request->get('teacher_id');
            // Faire une fonction pour récupérer tous les cours de l'user en fonction de la date envoyée en ajax
            $lessons =  getRepository('AppBundle:Subscription')->showLessonsByTeacherId($teacherId);
            return new JsonResponse($lessons);
        }
    }

    /**
     *
     * @Route("/json/subscriptions", name="json_get_subscriptions")
     * @Method("GET")
     */
    public function jsonGetSubscriptionsAction()
    {
        $em = $this->getDoctrine()->getManager();
        $subscriptions = $em->getRepository('AppBundle:Subscription')->showAllAction();
        return $this->render('default/test.json.twig', [
            'inscriptions' => $subscriptions,
        ],
        new JsonResponse()
    );
    }

    /**
     * @Route("/show/myStudents", name="show_myStudents")
     */
     public function showMyStudentsAction()
     {
         // Je récupère l'ID de l'utilisateur connecté
         $userId = $this->getUser()->getId();
        $em = $this->getDoctrine()->getManager();
        $students = $em->getRepository('AppBundle:Subscription')->showMyStudentsAction($userId);

        return $this->render('default/student.html.twig', [
            'students' => $students,
        ]);
     }

    /**
    * @Route("/show/mySubscriptions", name="show_mySubscriptions")
    */
    public function showMymySubscriptionsAction()
    {
        // Je récupère l'ID de l'utilisateur connecté
        $userId = $this->getUser()->getId();
        $em = $this->getDoctrine()->getManager();
        $subscriptions = $em->getRepository('AppBundle:Subscription')->showMySubscriptions($userId);

        return $this->render('default/subscriptions.html.twig', [
        'subscriptions' => $subscriptions,
        ]);
    }


    /**
     * @Route("showTeachers", name="show_teachers")
     */
     public function showTeachersAction()
     {
         $em = $this->getDoctrine()->getManager();
         $teachers = $em->getRepository('AppBundle:User')->showTeachers();
         dump($teachers);
         exit;
     }



     /**
      * @Route("/all/observations/{id}/{student}/{teacher}/{speciality}", name="all_observations")
      */
      public function allObservationAction(Request $request, $id)
      {
        $student = $request->get('student');
        $teacher = $request->get('teacher');
        $speciality = $request->get('speciality');
        $id = $request->get('id');
        $em = $this->getDoctrine()->getManager();
        $result = $em->getRepository('AppBundle:Lesson')->showAllObservations($id);

        return $this->render('default/observation.html.twig', [
            'result' => $result,
            'student'=>$student,
            'teacher'=>$teacher,
            'speciality'=>$speciality
        ]);
      }


}
