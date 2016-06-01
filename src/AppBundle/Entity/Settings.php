<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table()
 */
class Settings
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @ORM\Column(type="decimal", scale=2, precision=4)
     * @Assert\NotBlank()
     * @Assert\Type(type="float")
     * @Assert\Range(
     *      min = 0.01,
     *      max = 30.00,
     *      minMessage = "The duration must be at least {{ limit }} seconds.",
     *      maxMessage = "The duration cannot be greater than {{ limit }} seconds for security reasons."
     * )
     */
    private $durationPortion;

    /**
     * @ORM\Column(type="decimal", scale=2, precision=4)
     * @Assert\NotBlank()
     * @Assert\Type(type="float")
     * @Assert\Range(
     *      min = 0.01,
     *      max = 30.00,
     *      minMessage = "The duration must be at least {{ limit }} seconds.",
     *      maxMessage = "The duration cannot be greater than {{ limit }} seconds for security reasons."
     * )
     */
    private $durationLightBarrier;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isLightBarrierActive = false;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\WirelessPlugSocket", cascade={"persist"})
     * @ORM\JoinColumn(referencedColumnName="id", onDelete="CASCADE")
     */
    private $wirelessPlugSocket;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getDurationPortion()
    {
        return $this->durationPortion;
    }

    /**
     * @param mixed $durationPortion
     */
    public function setDurationPortion($durationPortion)
    {
        $this->durationPortion = $durationPortion;
    }

    /**
     * @return mixed
     */
    public function getDurationLightBarrier()
    {
        return $this->durationLightBarrier;
    }

    /**
     * @param mixed $durationLightBarrier
     */
    public function setDurationLightBarrier($durationLightBarrier)
    {
        $this->durationLightBarrier = $durationLightBarrier;
    }

    /**
     * @return mixed
     */
    public function getIsLightBarrierActive()
    {
        return $this->isLightBarrierActive;
    }

    /**
     * @param mixed $isLightBarrierActive
     */
    public function setIsLightBarrierActive($isLightBarrierActive)
    {
        $this->isLightBarrierActive = $isLightBarrierActive;
    }

    /**
     * @return mixed
     */
    public function getWirelessPlugSocket()
    {
        return $this->wirelessPlugSocket;
    }

    /**
     * @param mixed $wirelessPlugSocket
     */
    public function setWirelessPlugSocket($wirelessPlugSocket)
    {
        $this->wirelessPlugSocket = $wirelessPlugSocket;
    }
}