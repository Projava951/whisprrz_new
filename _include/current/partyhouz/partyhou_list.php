<?php
/* (C) Websplosion LTD., 2001-2014

IMPORTANT: This is a commercial software product
and any kind of using it must agree to the Websplosion's license agreement.
It can be found at http://www.chameleonsocial.com/license.doc

This notice may not be removed from the source code. */

require_once('tools.php');

class CpartyhouzpartyhouList extends CHtmlBlock
{
	var $m_need_container = true;
	var $m_list_type = "by_partyhouzian";
	var $m_partyhouzian_id = null;
	var $m_exclude_partyhou_id = null;
	var $m_n_results_per_page = 10;
	var $m_partyhou_where_when = true;
    var $m_country_id = null;
    var $m_category_id = null;
    var $m_partyhouzian_founded = null;
    var $m_partyhou_datetime = null;
    var $m_query = null;
    var $m_search_type_item = null;
    var $m_need_not_found_message = true;
    var $m_n_results = null;
    var $m_upcoming = 0;

	function parseBlock(&$html)
	{
		global $g_user;
		global $l;
		global $g;

        $n_results_per_page = get_param('n_results_per_page', $this->m_n_results_per_page);
        $partyhou_where_when = get_param('partyhou_where_when', $this->m_partyhou_where_when);
        $list_type = get_param('list_type', $this->m_list_type);
        $partyhouzian_id = get_param('partyhouzian_id', $this->m_partyhouzian_id);
        $user_id = get_param('user_id', $g_user['user_id']);

        $country_id = get_param('country_id', $this->m_country_id);
        $category_id = get_param('category_id', $this->m_category_id);
        $partyhouzian_founded = get_param('partyhouzian_founded', $this->m_partyhouzian_founded);
        $partyhou_datetime = get_param('partyhou_datetime', $this->m_partyhou_datetime);
        if ($partyhou_datetime == "") {
            $partyhou_datetime = get_param('datetime', $this->m_partyhou_datetime);
        }
        // query can be 0
		$query = strval(get_param('query', $this->m_query));
		$search_type_item = strval(get_param('search_type_item', $this->m_search_type_item));
        $upcoming = get_param('upcoming', $this->m_upcoming);

        switch($list_type)
        {
            case "by_user":
                if($this->m_upcoming)
                    $sql_base = CpartyhouzTools::partyhouz_by_user_sql_base($user_id);
                else
                    $sql_base = CpartyhouzTools::partyhouz_by_user_as_guest_sql_base($user_id);
                break;
            case "most_discussed":
                $sql_base = CpartyhouzTools::partyhouz_most_discussed_sql_base();
                break;
            case "most_anticipated":
                $sql_base = CpartyhouzTools::partyhouz_most_anticipated_sql_base();
                break;
            case "popular_finished":
                $sql_base = CpartyhouzTools::partyhouz_popular_finished_sql_base();
                break;
            case "upcoming":
                $sql_base = CpartyhouzTools::partyhouz_upcoming_sql_base();
                break;
            case "random":
                $sql_base = CpartyhouzTools::partyhouz_random_partyhouz_sql_base($upcoming);
                break;
            case "search":
				if($query != "" && $search_type_item != "")
				{
                    $sql_base = CpartyhouzTools::partyhouz_by_query_sql_base($query, $search_type_item, $upcoming);

				}
				else if($category_id)
				{
					$sql_base = CpartyhouzTools::partyhouz_by_category_id_sql_base($category_id, $upcoming);
				}
				else if($partyhou_datetime)
				{
                    $sql_base = CpartyhouzTools::partyhouz_by_partyhou_datetime_sql_base($partyhou_datetime, $upcoming);
				}
				else  $sql_base = CpartyhouzTools::partyhouz_by_query_sql_base("", 1, $upcoming);

                break;
			case "past_alike":
				$partyhou_id = get_param('partyhou_id');
		        $partyhou = CpartyhouzTools::retrieve_partyhou_by_id($partyhou_id);
				$sql_base = CpartyhouzTools::partyhouz_past_partyhouz_alike_sql_base($partyhou);
                break;
			case "coming":
				$partyhou_id = get_param('partyhou_id');
		        $partyhou = CpartyhouzTools::retrieve_partyhou_by_id($partyhou_id);
				$sql_base = CpartyhouzTools::partyhouz_coming_partyhouz_sql_base($partyhou);
				break;

            default:
        		$sql_base = CpartyhouzTools::partyhouz_recent_sql_base();
        		break;
        }

        $n_results = CpartyhouzTools::count_from_sql_base($sql_base);

        if(!$n_results && $list_type == "by_partyhouzian")
        {
        	$sql_base = CpartyhouzTools::partyhouz_by_partyhouzian_sql_base($partyhouzian_id);
        	$n_results = CpartyhouzTools::count_from_sql_base($sql_base);
        }

        $this->m_n_results = $n_results;

        /*if(!$n_results && $list_type == "search")
        {
        	$sql_base = CpartyhouzTools::partyhouz_by_rand_sql_base();
            $n_results = min($n_results_per_page, CpartyhouzTools::count_from_sql_base($sql_base));
        }*/

        $page = intval(get_param('partyhouz_partyhou_list_page', 1));
        $n_pages = ceil($n_results / $n_results_per_page);
        $page = max(1, min($n_pages, $page));

        $html->setvar('page', $page);
        $html->setvar('list_type', $list_type);
        $html->setvar('partyhouzian_id', $partyhouzian_id);
        $html->setvar('user_id', $user_id);
        $html->setvar('partyhou_id', get_param('partyhou_id'));
        $html->setvar('n_results_per_page', $n_results_per_page);
        $html->setvar('partyhou_where_when', $partyhou_where_when);

		$html->setvar('country_id', $country_id);
		$html->setvar('category_id', $category_id);
		$html->setvar('partyhouzian_founded', $partyhouzian_founded);
		$html->setvar('partyhou_datetime', $partyhou_datetime);
		$html->setvar('query', urlencode($query));
		$html->setvar('upcoming', $upcoming);

        if($this->m_need_container)
        {
            $html->parse('container_header');
            $html->parse('container_footer');
        }

        $partyhouz = CpartyhouzTools::retrieve_from_sql_base($sql_base, $n_results_per_page, ($page - 1) * $n_results_per_page);

        if(count($partyhouz))
        {
        	if($partyhou_where_when)
                $html->parse('partyhouz_where_when_title');
            else
                $html->parse('partyhouz_when_guests_comments_title');

	        foreach($partyhouz as $partyhou)
	        {
	            $html->clean('partyhou_where_when_rows');
	            $html->clean('partyhou_when_guests_comments_rows');

	        	$html->setvar('partyhou_id', $partyhou['partyhou_id']);
	            $html->setvar('partyhou_title', strcut(to_html($partyhou['partyhou_title']), 20));
	            $html->setvar('partyhou_title_full', to_html($partyhou['partyhou_title']));

	            $html->setvar('partyhou_n_comments', $partyhou['partyhou_n_comments']);
	            $html->setvar('partyhou_n_guests', $partyhou['partyhou_n_guests']);
                $html->setvar('partyhou_host_name', $partyhou['name']);
                $html->setvar('partyhou_host_id', $partyhou['user_id']);

                $cum_string = "";
                if ($partyhou['cum_males'] == 1) {
                    $cum_string = "Males / ";
                }
                if ($partyhou['cum_females'] == 1) {
                    $cum_string = $cum_string . "Females / ";
                }
                if ($partyhou['cum_couples'] == 1) {
                    $cum_string = $cum_string . "Couples";
                }
                if ($partyhou['cum_everyone'] == 1) {
                    $cum_string = "Everyone";
                }
                $cum_string = "Cum to " . $cum_string;

                $locked_string = "";
                if ($partyhou['is_lock'] == 1) {
                    $locked_string = "Room is Locked";
                } else {
                    $locked_string = "Room is Unlocked";
                }
                

                $lookin_string = "";
                if ($partyhou['lookin_males'] == 1) {
                    $lookin_string = "Males / ";
                }
                if ($partyhou['lookin_females'] == 1) {
                    $lookin_string = $lookin_string . "Females / ";
                }
                if ($partyhou['lookin_couples'] == 1) {
                    $lookin_string = $lookin_string . "Couples";
                }
                if ($partyhou['lookin_everyone'] == 1) {
                    $lookin_string = "Everyone";
                }
                $lookin_string = "Lookin to " . $lookin_string;
	            $html->setvar('partyhou_date', to_html(Common::dateFormat($partyhou['partyhou_datetime'],'partyhouz_partyhou_date')));
	            $html->setvar('partyhou_time', to_html(Common::dateFormat($partyhou['partyhou_datetime'],'partyhouz_partyhou_time')));
	            $html->setvar('partyhou_datetime_raw', to_html($partyhou['partyhou_datetime']));
	            $html->setvar('lookin_string', $lookin_string);
	            $html->setvar('cum_string', $cum_string);
	            $html->setvar('locked_string', $locked_string);
                

                $datetime = new DateTime($partyhou['partyhou_datetime']); // Replace this with your desired datetime
                $now = new DateTime();

                $interval = $now->diff($datetime);
                $days = $interval->format('%a');
                $hours = $interval->format('%h');
                $minutes = $interval->format('%i');

                if ($interval->invert) {
                    $sign = "-";
                } else {
                    $sign = "+";
                }

                $formattedDifference = "{$days}:{$hours}:{$minutes}";
	            $html->setvar('formattedDifference', $formattedDifference);
                $html->setvar('sign', $sign);


	            $images = CpartyhouzTools::partyhou_images($partyhou['partyhou_id']);
	            $html->setvar("image_thumbnail", $images["image_thumbnail"]);

	            if($partyhou_where_when)
	                $html->parse('partyhou_where_when_rows');
	            else
	                $html->parse('partyhou_when_guests_comments_rows');

	            $html->parse("partyhou");
	        }

            

            if($n_pages > 1)
            {
                if($page > 1)
                {
                    $html->setvar('page_n', $page-1);
                    $html->parse('pager_prev');
                }

                $links = pager_get_pages_links($n_pages, $page);

                foreach($links as $link)
                {
                    $html->setvar('page_n', $link);

                    if($page == $link)
                    {
                        $html->parse('pager_link_active', false);
                        $html->setblockvar('pager_link_not_active', '');
                    }
                    else
                    {
                        $html->parse('pager_link_not_active', false);
                        $html->setblockvar('pager_link_active', '');
                    }
                    $html->parse('pager_link');
                }

                if($page < $n_pages)
                {
                    $html->setvar('page_n', $page+1);
                    $html->parse('pager_next');
                }

                $html->parse('pager');
            }

            if($partyhou_where_when)
                $html->parse('partyhouz_where_when_footer');
            else
                $html->parse('partyhouz_when_guests_comments_footer');

            $html->parse("partyhouz");
        }
        else
        {
            if($this->m_need_not_found_message)
                $html->parse("no_partyhouz_message");
        	$html->parse("no_partyhouz");
        }


        // making flip box
        $host_ids = array_unique(array_column($partyhouz, "user_id"));
        $host_ids_str = implode(',', $host_ids);
        $flipbox_user_query = "SELECT u.*, (DATE_FORMAT(NOW(), '%Y') - DATE_FORMAT(birth, '%Y') - (DATE_FORMAT(NOW(), '00-%m-%d') < DATE_FORMAT(birth, '00-%m-%d'))
        ) AS age FROM user AS u WHERE u.user_id IN ($host_ids_str)";

