<?php

namespace App\Presentation\Controller;

use App\Application\Command\CommandBus;
use App\Domain\ReadModel\Repository\ItemsRepository;
use App\Presentation\Form\CategoriseItem;
use App\Presentation\OAuthSecuredController;
use App\Application\Command\Items\CategoriseItem as CategoriseItemCommand;


/**
 *
 * @Route(
 *     "/v1",
 *     name="api.items.",
 *     host="api.{domain}",
 *     defaults={"domain"="%domain%"},
 *     requirements={"domain"="%domain%"}
 * )
 */
class ItemsController extends OAuthSecuredController
{

    private CommandBus      $commandBus;
    private ItemsRepository $itemsRepository;


    public function __construct(
        ItemsRepository $itemsRepository,
        FormErrorRetriever $errorRetriever,
        CommandBus $commandBus
    ) {
        $this->itemsRepository = $itemsRepository;
        $this->commandBus      = $commandBus;

        parent::__construct($errorRetriever);
    }


    /**
     * @Route("/items", methods={"GET", "HEAD", "OPTIONS"}, name="items")
     */
    public function items(Request $request): Response
    {
        $this->requireScope($request, Scope::SCOPE_READ_ITEMS);

        $userID = $this->getUserIDFromRequest($request);

        $filter = new ItemsFilter($this->getJsonParametersFromBody($request));

        $items = $this->itemsRepository->items($userID, $filter);

        return new JsonResponse(
            $items->toSerialisable(),
            Response::HTTP_OK,
            ['content-type' => 'application/json']
        );
    }


    /**
     * @Route("/items", methods={"POST"}, name="create")
     */
    public function create(Request $request): Response
    {
        $this->requireScope($request, Scope::SCOPE_WRITE_ITEMS);

        $newId  = ItemId::generate();
        $userId = $this->getUserIDFromRequest($request);

        $form = $this->createForm(
            CreateItem::class,
            null,
            [
                'user_id' => $userId
            ]
        );

        $this->submitFormAndHandleCommand($form, $request, $this->commandBus);

        return new Response(
            null,
            Response::HTTP_CREATED,
            [
                'Location' => $this->generateUrl(
                    'api.items.byId',
                    ['id' => $newId->toString()]
                )
            ]
        );
    }


    /**
     * @Route("/items/{itemId}/categorise", methods={"PUT"}, name="categorise", requirements={"itemId"="%uuid%"})
     */
    public function categorise(Request $request, string $itemId): Response
    {
        $this->requireScope($request, Scope::SCOPE_WRITE_ITEMS);

        $data = $this->getJsonParametersFromBody($request);

        $form = $this->createForm(
            CategoriseItem::class,
            new CategoriseItemCommand($data),
            [
                'itemId' => $itemId
            ]
        );

        $this->submitFormAndHandleCommand($form, $request, $this->commandBus, []);

        return new Response(
            null,
            Response::HTTP_NO_CONTENT,
            [
                'Location' => $this->generateUrl(
                    'api.items.byId',
                    ['itemId' => $itemId]
                )
            ]
        );
    }


    /**
     * @Route("/items/{itemId}", methods={"GET"}, name="byId", requirements={"itemId"="%uuid%"})
     */
    public function byId(Request $request, string $itemId): Response
    {

        $this->requireScope($request, Scope::SCOPE_READ_ITEMS);

        $items = $this->itemsRepository->itemsById(ItemId::fromString($itemId));

        return new JsonResponse(
            $items->toSerialisable(),
            Response::HTTP_OK,
            ['content-type' => 'application/json']
        );
    }
}
