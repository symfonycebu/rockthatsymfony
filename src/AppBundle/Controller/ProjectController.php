<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Project;
use AppBundle\Entity\Task;
use AppBundle\Repository\TaskRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Class ProjectController
 *
 * Controller class for performing CRUD operations to `Project` entity. Remember to extend
 * `Symfony\Bundle\FrameworkBundle\Controller\Controller` to have to the method `getDoctrine()`.
 *
 * This class can be generated using `bin/console generate:controller`
 *
 * @package AppBundle\Controller
 */
class ProjectController extends Controller
{
    /**
     * Create a new project
     *
     * @Route("/project/new")
     */
    public function newAction()
    {
        // create a new Project entity and set its properties using the setter(s). An entity is a plain PHP object
        // that holds data.
        $project = new Project();
        $project->setName('Rock That Symfony');

        // get instance of the EntityManager. The EntityManager class is responsible for saving the data from the
        // entities to the database.
        $em = $this->getDoctrine()->getManager();
        $em->persist($project); // tell EntityManager that $project entity needs to be saved
        $em->flush(); // tell EntityManager to actually perform the operation, in this case, perform an INSERT statement.

        return $this->render('AppBundle:Project:new.html.twig', array(
            // ...
        ));
    }

    /**
     * Show an existing project along with its related tasks. If project does not exist, show 404
     *
     * This route uses `id` as a route parameter, which is a placeholder for an actual value provided in the URL. For example,
     * the route "/project/1" will find an instance of `Project` with the `id` equal to "1". This is
     * done automatically by Symfony by type hinting the parameter `$project` as `Project` in this method.
     *
     * For more information, search for "PHP type hinting" and "Symfony ParamConverter" or go to any of the ff links:
     * Related Links: https://symfony.com/doc/current/bundles/SensioFrameworkExtraBundle/annotations/converters.html
     * Related Links: http://php.net/manual/en/functions.arguments.php#functions.arguments.type-declaration
     * Related Links: https://symfony.com/doc/current/best_practices/controllers.html#using-the-paramconverter
     *
     * @Route("/project/{id}")
     */
    public function showAction(Project $project)
    {
        // get the Repository class of Task entity. A Repository is a class containing methods for retrieving Task entities
        /** @var TaskRepository $task_repository */
        $task_repository = $this->getDoctrine()->getRepository(Task::class);
        $tasks = $task_repository->getIncompleteTasks($project);

        return $this->render('AppBundle:Project:show.html.twig', array(
            'tasks' => $tasks,
            'project' => $project
        ));
    }

    /**
     * Edit a project
     *
     * @Route("/project/{id}/edit")
     */
    public function editAction($id)
    {
        // get an instance of ProjectRepository. This mapping is set in `src/AppBundle/Entity/Project.php line 12.
        $repository = $this->getDoctrine()->getRepository(Project::class);
        // Use `find` method to find an Entity by its `id` property. Other convenience methods are `findBy`, `findOne`, `findAll`
        $project = $repository->find($id);

        $project->setDescription('Prepare, Plan, Party, Enjoy!');

        $em = $this->getDoctrine()->getManager();

        // tell EntityManager to actually perform the needed action. In this case, we updated the property `description`
        // of `$project` entity using its setter method. EntityManager will recognize that the `$project` entity needs to
        // be updated and so will perform an "UPDATE" statement.
        $em->flush();

        // `dump` is a Symfony helper method for debugging/showing a variable in the developer toolbar.
        dump($project);

        return $this->render('AppBundle:Project:edit.html.twig', array(
            // ...
        ));
    }

    /**
     * Remove a project
     * @Route("/project/{id}/delete")
     */
    public function deleteAction(Project $project)
    {
        $em = $this->getDoctrine()->getManager();
        // tell the EntityManager that the `$project" entity should be removed.
        $em->remove($project);
        // tell EntityManager to actually perform the delete or remove operation in the database.
        $em->flush();

        return $this->render('AppBundle:Project:delete.html.twig', array(
            // ...
        ));
    }

}
