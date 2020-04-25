<?php


namespace App\Controller;


use App\Entity\Category;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class CategoriesController extends AbstractController
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * CategoriesController constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/categories",methods={"POST"})
     */
    public function create(Request $request) : Response
    {
        $requestData = $request->getContent();
        $json = json_decode($requestData);

        $category = new Category();
        $entity = $category->setName($json->name);

        $this->entityManager->persist($entity);
        $this->entityManager->flush();

        return new JsonResponse($entity,200);
    }
}