<?php
/**
 * $Id: auditoryLoyality.php 6 2006-08-20 10:51:26Z zerkms $
 *
 * Класс получения информации о лояльности аудитории за период
 *
 */

class auditoryLoyality extends simpleStat
{
    /**
     * Имя поля, по которому происходит группировка данных
     *
     * @var string
     */
    private $groupby;

    /**
     * Интервал по умолчанию
     * задаётся в насоедниках, если нужно
     *
     * @var string
     */
    protected $interval = '-30 days';

    /**
     * Метод получения отчёта
     *
     * @return array
     */
    public function get()
    {
        $this->groupby = $this->calcGroupby($this->start, $this->finish);

        return array('detail' => $this->getDetail(), 'dynamic' => $this->getDynamic(), 'groupby' => $this->groupby);

    }

    private function getDetail()
    {
		$connection = ConnectionPool::getInstance()->getConnection();
		$connection->query("DROP TEMPORARY TABLE IF EXISTS `tmp_users_loyality`");
		$connection->query("CREATE TEMPORARY TABLE `tmp_users_loyality` (`count` INT) ENGINE = MEMORY");
		$connection->query("INSERT INTO `tmp_users_loyality` SELECT COUNT(*) AS `cnt` FROM `cms_stat_paths` `p`
                      INNER JOIN `cms_stat_users` `u` ON `u`.`id` = `p`.`user_id` AND `u`.`first_visit` < `p`.`date`
                       WHERE `p`.`date` BETWEEN " . $this->getQueryInterval() . " " . $this->getHostSQL("p") . $this->getUserFilterWhere('p') .  "
                        GROUP BY `p`.`user_id`");
        return $this->simpleQuery("SELECT COUNT(*) AS `cnt`, IF(`count` > 10, IF(`count` > 20, IF(`count` > 30, IF(`count` > 40, IF(`count` > 50, 51, 41), 31), 21), 11), `count`) AS `visits_count` FROM `tmp_users_loyality`
                             GROUP BY `visits_count`");
    }

    private function getDynamic()
    {
        return $this->simpleQuery("SELECT COUNT(*) / COUNT(DISTINCT(`p`.`user_id`)) AS `avg`, `h`.`" . $this->groupby . "` AS `period`, UNIX_TIMESTAMP(`h`.`date`) AS `ts` FROM `cms_stat_hits` `h`
                                    INNER JOIN `cms_stat_paths` `p` ON `p`.`id` = `h`.`path_id`
                                     WHERE `h`.`date` BETWEEN " . $this->getQueryInterval() . " AND `h`.`number_in_path` = 1 " . $this->getHostSQL("p") . $this->getUserFilterWhere('p') . "
                                      GROUP BY `h`.`" . $this->groupby . "`, `h`.`year` ORDER BY `ts` ASC");

    }

    /**
     * Метод получения поля, по которому будет производиться группировка в зависимости от величины интервала
     *
     * @param integer $start
     * @param integer $finish
     * @return string
     *
     * @see auditoryVolumeGrowth::__construct()
     */
    private function calcGroupby($start, $finish)
    {
        $daysInterval = ceil(($finish - $start) / (3600 * 24));

        if ($daysInterval > 180) {
            return 'month';
        }
        return 'week';
    }
}

?>