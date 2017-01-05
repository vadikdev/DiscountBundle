<?php
/**
 * Created by PhpStorm.
 * User: vadik
 * Date: 05.01.17
 * Time: 12:44
 */

namespace Vadiktok\DiscountBundle\Entity;


interface DiscountableInterface
{
    /**
     * @param Discount $discount
     * @return DiscountableInterface
     */
    public function setDiscount(Discount $discount);

    /**
     * @return Discount
     */
    public function getDiscount();
}