        foreach($host_ids as $host_id)
        {
            parse_user_host($html, $flipbox_user_query, $host_id);
        }
        
		parent::parseBlock($html);
	}
}

function parse_user_host(&$html, $sql, $i){

	$fliptxt = "host";
	return parse_user_common($html, $sql, $i, $fliptxt);
}

function parse_user_common(&$html, $sql, $i=0, $fliptxt="") {
    global $users_stop_list, $member_index, $status_style;
	global $g_user; //cuigao-diamond-20201113
    if(Users_List::isBigBase()) {
        $sql = 'SELECT * FROM (' . $sql . ' ORDER BY u.user_id DESC LIMIT 100) AS u_tmp';
    }

	if ($fliptxt == "") {
		$sql .= ' ORDER BY RAND() LIMIT 1';
	} else {
		$sql .= ' ORDER BY u.user_id DESC LIMIT '."0".',1';
	}
	
	$row = DB::row($sql);

	
	if(!is_array($row)) return false;


	//cuigao-diamond-20201113-start
    $set_my_presence_couples = $row['set_my_presence_couples'];
	$set_my_presence_males = $row['set_my_presence_males'];
	$set_my_presence_females = $row['set_my_presence_females'];
	$set_my_presence_everyone = $row['set_my_presence_everyone'];
	if($g_user['orientation']==5 && $set_my_presence_couples==1){		
		return false;
	}
	if($g_user['orientation']==1 && $set_my_presence_males==1){
		return false;
	}
	if($g_user['orientation']==2 && $set_my_presence_females==1){
		return false;
	}
	if($set_my_presence_everyone==1){		
		return false;
	}
	//cuigao-diamond-20201113-end

	$users_stop_list .= ",".$row['user_id'];
	

	$row['country_title'] = trim($row['country']);
	if(pl_strlen($row['country_title']) > 7 ) $row['country_title'] = pl_substr($row['country_title'], 0, 7) . "...";
	foreach($row as $k=>$v) {
        if ($k == 'name') $v = User::nameOneLetterFull($v);
		if($k =='orientation') {
			$orientation_row = DB::row("SELECT * FROM const_orientation WHERE id = " . $v . ";");
			$v = " -". $orientation_row['title'];

		}
		// if($k == 'orientation') $v = "   -" . l($v);
        $html->assign("members_".$k, $v);
    }

	// PHOTO
	$html->assign("members_photo",User::getPhotoDefault($row['user_id'],"s"));

	// STATUS
	$status = DB::row("SELECT status FROM profile_status WHERE user_id=".$row['user_id']);
	if(is_array($status)) {
		$html->assign("members_status",$status['status']);
		$html->assign("members_status_style",$status_style++%6 + 1);
	}
    if (Common::isOptionActive('profile_status')) {
        $html->subcond(is_array($status), "user_status");
    }

	$profile_viewed_me = false;
	if($fliptxt == "viewed_me") {
		if($g_user['orientation']==5 && $row['set_profile_visitor_couples']==2){	
			$profile_viewed_me = true;
	
		} else if($g_user['orientation']==1 && $row['set_profile_visitor_males']==2){	
			$profile_viewed_me = true;

	
		} else if($g_user['orientation']==2 && $row['set_profile_visitor_females']==2){		
			$profile_viewed_me = true;

		} 
	} else {
		$profile_viewed_me = true;
	}
	if(!$profile_viewed_me) return false;

	$fliptxt_index = '';
	$tmp_suffix = '';

	if($fliptxt == "") {
		$fliptxt_index = $member_index;
		$tmp_suffix = '';
	} else {
		$fliptxt_index = $fliptxt.$i;
		$tmp_suffix = '_' . $fliptxt;

	}

	$html->assign("members_num", $fliptxt_index);

		$flip_fields =  flipFields($row['user_id']);

		$filp_indexes_about = ["income", "status", "smoking", "drinking", "education", "height", "body", "hair", "eye"];
		$filp_indexes_other = ["ethnicity", "first_date", "live_where", "living_with", "appearance", "age_preference", "humor", "can_you_host"];
	
		
		foreach ($filp_indexes_about as $key => $value) {
			$html->setvar('field', l($value));
			$value1 = "-";
			if($flip_fields[$value . '_title'] != "") {
				$value1 = $flip_fields[$value . '_title'];
			}
			$html->setvar('value', $value1);


			$sql = "SELECT * FROM userinfo WHERE user_id = " . $row['user_id'] . ";";
			$row1 = DB::row($sql);
			
			$icon_limit = array(
				'drinking' => array('limit' => [2,3,4], 'path' => "/_files/icons/drinking.png"),
				'smoking' => array('limit' => [1,2,4], 'path' => "/_files/icons/smoking.png"),
			);

			
			if(isset($icon_limit[$value]) && in_array($row1[$value], $icon_limit[$value]['limit'])) {
				$img_path = $icon_limit[$value]['path'];
				
				$personal_icon_style = "background-image: url('" . $img_path . "')";
				$html->setvar('personal_icon_style', $personal_icon_style);
		
				$html->parse('icon_item', true);
			}

			$html->parse('fields_about_row', true);
			$html->clean('icon_item');
		}

		parseIcons($html, $row['user_id']);


		$mask = $row['p_orientation'];
		$orientation_sql = "SELECT id, title FROM const_orientation" . ' ORDER BY id ASC';
        $orientation_rows = DB::rows($orientation_sql, 0, true);

		$flips = array(
			array(
				"color" => "red",
				"field" => "Cpl: "
			),
			array(
				"color" => "green",
				"field" => "Mal: "
			),
			array(
				"color" => "blue",
				"field" => "Fem: "
			)
		);



		
		parseSlides($html, "relation",$row);

		
		$html->parse("fields_about", false);
		$html->clean('fields_about_row');
		
		$html->clean('what_looking_sliders');

		$html->clean('flip_looking_for_item');

		foreach ($filp_indexes_other as $key => $value) {
			$html->setvar('field',l($value));
			$value1 = "-";
			if($flip_fields[$value . '_title'] != "") {
				$value1 = $flip_fields[$value . '_title'];
			}
			$html->setvar('value', $value1);
			$html->parse('fields_other_row', true);
		}
		// global $g;
		// $user_banner = new CUsers("", $g['tmpl']['dir_tmpl_main'] . "home.html");
		// $user_banner->onItem($html, $row, 0 ,0 );

		parseBanners($html, $row);

		$html->parse("fields_other", false);
		$html->clean('fields_other_row');
		$html->clean('hotdate');
		$html->clean('event');
		$html->clean('partyhou_flip');

		$html->parse("users_new_item" . $tmp_suffix, true);
		$html->parse("users_new_item2",true);


	return true;
}

