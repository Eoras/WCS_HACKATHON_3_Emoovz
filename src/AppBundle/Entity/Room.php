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
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\MoveOutRoom", mappedBy="room")
     */
    private $moveOutRooms;

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
     * Constructor
     */
    public function __construct()
    {
        $this->moveOutRooms = new \Doctrine\Common\Collections\ArrayCollection();
        $this->objects = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Add moveOutRoom
     *
     * @param \AppBundle\Entity\MoveOutRoom $moveOutRoom
     *
     * @return Room
     */
    public function addMoveOutRoom(\AppBundle\Entity\MoveOutRoom $moveOutRoom)
    {
        $this->moveOutRooms[] = $moveOutRoom;

        return $this;
    }

    /**
     * Remove moveOutRoom
     *
     * @param \AppBundle\Entity\MoveOutRoom $moveOutRoom
     */
    public function removeMoveOutRoom(\AppBundle\Entity\MoveOutRoom $moveOutRoom)
    {
        $this->moveOutRooms->removeElement($moveOutRoom);
    }

    /**
     * Get moveOutRooms
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMoveOutRooms()
    {
        return $this->moveOutRooms;
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
