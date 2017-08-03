# RockThatSymfony

## Day 2: Symfony and Doctrine ORM

Branch: day_2_doctrine_orm

The Code: The source code is _extra_ verbose. Inline comments were added to explain what important lines do. The ff files are where to find important stuff::

 * `src/AppBundle/Entity` - contains Project and Task entity classes
 * `src/AppBundle/Controller/ProjectController.php` - CRUD functionality for Project entity and controller action Doctrine type hinting
 * `src/AppBundle/Controller/TaskController.php` - Saving related entity - Project task
 * `src/AppBundle/Resources/views/Project/show.html.twig` - Using an entity on a twig template
