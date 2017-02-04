<?php

namespace AppBundle\Entity;

/**
 * JobAttribut
 */
class JobAttribut
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $monthly_gross_salary;

    /**
     * @var string
     */
    private $monthly_charge;

    /**
     * @var string
     */
    private $monthly_employer_contribution;

    /**
     * @var string
     */
    private $annual_employer_aid;

    /**
     * @var string
     */
    private $annual_effective_working_time;

    /**
     * @var string
     */
    private $annual_real_hour;

    /**
     * @var string
     */
    private $annual_net;

    /**
     * @var string
     */
    private $bounty;

    /**
     * @var string
     */
    private $avantage;


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
     * Set monthlyGrossSalary
     *
     * @param string $monthlyGrossSalary
     *
     * @return JobAttribut
     */
    public function setMonthlyGrossSalary($monthlyGrossSalary)
    {
        $this->monthly_gross_salary = $monthlyGrossSalary;

        return $this;
    }

    /**
     * Get monthlyGrossSalary
     *
     * @return string
     */
    public function getMonthlyGrossSalary()
    {
        return $this->monthly_gross_salary;
    }

    /**
     * Set monthlyCharge
     *
     * @param string $monthlyCharge
     *
     * @return JobAttribut
     */
    public function setMonthlyCharge($monthlyCharge)
    {
        $this->monthly_charge = $monthlyCharge;

        return $this;
    }

    /**
     * Get monthlyCharge
     *
     * @return string
     */
    public function getMonthlyCharge()
    {
        return $this->monthly_charge;
    }

    /**
     * Set monthlyEmployerContribution
     *
     * @param string $monthlyEmployerContribution
     *
     * @return JobAttribut
     */
    public function setMonthlyEmployerContribution($monthlyEmployerContribution)
    {
        $this->monthly_employer_contribution = $monthlyEmployerContribution;

        return $this;
    }

    /**
     * Get monthlyEmployerContribution
     *
     * @return string
     */
    public function getMonthlyEmployerContribution()
    {
        return $this->monthly_employer_contribution;
    }

    /**
     * Set annualEmployerAid
     *
     * @param string $annualEmployerAid
     *
     * @return JobAttribut
     */
    public function setAnnualEmployerAid($annualEmployerAid)
    {
        $this->annual_employer_aid = $annualEmployerAid;

        return $this;
    }

    /**
     * Get annualEmployerAid
     *
     * @return string
     */
    public function getAnnualEmployerAid()
    {
        return $this->annual_employer_aid;
    }

    /**
     * Set annualEffectiveWorkingTime
     *
     * @param string $annualEffectiveWorkingTime
     *
     * @return JobAttribut
     */
    public function setAnnualEffectiveWorkingTime($annualEffectiveWorkingTime)
    {
        $this->annual_effective_working_time = $annualEffectiveWorkingTime;

        return $this;
    }

    /**
     * Get annualEffectiveWorkingTime
     *
     * @return string
     */
    public function getAnnualEffectiveWorkingTime()
    {
        return $this->annual_effective_working_time;
    }

    /**
     * Set annualRealHour
     *
     * @param string $annualRealHour
     *
     * @return JobAttribut
     */
    public function setAnnualRealHour($annualRealHour)
    {
        $this->annual_real_hour = $annualRealHour;

        return $this;
    }

    /**
     * Get annualRealHour
     *
     * @return string
     */
    public function getAnnualRealHour()
    {
        return $this->annual_real_hour;
    }

    /**
     * Set annualNet
     *
     * @param string $annualNet
     *
     * @return JobAttribut
     */
    public function setAnnualNet($annualNet)
    {
        $this->annual_net = $annualNet;

        return $this;
    }

    /**
     * Get annualNet
     *
     * @return string
     */
    public function getAnnualNet()
    {
        return $this->annual_net;
    }

    /**
     * Set bounty
     *
     * @param string $bounty
     *
     * @return JobAttribut
     */
    public function setBounty($bounty)
    {
        $this->bounty = $bounty;

        return $this;
    }

    /**
     * Get bounty
     *
     * @return string
     */
    public function getBounty()
    {
        return $this->bounty;
    }

    /**
     * Set avantage
     *
     * @param string $avantage
     *
     * @return JobAttribut
     */
    public function setAvantage($avantage)
    {
        $this->avantage = $avantage;

        return $this;
    }

    /**
     * Get avantage
     *
     * @return string
     */
    public function getAvantage()
    {
        return $this->avantage;
    }
}
