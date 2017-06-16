<?php
namespace Quartz\App\Console;

use Enqueue\Consumption\ChainExtension;
use Enqueue\Consumption\Extension\LoggerExtension;
use Enqueue\Consumption\Extension\ReplyExtension;
use Quartz\App\LoggerSubscriber;
use Quartz\App\RemoteScheduler;
use Quartz\App\SchedulerFactory;
use Quartz\App\Async\EnqueueJobRunShell;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Logger\ConsoleLogger;
use Symfony\Component\Console\Output\OutputInterface;

class WorkerCommand extends Command
{
    /**
     * SchedulerFactory
     */
    private $factory;

    /**
     * @param SchedulerFactory $scheduler
     */
    public function __construct(SchedulerFactory $scheduler)
    {
        parent::__construct('worker');

        $this->factory = $scheduler;
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $enqueue = $this->factory->getEnqueue();

        $scheduler = $this->factory->getScheduler();
        $logger = new LoggerSubscriber(new ConsoleLogger($output));
        $scheduler->getEventDispatcher()->addSubscriber($logger);

        $jobRunShell = $this->factory->getJobRunShellProcessor();
        $enqueue->bind(EnqueueJobRunShell::COMMAND, EnqueueJobRunShell::COMMAND, function($message, $context) use ($jobRunShell) {
            return $jobRunShell->process($message, $context);
        });

        $remoteScheduler = $this->factory->getRemoteSchedulerProcessor();
        $enqueue->bind(RemoteScheduler::COMMAND, RemoteScheduler::COMMAND, function($message, $context) use ($remoteScheduler) {
            return $remoteScheduler->process($message, $context);
        });

        $extensions = new ChainExtension([new ReplyExtension(), new LoggerExtension(new ConsoleLogger($output))]);

        $enqueue->consume($extensions);
    }
}
