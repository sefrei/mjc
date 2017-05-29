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

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // $rawpostdata = file_get_contents("php://input");
        // $rawpostdata = json_decode($rawpostdata);
        // dump($rawpostdata);

        // echo "<pre>";
        // echo $_POST['firstName'];
        // echo "</pre>";
    // $essai=$request->request->get();
    // dump($essai);
    // exit;
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
            // 'essai' => $rawpostdata,
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
     * @Route("/ajax", name="ajax")
     *
     */
    public function ajaxAction(Request $request)
    {
                    $em = $this->getDoctrine()->getManager();
                    $subscriptions = $em->getRepository('AppBundle:Subscription')->showAllAction();

                    $date = $request->request->get('data');

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
}
