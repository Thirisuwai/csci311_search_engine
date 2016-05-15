<?php

namespace AppBundle\Console\Command;

use AppBundle\Utils\Crawler;
use AppBundle\Utils\CrawlerHelper;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;


class CrawlerCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('crawler:crawl')
            ->setDescription('Start Crawling the url')
        ;
    }


    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $crawler = new CrawlerHelper();
        $crawler->processMainPage();
        $output->writeln('done');
    }
}