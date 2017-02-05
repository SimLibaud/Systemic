<?php

namespace AppBundle\Entity;

/**
 * FinancialYear
 */
class FinancialYear
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var \DateTime
     */
    private $start;

    /**
     * @var \DateTime
     */
    private $end;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $missions;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $functions_assoc;

    /**
     * @var \AppBundle\Entity\Society
     */
    private $society;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->missions = new \Doctrine\Common\Collections\ArrayCollection();
        $this->functions_assoc = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set start
     *
     * @param \DateTime $start
     *
     * @return FinancialYear
     */
    public function setStart($start)
    {
        $this->start = $start;

        return $this;
    }

    /**
     * Get start
     *
     * @return \DateTime
     */
    public function getStart()
    {
        return $this->start;
    }

    /**
     * Set end
     *
     * @param \DateTime $end
     *
     * @return FinancialYear
     */
    public function setEnd($end)
    {
        $this->end = $end;

        return $this;
    }

    /**
     * Get end
     *
     * @return \DateTime
     */
    public function getEnd()
    {
        return $this->end;
    }

    /**
     * Add mission
     *
     * @param \AppBundle\Entity\Mission $mission
     *
     * @return FinancialYear
     */
    public function addMission(\AppBundle\Entity\Mission $mission)
    {
        $this->missions[] = $mission;

        return $this;
    }

    /**
     * Remove mission
     *
     * @param \AppBundle\Entity\Mission $mission
     */
    public function removeMission(\AppBundle\Entity\Mission $mission)
    {
        $this->missions->removeElement($mission);
    }

    /**
     * Get missions
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMissions()
    {
        return $this->missions;
    }

    /**
     * Add functionsAssoc
     *
     * @param \AppBundle\Entity\FunctionAssoc $functionsAssoc
     *
     * @return FinancialYear
     */
    public function addFunctionsAssoc(\AppBundle\Entity\FunctionAssoc $functionsAssoc)
    {
        $this->functions_assoc[] = $functionsAssoc;

        return $this;
    }

    /**
     * Remove functionsAssoc
     *
     * @param \AppBundle\Entity\FunctionAssoc $functionsAssoc
     */
    public function removeFunctionsAssoc(\AppBundle\Entity\FunctionAssoc $functionsAssoc)
    {
        $this->functions_assoc->removeElement($functionsAssoc);
    }

    /**
     * Get functionsAssoc
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFunctionsAssoc()
    {
        return $this->functions_assoc;
    }

    /**
     * Set society
     *
     * @param \AppBundle\Entity\Society $society
     *
     * @return FinancialYear
     */
    public function setSociety(\AppBundle\Entity\Society $society)
    {
        $this->society = $society;

        return $this;
    }

    /**
     * Get society
     *
     * @return \AppBundle\Entity\Society
     */
    public function getSociety()
    {
        return $this->society;
    }
    /**
     * @var \AppBundle\Entity\Organisation
     */
    private $organisation;


    /**
     * Set organisation
     *
     * @param \AppBundle\Entity\Organisation $organisation
     *
     * @return FinancialYear
     */
    public function setOrganisation(\AppBundle\Entity\Organisation $organisation)
    {
        $this->organisation = $organisation;

        return $this;
    }

    /**
     * Get organisation
     *
     * @return \AppBundle\Entity\Organisation
     */
    public function getOrganisation()
    {
        return $this->organisation;
    }
}
