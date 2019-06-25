<?php
namespace Madj2k\TwitterAnalyser\Repository;


/**
 * LogRepository
 *
 * @author Steffen Kroggel <developer@steffenkroggel.de>
 * @copyright Steffen Kroggel 2019
 * @package Madj2k_TwitterAnalyser
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */

class LogRepository extends RepositoryAbstract
{

    /**
     * Find all by level and time
     *
     * @param int $level
     * @param int $maxTime
     * @return array|null
     * @throws \Madj2k\TwitterAnalyser\Repository\RepositoryException
     */
    public function findAllByLevelAndTime (int $level, int $maxTime = 0)
    {

        $sql = 'SELECT * FROM ' . $this->table . ' WHERE level >= ? AND create_timestamp >= ? ORDER BY create_timestamp ASC';

        $result = $this->_findAll($sql, [$level, $maxTime]);
        return $result;
    }

}