function flipFields($user_id) {
	

	$filp_sql = "SELECT ui.user_id";
	$keyword = "";
	$where = "";
	$select_add = "";
	$from_add = " FROM userinfo AS ui ";

	$select_add .= " , vi.title AS income_title";
	$from_add .= " LEFT JOIN var_income  vi ON ui.income   = vi.id ";
	$where .= " or vi.title like '%" . $keyword ."%'";

	$select_add .= " , vs.title AS status_title";
	$from_add .=" LEFT JOIN var_status      vs ON ui.status   = vs.id ";
	$where .= " or vs.title LIKE '%" . $keyword ."%'";

	$select_add .= " , v_smoking.title AS smoking_title";
	$from_add .= " LEFT JOIN var_smoking  v_smoking ON ui.smoking   = v_smoking.id "; 
	$where .= " or v_smoking.title like '%" . $keyword ."%'";

	$select_add .= " , v_drinking.title AS drinking_title";
	$from_add .= " LEFT JOIN var_drinking  v_drinking ON ui.drinking   = v_drinking.id "; 
	$where .= " or v_drinking.title like '%" . $keyword ."%'";

	$select_add .= " , v_education.title AS education_title";
	$from_add .= " LEFT JOIN var_education  v_education ON ui.education   = v_education.id "; 
	$where .= " or v_education.title like '%" . $keyword ."%'";

	$select_add .= " , v_height.title AS height_title, v_height.value_cm AS height_value_cm, v_height.value_f AS height_value_f";
	$from_add .= " LEFT JOIN var_height  v_height ON ui.height   = v_height.id "; 
	$where .= " or v_height.title like '%" . $keyword ."%'";

	$select_add .= " , v_body.title AS body_title";
	$from_add .= " LEFT JOIN var_body  v_body ON ui.body   = v_body.id "; 
	$where .= " or v_body.title like '%" . $keyword ."%'";

	$select_add .= " , v_hair.title AS hair_title";
	$from_add .= " LEFT JOIN var_hair  v_hair ON ui.hair   = v_hair.id "; 
	$where .= " or v_hair.title like '%" . $keyword ."%'";

	$select_add .= " , v_eye.title AS eye_title";
	$from_add .= " LEFT JOIN var_eye  v_eye ON ui.eye   = v_eye.id "; 
	$where .= " or v_eye.title like '%" . $keyword ."%'";

	$select_add .= " , v_ethnicity.title AS ethnicity_title";
	$from_add .= " LEFT JOIN var_ethnicity  v_ethnicity ON ui.ethnicity   = v_ethnicity.id "; 
	$where .= " or v_ethnicity.title like '%" . $keyword ."%'";

	$select_add .= " , v_first_date.title AS first_date_title";
	$from_add .= " LEFT JOIN var_first_date  v_first_date ON ui.first_date   = v_first_date.id "; 
	$where .= " or v_first_date.title like '%" . $keyword ."%'";

	$select_add .= " , v_live_where.title AS live_where_title";
	$from_add .= " LEFT JOIN var_live_where  v_live_where ON ui.live_where = v_live_where.id ";
	$where .= " or v_live_where.title like '%" . $keyword ."%'";

	$select_add .= " , v_living_with.title AS living_with_title";
	$from_add .= " LEFT JOIN var_living_with  v_living_with ON ui.living_with = v_living_with.id ";
	$where .= " or v_living_with.title like '%" . $keyword ."%'";

	$select_add .= " , v_appearance.title AS appearance_title";
	$from_add .= " LEFT JOIN var_appearance  v_appearance ON ui.appearance   = v_appearance.id "; 
	$where .= " or v_appearance.title like '%" . $keyword ."%'";
	
	$select_add .= " , v_age_preference.title AS age_preference_title";
	$from_add .= " LEFT JOIN var_age_preference  v_age_preference ON ui.age_preference   = v_age_preference.id "; 
	$where .= " or v_age_preference.title like '%" . $keyword ."%'";

	$select_add .= " , v_humor.title AS humor_title";
	$from_add .= " LEFT JOIN var_humor  v_humor ON ui.humor   = v_humor.id "; 
	$where .= " or v_humor.title like '%" . $keyword ."%'";

	$select_add .= " , v_can_you_host.title AS can_you_host_title";
	$from_add .= " LEFT JOIN var_can_you_host  v_can_you_host ON ui.can_you_host   = v_can_you_host.id "; 
	$where .= " or v_can_you_host.title like '%" . $keyword ."%'";


	//$from_add .= " LEFT JOIN var_hobbies  v_hobbies ON ui.hobbies   = v_hobbies.id "; 
	//$where .= " or v_hobbies.title like '%" . $keyword ."%'";

	$filp_sql .= $select_add . $from_add . "WHERE ui.user_id =" . $user_id;
	$row1 = DB::row($filp_sql);


	return $row1;
}

