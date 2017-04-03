<?php

namespace MongoBundle\Command;

use AppBundle\Entity\City;
use AppBundle\Entity\Name;
use Doctrine\ORM\EntityManager;
use MongoBundle\Document\Actor;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class ImportActorCommand
 */
class ImportActorCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this->setName('database:import:actors');
    }

    /**
     * @param InputInterface  $input
     * @param OutputInterface $output
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $start = new \DateTime();
        $this->import($input, $output);
        $end          = new \DateTime();
        $diffStartEnd = $end->getTimestamp() - $start->getTimestamp();
        $output->writeln("\n<comment>...Completed in $diffStartEnd s.</comment>");
    }

    /**
     * @param InputInterface  $input
     * @param OutputInterface $output
     */
    private function import(InputInterface $input, OutputInterface $output)
    {
        /** @var EntityManager $om */
        $om = $this->getContainer()->get('doctrine')->getManager();
        $om->getConnection()->getConfiguration()->setSQLLogger(null);
        $dm = $this->getContainer()->get('doctrine_mongodb')->getManager();

        /** @var Name[] $names */
        $names = $om->getRepository('AppBundle:Name')->findBy([], ['id' => 'ASC'], 1000);
        foreach ($names as $name) {
            $actor = new Actor();
            $actor
                ->setName($name->getName());

            foreach ($name->getPersonsInfos() as $info) {
                if ($info->getInfoType()->getId() === 21) {
                    $actor->setBirthDay($info->getInfo());
                } elseif ($info->getInfoType()->getId() === 23) {
                    $actor->setDeathDay($info->getInfo());
                }
            }

            foreach ($name->getCastsInfos() as $castInfo) {
                $actor->addMovie($castInfo->getTitle()->getTitle());
            }

            $dm->persist($actor);
        }

        $dm->flush();
    }
}