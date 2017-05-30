<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Subscription;
use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Subscription controller.
 *
 * @Route("subscription")
 */
class SubscriptionController extends Controller
{
    /**
     * Lists all subscription entities.
     *
     * @Route("/", name="subscription_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $subscriptions = $em->getRepository('AppBundle:Subscription')->findAll();

        return $this->render('subscription/index.html.twig', array(
            'subscriptions' => $subscriptions,
        ));
    }

    /**
     * Creates a new subscription entity.
     *
     * @Route("/new", name="subscription_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $subscription = new Subscription();
        $form = $this->createForm('AppBundle\Form\SubscriptionType', $subscription);
        $form->handleRequest($request);

        // current date
        $subscription->setSubscriptionAt(new \DateTime());

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            /**
             * Enregistrement de la date de fin en fonction de la date de début et la durée d'un cours
             */
            // Je récupère la date du 1er cours
            $startAt = $subscription->getStartAt();
            // Je récupère la durée d'un cours
            $duration = $subscription->getDuration();
            // Je fais mon calcul pour ma date de fin (ici duration est enregistrée en int avec le nombre de secondes)
            $durationforDate = 'PT0H'.$duration .'S';
            // $durationModyfi
            // dump($durationforDate);
            // exit;
<<<<<<< HEAD
            $startAt->add(new \DateInterval('PT0H1800S'));

            exit;
=======
            //'PT0H1800S'=30min
            $subscription->setFinishAt($startAt);
            $finishAt->add(new \DateInterval($durationforDate));
            // dump($startAt);
            // exit;
>>>>>>> 046c1db0c57e0adc5d8a22b18bc159e4b447a23f
            // $startAt->modify('')
            // Je mets à jour ma date de fin avec set
            $subscription->setFinishAt($finishAt);

            // Et j'enregistre l'inscription
            $em->persist($subscription);
            $em->flush();

            return $this->redirectToRoute('subscription_show', array('id' => $subscription->getId()));
        }

        return $this->render('subscription/new.html.twig', array(
            'subscription' => $subscription,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a subscription entity.
     *
     * @Route("/{id}", name="subscription_show")
     * @Method("GET")
     */
    public function showAction(Subscription $subscription)
    {
        $deleteForm = $this->createDeleteForm($subscription);

        return $this->render('subscription/show.html.twig', array(
            'subscription' => $subscription,
            'delete_form' => $deleteForm->createView(),
        ));
    }




    /**
     * Displays a form to edit an existing subscription entity.
     *
     * @Route("/{id}/edit", name="subscription_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Subscription $subscription)
    {
        $deleteForm = $this->createDeleteForm($subscription);
        $editForm = $this->createForm('AppBundle\Form\SubscriptionType', $subscription);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('subscription_edit', array('id' => $subscription->getId()));
        }

        return $this->render('subscription/edit.html.twig', array(
            'subscription' => $subscription,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a subscription entity.
     *
     * @Route("/{id}", name="subscription_delete", requirements={"id": "\d+"})
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Subscription $subscription)
    {
        $form = $this->createDeleteForm($subscription);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($subscription);
            $em->flush();
        }

        return $this->redirectToRoute('subscription_index');
    }

    /**
     * Creates a form to delete a subscription entity.
     *
     * @param Subscription $subscription The subscription entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Subscription $subscription)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('subscription_delete', array('id' => $subscription->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
