<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Task
 *
 * @ORM\Table(name="task")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TaskRepository")
 */
class Task
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
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="completed_at", type="datetime", nullable=true)
     */
    private $completedAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="due_at", type="datetime", nullable=true)
     */
    private $dueAt;

    /**
     * @var string
     *
     * @ORM\Column(name="priority", type="string", length=1, nullable=true)
     */
    private $priority;

    /**
     * @var Project
     *
     * Since there are _many_ tasks associated to _one_ project, we use `ManyToOne`. The value for `targetEntity` is
     * the class name or variable type for `$project`. The value for `inversedBy` is the name of the property defined
     * in 'src/AppBundle/Entity/Project.php' line 61.
     *
     * @ORM\ManyToOne(targetEntity="Project", inversedBy="tasks")
     */
    private $project;


    public function setProject(Project $project)
    {
        $this->project = $project;
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
     * Set completedAt
     *
     * @param \DateTime $completedAt
     *
     * @return Task
     */
    public function setCompletedAt($completedAt)
    {
        $this->completedAt = $completedAt;

        return $this;
    }

    /**
     * Get completedAt
     *
     * @return \DateTime
     */
    public function getCompletedAt()
    {
        return $this->completedAt;
    }

    /**
     * Set dueAt
     *
     * @param \DateTime $dueAt
     *
     * @return Task
     */
    public function setDueAt($dueAt)
    {
        $this->dueAt = $dueAt;

        return $this;
    }

    /**
     * Get dueAt
     *
     * @return \DateTime
     */
    public function getDueAt()
    {
        return $this->dueAt;
    }

    /**
     * Set priority
     *
     * @param string $priority
     *
     * @return Task
     */
    public function setPriority($priority)
    {
        $this->priority = $priority;

        return $this;
    }

    /**
     * Get priority
     *
     * @return string
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * Return whether this task has been completed or not.
     *
     * @return bool
     */
    public function isCompleted()
    {
        // The `(bool)` in this expression is called 'type casting'. This means changing the type of the value of `completedAt`
        // from its original type to the specified type, in this case, bool which is short for boolean (true or false).
        // If completedAt has a value, this will return to true. Otherwise, this will return false.
        return (bool) $this->completedAt;
    }
}

