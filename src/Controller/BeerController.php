<?php

namespace App\Controller;

use FOS\RestBundle\Controller\AbstractFOSRestController;
use GuzzleHttp\Exception\RequestException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use billythekid\PunkApi;
use App\ValueObjects;

/**
 * Beer controller.
 * @Route("/api", name="api_")
 */

class BeerController extends AbstractFOSRestController
{
    /**
     * Lists Beer by food.
     * @Route("/beer", methods={"GET"})
     * @param Request $request
     *
     * @return Response
     */
    public function getBeersByFoodAction(Request $request): Response
    {
        $food = $request->get('food') ? $request->get('food') : '';
        $result = [];
        $status = Response::HTTP_NOT_FOUND ;

        if ('' !== $food) {
            $punkApi = PunkApi::create();
            $beersByFood = $punkApi->food($food)->getBeers();

            foreach ($beersByFood as $beer) {
                $newBeer = new ValueObjects\Beer($beer);
                $result[] = $newBeer;
            }
            $status = Response::HTTP_OK;
        }

        return $this->json([
            'beers' => $result,
        ], $status);
    }

    /**
     * Lists Beer by id.
     * @Route("/beer/detail", methods={"GET"})
     * @param Request $request
     *
     * @return Response
     */
    public function getBeerDetailByIdAction(Request $request): Response
    {

        $id = $request->get('id') ? $request->get('id') : '';
        $newBeer=[];
        $status = Response::HTTP_NOT_FOUND ;

        if ('' !== $id) {
            $punkApi = PunkApi::create();

            try {
                $beerById = $punkApi->getBeerById($id);
                if (count($beerById) > 0) {
                    $newBeer = new ValueObjects\BeerDetail($beerById[0]);
                }
                $status = Response::HTTP_OK;
            } catch (RequestException $exception) {
                $status = Response::HTTP_NOT_FOUND;
            }
        }

        return $this->json([
            'beer' => $newBeer,
        ], $status);
    }
}