function parseIcons($html, $user_id) {
	
	$sql = "SELECT * FROM userinfo WHERE user_id = " . $user_id . ";";
	$row1 = DB::row($sql);
	
	$icon_limit = array(
		'drinking' => array('limit' => [2,3,4], 'path' => "/_files/icons/drinking.png"),
		'smoking' => array('limit' => [1,2,4], 'path' => "/_files/icons/smoking.png"),
	);
	

	foreach ($icon_limit as $key => $value) {
		if(in_array($row1[$key], $value['limit'])) {
			$img_path = $value['path'];

			$personal_icon_style = "background-image: url('" . $img_path . "')";
			$html->setvar('personal_icon_style', $personal_icon_style);

			$html->parse('icon_item', true);
		}
		
	}

	$html->parse('icon_items', false);
	$html->clean('icon_item');


}

function parseSlides($html, $name, $flip_user) {
	
	$mask = ""; //value from scale sliders fields of user table.
	$mask  = $flip_user[$name];
	$maskArray = [];

	$parts = explode(", ", $mask);
	
	foreach ($parts as $part) {
		if (strpos($part, ":") !== false) {
			list($key, $value) = explode(":", $part);
			$maskArray[(int)$key] = (int)$value;
		}
	}

	// if($flip_user['user_id'] == "11") {
	// 	var_dump($maskArray); die();
	// }

	// get from const_relation, const_orientation table  
	$csql = "SELECT * FROM const_" . $name . ";";

	if($name == "p_orientation") {
		$csql = "SELECT * FROM const_orientation;";
	}

	$c_rows = DB::rows($csql);

	// get levels from looking_level table
	$l_sql = "SELECT id, title FROM looking_level;";
	$l_levels = DB::rows($l_sql);

	$scale_back_colors = ['#e91720','#f79122', '#f8eb10' ,'#92d14f', '#3ab34a'];

	foreach ($c_rows as $key => $c_row) {
		
		$scale_field_name = $c_row['title'];
		$html->setvar('scale_field_name', $scale_field_name);

		$scale_value = 3;
		foreach ($l_levels as $level_id => $level_title) {
			if(isset($maskArray[$c_row['id']]) && $level_title['id'] == $maskArray[$c_row['id']]) {
				$scale_value = (int) $level_title['id'];
				break;
			}  
		}

		
		$item_index = 0;
		foreach ($l_levels as $level_id => $level_title) {
			// $back_item_style = "background-color: " . $scale_back_colors[$item_index];
			
			$back_item_style = "background-color: rgb(28, 27, 27)" ;

			$html->setvar('back_item_style', $back_item_style);
			$html->parse('scale_back_item', true);
			$item_index++;
		}

		$scale_length = $scale_value* 21 - 3;
		$scale_var_style = "background-color: " . $scale_back_colors[$scale_value-1] . "; width: " . $scale_length . "px;";

		if($scale_value == 5) {
			$scale_length = $scale_value* 21 - 5;
			$scale_var_style = "background-color: " . $scale_back_colors[$scale_value-1] . "; width: " . $scale_length . "px;";

			$scale_var_style = $scale_var_style . "border-top-right-radius: 7px; border-bottom-right-radius: 7px;";
		}


		$html->setvar('scale_bar_back_style', "background-color: " . $scale_back_colors[$scale_value-1] . "; color: black;" );

		$html->setvar('scale_bar_style', $scale_var_style);

		
	

		$scale_level_name = l("set_".$l_levels[$scale_value-1]['title']);
		$html->setvar('scale_level_name', $scale_level_name);

		$html->parse('scale_slider', true);
		$html->clean('scale_back_item');
		
	}

	$html->parse('what_looking_sliders', true);

	$html->clean('scale_slider');

}

