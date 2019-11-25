<?php
namespace App\ValueObjects;

/**
 * Class BeerDetail
 */
class BeerDetail extends Beer
{
    /**
     * @var string
     */
    private $imagen;

    /**
     * @var string
     */
    private $slogan;

    /**
     * @var \DateTime
     */
    private $fechaFabricacion;

    /**
     * Beer constructor.
     * @param mixed $beerCrud
     */
    public function __construct($beerCrud)
    {
        parent::__construct($beerCrud);
        $this->imagen = $beerCrud->image_url;
        $this->slogan = $beerCrud->tagline;
        $this->fechaFabricacion = \DateTime::createFromFormat('m/Y', $beerCrud->first_brewed);
    }

    /**
     * @return string
     */
    public function getImagen(): string
    {
        return $this->imagen;
    }

    /**
     * @param string $imagen
     */
    public function setImagen(string $imagen)
    {
        $this->imagen = $imagen;
    }

    /**
     * @return string
     */
    public function getSlogan(): string
    {
        return $this->slogan;
    }

    /**
     * @param string $slogan
     */
    public function setSlogan(string $slogan)
    {
        $this->slogan = $slogan;
    }

    /**
     * @return \DateTime
     */
    public function getFechaFabricacion(): \DateTime
    {
        return $this->fechaFabricacion;
    }

    /**
     * @param \DateTime $fechaFabricacion
     */
    public function setFechaFabricacion(\DateTime $fechaFabricacion)
    {
        $this->fechaFabricacion = $fechaFabricacion;
    }
}
