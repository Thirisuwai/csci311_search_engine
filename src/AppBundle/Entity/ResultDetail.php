<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * Class ResultDetail
 * @package AppBundle\Entity
 * @ORM\Entity()
 * @ORM\Table(name="ResultDetail")
 */
class ResultDetail
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type"integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string $subDirectoryAddress
     *
     * @ORM\Column(name="sub_directory_address", type="string", length=255)
     */
    protected $subDirectoryAddress;

    /**
     * @var string $subDirectoryName
     *
     * @ORM\Column(name="sub_directory_name", type="string", length=255)
     */
    protected $subDirectoryName;

    /**
     * @var string $subDirectoryTitle
     *
     * @ORM\Column(name="sub_directory_name", type="string", length=255)
     */
    protected $subDirectoryTitle;

    /**
     * @var string $subDirectoryParagraph
     *
     * @ORM\Column(name="sub_directory_paragraph", type="string", length=255)
     */
    protected $subDirectoryParagraph;

    /**
     * @var \DateTime $createdAt
     *
     * @ORm\Column(name="created_at", type="datetime")
     */
    protected $createdAt;

    /**
     * @var ResultHeader $resultHeader
     *
     * @ORM\ManyToOne(targetEntity="ResultHeader", inversedBy="resultDetails")
     * @ORM\JoinColumn(name="result_header_id", referencedColumnName="id")
     */
    protected $resultHeader;

    ///////////////////////
    //  Methods
    ///////////////////////

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
     * Get subDirectoryAddress
     *
     * @return string
     */
    public function getSubDirectoryAddress()
    {
        return $this->subDirectoryAddress;
    }


    /**
     * Set subDirectoryAddress
     *
     * @param string $subDirectoryAddress
     * @return ResultDetail
     */
    public function setSubDirectoryAddress($subDirectoryAddress)
    {
        $this->subDirectoryAddress = $subDirectoryAddress;
        return $this;
    }


    /**
     * Get subDirectoryName
     *
     * @return string
     */
    public function getSubDirectoryName()
    {
        return $this->subDirectoryName;
    }


    /**
     * Set subDirectoryName
     *
     * @param string $subDirectoryName
     * @return ResultDetail
     */
    public function setSubDirectoryName($subDirectoryName)
    {
        $this->subDirectoryName = $subDirectoryName;
        return $this;
    }


    /**
     * Get subDirectoryTitle
     *
     * @return string
     */
    public function getSubDirectoryTitle()
    {
        return $this->subDirectoryTitle;
    }


    /**
     * Set subDirectoryTitle
     *
     * @param string $subDirectoryTitle
     * @return ResultDetail
     */
    public function setSubDirectoryTitle($subDirectoryTitle)
    {
        $this->subDirectoryTitle = $subDirectoryTitle;
        return $this;
    }


    /**
     * Get subDirectoryParagraph
     *
     * @return string
     */
    public function getSubDirectoryParagraph()
    {
        return $this->subDirectoryParagraph;
    }


    /**
     * Set subDirectoryParagraph
     *
     * @param string $subDirectoryParagraph
     * @return ResultDetail
     */
    public function setSubDirectoryParagraph($subDirectoryParagraph)
    {
        $this->subDirectoryParagraph = $subDirectoryParagraph;
        return $this;
    }


    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }


    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return ResultDetail
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
        return $this;
    }


    /**
     * Get resultHeader
     *
     * @return int
     */
    public function getResultHeader()
    {
        return $this->resultHeader;
    }


    /**
     * Set resultHeader
     *
     * @param ResultHeader $resultHeader
     * @return ResultDetail
     */
    public function setResultHeader(ResultHeader $resultHeader)
    {
        $this->resultHeader = $resultHeader;
        return $this;
    }
}