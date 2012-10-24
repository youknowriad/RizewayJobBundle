<?php

namespace Rizeway\JobBundle\Logger;

use Rizeway\JobBundle\Entity\Job;

interface JobLoggerInterface extends LoggerInterface
{
    /**
     * @param \Rizeway\JobBundle\Entity\Job $job
     */
    public function setJob(Job $job);
}