function parseBanners ($html, $row) {

	$sql = "SELECT e.* FROM events_event AS e, events_event_guest AS eg WHERE eg.event_id=e.event_id AND e.event_private=0 AND eg.user_id=".$row['user_id']." AND DATE_ADD(e.event_datetime, INTERVAL 3 HOUR) > NOW() ORDER BY e.event_n_comments DESC, e.event_datetime ASC LIMIT 0,10";
    DB::query($sql);
    $events = array();

    while($events_row = DB::fetch_row())
    {
        $events[] = $events_row;
    }
    if(count($events) && isset($row['set_events_banner_activity']) && $row['set_events_banner_activity']==1)
    {
        
        foreach($events as $event)
        {
            $html->clean('event_where_when_rows');
            $html->clean('event_when_guests_comments_rows');

            $html->setvar('event_id', $event['event_id']);
            $html->setvar('event_title', strcut(to_html($event['event_title']), 20));
            $html->setvar('event_title_full', to_html($event['event_title']));

            $html->setvar('event_n_comments', $event['event_n_comments']);
            $html->setvar('event_n_guests', $event['event_n_guests']);
            $html->setvar('event_place', strcut(to_html($event['event_place']), 16));
            $html->setvar('event_place_full', to_html($event['event_place']));

            $html->setvar('event_date', to_html(Common::dateFormat($event['event_datetime'],'events_event_date')));
            $html->setvar('event_datetime_raw', to_html($event['event_datetime']));
            $html->setvar('event_time', to_html(Common::dateFormat($event['event_datetime'],'events_event_time')));

            $images = event_images($event['event_id']);				
            $html->setvar("image_thumbnail", $images["image_thumbnail"]);
            $html->parse("event");
        }
    }

	
	$sql = "SELECT e.* FROM hotdates_hotdate AS e, hotdates_hotdate_guest AS eg WHERE eg.hotdate_id=e.hotdate_id AND eg.user_id=".$row['user_id']." AND DATE_ADD(e.hotdate_datetime, INTERVAL 3 HOUR) > NOW() ORDER BY e.hotdate_n_comments DESC, e.hotdate_datetime ASC LIMIT 0,10";
    DB::query($sql);
    $hotdates = array();

    while($hotdates_row = DB::fetch_row())
    {
        $hotdates[] = $hotdates_row;
    }
    if(count($hotdates) && isset($row['set_nsc_banner_activity']) && $row['set_nsc_banner_activity']==1)
    {
        
        foreach($hotdates as $hotdate)
        {
            $html->clean('hotdate_where_when_rows');
            $html->clean('hotdate_when_guests_comments_rows');

            $html->setvar('hotdate_id', $hotdate['hotdate_id']);
            $html->setvar('hotdate_title', strcut(to_html($hotdate['hotdate_title']), 20));
            $html->setvar('hotdate_title_full', to_html($hotdate['hotdate_title']));

            $html->setvar('hotdate_n_comments', $hotdate['hotdate_n_comments']);
            $html->setvar('hotdate_n_guests', $hotdate['hotdate_n_guests']);
            $html->setvar('hotdate_place', strcut(to_html($hotdate['hotdate_place']), 16));
            $html->setvar('hotdate_place_full', to_html($hotdate['hotdate_place']));

            $html->setvar('hotdate_date', to_html(Common::dateFormat($hotdate['hotdate_datetime'],'hotdates_hotdate_date')));
            $html->setvar('hotdate_datetime_raw', to_html($hotdate['hotdate_datetime']));
            $html->setvar('hotdate_time', to_html(Common::dateFormat($hotdate['hotdate_datetime'],'hotdates_hotdate_time')));

            $images = hotdate_images($hotdate['hotdate_id']);				
            $html->setvar("image_thumbnail", $images["image_thumbnail"]);
            $html->parse("hotdate" ,true);
        }
    }   


    $sql = "SELECT e.* FROM partyhouz_partyhou AS e, partyhouz_partyhou_guest AS eg WHERE eg.partyhou_id=e.partyhou_id AND eg.user_id=".$row['user_id']." AND DATE_ADD(e.partyhou_datetime, INTERVAL 3 HOUR) > NOW() ORDER BY e.partyhou_n_comments DESC, e.partyhou_datetime ASC LIMIT 0,10";
    DB::query($sql);
    $partyhous = array();

    while($partyhous_row = DB::fetch_row())
    {
        $partyhous[] = $partyhous_row;
    }
    if(count($partyhous) && isset($row['set_nsc_banner_activity']) && $row['set_nsc_banner_activity']==1)
    {
        
        foreach($partyhous as $partyhou)
        {
            $html->clean('partyhou_where_when_rows');
            $html->clean('partyhou_when_guests_comments_rows');

            $html->setvar('partyhou_id', $partyhou['partyhou_id']);
            $html->setvar('partyhou_title', strcut(to_html($partyhou['partyhou_title']), 20));
            $html->setvar('partyhou_title_full', to_html($partyhou['partyhou_title']));

            $html->setvar('partyhou_n_comments', $partyhou['partyhou_n_comments']);
            $html->setvar('partyhou_n_guests', $partyhou['partyhou_n_guests']);
            // $html->setvar('partyhou_place', strcut(to_html($partyhou['partyhou_place']), 16));
            // $html->setvar('partyhou_place_full', to_html($partyhou['partyhou_place']));

            // $html->setvar('partyhou_date', to_html(Common::dateFormat($partyhou['partyhou_datetime'],'partyhous_partyhou_date')));
            // $html->setvar('partyhou_datetime_raw', to_html($partyhou['partyhou_datetime']));
            // $html->setvar('partyhou_time', to_html(Common::dateFormat($partyhou['partyhou_datetime'],'partyhous_partyhou_time')));

            $images = partyhou_images($partyhou['partyhou_id']);				
            $html->setvar("image_thumbnail", $images["image_thumbnail"]);
            $html->parse("partyhou" ,true);
        }
    }
}

