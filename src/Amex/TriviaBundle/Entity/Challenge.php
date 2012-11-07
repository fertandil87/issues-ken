<?php

namespace Amex\TriviaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Amex\TriviaBundle\Entity\Challenge
 */
class Challenge
{
    /**
     * @var integer $id
     */
    private $id;

    /**
     * @var string $question
     */
    private $question;

    /**
     * @var string $answer
     */
    private $answer;

    /**
     * @var \DateTime $date
     */
    private $date;

    /**
     * @var Amex\TriviaBundle\Entity\Type
     */
    private $type;


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
     * Set question
     *
     * @param string $question
     * @return Challenge
     */
    public function setQuestion($question)
    {
        $this->question = $question;
    
        return $this;
    }

    /**
     * Get question
     *
     * @return string 
     */
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * Set answer
     *
     * @param string $answer
     * @return Challenge
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
     * Set date
     *
     * @param \DateTime $date
     * @return Challenge
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
     * Set type
     *
     * @param Amex\TriviaBundle\Entity\Type $type
     * @return Challenge
     */
    public function setType(\Amex\TriviaBundle\Entity\Type $type = null)
    {
        $this->type = $type;
    
        return $this;
    }

    /**
     * Get type
     *
     * @return Amex\TriviaBundle\Entity\Type 
     */
    public function getType()
    {
        return $this->type;
    }
    public function __toString() {
        return '() '.$this->question.'['.$this->getType().']';
    }
}
