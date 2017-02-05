<?php

namespace AppBundle\Entity;

/**
 * Organisation
 */
class Organisation
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $description;

    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * @var string
     */
    private $slug;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $financial_years;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->financial_years = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Organisation
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Organisation
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Organisation
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
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return Organisation
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return Organisation
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Add financialYear
     *
     * @param \AppBundle\Entity\FinancialYear $financialYear
     *
     * @return Organisation
     */
    public function addFinancialYear(\AppBundle\Entity\FinancialYear $financialYear)
    {
        $this->financial_years[] = $financialYear;

        return $this;
    }

    /**
     * Remove financialYear
     *
     * @param \AppBundle\Entity\FinancialYear $financialYear
     */
    public function removeFinancialYear(\AppBundle\Entity\FinancialYear $financialYear)
    {
        $this->financial_years->removeElement($financialYear);
    }

    /**
     * Get financialYears
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFinancialYears()
    {
        return $this->financial_years;
    }

    public function hasChild()
    {
        return !$this->financial_years->isEmpty();
    }
}
