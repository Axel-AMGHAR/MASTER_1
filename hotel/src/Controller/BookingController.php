<?php

namespace App\Controller;

use App\Entity\Booking;
use App\Form\BookingType;
use App\Repository\BookingRepository;
use Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin")
 */

class BookingController extends AbstractController
{
    /**
     * @route("/booking", name="booking")
     * @param Request $request
     * @return Response
     * @throws Exception
     */
    public function index(Request $request, BookingRepository $bookingRepository): Response
    {
        $booking = new Booking();
        $form = $this->createForm(BookingType::class, $booking);

        $form->handleRequest($request);
        if( $form->isSubmitted() && $form->isValid()){

            $room_check = $bookingRepository->check_room_available($booking);
            if($room_check){


                /* Already made in prepersist
                 *             $booking->setCreatedAt(new \DateTime());*/
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($booking);
                $entityManager->flush();

                $this->addFlash('success', 'Le booking a bien été créé');
                return $this->redirectToRoute('default');
            }
            else
                $this->addFlash('danger', 'La chambre est indisponible pour les dates données');

        }

        return $this->render('booking/booking.html.twig', [
            'controller_name' => 'BookingController',
            'form' => $form->createView()
        ]);
    }
}
