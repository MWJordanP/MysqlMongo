<?php

namespace MongoBundle\Command;

use AppBundle\Entity\Title;
use Doctrine\ORM\EntityManager;
use MongoBundle\Document\Movie;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class ImportMovieCommand
 */
class ImportMovieCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('database:import:movies');
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
        $dm   = $this->getContainer()->get('doctrine_mongodb')->getManager();
        $list = $dm->getRepository(Movie::class)->findAll();

        /** @var Title[] $titles */
        $titles = $om->getRepository('AppBundle:Title')->findBy([], ['id' => 'ASC'], 1000);
        foreach ($titles as $title) {
            $movie = new Movie();
            $movie
                ->setTitle($title->getTitle())
                ->setYear($title->getProductionYear());

            foreach ($title->getCastsInfos() as $info) {
                if (null !== $info->getRoleType()) {
                    if ($info->getRoleType()->getId() === 8) {
                        $movie->setDirector($info->getName()->getName());
                    } elseif ($info->getRoleType()->getId() === 1 || $info->getRoleType()->getId() === 2) {
                        $movie->addActor($info->getName()->getName());
                    }
                }
            }

            foreach ($title->getKeywords() as $keyword) {
                $movie->addKeyword($keyword->getKeyword());
            }

            foreach ($title->getMoviesInfos() as $movieInfo) {
                if ($movieInfo->getInfoType()->getId() === 3) {
                    $movie->addGenre($movieInfo->getInfo());
                }
            }

            $dm->persist($movie);
        }

        $dm->flush();
    }
}