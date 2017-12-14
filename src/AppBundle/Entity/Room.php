<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Room
 *
 * @ORM\Table(name="room")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\RoomRepository")
 */
class Room
{
    /**
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\MoveOut", inversedBy="rooms")
     *
     */
    private $moveOut;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Object")
     */
    private $objects;

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
     * Get id
     *
     * @return int
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
     * @return Room
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
     * Constructor
     */
    public function __construct()
    {
        $this->objects = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set moveOut
     *
     * @param \AppBundle\Entity\MoveOut $moveOut
     *
     * @return Room
     */
    public function setMoveOut(\AppBundle\Entity\MoveOut $moveOut = null)
    {
        $this->moveOut = $moveOut;

        return $this;
    }

    /**
     * Get moveOut
     *
     * @return \AppBundle\Entity\MoveOut
     */
    public function getMoveOut()
    {
        return $this->moveOut;
    }

    /**
     * Add object
     *
     * @param \AppBundle\Entity\Object $object
     *
     * @return Room
     */
    public function addObject(\AppBundle\Entity\Object $object)
    {
        $this->objects[] = $object;

        return $this;
    }

    /**
     * Remove object
     *
     * @param \AppBundle\Entity\Object $object
     */
    public function removeObject(\AppBundle\Entity\Object $object)
    {
        $this->objects->removeElement($object);
    }

    /**
     * Get objects
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getObjects()
    {
        return $this->objects;
    }
}
