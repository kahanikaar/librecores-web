<?php

namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * A ProjectClassification represents a single classification for a Project
 *
 * A group of related categories can be used to classify the projects
 *
 * @author Sandip Kumar Bhuyan <sandipbhuyan@gmail.com>
 *
 * @ORM\Table(name="ProjectClassification")
 * @ORM\Entity
 */
class ProjectClassification
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * Classifiers for Project Classification
     *
     * This attribute holds the classifier for the classification of the
     * projects categories. The classification is a combination of categories.
     * Parent and child are separated by '::'.
     *
     * @var string
     *
     * @ORM\Column(name="classification", type="text")
     */
    private $classification;

    /**
     * Project entity object for a classification
     *
     * @var Project
     *
     * @ORM\ManyToOne(targetEntity="Project", inversedBy="classifications")
     * @ORM\JoinColumn(nullable=false, onDelete="CASCADE")
     */
    private $project;

    /**
     * ProjectClassification creation date/time
     *
     * @var DateTime
     *
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * User who added this classification to the project
     *
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(nullable=false)
     */
    private $createdBy;

    public function __construct()
    {
        $this->createdAt = new DateTime();
    }

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
     * Get classification
     *
     * @return string
     */
    public function getClassification()
    {
        return $this->classification;
    }

    /**
     * Set classification string for the Project
     *
     * @param string $classification
     *
     * @return ProjectClassification
     */
    public function setClassification($classification)
    {
        $this->classification = $classification;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set createdAt
     *
     * @param DateTime $createdAt
     *
     * @return ProjectClassification
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get project
     *
     * @return Project
     */
    public function getProject()
    {
        return $this->project;
    }

    /**
     * Set the Project for the given ProjectClassification object
     *
     * @param Project $project
     *
     * @return ProjectClassification
     */
    public function setProject(Project $project = null)
    {
        if ($this->project !== null) {
            $this->project->removeClassification($this);
        }

        if ($project !== null) {
            $project->addClassification($this);
        }

        $this->project = $project;

        return $this;
    }

    /**
     * Get createdBy
     *
     * @return User
     */
    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    /**
     * Set createdBy
     *
     * @param User $createdBy
     *
     * @return ProjectClassification
     */
    public function setCreatedBy(User $createdBy)
    {
        $this->createdBy = $createdBy;

        return $this;
    }
}
