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

//                 $date = $request->get('date');
//
// var_dump($date);
        //     $return = $date;
        //
        // return new JsonResponse($return);


        /**
         * Essai Récup date
         */
//         $date = $_POST['date'];
//         var_dump($date);
//     $date =    $request->get('date');
//     dump($date);
// $headers = $request->headers->all();
// dump($headers);
//
// $rawData = file_get_contents('php://input');
//   $json = json_decode($rawData);
//   dump($json);
//
// $all = $request->request->all();
// dump($all);
// exit;

// // $stack = $this->requestStack->getCurrentRequest();
// // dump($stack);
//
// $params = array();
//     $content = $request->getContent();
//     if (!empty($content))
//     {
//         $params = json_decode($content, true); // 2nd param to get as array
//     }
//     dump($params);
//
//     $order = $request->request->get('date');
//     dump($order);
// exit;

                    $em = $this->getDoctrine()->getManager();
                    $subscriptions = $em->getRepository('AppBundle:Subscription')->showAllAction();

                    $date = $request->request->get('date');

                    return $this->render('default/test.json.twig', [
                        'inscriptions' => $subscriptions,
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

         }
             /**
              * @Route("/date", name="date")
              */
              public function dateAction(Request $request)
              {
                  $date = $request->get('date');
                //   dump($date);
                //   exit;
                  return new Response(
             $date
        );
              }
}
