<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Object
 *
 * @ORM\Table(name="object")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ObjectRepository")
 */
class Object
{

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Category", inversedBy="objects")
     */
    private $category;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\MoveOutRoomObject", mappedBy="object")
     */
    private $moveOutRoomObjects;

    // PERSONNAL RELATIONS

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->moveOutRoomObjects = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Object
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set category
     *
     * @param \AppBundle\Entity\Category $category
     *
     * @return Object
     */
    public function setCategory(\AppBundle\Entity\Category $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \AppBundle\Entity\Category
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Add moveOutRoomObject
     *
     * @param \AppBundle\Entity\MoveOutRoomObject $moveOutRoomObject
     *
     * @return Object
     */
    public function addMoveOutRoomObject(\AppBundle\Entity\MoveOutRoomObject $moveOutRoomObject)
    {
        $this->moveOutRoomObjects[] = $moveOutRoomObject;

        return $this;
    }

    /**
     * Remove moveOutRoomObject
     *
     * @param \AppBundle\Entity\MoveOutRoomObject $moveOutRoomObject
     */
    public function removeMoveOutRoomObject(\AppBundle\Entity\MoveOutRoomObject $moveOutRoomObject)
    {
        $this->moveOutRoomObjects->removeElement($moveOutRoomObject);
    }

    /**
     * Get moveOutRoomObjects
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMoveOutRoomObjects()
    {
        return $this->moveOutRoomObjects;
    }
}
