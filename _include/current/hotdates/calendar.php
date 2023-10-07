<?php
/* (C) Websplosion LTD., 2001-2014

IMPORTANT: This is a commercial software product
and any kind of using it must agree to the Websplosion's license agreement.
It can be found at http://www.chameleonsocial.com/license.doc

This notice may not be removed from the source code. */

require_once('tools.php');

class ChotdatesCalendar extends CHtmlBlock
{
	var $m_need_container = true;
        var $length_title_one = 40; // Длинна названия если событие одно
        var $length_title_more = 20; // Длинна названия если событий несколько

	function parseBlock(&$html)
	{
		global $g_user;
		global $l;

        $isCalendarSocial = Common::isOptionActiveTemplate('hotdate_social_enabled');
        $day_time = intval(get_param('day_time'));
        $hotdateDayLoadMore = get_param('hotdate_day_load_more');

        if ($day_time){
            $this->parse_day($html, $day_time);
        } elseif ($hotdateDayLoadMore){
            $this->parse_day($html, strtotime($hotdateDayLoadMore));
        } else {
            $calendar_month = intval(get_param('calendar_month', date("n")));
			$calendar_year = intval(get_param('calendar_year', date("Y")));

            $calendarDate = get_param('date');
            if ($calendarDate) {
                $d = DateTime::createFromFormat('Y-m-d', $calendarDate);
                if ($d && $d->format('Y-m-d') == $calendarDate) {
                    $calendar_day = intval(date('j', strtotime($calendarDate)));
                    $calendar_month = intval(date('n', strtotime($calendarDate)));
                    $calendar_year = intval(date('Y', strtotime($calendarDate)));

                    $html->setvar('calendar_init_day', $calendar_day);
                    $html->setvar('calendar_init_date', $calendarDate);
                }
            }

			$need_container = get_param('need_container', $this->m_need_container);

			if($calendar_month > 12)
			{
	            $calendar_month = $calendar_month - 12;
	            $calendar_year++;
			}
	        if($calendar_month < 1)
	        {
	            $calendar_month = $calendar_month + 12;
	            $calendar_year--;
	        }

			$html->setvar('calendar_month', $calendar_month);
			$html->setvar('calendar_month_title', l(date("F", strtotime('2010-'.$calendar_month.'-01'))));
			$html->setvar('calendar_year', $calendar_year);

			if($need_container)
			{
				$html->parse('container_header');
				$html->parse('container_footer');
			}
            $html->parse('table_header');
            $html->parse('table_footer');

			$day_time = strtotime($calendar_year.'-'.$calendar_month.'-01');

			while(intval(date("n", $day_time)) == $calendar_month)
			{
				$this->parse_day($html, $day_time);

	            $day_time += 24 * 60 * 60;
			};
		}

        if ($isCalendarSocial) {
            if ($hotdateDayLoadMore) {
                $html->parse('add_hotdates', false);
            } else {
                $html->parse('set_hotdates', false);
            }
        }

		parent::parseBlock($html);
	}

