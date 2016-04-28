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
     * @Assert\Type(type="number")
     */
    private $durationPortion;

    /**
     * @ORM\Column(type="decimal", scale=2, precision=4)
     * @Assert\NotBlank()
     * @Assert\Type(type="number")
     */
    private $durationLightBarrier;

    /**
     * @ORM\Column(type="boolean")
     * @Assert\NotBlank()
     * @Assert\Type(type="boolean")
     */
    private $isLightBarrierActive;
}