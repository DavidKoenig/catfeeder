<?php
/**
 * Created by PhpStorm.
 * User: kinske
 * Date: 28.04.16
 * Time: 20:59
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table()
 */
class WirelessPlugSocket
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @Assert\Type(type="string")
     */
    private $name;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     * @Assert\Type(type="string")
     */
    private $channelCode;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     * @Assert\Type(type="string")
     */
    private $unitCode;

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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getChannelCode()
    {
        return $this->channelCode;
    }

    /**
     * @param mixed $channelCode
     */
    public function setChannelCode($channelCode)
    {
        $this->channelCode = $channelCode;
    }

    /**
     * @return mixed
     */
    public function getUnitCode()
    {
        return $this->unitCode;
    }

    /**
     * @param mixed $unitCode
     */
    public function setUnitCode($unitCode)
    {
        $this->unitCode = $unitCode;
    }
}