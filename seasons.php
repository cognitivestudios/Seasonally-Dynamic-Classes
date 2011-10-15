<?php

/**	Seasonal Dynamic CSS Class/ID Assignment
 *	Author:		Andy Smith, Cognitive Studios
 *	Copyright:	(c) 2011, Cognitive Studios
 *
 *	License:	CC BY 3.0
 *				http://creativecommons.org/licenses/by/3.0/
 *
 *	Disclaimer:	This software is provided as-is, without any warranty of any kind.		
 */
 
// ------------------------------------------------------------------------


// Assign a date/time to test what will results will be, or use server time.

//$now = mktime(00,00,00,12,25,11);
$now = time();

/* Uncomment this line to write the configured time to output. Disable for live use.  */
// echo "Configured Time = $now ".date('m-d-Y', $now)."\n\n";

/*
 *	Configure seasons in the following array.
 * 	Each line except last ends with a comma.
 *	new season('Long Name', 'class name', 'start month', 'start date', 'end month', 'end date'),
 */
$seasons = array(
	new season('Christmas', 'christmas', '12', '01', '01', '06'),
	new season('Spring', 'spring', '03', '21', '06', '21'),
	new season('Summer', 'summer', '06', '21', '09', '21'),
	new season('Autumn', 'autumn', '09', '21', '12', '21'),
	new season('Winter', 'winter', '12', '21', '03', '21'),
	new season('Tax Day', 'taxday', '04', '15', '04', '15')
	);


/*** END OF CONFIGURABLES ***/

function print_active_seasons($seasons)
{
	foreach($seasons as $s)
	{
		$s->print_active_class();
	}
}

class season
{
	private $season_title = '';
	private $season_class_name = '';
	private $season_start;
	private $season_end;
	private $season_active = FALSE;

	function __construct($title = '', $class_name = '', $start_month = '', $start_date = '', $end_month = '', $end_date = '')
	{
		$this->season_title = $title;
		$this->season_class_name = $class_name;
		$this->set_active_range($start_month, $start_date, $end_month, $end_date);
		$this->set_active();
	}


	private function set_active_range($start_m, $start_d, $end_m, $end_d)
	{
		global $now;

		$year = date('Y', $now);
		$start_index	= ($start_m * 100) + $start_d;
		$end_index 		= ($end_m * 100) + $end_d;

		if($start_index <= $end_index)
		{
			$this->set_start($start_m, $start_d, $year);
			$this->set_end($end_m, $end_d, $year);
		}
		elseif($start_index > $end_index)
		{
			$now_index = (date('m', $now) * 100) + date('d', $now);
			if($now_index > $end_index)
			{
				$start_y = $year;
				$end_y = $year + 1;
				$this->set_start($start_m, $start_d, $start_y);
				$this->set_end($end_m, $end_d, $end_y);
			}
			elseif($now_index <= $end_index)
			{
				$start_y = $year - 1;
				$end_y = $year;
				$this->set_start($start_m, $start_d, $start_y);
				$this->set_end($end_m, $end_d, $end_y);
			}
		}
	}

	private function set_start($m, $d, $y)
	{
		$start = mktime(00, 00, 00, $m, $d, $y);
		$this->season_start = $start;
	}

	private function set_end($m, $d, $y)
	{
		$end = mktime(23, 59, 59, $m, $d, $y);
		$this->season_end = $end;
	}

	private function set_active()
	{
		global $now;
		if($now >= $this->season_start && $now <= $this->season_end)
		{
			$this->season_active = TRUE;
		}
	}

	private function get_class_name()
	{
		return $this->season_class_name;
	}

	private function is_active()
	{
		return $this->season_active;
	}

	public function print_active_class()
	{
		if($this->is_active())
		{
			echo $this->get_class_name().' ';
		}
	}
}

?>