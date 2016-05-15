<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;


/**
 * Class ResultHeader
 * @package AppBundle\Entity
 * @ORM\Entity()
 * @ORM\Table(name="ResultHeader")
 */
class ResultHeader
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string $mainPageAddress
     *
     * @ORM\Column(name="main_page_address", type="string", length=255)
     */
    protected $mainPageAddress;

    /**
     * @var string $mainPageTitle
     *
     * @ORM\Column(name="main_page_title", type="string", length=255)
     */
    protected $mainPageTitle;

    /**
     * @var integer $viewCount
     *
     * @ORM\Column(name="view_count", type="integer")
     */
    protected $viewCount;

    /**
     * @var integer $status
     *
     * @ORM\Column(name="status", type="integer")
     */
    protected $status;

    /**
     * @var string $headerParagraph
     *
     * @ORM\Column(name="header_paragraph", type="string", length=255)
     */
    protected $headerParagraph;

    /**
     * @var ResultDetail[] $resultDetails
     *
     * @ORM\OneToMany(targetEntity="ResultDetail", mappedBy="resultHeader", cascade={"persist", "remove"})
     */
    protected $resultDetails;

    ///////////////////////
    //  Methods
    ///////////////////////

    /**
     * ResultHeader constructor.
     */
    public function __construct()
    {
        $this->resultDetails = new ArrayCollection();
    }


    /**
     * Get Id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }


    /**
     * Get mainPageAddress
     *
     * @return string
     */
    public function getMainPageAddress()
    {
        return $this->mainPageAddress;
    }


    /**
     * Set mainPageAddress
     *
     * @param string $mainPageAddress
     * @return ResultHeader
     */
    public function setMainPageAddress($mainPageAddress)
    {
        $this->mainPageAddress = $mainPageAddress;
        return $this;
    }


    /**
     * Get mainPageTitle
     *
     * @return string
     */
    public function getMainPageTitle()
    {
        return $this->mainPageTitle;
    }


    /**
     * Set mainPageTitle
     *
     * @param string $mainPageTitle
     * @return ResultHeader
     */
    public function setMainPageTitle($mainPageTitle)
    {
        $this->mainPageTitle = $mainPageTitle;
        return $this;
    }


    /**
     * Get viewCount
     *
     * @return int
     */
    public function getViewCount()
    {
        return $this->viewCount;
    }


    /**
     * Set viewCount
     *
     * @param int $viewCount
     * @return ResultHeader
     */
    public function setViewCount($viewCount)
    {
        $this->viewCount = $viewCount;
        return $this;
    }


    /**
     * Get status
     *
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }


    /**
     * Set status
     *
     * @param int $status
     * @return ResultHeader
     */
    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }


    /**
     * Get headerParagraph
     *
     * @return string
     */
    public function getHeaderParagraph()
    {
        return $this->headerParagraph;
    }


    /**
     * Set headerParagraph
     *
     * @param string $headerParagraph
     * @return ResultHeader
     */
    public function setHeaderParagraph($headerParagraph)
    {
        $this->headerParagraph = $headerParagraph;
        return $this;
    }


    /**
     * Add resultDetail
     *
     * @param ResultDetail $resultDetail
     * @return $this
     */
    public function addResultDetail(ResultDetail $resultDetail)
    {
        $resultDetail->setResultHeader($this);

        $this->resultDetails[] = $resultDetail;
        return $this;
    }


    /**
     * Remove resultDetail
     * @param ResultDetail $resultDetail
     */
    public function removeResultDetail(ResultDetail $resultDetail)
    {
        $this->resultDetails->removeElement($resultDetail);
    }


    /**
     * Get resultDetails
     *
     * @return ResultDetail[]|ArrayCollection
     */
    public function getResultDetails()
    {
        return $this->resultDetails;
    }
}