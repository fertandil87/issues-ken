<?php

namespace Amex\TriviaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Amex\TriviaBundle\Entity\UserAnswer
 */
class UserAnswer
{
    /**
     * @var integer $id
     */
    private $id;

    /**
     * @var string $answer
     */
    private $answer;

    /**
     * @var integer $responseTime
     */
    private $responseTime;

    /**
     * @var integer $rightAnswer
     */
    private $rightAnswer;

    /**
     * @var \DateTime $date
     */
    private $date;

    /**
     * @var Amex\TriviaBundle\Entity\User
     */
    private $user;

    /**
     * @var Amex\TriviaBundle\Entity\Challenge
     */
    private $challenge;


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
     * Set answer
     *
     * @param string $answer
     * @return UserAnswer
     */
    public function setAnswer($answer)
    {
        $this->answer = $answer;
    
        return $this;
    }

    /**
     * Get answer
     *
     * @return string 
     */
    public function getAnswer()
    {
        return $this->answer;
    }

    /**
     * Set responseTime
     *
     * @param integer $responseTime
     * @return UserAnswer
     */
    public function setResponseTime($responseTime)
    {
        $this->responseTime = $responseTime;
    
        return $this;
    }

    /**
     * Get responseTime
     *
     * @return integer 
     */
    public function getResponseTime()
    {
        return $this->responseTime;
    }

    /**
     * Set rightAnswer
     *
     * @param integer $rightAnswer
     * @return UserAnswer
     */
    public function setRightAnswer($rightAnswer)
    {
        $this->rightAnswer = $rightAnswer;
    
        return $this;
    }

    /**
     * Get rightAnswer
     *
     * @return integer 
     */
    public function getRightAnswer()
    {
        return $this->rightAnswer;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return UserAnswer
     */
    public function setDate($date)
    {
        $this->date = $date;
    
        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set user
     *
     * @param Amex\TriviaBundle\Entity\User $user
     * @return UserAnswer
     */
    public function setUser(\Amex\TriviaBundle\Entity\User $user = null)
    {
        $this->user = $user;
    
        return $this;
    }

    /**
     * Get user
     *
     * @return Amex\TriviaBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set challenge
     *
     * @param Amex\TriviaBundle\Entity\Challenge $challenge
     * @return UserAnswer
     */
    public function setChallenge(\Amex\TriviaBundle\Entity\Challenge $challenge = null)
    {
        $this->challenge = $challenge;
    
        return $this;
    }

    /**
     * Get challenge
     *
     * @return Amex\TriviaBundle\Entity\Challenge 
     */
    public function getChallenge()
    {
        return $this->challenge;
    }
    
    
}
