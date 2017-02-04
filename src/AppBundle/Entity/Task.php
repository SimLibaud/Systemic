<?php

namespace AppBundle\Entity;

/**
 * Task
 */
class Task
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
    private $unity;

    /**
     * @var \AppBundle\Entity\FunctionAssoc
     */
    private $function_assoc;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $missions;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->missions = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Task
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
     * Set unity
     *
     * @param string $unity
     *
     * @return Task
     */
    public function setUnity($unity)
    {
        $this->unity = $unity;

        return $this;
    }

    /**
     * Get unity
     *
     * @return string
     */
    public function getUnity()
    {
        return $this->unity;
    }

    /**
     * Set functionAssoc
     *
     * @param \AppBundle\Entity\FunctionAssoc $functionAssoc
     *
     * @return Task
     */
    public function setFunctionAssoc(\AppBundle\Entity\FunctionAssoc $functionAssoc = null)
    {
        $this->function_assoc = $functionAssoc;

        return $this;
    }

    /**
     * Get functionAssoc
     *
     * @return \AppBundle\Entity\FunctionAssoc
     */
    public function getFunctionAssoc()
    {
        return $this->function_assoc;
    }

    /**
     * Add mission
     *
     * @param \AppBundle\Entity\Mission $mission
     *
     * @return Task
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
}
