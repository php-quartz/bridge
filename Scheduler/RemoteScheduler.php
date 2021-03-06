<?php
namespace Quartz\Bridge\Scheduler;

use Quartz\Core\Calendar;
use Quartz\Core\JobDetail;
use Quartz\Core\Key;
use Quartz\Core\Scheduler;
use Quartz\Core\Trigger;

class RemoteScheduler implements Scheduler
{
    /**
     * @var RemoteTransport
     */
    private $transport;

    /**
     * @var RpcProtocol
     */
    private $rpcProtocol;

    /**
     * @param RemoteTransport $transport
     * @param RpcProtocol     $rpcProtocol
     */
    public function __construct(RemoteTransport $transport, RpcProtocol $rpcProtocol)
    {
        $this->transport = $transport;
        $this->rpcProtocol = $rpcProtocol;
    }

    /**
     * @param string $method
     * @param array  $args
     *
     * @return mixed
     *
     * @throws \Exception
     */
    private function call($method, array $args)
    {
        $request = $this->rpcProtocol->encodeRequest($method, $args);

        $response = $this->transport->request($request);

        $response = $this->rpcProtocol->decodeValue($response);

        if ($response instanceof \Exception) {
            throw $response;
        }

        return $response;
    }

    /**
     * {@inheritdoc}
     */
    public function start()
    {
        // TODO: Implement start() method.
    }

    /**
     * {@inheritdoc}
     */
    public function clear()
    {
        return $this->call(__FUNCTION__, func_get_args());
    }

    /**
     * {@inheritdoc}
     */
    public function scheduleJob(Trigger $trigger, JobDetail $jobDetail = null)
    {
        return $this->call(__FUNCTION__, func_get_args());
    }

    /**
     * {@inheritdoc}
     */
    public function addJob(JobDetail $jobDetail, $replace = false, $storeNonDurableWhileAwaitingScheduling = false)
    {
        return $this->call(__FUNCTION__, func_get_args());
    }

    /**
     * {@inheritdoc}
     */
    public function deleteJobs(array $jobKeys)
    {
        return $this->call(__FUNCTION__, func_get_args());
    }

    /**
     * {@inheritdoc}
     */
    public function unscheduleJobs(array $triggerKeys)
    {
        return $this->call(__FUNCTION__, func_get_args());
    }

    /**
     * {@inheritdoc}
     */
    public function unscheduleJob(Key $triggerKey)
    {
        return $this->call(__FUNCTION__, func_get_args());
    }

    /**
     * {@inheritdoc}
     */
    public function deleteJob(Key $jobKey)
    {
        return $this->call(__FUNCTION__, func_get_args());
    }

    /**
     * {@inheritdoc}
     */
    public function rescheduleJob(Key $triggerKey, Trigger $newTrigger)
    {
        return $this->call(__FUNCTION__, func_get_args());
    }

    /**
     * {@inheritdoc}
     */
    public function triggerJob(Key $jobKey, array $jobDataMap = [])
    {
        return $this->call(__FUNCTION__, func_get_args());
    }

    /**
     * {@inheritdoc}
     */
    public function pauseTrigger(Key $triggerKey)
    {
        return $this->call(__FUNCTION__, func_get_args());
    }

    /**
     * {@inheritdoc}
     */
    public function pauseJob(Key $jobKey)
    {
        return $this->call(__FUNCTION__, func_get_args());
    }

    /**
     * {@inheritdoc}
     */
    public function getPausedTriggerGroups()
    {
        return $this->call(__FUNCTION__, func_get_args());
    }

    /**
     * {@inheritdoc}
     */
    public function resumeTrigger(Key $triggerKey)
    {
        return $this->call(__FUNCTION__, func_get_args());
    }

    /**
     * {@inheritdoc}
     */
    public function resumeJob(Key $jobKey)
    {
        return $this->call(__FUNCTION__, func_get_args());
    }

    /**
     * {@inheritdoc}
     */
    public function pauseAll()
    {
        return $this->call(__FUNCTION__, func_get_args());
    }

    /**
     * {@inheritdoc}
     */
    public function resumeAll()
    {
        return $this->call(__FUNCTION__, func_get_args());
    }

    /**
     * {@inheritdoc}
     */
    public function getJobGroupNames()
    {
        return $this->call(__FUNCTION__, func_get_args());
    }

    /**
     * {@inheritdoc}
     */
    public function getTriggerGroupNames()
    {
        return $this->call(__FUNCTION__, func_get_args());
    }

    /**
     * {@inheritdoc}
     */
    public function getTriggersOfJob(Key $jobKey)
    {
        return $this->call(__FUNCTION__, func_get_args());
    }

    /**
     * {@inheritdoc}
     */
    public function getJobDetail(Key $jobKey)
    {
        return $this->call(__FUNCTION__, func_get_args());
    }

    /**
     * {@inheritdoc}
     */
    public function getTrigger(Key $triggerKey)
    {
        return $this->call(__FUNCTION__, func_get_args());
    }

    /**
     * {@inheritdoc}
     */
    public function getTriggerState(Key $triggerKey)
    {
        return $this->call(__FUNCTION__, func_get_args());
    }

    /**
     * {@inheritdoc}
     */
    public function addCalendar($calName, Calendar $calendar, $replace = false, $updateTriggers = false)
    {
        return $this->call(__FUNCTION__, func_get_args());
    }

    /**
     * {@inheritdoc}
     */
    public function deleteCalendar($calName)
    {
        return $this->call(__FUNCTION__, func_get_args());
    }

    /**
     * {@inheritdoc}
     */
    public function getCalendar($calName)
    {
        return $this->call(__FUNCTION__, func_get_args());
    }

    /**
     * {@inheritdoc}
     */
    public function getCalendarNames()
    {
        return $this->call(__FUNCTION__, func_get_args());
    }

    /**
     * {@inheritdoc}
     */
    public function checkJobExists(Key $jobKey)
    {
        return $this->call(__FUNCTION__, func_get_args());
    }

    /**
     * {@inheritdoc}
     */
    public function checkTriggerExists(Key $triggerKey)
    {
        return $this->call(__FUNCTION__, func_get_args());
    }

    /**
     * {@inheritdoc}
     */
    function resetTriggerFromErrorState(Key $triggerKey)
    {
        return $this->call(__FUNCTION__, func_get_args());
    }
}
