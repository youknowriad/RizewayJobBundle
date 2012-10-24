<?php

namespace Rizeway\JobBundle\Logger;

use Rizeway\JobBundle\Entity\JobLog;
use Rizeway\JobBundle\Entity\Job;
use Doctrine\ORM\EntityManager;

class DoctrineLogger implements JobLoggerInterface
{
    protected $job;
    protected $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function log($message, $priority = self::PRIORITY_INFO)
    {
        $log = new JobLog();
        $log->setJob($this->job);
        $log->setMessage($message);
        $log->setPriority($priority);

        $this->em->persist($log);
        $this->em->flush();
    }

    /**
     * @param \Rizeway\JobBundle\Entity\Job $job
     */
    public function setJob(Job $job)
    {
        $this->job = $job;
    }
}
