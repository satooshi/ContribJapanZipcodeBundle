<?php

namespace Contrib\JapanZipcodeBundle\Command;

use Contrib\CommonBundle\Command\AbstractCommand;

abstract class BaseCommand extends AbstractCommand
{
    /**
     * Default connection name.
     *
     * @var string
     */
    protected $defaultConnection = 'batch';
}
