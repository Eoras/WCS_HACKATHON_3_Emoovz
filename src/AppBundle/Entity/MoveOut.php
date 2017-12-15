<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

/**
 * MoveOut
 *
 * @ORM\Table(name="move_out")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\MoveOutRepository")
 */
class MoveOut
{
    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\MoveOutRoom", mappedBy="moveOut")
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
    private $email;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->moveOutRooms = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set email
     *
     * @param string $email
     *
     * @return MoveOut
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Add moveOutRoom
     *
     * @param \AppBundle\Entity\MoveOutRoom $moveOutRoom
     *
     * @return MoveOut
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
}
