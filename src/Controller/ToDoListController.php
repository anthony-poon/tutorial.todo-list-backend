<?php
namespace App\Controller;

use App\Service\ToDoListService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ToDoListController
 * @package App\Controller
 * @Route("/todo-list")
 */
class ToDoListController extends AbstractController {
    /**
     * @Route("/")
     * @param Request $request
     * @param ToDoListService $db
     * @return Response
     */
    public function addListItem(Request $request, ToDoListService $db): Response{
        $test = $request->query->get("test");
        $items = $db->getItems();
        return new JsonResponse([
            "foo" => "bar",
            "test" => $items
        ]);
    }

}