function event_images($event_id, $random = true)
{
    global $g;

    if($n_images = DB::result("SELECT COUNT(image_id) FROM events_event_image WHERE event_id=" . to_sql($event_id, 'Number') . " LIMIT 1"))
    {
        $image_n = $random ? rand(0, $n_images-1) : 0;
        $image = DB::row("SELECT * FROM events_event_image WHERE event_id=" . to_sql($event_id, 'Number') . " ORDER BY image_id DESC LIMIT " . $image_n . ", 1");

        return array(
            "image_thumbnail" => $g['path']['url_files'] . "events_event_images/" . $image['image_id'] . "_th.jpg",
            "image_thumbnail_s" => $g['path']['url_files'] . "events_event_images/" . $image['image_id'] . "_th_s.jpg",
            "image_thumbnail_b" => $g['path']['url_files'] . "events_event_images/" . $image['image_id'] . "_th_b.jpg",
            "image_file" => $g['path']['url_files'] . "events_event_images/" . $image['image_id'] . "_b.jpg",
            "photo_id" => $image['image_id'],
            "system" => 0);
    } else {

        if (Common::isOptionActiveTemplate('event_social_enabled')) {
            $images = array(
                "image_thumbnail"   => $g['tmpl']['url_tmpl_main'] . "images/event_clock_s.png",
                "image_thumbnail_s" => $g['tmpl']['url_tmpl_main'] . "images/event_clock_s.png",
                "image_thumbnail_b" => $g['tmpl']['url_tmpl_main'] . "images/event_clock_b.png",
                "image_file"        => $g['tmpl']['url_tmpl_main'] . "images/event_clock_b.png",
                "system" => 1,
                "photo_id" => 0,
            );
            return $images;
        }
        // entry or event images

        $type = DB::result("SELECT event_private FROM events_event WHERE event_id=".to_sql($event_id,"Number"));

    // entry
        if($type==1) {
            $images = array(
                "image_thumbnail" => $g['tmpl']['url_tmpl_main'] . "images/events/carusel_foto_clock.gif",
                "image_thumbnail_s" => $g['tmpl']['url_tmpl_main'] . "images/events/carusel_foto_clock.gif",
                "image_thumbnail_b" => $g['tmpl']['url_tmpl_main'] . "images/events/foto_clock_l.gif",
                "image_file" => $g['tmpl']['url_tmpl_main'] . "images/events/foto_clock_l.gif",
                "sysytem" => 1,
                "photo_id" => 0,
            );
        } else {
            $images = array(
                "image_thumbnail" => $g['tmpl']['url_tmpl_main'] . "images/events/foto_02.jpg",
                "image_thumbnail_s" => $g['tmpl']['url_tmpl_main'] . "images/events/carusel_foto01.gif",
                "image_thumbnail_b" => $g['tmpl']['url_tmpl_main'] . "images/events/foto_02_l.jpg",
                "image_file" => $g['tmpl']['url_tmpl_main'] . "images/events/foto_02_l.jpg",
                "sysytem" => 1,
                "photo_id" => 0,
            );
        }

        return $images;
    }
}

