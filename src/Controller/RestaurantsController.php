<?php


namespace App\Controller;


use App\Entity\Category;
use App\Entity\Restaurant;
use App\Repository\CategoryRepository;
use App\Repository\RestaurantRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class RestaurantsController extends AbstractController
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;
    /**
     * @var CategoryRepository
     */
    private $categoryRepository;
    /**
     * @var RestaurantRepository
     */
    private $restaurantRepository;

    /**
     * CategoriesController constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(
        EntityManagerInterface $entityManager,
        CategoryRepository $categoryRepository,
        RestaurantRepository $restaurantRepository)
    {
        $this->entityManager = $entityManager;
        $this->categoryRepository = $categoryRepository;
        $this->restaurantRepository = $restaurantRepository;
    }

    /**
     * @Route("/restaurants",methods={"POST"})
     */
    public function create(Request $request) : Response
    {
        $requestData = $request->getContent();
        $json = json_decode($requestData);
        $categoryId = $this->categoryRepository->find($json->categoryId);

        $restaurant = new Restaurant();
        $entity = $restaurant
            ->setName($json->name)
            ->setCategory($categoryId)
            ->setRating($json->rating)
            ->setDeliveryEstimate($json->deliveryEstimate)
            ->setImagePath($json->imagePath);

        $this->entityManager->persist($entity);
        $this->entityManager->flush();

        return new JsonResponse($entity,200);
    }
    /**
     * @Route("/restaurants",methods={"GET"})
     */
    public function all()
    {
        $restaurants = $this->restaurantRepository->findAll();

        return new JsonResponse($restaurants);
    }
}