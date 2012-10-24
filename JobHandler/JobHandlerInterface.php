<?php

namespace Rizeway\JobBundle\JobHandler;

use Rizeway\JobBundle\Logger\JobLoggerInterface;

interface JobHandlerInterface
{
    public function setOptions(array $options);
    public function setLogger(JobLoggerInterface $logger = null);
    public function run();
}