<?php

namespace AppBundle\Utils;

use AppBundle\Entity\ResultDetail;
use AppBundle\Entity\ResultHeader;
use Doctrine\ORM\EntityManager;
use GuzzleHttp\Client;


class CrawlerHelper
{
    const MAX_CRAWL_LIMIT = 500;

    /**
     * @var EntityManager $entityManager
     */
    protected $entityManager;


    public function processMainPage()
    {
        if ($this->isFirstCrawling()) {
            // if it is to crawl from the start, remove everything in header and detail table
            $this->truncateResultHeaderTable();
            $this->truncateResultDetailTable();
        }

        // get url from the db
        $sources = $this->entityManager->getRepository('AppBundle:Source')
            ->findAll();

        foreach ($sources as $s) {
            if (1 === $s->getStatus()) { // crawl only active urls
                $url = $s->getUrl();

                $client = new Client();
                $crawler = $client->request('GET', $url);
                $status = $client->getResponse()->getStatus();

                if ($status === 200) {
                    $resultHeader = new ResultHeader();
                    $resultHeader->setMainPageAddress($url)
                        ->setMainPageTitle($crawler->filter('title'))
                        ->setViewCount(0)
                        ->setStatus(1)
                        ->setHeaderParagraph($crawler->filterXpath('//meta[@name=description]')->attr('content'));
                    $this->processSubPage($resultHeader, $url);
                }
            }
        }
    }

    public function processSubPage($resultHeader, $url)
    {
        try {
            if ($this->isExistingUrl($url)) {
                $resultDetail = new ResultDetail();
                $client = new Client();
                $crawler = $client->request('GET', $url);
                $status = $client->getResponse()->getStatus();
                if ($status === 200) {
                    $resultDetail->setResultHeader($resultHeader)
                        ->setSubDirectoryAddress($url)
                        ->setSubDirectoryTitle($crawler->filter('title'))
                        ->setSubDirectoryName('')
                        ->setSubDirectoryParagraph($crawler->filterXpath('//meta[@name=description')->attr('content'))
                        ->setCreatedAt(new \DateTime());
                }

                // search all links and call processSubPage recursively
                $crawler->filter('a')->each(function (\Symfony\Component\DomCrawler\Crawler $node, $i) use ($resultHeader) {
                    $count = 0;
                    $nodeUrl = $node->attr('href');
                    if ($nodeUrl !== null && $count <= self::MAX_CRAWL_LIMIT) {
                        $count++;
                        $this->processSubPage($resultHeader, $nodeUrl);
                    }
                });
            }
        } catch (\Exception $e) {
            echo 'Unable to access page: ' . $e;

        }
    }


    public function isFirstCrawling()
    {
        if ($this->isResultHeaderTableEmpty() && $this->isResultDetailTableEmpty()) {
            return true;
        }
        return false;
    }


    /**
     * Check whether ResultHeader is empty
     * @return bool
     */
    public function isResultHeaderTableEmpty()
    {
        $resultHeader = $this->entityManager->getRepository('AppBundle:ResultHeader')
            ->findAll();

        return $resultHeader ? true : false;
    }


    public function truncateResultHeaderTable()
    {
        $resultHeaders = $this->entityManager->getRepository('AppBundle:ResultHeader')
            ->findAll();
        foreach ($resultHeaders as $h) {
            $this->entityManager->remove($h);
        }
        $this->entityManager->flush();
    }


    public function truncateResultDetailTable()
    {
        $resultDetails = $this->entityManager->getRepository('AppBundle:ResultDetail')
            ->findAll();
        foreach ($resultDetails as $d) {
            $this->entityManager->remove($d);
        }
        $this->entityManager->flush();
    }


    /**
     * Check whether ResultDetail is empty
     * @return bool
     */
    public function isResultDetailTableEmpty()
    {
        $resultDetail = $this->entityManager->getRepository('AppBundle:ResultDetail')
            ->findAll();

        return $resultDetail ? true : false;
    }


    /**
     * This method check whether the url
     * @param $url
     * @return bool
     */
    public function isExistingUrl($url)
    {
        $findUrl = $this->entityManager->getRepository('AppBundle:ResultDetail')
            ->findOneBy(['subDirectoryAddress' => $url]);

        return $findUrl ? true : false;
    }
}