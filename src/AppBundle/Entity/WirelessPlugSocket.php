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
     * @ORM\Column(type="integer")
     * @Assert\NotBlank()
     * @Assert\Type(type="integer")
     * @Assert\Range(min = 1, max = 5)
     */
    private $channelCode;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank()
     * @Assert\Type(type="integer")
     * @Assert\Range(min = 1, max = 5)
     */
    private $unitCode;
}