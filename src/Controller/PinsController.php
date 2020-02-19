<?php

namespace App\Controller;

use App\Entity\Pin;
use App\Repository\PinRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PinsController extends AbstractController
{
    private $em;
    private $repository;

    public function __construct(EntityManagerInterface $em, PinRepository $repository)
    {
        $this->em = $em;
        $this->repository = $repository;
    }

    /**
     * @Route("/pins", name="pins")
     */
    public function index(): Response
    {
        $pin = new Pin();
        $pin->setTitle('Teacher du net')
            ->setDescription('Chaine de formation en ligne');
        $this->em->persist($pin);
        $this->em->flush();

        $pins = $this->repository->findAll();

        return $this->render('pins/index.html.twig', [
            compact('pins')
        ]);
    }
}
