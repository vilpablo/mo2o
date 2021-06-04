<?php

namespace App\Controller;

use FOS\RestBundle\Controller\AbstractFOSRestController;
use GuzzleHttp\Client;
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
    /** @var string  */
    private const API_URL = 'https://api.punkapi.com/v2/beers/';

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
            $client = new Client();
            $beersByFood = $client->get($this::API_URL.'?food='.$food);
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
            $client = new Client();
            $newBeers = [];
            try {
                /** @var \GuzzleHttp\Message\Response $beerById */
                $beerById = $client->get($this::API_URL.'?ids='.$id);
                $jsonBeers = json_decode($beerById->getBody()->getContents(), true);
                if(200 === $beerById->getStatusCode() && !empty($jsonBeers)){
                    $newBeer = new ValueObjects\BeerDetail($jsonBeers[0]);
                    $status = Response::HTTP_OK;
                }
            } catch (RequestException $exception) {
                $status = Response::HTTP_NOT_FOUND;
            }
        }

        return $this->json([
                'beer' => $newBeer,
        ], $status);
    }
}
