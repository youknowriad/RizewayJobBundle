<?php

namespace Rizeway\JobBundle\JobHandler;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Rizeway\JobBundle\Logger\JobLoggerInterface;

abstract class JobHandler implements JobHandlerInterface
{
    private $options = array();
    private $logger;

    public function setOptions(array $options)
    {
        $resolver = new OptionsResolver();
        $this->setDefaultOptions($resolver);

        $this->options = $resolver->resolve($options);
    }

    public function setLogger(JobLoggerInterface $logger = null)
    {
        $this->logger = $logger;
    }

    public function getLogger()
    {
        return $this->logger;
    }

    protected function log($message, $priority = JobLoggerInterface::PRIORITY_INFO)
    {
        if (!is_null($this->logger)) {
            $this->logger->log($message, $priority);
        }
    }

    protected function getOption($key)
    {
        return $this->options[$key];
    }

    abstract protected function setDefaultOptions(OptionsResolverInterface $resolver);
}