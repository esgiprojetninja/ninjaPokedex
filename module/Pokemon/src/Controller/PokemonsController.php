<?php
namespace Pokemon\Controller;

use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;

class PokemonsController extends AbstractRestfulController {

    protected $pokemonService;

    public function __construct($pokemonService) {
        $this->pokemonService = $pokemonService;
    }

    public function signalAction() {
        var_dump("signal Action !! isPost: ", $this->request->isPost());
        var_dump("signal Action !! getPost: ", $this->request->getPost());
        exit;
    }

    public function get($id) {
        return new JsonModel(
            array("get" => $id)
        );
    }
    public function getList() {
        return new JsonModel(
            array("data" => [
                [
                    "name" => "ezezfzefezf",
                    "id_national" => 11,
                    "parent" => null,
                    "icon" => "https://raw.githubusercontent.com/PokeAPI/sprites/master//sprites/pokemon/11.png"
                ],
                [
                    "name" => "zdarbethzrr",
                    "id_national" => 25,
                    "parent" => null,
                    "icon" => "https://raw.githubusercontent.com/PokeAPI/sprites/master//sprites/pokemon/25.png"
                ],
                [
                    "name" => "ezrtyktygrevrf",
                    "id_national" => 150,
                    "parent" => null,
                    "icon" => "https://raw.githubusercontent.com/PokeAPI/sprites/master//sprites/pokemon/150.png"
                ],
                [
                    "name" => "dezgzrgrzgrzevfr",
                    "id_national" => 87,
                    "parent" => null,
                    "icon" => "https://raw.githubusercontent.com/PokeAPI/sprites/master//sprites/pokemon/87.png"
                ],
            ])
        );
    }
    public function create($data) {
        return new JsonModel(
            array("create" => $data)
        );
    }
    public function update($id, $data) {
        return new JsonModel(
            array("update" => $id)
        );
    }
    public function delete($id) {
        return new JsonModel(
            array("delete" => $id)
        );
    }
    public function marked() {
        return new JsonModel(
            array("data" => [
                [
                    "name" => "Bulbizarre",
                    "id_national" => 1,
                    "parent" => null,
                    "position" => [
                        "lat"=> -14.363882,
                        "lng"=> 118.044922
                    ],
                    "icon" => "https://raw.githubusercontent.com/PokeAPI/sprites/master//sprites/pokemon/1.png"
                ],
                [
                    "name" => "Herbizarre",
                    "id_national" => 2,
                    "parent" => null,
                    "position" => [
                        "lat"=> -40.363882,
                        "lng"=> 141.044922
                    ],
                    "icon" => "https://raw.githubusercontent.com/PokeAPI/sprites/master//sprites/pokemon/2.png"
                ],
                [
                    "name" => "Florizarre",
                    "id_national" => 3,
                    "parent" => null,
                    "position" => [
                        "lat"=> -46.363882,
                        "lng"=> 170.044922
                    ],
                    "icon" => "https://raw.githubusercontent.com/PokeAPI/sprites/master//sprites/pokemon/3.png"
                ],
                [
                    "name" => "Salamèche",
                    "id_national" => 4,
                    "parent" => null,
                    "position" => [
                        "lat"=> -35.363882,
                        "lng"=> 135.044922
                    ],
                    "icon" => "https://raw.githubusercontent.com/PokeAPI/sprites/master//sprites/pokemon/4.png"
                ],
            ])
        );
    }
    public function methodNotAllowed() {
        $this->response->setStatusCode(
            \Zend\Http\PhpEnvironment\Response::STATUS_CODE_405
        );
        throw new Exception('Method Not Allowed');
    }
}
