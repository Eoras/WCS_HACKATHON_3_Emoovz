<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MoveOutRoom
 *
 * @ORM\Table(name="move_out_room")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\MoveOutRoomRepository")
 */
class MoveOutRoom
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\MoveOut", inversedBy="moveOutRooms")
     */
    private $moveOut;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Room", inversedBy="moveOutRooms")
     */
    private $room;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\MoveOutRoomObject", mappedBy="moveOutRoom")
     */
    private $moveOutRoomObjects;

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
     * Set moveOut
     *
     * @param \AppBundle\Entity\MoveOut $moveOut
     *
     * @return MoveOutRoom
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
     * Set room
     *
     * @param \AppBundle\Entity\Room $room
     *
     * @return MoveOutRoom
     */
    public function setRoom(\AppBundle\Entity\Room $room = null)
    {
        $this->room = $room;

        return $this;
    }

    /**
     * Get room
     *
     * @return \AppBundle\Entity\Room
     */
    public function getRoom()
    {
        return $this->room;
    }

    /**
     * Add moveOutRoomObject
     *
     * @param \AppBundle\Entity\MoveOutRoomObject $moveOutRoomObject
     *
     * @return MoveOutRoom
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