function partyhou_images($partyhou_id, $random = true)
{
    global $g;

    if($n_images = DB::result("SELECT COUNT(image_id) FROM partyhouz_partyhou_image WHERE partyhou_id=" . to_sql($partyhou_id, 'Number') . " LIMIT 1"))
    {
        $image_n = $random ? rand(0, $n_images-1) : 0;
        $image = DB::row("SELECT * FROM partyhouz_partyhou_image WHERE partyhou_id=" . to_sql($partyhou_id, 'Number') . " ORDER BY image_id DESC LIMIT " . $image_n . ", 1");

        return array(
            "image_thumbnail" => $g['path']['url_files'] . "partyhouz_partyhou_images/" . $image['image_id'] . "_th.jpg",
            "image_thumbnail_s" => $g['path']['url_files'] . "partyhouz_partyhou_images/" . $image['image_id'] . "_th_s.jpg",
            "image_thumbnail_b" => $g['path']['url_files'] . "partyhouz_partyhou_images/" . $image['image_id'] . "_th_b.jpg",
            "image_file" => $g['path']['url_files'] . "partyhouz_partyhou_images/" . $image['image_id'] . "_b.jpg",
            "photo_id" => $image['image_id'],
            "system" => 0);
    } else {

        if (Common::isOptionActiveTemplate('partyhouz_social_enabled')) {
            $images = array(
                "image_thumbnail"   => $g['tmpl']['url_tmpl_main'] . "images/partyhouz_clock_s.png",
                "image_thumbnail_s" => $g['tmpl']['url_tmpl_main'] . "images/partyhouz_clock_s.png",
                "image_thumbnail_b" => $g['tmpl']['url_tmpl_main'] . "images/partyhouz_clock_b.png",
                "image_file"        => $g['tmpl']['url_tmpl_main'] . "images/partyhouz_clock_b.png",
                "system" => 1,
                "photo_id" => 0,
            );
            return $images;
        }
        // entry or partyhouz images

        $type = DB::result("SELECT partyhou_private FROM partyhouz_partyhou WHERE partyhou_id=".to_sql($partyhou_id,"Number"));

    // entry
        if($type==1) {
            $images = array(
                "image_thumbnail" => $g['tmpl']['url_tmpl_main'] . "images/partyhouz/carusel_foto_clock.gif",
                "image_thumbnail_s" => $g['tmpl']['url_tmpl_main'] . "images/partyhouz/carusel_foto_clock.gif",
                "image_thumbnail_b" => $g['tmpl']['url_tmpl_main'] . "images/partyhouz/foto_clock_l.gif",
                "image_file" => $g['tmpl']['url_tmpl_main'] . "images/partyhouz/foto_clock_l.gif",
                "sysytem" => 1,
                "photo_id" => 0,
            );
        } else {
            $images = array(
                "image_thumbnail" => $g['tmpl']['url_tmpl_main'] . "images/partyhouz/foto_02.jpg",
                "image_thumbnail_s" => $g['tmpl']['url_tmpl_main'] . "images/partyhouz/carusel_foto01.gif",
                "image_thumbnail_b" => $g['tmpl']['url_tmpl_main'] . "images/partyhouz/foto_02_l.jpg",
                "image_file" => $g['tmpl']['url_tmpl_main'] . "images/partyhouz/foto_02_l.jpg",
                "sysytem" => 1,
                "photo_id" => 0,
            );
        }

        return $images;
    }
}

