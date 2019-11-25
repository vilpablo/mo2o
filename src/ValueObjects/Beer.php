<?php
namespace App\ValueObjects;

/**
 * Class Beer
 */
class Beer
{
    /** @var int */
    private $id;

    /** @var string */
    private $nombre;

    /** @var string */
    private $descripcion;

    /**
     * Beer constructor.
     * @param mixed $beerCrud
     */
    public function __construct($beerCrud)
    {
        $this->id = $beerCrud->id;
        $this->nombre = $beerCrud->name;
        $this->descripcion = $beerCrud->description;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getNombre(): string
    {
        return $this->nombre;
    }

    /**
     * @param string $nombre
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    /**
     * @return string
     */
    public function getDescripcion(): string
    {
        return $this->descripcion;
    }

    /**
     * @param string $descripcion
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }
}
