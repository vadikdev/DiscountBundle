<?php

namespace Vadiktok\DiscountBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
/**
 * @CronJob("PT1D")
 */
class DeleteIPCommand extends ContainerAwareCommand
{
    public function configure()
    {
        $this
            ->setName('vadiktok:blocked_ip:drop')
            ->setDescription('Delete all blocked IPs')
        ;
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $repository = $this->getContainer()->get('doctrine')->getRepository('DiscountBundle:BlockedIP');
        $em = $this->getContainer()->get('doctrine')->getManager();
        $IPs = $repository->findInactive(new \DateTime("-1 hour"));

        foreach ($IPs as $IP) {
            $em->remove($IP);
        }
        $em->flush();
    }
}