	function parse_day(&$html, $day_time)
	{

        $optionTmplName = Common::getTmplName();
        $isCalendarSocial = Common::isOptionActiveTemplate('hotdate_social_enabled');
        $hotdateDayLoadMore = get_param('hotdate_day_load_more');
        $guid = guid();

        $html->clean('day_action');
        $html->clean('hotdate');
        $html->clean('pager');
        $calendar_day = Common::dateFormat($day_time,'calendar_day',false);

        $today = date("Ymd", $day_time) == date("Ymd");

        $html->setvar('calendar_day', $calendar_day);
        $html->setvar('day_time', $day_time);
        $html->setvar('calendar_day_title', l(date("D", $day_time)));

        if ($isCalendarSocial) {
            $vars = array(
                'datetime_day' => date("j", $day_time)
            );
            $html->assign('hotdate', $vars);
        }

        $html->setvar('calendar_datetime', Common::dateFormat($day_time,'calendar_datetime', false, false, true));


        $sql_base = ChotdatesTools::hotdates_by_calendar_day($day_time);
        #print_r($sql_base);
        $n_results = ChotdatesTools::count_from_sql_base($sql_base);

        if ($n_results == 1) {
            $html->setvar('empty', 'one_');
        } elseif ($n_results > 1) {
            $html->setvar('empty', 'full_');
        } else {
            $html->setvar('empty', 'empty_');
        }

        if ($n_results != 1) {
            $html->setvar('calendar_day_value', Common::dateFormat($day_time,'calendar_day_value', false, false, true));
            $html->parse('set_day');
        }

        if(date("N", $day_time) > 5) {
            if($today) {
                $html->parse('holiday_today', false);
                $html->clean('holiday_not_today');
            } else {
                $html->parse('holiday_not_today', false);
                $html->clean('holiday_today');
            }

            $html->parse('holiday', false);
            $html->clean('not_holiday');
        } else {
            if($today) {
                $html->parse('today', false);
                $html->clean('not_today');
            } else {
                $html->parse('not_today', false);
                $html->clean('today');
            }

            $html->parse('not_holiday', false);
            $html->clean('holiday');
        }

        $n_results_per_page = 2;
        $nResultsPerPageTemplate = Common::getOption('number_calendar_item', "{$optionTmplName}_hotdates_settings");
        if ($nResultsPerPageTemplate !== null && $nResultsPerPageTemplate) {
            $n_results_per_page = $nResultsPerPageTemplate;
        }

        if ($n_results > $n_results_per_page) {
            $html->setvar('hotdates_num', $n_results - $n_results_per_page);
            $html->parse('block_hotdates_num', false);
        } else {
            $html->setvar('hotdates_num', 0);
            $html->clean('block_hotdates_num');
        }

        if($n_results) {

            $page = intval(get_param('hotdate_calendar_day_page', 1));
            $n_pages = ceil($n_results / $n_results_per_page);
            $page = max(1, min($n_pages, $page));

            $html->setvar('page', $page);

            $hotdates = ChotdatesTools::retrieve_from_sql_base($sql_base, $n_results_per_page, ($page - 1) * $n_results_per_page);

            foreach($hotdates as $hotdate) {

                    /* Edge */
                    if ($html->varExists('hotdate_id')) {
                        $html->setvar('hotdate_id', $hotdate['hotdate_id']);
                    }

                    $userInfo = User::getInfoBasic($hotdate['user_id']);
                    if ($html->varExists('hotdate_user_name_js') && Common::isOptionActive('calendar_item_show_name_user', "{$optionTmplName}_hotdates_settings")) {
                        $html->setvar('hotdate_user_name_js', toJs($userInfo['name']));
                    }

                    if ($html->varExists('hotdate_user_photo') && Common::isOptionActive('calendar_item_show_photo_user', "{$optionTmplName}_hotdates_settings")) {
                        $html->setvar('hotdate_user_photo', User::getPhotoDefault($hotdate['user_id'], 'm'));

                        $html->setvar('hotdate_user_is_online', intval(User::isOnline($hotdate['user_id'], $userInfo)));
                    }

                    if ($html->varExists('hotdate_user_url')){
                        $html->setvar('hotdate_user_url', User::url($hotdate['user_id'], $userInfo));
                    }

                    if ($html->varExists('hotdate_user_uid')) {
                        $html->setvar('hotdate_user_uid', $hotdate['user_id']);
                    }
                    if ($html->varExists('hotdate_edit_url')) {
                        $html->setvar('hotdate_edit_url', Common::pageUrl('edit_task', 0, $hotdate['hotdate_id']));
                    }

                    if ($html->varExists('hotdate_title_js')) {
                        $html->setvar('hotdate_title_js', toJs($hotdate['hotdate_title']));
                    }
                    if ($html->varExists('hotdate_description_js') && Common::isOptionActive('calendar_item_show_description', "{$optionTmplName}_hotdates_settings")) {
                        $html->setvar('hotdate_description_js', toJs($hotdate['hotdate_description']));
                    }
                    if ($html->blockExists('my_hotdate_class')) {
                        $html->subcond($hotdate['user_id'] == $guid, 'my_hotdate_class', 'other_hotdate_class');
                    }
                    /* Edge */

                    if ($n_results == 1) {
                        $html->setvar('calendar_day_value', $hotdate['hotdate_id']);
                        $html->setvar('hotdate_title', strcut(to_html($hotdate['hotdate_title']), $this->length_title_one));
                        $html->parse('set_day');
                    }else{
                        $html->setvar('hotdate_title', strcut(to_html($hotdate['hotdate_title']), $this->length_title_more));
                    }
	                $html->setvar('hotdate_id', $hotdate['hotdate_id']);

	                $html->setvar('hotdate_title_full', to_html($hotdate['hotdate_title']));
                    if(!$hotdate['hotdate_private']) {
                        $html->setvar('hotdate_n_guests', $hotdate['hotdate_n_guests']);
                        $html->parse('guests',false);
                    } else {
                        $html->setblockvar('guests',"");
                    }

                    $isParseTime = true;
                    if ($isCalendarSocial) {
                        $isParseTime = Common::isOptionActive('calendar_item_show_time', "{$optionTmplName}_hotdates_settings");
                    }
                    if ($isParseTime) {
                        $html->setvar('hotdate_time', to_html(Common::dateFormat($hotdate['hotdate_datetime'],'hotdate_time')));
                    }

                    $isParseImage = true;
                    if ($isCalendarSocial) {
                        $isParseImage = false;//Common::isOptionActive('calendar_item_show_image', "{$optionTmplName}_hotdates_settings");
                    }
                    if ($isParseImage) {
                        $random = true;
                        if ($isCalendarSocial) {
                            $random = false;
                        }
                        $images = ChotdatesTools::hotdate_images($hotdate['hotdate_id'], $random);
                        $html->setvar("image_thumbnail", $images["image_thumbnail"]);
                    }

                    $html->parse('hotdate');
	            }

	            if($n_pages > 1)
	            {
		            if($page > 1)
		            {
		                $html->setvar('page_n', $page-1);
		                $html->parse('pager_prev');
		            }
		            else
		            {
		                $html->parse('pager_prev_inactive');
		            }

		            if($page < $n_pages)
		            {
		                $html->setvar('page_n', $page+1);
		                $html->parse('pager_next');
		            }
		            else
		            {
		                $html->parse('pager_next_inactive');
		            }

		            $html->parse('pager');
	            }
            } else {
            	//$html->clean('hotdate');
            }

            if ($isCalendarSocial && !$hotdateDayLoadMore) {
                $actionTitle = '';
                if (!$n_results) {
                    $actionTitle = toJsL('no_task');
                }
                $html->setvar('hotdate_title_js', $actionTitle);
                $html->setvar('url_create_new_item', Common::pageUrl('create_task', 0, date('Y-m-d', $day_time)));
                $html->parse('day_action', false);
            }
            $html->parse('day');
	}
}

