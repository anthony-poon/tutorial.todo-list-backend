<?php
namespace App\Controller;

use App\Service\ToDoListService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ToDoListController extends AbstractController {
    /**
     * @Route("/todo-list", methods={"POST"})
     *
     * Controller is a interface between frontend and backend. When the frontend execute an ajax operation,
     * the frontend will create a HTTP request and send it to the backend. A HTTP request includes, but not limited to
     * the following:
     *
     * 1. URL
     * 2. HTTP Method
     * 3. Content-Type
     * 4. Header
     * 5. Content
     *
     * When the backend framework received the HTTP request, it will parse the request so that the controller can access
     * the parameter send from the frontend. For example, consider the following request being send from the front end:
     *
     * Request URL: http://example.com/todo-list?id=1&name=abc
     * Request Method: POST,
     * Content-Type: application/json
     * Content:
     *
     * {'item': 'lorem ipsum'}
     *
     * First, the controller will scan for all the controller method, and match the @Route annotation and know that addListItem
     * should be called to handle this request.
     *
     * Second, the controller will parse '?id=1&name=abc' so that we can access 'id' with $request->query->get("id")
     *
     * Third, the content can be access by $request->getContent()
     *
     * Since the Content-Type is application/json. we need to use json_decode() to further parse it.
     *
     * Different programming language and framework might differ slightly on how things work, but the fundamental are
     * pretty much the same.
     */
    public function addListItem(Request $request, ToDoListService $db): Response {
        $content = json_decode($request->getContent(), true);
        $db->addItem($content["item"]);
        return new JsonResponse([
            "status" => "success"
        ]);
    }

    /**
     * @Route("/todo-list", methods={"GET"})
     */
    public function getListItem(ToDoListService $db): Response {
        $items = $db->getItems();
        return new JsonResponse($items);
    }
}