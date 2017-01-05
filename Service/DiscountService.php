<?php

namespace Vadiktok\DiscountBundle\Service;

use Symfony\Component\HttpFoundation\RequestStack;
use Vadiktok\DiscountBundle\Entity\BlockedIP;
use Vadiktok\DiscountBundle\Entity\DiscountableInterface;
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

    private $ip;

    public function __construct(EntityManager $em, RequestStack $requestStack)
    {
        $this->em = $em;
        $this->ip = $requestStack->getCurrentRequest()->getClientIp();
    }

    public function get(DiscountableInterface $discountable, $code)
    {
        if (!$discountable->getDiscount()) {
            return null;
        }

        if ($this->getBlocks() >= 5) {
            throw new DiscountException("IP is blocked", 100);
        }
        $discount = $this->em->getRepository('VadiktokDiscountBundle:Discount')->findOneBy([
            'code' => $code,
            'used' => false,
        ]);
        if (!$discount || ($discount->getCode() != $discountable->getDiscount()->getCode())) {
            // @TODO: Uncomment this line.
            //$this->block($ip);
            throw new DiscountException("Incorrect discount code", 101);
        }
        // @TODO: use "used" flag.
        return $discount;
    }

    private function getBlocks() {
        return $this->em->getRepository('VadiktokDiscountBundle:BlockedIP')
            ->findActive(new \DateTime('-1 hour'), $this->ip);
    }

    private function block($ip) {
        $entity = new BlockedIP();
        $entity->setIP($ip);
        $this->em->persist($entity);
        $this->em->flush();
    }
}