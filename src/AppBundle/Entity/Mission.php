<?php

namespace AppBundle\Entity;

/**
 * Mission
 */
class Mission
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
     * @var \AppBundle\Entity\Mission
     */
    private $child_mission;

    /**
     * @var \AppBundle\Entity\FinancialYear
     */
    private $financial_year;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $tasks;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->tasks = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Mission
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
     * @return Mission
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
     * Set childMission
     *
     * @param \AppBundle\Entity\Mission $childMission
     *
     * @return Mission
     */
    public function setChildMission(\AppBundle\Entity\Mission $childMission = null)
    {
        $this->child_mission = $childMission;

        return $this;
    }

    /**
     * Get childMission
     *
     * @return \AppBundle\Entity\Mission
     */
    public function getChildMission()
    {
        return $this->child_mission;
    }

    /**
     * Set financialYear
     *
     * @param \AppBundle\Entity\FinancialYear $financialYear
     *
     * @return Mission
     */
    public function setFinancialYear(\AppBundle\Entity\FinancialYear $financialYear)
    {
        $this->financial_year = $financialYear;

        return $this;
    }

    /**
     * Get financialYear
     *
     * @return \AppBundle\Entity\FinancialYear
     */
    public function getFinancialYear()
    {
        return $this->financial_year;
    }

    /**
     * Add task
     *
     * @param \AppBundle\Entity\Task $task
     *
     * @return Mission
     */
    public function addTask(\AppBundle\Entity\Task $task)
    {
        $this->tasks[] = $task;

        return $this;
    }

    /**
     * Remove task
     *
     * @param \AppBundle\Entity\Task $task
     */
    public function removeTask(\AppBundle\Entity\Task $task)
    {
        $this->tasks->removeElement($task);
    }

    /**
     * Get tasks
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTasks()
    {
        return $this->tasks;
    }
}
