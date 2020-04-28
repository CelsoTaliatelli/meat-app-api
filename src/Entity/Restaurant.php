<?php


namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RestaurantRepository")
 */
class Restaurant implements \JsonSerializable
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @ORM\Column(type="string")
     */
    private $name;
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Category")
     * @ORM\JoinColumn(nullable=false)
     */
    private $category;
    /**
     * @ORM\Column(type="integer")
     */
    private $deliveryEstimate;
    /**
     * @ORM\Column(type="decimal")
     */
    private $rating;
    /**
     * @ORM\Column(type="string")
     */
    private $imagePath;


    public function getId() : int
    {
        return $this->id;
    }

    public function getName() : string
    {
        return $this->name;
    }

    public function setName($name): self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCategory() : ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDeliveryEstimate()
    {
        return $this->deliveryEstimate;
    }

    /**
     * @param mixed $deliveryEstimate
     */
    public function setDeliveryEstimate($deliveryEstimate): self
    {
        $this->deliveryEstimate = $deliveryEstimate;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * @param mixed $rating
     */
    public function setRating($rating): self
    {
        $this->rating = $rating;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getImagePath(): string
    {
        return $this->imagePath;
    }

    /**
     * @param mixed $imagePath
     */
    public function setImagePath($imagePath): self
    {
        $this->imagePath = $imagePath;
        return $this;
    }

    /**
     * Specify data which should be serialized to JSON
     * @link https://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    public function jsonSerialize()
    {
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'deliveryEstimate' => $this->getDeliveryEstimate(),
            'rating' => $this->getRating(),
            'imagePath' => $this->getImagePath(),
            'categoryId' => $this->getCategory()->getName()
        ];
    }
}