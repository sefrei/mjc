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
// $data = $request->request->get('date');
//  var_dump($data);
// $headers = $request->headers->all();
// $form->bindRequest($request);


        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
            // 'essai' => $data,
            // 'head'=> $headers,
         ]);
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
     * Finds and displays a subscription entity.
     *
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

        return $this->render('default/test.json.twig', [
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
         * Finds and displays a subscription entity.
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
            //  dump($userId);
            //  exit;
                $em = $this->getDoctrine()->getManager();
                $students = $em->getRepository('AppBundle:Subscription')->showMyStudentsAction($userId);
                //  dump($students);
                //  exit;
                return $this->render('default/student.html.twig', [
                    'students' => $students,
                ]);
         }

             /**
              * @Route("/date/{date}", name="date")
              */
              public function dateAction(Request $request)
              {
                  $dateRequest = $request->get('date');

                //   dump($dateRequest);
                  $date = new \DateTime($dateRequest);
                  $em = $this->getDoctrine()->getManager();
                  $lessons = $em->getRepository('AppBundle:Lesson')->getLessonsFromDate($date);

                  return $this->render('default/test.json.twig', [
                      'lessons' => $lessons,
                  ],
                  new JsonResponse()
                    );
              }

           /**
            * @Route("planning/{date}", name="planning_date")
            */
            public function userDateAction(Request $request)
            {
                $dateRequest = $request->get('date');
                $id = $this->getUser()->getId();

                $date = new \DateTime($dateRequest);
                $em = $this->getDoctrine()->getManager();
                $lessons = $em->getRepository('AppBundle:Lesson')->getLessonsFromDateAndId($date, $id);
                // dump($lessons);
                // exit;
                return $this->render('default/test.json.twig', [
                    'lessons' => $lessons,
                ],
                new JsonResponse()
                  );
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
              * @Route("/activity/{id}", name="activity")
              */
            public function showActivityAction(Request $request, Lesson $lesson)
            {

                return $this->redirectToRoute('homepage');
            }
            /**
             * @Route("/next", name="next")
             */
             public function nextAction()
             {
                $em = $this->getDoctrine()->getManager();
                $id = $this->getUser()->getId();
                $result = $em->getRepository('AppBundle:Lesson')->lessonsNowAfter($id);
// dump($result);
//
// exit;
                return $this->render('default/next.json.twig', [
                    'result' => $result,
                ],
                new JsonResponse()
                  );

             }
}
