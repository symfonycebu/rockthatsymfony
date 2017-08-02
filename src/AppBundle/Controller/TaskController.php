<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Project;
use AppBundle\Entity\Task;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class TaskController extends Controller
{
    /**
     * @Route("/project/{id}/task/new")
     */
    public function newAction(Project $project)
    {
        // create a new Task entity and set its property values.
        $task = new Task();
        $task->setName('Book a hotel');
        $task->setPriority('A');

        // set the association between `$task` and `$project`
        $task->setProject($project);

        // get an instance of the EntityManager
        $em = $this->getDoctrine()->getManager();
        // Since task is a new object, we need to call `persist` method
        $em->persist($task);
        // actually perform the operation. In this case, it will be INSERT.
        $em->flush();

        dump($task);

        return $this->render('AppBundle:Task:new.html.twig', array(
            // ...
        ));
    }

}
