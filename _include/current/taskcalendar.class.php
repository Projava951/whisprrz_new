<?php
/* (C) Websplosion LLC, 2001-2021

IMPORTANT: This is a commercial software product
and any kind of using it must agree to the Websplosion's license agreement.
It can be found at http://www.chameleonsocial.com/license.doc

This notice may not be removed from the source code. */

Class TaskCalendar {

    static $tableEvent = 'events_event';
    static $length_title_one = 40; // Длинна названия если событие одно
    static $length_title_more = 20; // Длинна названия если событий несколько
    static $uid = null;

    static function getTaskById($id)
    {
        if (!$id) {
            return false;
        }
        $event = DB::one(self::$tableEvent, 'event_id = ' . to_sql($id));

        return $event;
    }

    static function getWhereByDay($dayTime, $where = '', $uid = null, $dayTimeConvert = true)
    {
        if ($uid === null) {
            $uid = self::getUid($uid);
        }

        if ($where) {
            $where .= ' AND ';
        }

        if ($dayTimeConvert) {
            $dayTime = date("Y-m-d", $dayTime);
        }
        $where .= " `event_datetime` >= '" . $dayTime . "' " .
                  " AND `event_datetime` < DATE_ADD('" . $dayTime . "', INTERVAL 1 DAY) " .
                  " AND `user_to` = " . to_sql($uid);
        return $where;
    }

    static function getSqlTasksByDay($dayTime, $where = '', $uid = null, $dayTimeConvert = true)
    {

        $where = self::getWhereByDay($dayTime, $where, $uid, $dayTimeConvert);

        $sql = self::$tableEvent .
               " WHERE " . $where .
               " ORDER BY `event_datetime` ASC, `event_id` ASC";

        return array('query' => $sql, 'columns' => '*');
    }

    static function getCountOpenTasksByCurrentDay($uid = null)
    {
        if ($uid === null) {
            $uid = guid();
        }

        $date = time();

        return self::getCountOpenTasksByDay($date, $uid);
    }

    static function getCountOpenTasksByDay($dayTime, $uid)
    {
        $where = self::getWhereByDay($dayTime, '`done_user` = 0', $uid);

        return DB::count(self::$tableEvent, $where);
    }

    static function getListTasksByDay($dayTime = null, $uid = null, $order = '`event_datetime` ASC, `event_id` ASC', $limit = null)
    {
        if ($uid === null) {
            $uid = guid();
        }

        if ($dayTime === null) {
            $dayTime = time();
        }

        if ($limit === null) {
            $optionTmplName = Common::getTmplName();
            $limit = 4;
            $limitTemplate = Common::getOption('number_notif_title', "{$optionTmplName}_events_settings");
            if ($limitTemplate !== null && $limitTemplate) {
                $limit = $limitTemplate;
            }
        }

        $where = self::getWhereByDay($dayTime, '`done_user` = 0', $uid);

        return DB::select(self::$tableEvent, $where, $order, $limit);
    }

    static function getNextTask($lastEventId = null, $limit = 1)
    {
        if ($lastEventId === null) {
            $lastEventId = get_param_int('last_id');
        }

        if (!$lastEventId) {
            return false;
        }

        $where = 'event_id = ' . to_sql($lastEventId);
        $event = DB::one(self::$tableEvent, $where);
        if (!$event) {
            return false;
        }
        $uid = self::getUid();

        $where = 'event_id < ' . to_sql($lastEventId);
        $sqlBase = CEventsTools::events_by_calendar_day(strtotime($event['event_datetime']), $where, $uid);
        $event = CEventsTools::retrieve_from_sql_base($sqlBase, $limit);

        return $event;
    }

    static function getNextTaskMoreCount($eventId)
    {

        $where = 'event_id = ' . to_sql($eventId);
        $event = DB::one(self::$tableEvent, $where);
        if (!$event) {
            return false;
        }

        $uid = self::getUid();

        $where = 'event_id < ' . to_sql($eventId);
        $sqlBase = CEventsTools::events_by_calendar_day(strtotime($event['event_datetime']), $where, $uid);
        $count = CEventsTools::count_from_sql_base($sqlBase);

        return $count;
    }

    static function markSeen($id)
    {
        $guid = guid();
        $where = 'event_id = ' . to_sql($id)
              . ' AND (`user_id` = ' . to_sql($guid) . ' OR `user_to` = ' . to_sql($guid) . ')';
        DB::update(self::$tableEvent, array('done_new' => 0), $where);
    }

    static function done($eventId = null)
    {
        if ($eventId === null) {
            $eventId = get_param_int('event_id');
        }

        $guid = guid();
        $event = self::getTaskById($eventId);
        if($event && ($event['user_id'] == $guid || $event['user_to'] == $guid)){
            $where = 'event_id = ' . to_sql($eventId);

            $done = DB::result('SELECT `done_user` FROM ' . self::$tableEvent . ' WHERE ' . $where);
            $result = $done ? 0 : $guid;
            $new = $result && $done != $guid ? 1 : 0;
            DB::update(self::$tableEvent, array('done_user' => $result, 'done_new' => $new), $where);
            return $result;

        }
        return false;
    }

    static function getEventsOwnerCounts($day_time, $uid)
    {
        $guid = guid();
        $eventsOwner = DB::select(self::$tableEvent, self::getWhereByDay($day_time, '', $uid));
        $checkEventsOwner = array('my' => 0, 'other' => 0);
        foreach ($eventsOwner as $key => $eventsOwnerItem) {
            if ($eventsOwnerItem['user_id'] == $guid) {
                $checkEventsOwner['my']++;
            } else {
                $checkEventsOwner['other']++;
            }
        }

        return $checkEventsOwner;
    }

    static function parseEvent(&$html, $event, $n_results)
	{
        $optionTmplName = Common::getTmplName();
        $isCalendarSocial = Common::isOptionActiveTemplate('event_social_enabled');
        $guid = guid();

        /* Edge */
        if ($html->varExists('event_id')) {
            $html->setvar('event_id', $event['event_id']);
        }

        if ($html->varExists('event_done')) {
            $html->setvar('event_done', $event['done_user']);
        }

        $userInfo = User::getInfoBasic($event['user_id']);
        if ($html->varExists('event_user_name_js')
                && Common::isOptionActive('calendar_item_show_name_user', "{$optionTmplName}_events_settings")) {
            $html->setvar('event_user_name_js', toJs($userInfo['name']));
        }

        if ($html->varExists('event_user_photo')
                && Common::isOptionActive('calendar_item_show_photo_user', "{$optionTmplName}_events_settings")) {
            $html->setvar('event_user_photo', User::getPhotoDefault($event['user_id'], 'm'));
            $html->setvar('event_user_is_online', intval(User::isOnline($event['user_id'], $userInfo)));
        }

        if ($html->varExists('event_user_url')){
            $html->setvar('event_user_url', User::url($event['user_id'], $userInfo));
        }

        if ($html->varExists('event_user_uid')) {
            $html->setvar('event_user_uid', $event['user_id']);
        }

        if ($html->varExists('event_user_to_uid')) {
            $html->setvar('event_user_to_uid', $event['user_to']);
        }

        if ($html->varExists('event_edit_url')) {
            $html->setvar('event_edit_url', Common::pageUrl('task_edit', 0, $event['event_id']));
        }

        if ($html->varExists('event_title_js')) {
            $html->setvar('event_title_js', toJs($event['event_title']));
        }

        if ($html->varExists('event_description_js') && Common::isOptionActive('calendar_item_show_description', "{$optionTmplName}_events_settings")) {
            $description = Common::parseLinksTag(to_html($event['event_description']), 'a', '&lt;', 'parseLinksSmile');
            $html->setvar('event_description_js', toJs($description));
        }

        if ($html->blockExists('my_event_class')) {
            $html->subcond($event['user_id'] == $guid, 'my_event_class', 'other_event_class');
        }
        /* Edge */

        if ($n_results == 1) {
            $html->setvar('calendar_day_value', $event['event_id']);
            $html->setvar('event_title', strcut(to_html($event['event_title']), self::$length_title_one));
            $html->parse('set_day');
        } else {
            $html->setvar('event_title', strcut(to_html($event['event_title']), self::$length_title_more));
        }

        $html->setvar('event_id', $event['event_id']);

        $html->setvar('event_title_full', to_html($event['event_title']));
        if(!$event['event_private']) {
            $html->setvar('event_n_guests', $event['event_n_guests']);
            $html->parse('guests',false);
        } else {
            $html->setblockvar('guests',"");
        }

        $isParseTime = true;
        if ($isCalendarSocial) {
            $isParseTime = Common::isOptionActive('calendar_item_show_time', "{$optionTmplName}_events_settings");
        }
        if ($isParseTime) {
            $html->setvar('event_time', to_html(Common::dateFormat($event['event_datetime'],'event_time')));
        }

        if (!$isCalendarSocial) {
            $random = true;
            if ($isCalendarSocial) {
                $random = false;
            }
            $images = CEventsTools::event_images($event['event_id'], $random);
            $html->setvar("image_thumbnail", $images["image_thumbnail"]);
        }
        $html->parse('event');
    }

    static function getNumberEventLoad()
	{
        $optionTmplName = Common::getTmplName();

        $numberEvent = 2;
        $numberEventTemplate = Common::getOption('number_calendar_item', "{$optionTmplName}_events_settings");
        if ($numberEventTemplate !== null && $numberEventTemplate) {
            $numberEvent = $numberEventTemplate;
        }
        return $numberEvent;
    }

    static function parseEventsDay(&$html, $day_time, $uid = null)
	{
        global $p;

        $optionTmplName = Common::getTmplName();
        $isCalendarSocial = Common::isOptionActiveTemplate('event_social_enabled');
        $eventDayLoadMore = get_param('event_day_load_more');
        $guid = guid();
        $uid = self::getUid($uid);

        $html->clean('day_action');
        $html->clean('event');
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
            $html->assign('event', $vars);
        }

        $html->setvar('calendar_datetime', Common::dateFormat($day_time,'calendar_datetime', false, false, true));

        if ($isCalendarSocial) {
            $eventsOwner = self::getEventsOwnerCounts($day_time, $uid);
            $html->setvar('day_owners', json_encode($eventsOwner));
        }

        $sql_base = CEventsTools::events_by_calendar_day($day_time, '', $uid);
        //print_r($sql_base, true);
        $n_results = CEventsTools::count_from_sql_base($sql_base);

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

        $n_results_per_page = self::getNumberEventLoad();

        if($n_results) {

            $page = intval(get_param('event_calendar_day_page', 1));
            $n_pages = ceil($n_results / $n_results_per_page);
            $page = max(1, min($n_pages, $page));

            $html->setvar('page', $page);

            $limit = $n_results_per_page;
            $shift = ($page - 1) * $n_results_per_page;

            $events = CEventsTools::retrieve_from_sql_base($sql_base, $limit, $shift);

            if (Common::isOptionActiveTemplate('event_social_enabled')) {
                $whereNotifId = '';
                $eventIdNotif = get_param_int('neid');
				if (!$eventIdNotif) {
					$eventIdNotif = get_param_int('task_id');
				}

                $isCheckEvent = false;
                if ($p == 'events_calendar.php' && $eventIdNotif) {
                    $html->setvar('highlight_event_id', $eventIdNotif);
                    $html->parse('highlight_event', false);

                    foreach ($events as $key => $event) {
                        if ($event['event_id'] == $eventIdNotif) {
                            $isCheckEvent = true;
                            break;
                        }
                    }
                    if (!$isCheckEvent) {
                        $limit = 0;
                        $sql_base = CEventsTools::events_by_calendar_day($day_time, '`event_id` <= ' . to_sql($eventIdNotif), $uid);
                        $events = CEventsTools::retrieve_from_sql_base($sql_base);
						if ($n_results == count($events)) {
							$n_results = $n_results_per_page;
						}
                    }
                }

                $whereDone = '`done_new` = 1';
                $whereUpdateDone = TaskCalendar::getWhereByDay($day_time, $whereDone, $uid);

                $sqlLimit = ($limit ? " LIMIT " .  intval($shift) . ", " . intval($limit) : '');
                $sqlSelectDone_1 = "SELECT event_id FROM " . self::$tableEvent
                                 . ' WHERE ' . $whereUpdateDone
                                 . $sqlLimit;

                $sqlSelectDone = 'SELECT event_id FROM (' . $sqlSelectDone_1 . ') tmp';
                $sqlUpdateDone = 'UPDATE ' . self::$tableEvent . ' SET `done_new` = 0
                                    WHERE  event_id IN (' .  $sqlSelectDone . ')';
                DB::execute($sqlUpdateDone);
            }

            foreach($events as $event) {
                self::parseEvent($html, $event, $n_results);
            }

            if($n_pages > 1){
		        if($page > 1) {
                    $html->setvar('page_n', $page-1);
                    $html->parse('pager_prev');
                } else {
                    $html->parse('pager_prev_inactive');
                }

                if($page < $n_pages) {
                    $html->setvar('page_n', $page+1);
                    $html->parse('pager_next');
                } else {
                    $html->parse('pager_next_inactive');
                }

                $html->parse('pager');
            }
        } else {
            //$html->clean('event');
        }

		if ($n_results > $n_results_per_page) {
            $html->setvar('events_num', $n_results - $n_results_per_page);
            $html->parse('block_events_num', false);
        } else {
            $html->setvar('events_num', 0);
            $html->clean('block_events_num');
        }

        if ($isCalendarSocial && !$eventDayLoadMore) {
            $actionTitle = '';
            if (!$n_results) {
                $actionTitle = toJsL('no_task');
            }
            $html->setvar('event_title_js', $actionTitle);
            $html->setvar('url_create_new_item', Common::pageUrl('task_create', $uid, date('Y-m-d', $day_time)));
            $html->parse('day_action', false);
        }

        $html->parse('day');
	}

    static function searchUsersFromName()
	{
        $responseData = '';
        $name = trim(get_param('name'));
        if ($name) {
            $sql = 'SELECT `user_id`, `name` FROM `user` WHERE `name` LIKE "' . DB::esc_like($name) . '%"';
            $users = DB::rows($sql);
            if ($users) {
                foreach ($users as $key => $user) {
                    $responseData .= '<li class="search_user_item" data-name="' . toAttr($user['name']) . '" data-uid="' . $user['user_id'] . '" >' . $user['name'] . '</li>';
                }
            }
        }
        return $responseData;
    }

    static function getUid($uid = null)
    {
        if (self::$uid !== null) {
            return self::$uid;
        }

        if ($uid === null) {
            $uid = User::getParamUid(guid());
        }

        self::$uid = $uid;

        return $uid;
    }

    static function getNotifTitle($count = null, $uid = null)
    {
        if ($uid === null) {
            $uid = guid();
        }
        if ($count === null) {
            $count = self::getCountOpenTasksByCurrentDay($uid);
        }
        if ($count) {
            $lTasks = $count == 1 ? 'active_tasks_one' : 'active_tasks';
            $tasksList = TaskCalendar::getListTasksByDay(null, null, '`event_datetime` DESC, `event_id` DESC');
            $countList = count($tasksList);

            $tasksListTitle = array();
            foreach ($tasksList as $task) {
                $tasksListTitle[] = $task['event_title'];
            }
            $tasksListTitle = implode(', ', $tasksListTitle);
            $lData = array('task_list' => trim($tasksListTitle));
            if ($count > $countList) {
                $lTasks = 'active_tasks_all';
                $lData['task_more'] = $count - $countList;
            }
            $newTasksTitle = lSetVars($lTasks, $lData);
        } else {
            $newTasksTitle = l('notification_title_calendar');
        }

        return $newTasksTitle;
    }
}