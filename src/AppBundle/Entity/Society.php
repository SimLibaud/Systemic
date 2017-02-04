<?php

namespace AppBundle\Entity;

/**
 * Society
 */
class Society
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
     * @return Society
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
     * Add financialYear
     *
     * @param \AppBundle\Entity\FinancialYear $financialYear
     *
     * @return Society
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
}
