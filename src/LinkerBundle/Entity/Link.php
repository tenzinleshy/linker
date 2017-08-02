<?php

namespace LinkerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use LinkerBundle\Validator\Constraints as LinkerAssert;

use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Link
 *
 * @ORM\Table(name="link")
 * @ORM\Entity(repositoryClass="LinkerBundle\Repository\LinkRepository")
 * @UniqueEntity("shortUrlId")
 */
class Link
{
    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @LinkerAssert\ContainsHttpStatusCode
     *
     * @ORM\Column(type="string", length=1024)
     */
    private $url;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=20, unique=true)
     */
    private $shortUrlId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @var int
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    private $usesCount;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set url
     *
     * @param string $url
     *
     * @return Link
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set shortUrlId
     *
     * @param string $shortUrlId
     *
     * @return Link
     */
    public function setShortUrlId($shortUrlId)
    {
        $this->shortUrlId = $shortUrlId;

        return $this;
    }

    /**
     * Get shortUrlId
     *
     * @return string
     */
    public function getShortUrlId()
    {
        return $this->shortUrlId;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Link
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

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
     * Set usesCount
     *
     * @param integer $usesCount
     *
     * @return Link
     */
    public function setUsesCount($usesCount)
    {
        $this->usesCount = $usesCount;

        return $this;
    }

    /**
     * Get usesCount
     *
     * @return int
     */
    public function getUsesCount()
    {
        return $this->usesCount;
    }
}

