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
     * @var string
     *
     * @ORM\Column(name="pictureName", type="string", length=255)
     */
    private $pictureName;

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
     * Set pictureName
     *
     * @param string $pictureName
     *
     * @return Room
     */
    public function setPictureName($pictureName)
    {
        $this->pictureName = $pictureName;

        return $this;
    }

    /**
     * Get pictureName
     *
     * @return string
     */
    public function getPictureName()
    {
        return $this->pictureName;
    }
}
