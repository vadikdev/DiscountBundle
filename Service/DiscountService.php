<?php

namespace Vadiktok\DiscountBundle\Service;

use Vadiktok\DiscountBundle\Entity\BlockedIP;
use Vadiktok\DiscountBundle\Exception\DiscountException;
use Doctrine\ORM\EntityManager;

/**
 * Created by PhpStorm.
 * User: vadik
 * Date: 29.11.16
 * Time: 15:34
 */
class DiscountService
{
    /** @var EntityManager $em */
    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function get($code, $ip)
    {
        if ($this->getBlocks($ip) >= 5) {
            throw new DiscountException("IP is blocked", 100);
        }
        $discount = $this->em->getRepository('DiscountBundle:Discount')->findOneBy([
            'code' => $code,
            'used' => false,
        ]);
        if (!$discount) {
            // @TODO: Uncomment this line.
            //$this->block($ip);
            throw new DiscountException("Incorrect discount code", 101);
        }
        // @TODO: use "used" flag.
        return $discount;
    }

    private function getBlocks($ip) {
        return $this->em->getRepository('DiscountBundle:BlockedIP')
            ->findActive(new \DateTime('-1 hour'), $ip);
    }

    private function block($ip) {
        $entity = new BlockedIP();
        $entity->setIP($ip);
        $this->em->persist($entity);
        $this->em->flush();
    }
}