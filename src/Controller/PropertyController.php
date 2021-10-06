<?php

namespace App\Controller;

use App\Entity\Property;
use App\Repository\PropertyRepository;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PropertyController extends AbstractController
{

    /**
     * @var PropertyRepository
     */
    private $repository;
    public function __construct(PropertyRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @Route("/biens", name="property.index")
     * return Response
     */
    public function index(): Response
    {
        // CREER DES DONNEES
        // $property = new Property();
        // $property->setTitle("Bien 1")
        //     ->setPrice(20000)
        //     ->setRooms(4)
        //     ->setBedrooms(3)
        //     ->setDescription("Description 1")
        //     ->setSurface(60)
        //     ->setFloor(4)
        //     ->setHeat(1)
        //     ->setCity("Ville 1")
        //     ->setAdress("Adresse 1")
        //     ->setPostalCode(34000);
        // $em = $this->getDoctrine()->getManager();
        // $em->persist($property);
        // $em->flush();
        return $this->render("property/index.html.twig", [
            "current_menu" => "properties"
        ]);
    }

    /**
     * @Route("/biens/{slug}-{id}", name="property.show", requirements={"slug": "[a-z0-9\-]*"})
     * @return Response
     */
    public function show($slug, $id): Response
    {
        $property = $this->repository->find($id);
        if ($property->getSlug() !== $slug) {
            $this->redirectToRoute("property/show.html.twig", [
                "id" => $property->getId(),
                "slug" => $property->getSlug(),
            ], 301);
        }
        return $this->render('property/show.html.twig', [
            'property' => $property,
            'current_menu' => 'properties'
        ]);
    }
}
