<?php
namespace Madj2k\TwitterAnalyser\Utility;

/**
 * LogUtility
 *
 * @author Steffen Kroggel <developer@steffenkroggel.de>
 * @copyright Steffen Kroggel 2019
 * @package Madj2k_TwitterAnalyser
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class LogUtility
{

    /**
     * @const int
     */
    const LOG_DEBUG = 0;

    /**
     * @const int
     */
    const LOG_INFO = 1;

    /**
     * @const int
     */
    const LOG_WARNING = 2;

    /**
     * @const int
     */
    const LOG_ERROR = 3;


    /**
     * @var \Madj2k\TwitterAnalyser\Repository\LogRepository
     */
    protected $logRepository;


    /**
     * @var array
     */
    protected $settings;


    /**
     * Constructor
     *
     * @throws \Madj2k\TwitterAnalyser\Repository\RepositoryException
     * @throws \ReflectionException
     */
    public function __construct()
    {

        global $SETTINGS;
        $this->settings = &$SETTINGS;

        // set defaults
        $this->logRepository = new \Madj2k\TwitterAnalyser\Repository\LogRepository();

    }


    /**
     * Logs actions
     *
     * @param $level
     * @param $comment
     * @param $apiCall
     * @throws \Madj2k\TwitterAnalyser\Repository\RepositoryException
     */
    public function log ($level = LOG_DEBUG, $comment = '', $apiCall = '')
    {
        if (! in_array($level, range(0,4))){
            $level = self::LOG_DEBUG;
        }

        $dbt = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS,2);
        $method = isset($dbt[1]['function']) ? $dbt[1]['function'] : null;
        $class = isset($dbt[1]['class']) ? $dbt[1]['class'] : null;

        /** @var \Madj2k\TwitterAnalyser\Model\Log $log */
        $log = new \Madj2k\TwitterAnalyser\Model\Log();
        $log->setLevel($level)
            ->setClass($class)
            ->setMethod($method)
            ->setComment($comment)
            ->setApiCall($apiCall);

        $this->logRepository->insert($log);
    }
}