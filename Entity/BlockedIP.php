<?php

namespace Vadiktok\DiscountBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BlockedIP
 *
 * @ORM\Table(name="blocked_ips")
 * @ORM\Entity(repositoryClass="Vadiktok\DiscountBundle\Repository\BlockedIPRepository")
 */
class BlockedIP
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
     * @var string
     *
     * @ORM\Column(name="IP", type="string", length=255)
     */
    private $IP;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="access", type="datetime")
     */
    private $access;

    public function __construct()
    {
        if (empty($this->access)) {
            $this->access = new \DateTime();
        }
    }

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
     * Set IP
     *
     * @param string $IP
     *
     * @return BlockedIP
     */
    public function setIP($IP)
    {
        $this->IP = $IP;

        return $this;
    }

    /**
     * Get IP
     *
     * @return string
     */
    public function getIP()
    {
        return $this->IP;
    }

    /**
     * Set access
     *
     * @param \DateTime $access
     *
     * @return BlockedIP
     */
    public function setAccess($access)
    {
        $this->access = $access;

        return $this;
    }

    /**
     * Get access
     *
     * @return \DateTime
     */
    public function getAccess()
    {
        return $this->access;
    }
}
