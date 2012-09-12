RizewayJobBundle
================

A simple job bundle for symfony 2 projects (with doctrine)

Installation
------------

1. Add this bundle into your project *composer.json* file:
    
    ```json
    "require": {
      "rizeway/job-bundle": "dev-master"
    },
    ```
2. Update your composer dependancies.

    composer.phar update

3. Register this bundle in your *app/AppKernel.php*

    ```php
    <?php
    
    public function registerBundles()
    {
        $bundles = array(
            // ...some other bundles...
            new Rizeway\JobBundle\RizewayJobBundle(),
        );
    ```

4. Update your database schema

    php app/console doctrine:database:update --force


Usage
-----

1. Add the daemon to your cron tab

    php app/console rizeway:job:daemon

2. Creating a Job

A job is a class that implements Rizeway/JobBundle/JobHandler/JobHandlerInterface (you can also extends Rizeway/JobBundle/JobHandler/ContainerAwareJobHandler)

Example:

```php
<?php

namespace MyBundle\JobHandler;

use Rizeway\JobBundle\JobHandler\ContainerAwareJobHandler;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class MyJobHandler extends ContainerAwareJobHandler
{
    protected function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setRequired(array(
            'my_required_option',
        ));
    }

    public function run()
    {
        $this->log('My Option Is : '.$this->getOption('my_required_option'));
        ....
    }
```

3. Scheduling a job 

Scheduling a job is done like this

```php
<?php

namespace MyBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Rizeway\JobBundle\Entity\Job;

class myController extends Controller
{
    public function myAction()
    {
        $job = new Job();
        $job->setName('Job Name');
        $job->setType('Job Type');
        $job->setClassname('\MyBundle\JobHandler\MyJobHandler');
        $job->setOptions(array(
            'my_required_option'   => 'option_value'
        ));

        $this->getDoctrine()->getEntityManager()->persist($job);
        $this->getDoctrine()->getEntityManager()->flush();
        ....
    }
```