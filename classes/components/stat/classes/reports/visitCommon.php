<?php

	/** Класс получения обобщённого отчета о посещаемости */
	class visitCommon extends simpleStat {

		/** @var integer число выходных за период */
		private $holidays_count = 0;

		/** @var integer число будней за период */
		private $routine_count = 0;

		/** @inheritdoc */
		public function __construct($finish = null, $interval = null) {
			$finish = time();
			parent::__construct($finish);
		}

		/** @inheritdoc */
		public function get() {
			$arrDetail = $this->getDetail();
			return [
				'detail' => $arrDetail['all'],
				'avg' => $this->getAvg(),
				'summ' => $this->getSumm(),
				'total' => $arrDetail['total']
			];
		}

		/**
		 * Возвращает общую посещаемость
		 * @return int
		 */
		private function getSumm() {
			$this->setUpVars();
			$sQrInterval = $this->getQueryInterval();

			$sQr = '
				SELECT
					COUNT(*) AS `cnt`
				FROM
					`cms_stat_hits` `h`
									INNER JOIN
						`cms_stat_pages` `p` ON `p`.`id` = `h`.`page_id`
						INNER JOIN `cms_stat_paths` `pth` ON `pth`.`id` = `h`.`path_id`
				WHERE
					`h`.`date` BETWEEN ' . $sQrInterval . '
					 ' . $this->getHostSQL('p') . $this->getUserFilterWhere('pth') . '
				ORDER BY
					`h`.`date` ASC';

			$resSumm = $this->simpleQuery($sQr);
			return (int) $resSumm[0]['cnt'];
		}

		/**
		 * Возвразает сводный отчет о числе посещений за каждый из дней выбранного интервала
		 * @return array
		 */
		private function getDetail() {
			$this->setUpVars();
			$all = $this->simpleQuery('SELECT SQL_CALC_FOUND_ROWS COUNT(*) AS `cnt`, UNIX_TIMESTAMP(h.`date`) AS `ts` FROM `cms_stat_hits` `h`
								  INNER JOIN `cms_stat_pages` `p` ON `p`.`id` = `h`.`page_id`
								  INNER JOIN `cms_stat_paths` `pth` ON `pth`.`id` = `h`.`path_id`
								   WHERE `h`.`date` BETWEEN ' . $this->getQueryInterval() . ' ' . $this->getHostSQL('p') .
				$this->getUserFilterWhere('pth') . '
									GROUP BY `h`.`day`, h.`month`
									 ORDER BY `ts` ASC', true);

			$res = $this->simpleQuery('SELECT FOUND_ROWS() as `total`');
			$i_total = (int) $res[0]['total'];
			return [
				'all' => $all,
				'total' => $i_total
			];
		}

		/**
		 * Возвращает среднего числа посещений за выходные и будни
		 * @return array
		 * @throws Exception
		 */
		private function getAvg() {
			$this->setUpVars();
			$connection = ConnectionPool::getInstance()->getConnection();
			$qry = "(SELECT 'routine' AS `type`, COUNT(*) / " . $this->routine_count . '.0 AS `avg` FROM `cms_stat_hits` `h`
					 LEFT JOIN `cms_stat_holidays` `holidays` ON `h`.`day` = `holidays`.`day` AND `h`.`month` = `holidays`.`month`
					  INNER JOIN `cms_stat_pages` `p` ON `p`.`id` = `h`.`page_id`
					   WHERE `date` BETWEEN ' . $this->getQueryInterval() . '  ' . $this->getHostSQL('p') . "
					   AND `day_of_week` BETWEEN 1 AND 5 AND `holidays`.`id` IS NULL)
					UNION
					(SELECT 'weekend' AS `type`, COUNT(*) / " . $this->holidays_count . '.0 AS `avg` FROM `cms_stat_hits` `h`
					 LEFT JOIN `cms_stat_holidays` `holidays` ON `h`.`day` = `holidays`.`day` AND `h`.`month` = `holidays`.`month`
					  INNER JOIN `cms_stat_pages` `p` ON `p`.`id` = `h`.`page_id`
					   WHERE `date` BETWEEN ' . $this->getQueryInterval() . '  ' . $this->getHostSQL('p') . '
						AND (`day_of_week` NOT BETWEEN 1 AND 5 OR `holidays`.`id` IS NOT NULL))';
			$queryResult = $connection->queryResult($qry);
			$queryResult->setFetchType(IQueryResult::FETCH_ASSOC);

			$result = [];

			foreach ($queryResult as $row) {
				$result[$row['type']] = $row['avg'];
			}

			return $result;
		}

		/** Устанавливает количество выходных и будней */
		private function setUpVars() {
			$res = holidayRoutineCounter::count($this->start, $this->finish);
			$this->holidays_count = $res['holidays'];
			$this->routine_count = $res['routine'];
		}
	}

