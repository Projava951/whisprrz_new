<?php
/* (C) Websplosion LLC, 2001-2021

IMPORTANT: This is a commercial software product
and any kind of using it must agree to the Websplosion's license agreement.
It can be found at http://www.chameleonsocial.com/license.doc

This notice may not be removed from the source code. */

$g['template_options'] = array(
    'set' => 'urban',
    'name' => 'impact',
	'logo_w' => 396,
    'logo_h' => 44,
	'logo_inner_w' => 143,
    'logo_inner_h' => 24,
	'logo_inner' => 'Y',
    'login_page_template' => 'login.html',
    'type_payment_features' => 'impact',
    'type_payment_plan' => 'impact',
    'type_payment_module_credits' => 'payment_module_boost',
    'profile_photo_size' => 'm',
    'not_display_module' => array('custom_page', 'menu_help', 'complite', 'profile_menu',
                                  'search', 'users_list_header_buttons', 'friends_menu',
                                  'profile_head', 'profile_colum_narrow', 'people_nearby_spotlight',
                                  'custom_head', 'index_animated'),
    'fields_not_availableOLD' => array(133,134,136,137,139,140,142,144,145,146,148,149,150,152,154,155,156,157,158,160,162,163,164,165,166,167,168,169,170,348,468,471),
    'fields_not_available_admin' => array(133,134,136,137,139,140,142,144,145,146,148,149,150,152,154,156,157,158,160,162,163,164,165,166,167,168,169,170,348,468,471,485,494),
    'fields_not_available' => array(541,457),
    //'fields_available' => array(155),
    'fields_mode' => 'urban',
    'custom_profile_html' => 'profile_html_urban',
    'profile_basic_fields_edit_to_page' => 'Y',
    'profile_col_narrow' => 'Y',
    'no_photo_by_template' => 'Y',
    'private_photo_by_template' => 'Y',
    'near_me_radius' => 25,
    'access_check_to_profile' => 'Y',
    'redirect_user_blocked' => 'N',
    'allow_you_to_view_blocked_profile' => 'Y',

    /* Admin */
    'hide_site_sections' => array(
        'main_page_mode',
        'home_page_mode',
        'mode_profile',
        'feed_as_home_page',
        'allow_users_profile_mode'
    ),
    'banners_places' => array ('home' => 0,
                               'top' => 0,
                               'header' => 1,
                               'right_column' => 1,
                               'footer' => 1,
                               'footer_mobile' => 1,
                               'footer_additional' => 0,
                               'left_column' => 1),
    'number_banners_place_right_column' => 1,
    'number_banners_place_right_column_paid' => 1,
    'number_banners_place_left_column' => 1,
    'number_banners_place_left_column_paid' => 1,

    'menu_admin_banner' => 'Y',
    'smooth_scroll' => 'Y',
    'do_not_show_me_in_search' => 'Y',
    'rate_see_my_photo_rating' => 'Y',
    'map_on_main_page_urban' => 'Y',
    /* Admin */

    'list_users_filter' => 'Y',
    'list_users_filter_head_hide' => 'Y',
    'usersinfo_per_page' => 'number_of_profiles_in_the_search_results',
    'user_custom_per_page' => 10,
    'usersinfo_pages_per_list' => 10,
    'usersinfo_pages_per_join' => 12,
    'list_users_info_ajax' => 'Y',
    'list_users_info_tmpl_parts' => 'Y',
    'list_users_info_tmpl_base_parts' => 'Y',
    'list_users_my_friends_tmpl_parts' => 'Y',
    'list_users_custom_page' => 'Y',
    'upgraded_redirect_to_home_page' => 'Y',

    'width_captcha' => 151,
    'height_captcha' => 34,
    'ratio_font_captcha' => 1.5,
    'ratio_distance_captcha' => 1.78,

    'upload_icon_field_i_am_here_to' => 'Y',
    'upload_icon_field_orientation' => 'N',

    'viewed_me_custom_settings' => 'Y',

	'color_scheme_activate' => 'Y',
    'color_scheme_type' => 'impact',
	//'color_scheme_settings' => 'Y',если будет возможность выбирать цветовую схему пользователем
    'color_scheme' => array(
        'default' => array(
            'title' => 'Default',
            'color_scheme_background_color_impact' => '#254c8e',
            'color_scheme_header_text_color_impact' => '#FFFFFF',
            'color_scheme_header_text_color_hover_impact' => '#8ad4ff',
            'color_scheme_menu_icons_impact' => array('value' => 'icons_nav_default.png', 'type' => 'select'),
            'color_scheme_menu_selected_item_background_color_impact' => '#0a1f52',
            'color_scheme_menu_text_color_impact' => '#8ba1d5',
            'color_scheme_menu_text_hover_color_impact' => '#c5d5fc',
            'color_scheme_menu_inactive_text_color_impact' => '#49619a',
            'color_scheme_menu_counter_color_impact' => '#FFFFFF',
            'color_scheme_menu_counter_background_color_impact' => '#eb6077',
            'color_scheme_menu_item_border_top_color_impact' => '#FFFFFF',
            'color_scheme_menu_item_border_top_opacity_impact' => array('value' => '10', 'type' => 'text'),
            'color_scheme_menu_item_border_bottom_color_impact' => '#000000',
            'color_scheme_menu_item_border_bottom_opacity_impact' => array('value' => '40', 'type' => 'text'),
            'color_scheme_column_background_color_impact' => '#142d69',
            'color_scheme_column_text_color_impact' => '#FFFFFF',
            'color_scheme_remove_ads_color_impact' => '#f3f5f9',
            'color_scheme_remove_ads_color_hover_impact' => '#5ac9fe',
            'color_scheme_footer_menu_color_impact' => '#FFFFFF',
            'color_scheme_footer_menu_color_hover_impact' => '#5ac9fe',
            'color_scheme_footer_copyright_color_impact' => '#FFFFFF',
            'color_scheme_3dcity_page_background_color_impact' => '#002955',
            'color_scheme_3dcity_background_color_impact' => '#142d69',

            'color_scheme_mobile_main_page_text_color_impact' => '#FFFFFF',
            'color_scheme_mobile_main_page_text_shadow_color_impact' => '#000000',

            'color_scheme_mobile_main_page_button_color_impact' => '#ff6d85',
            'color_scheme_mobile_main_page_button_active_color_impact' => '#e7495c',
            'color_scheme_mobile_main_page_button_text_color_impact' => '#FFFFFF',
            'color_scheme_mobile_main_page_button_terms_color_impact' => '#6dc9ff',
            'color_scheme_mobile_main_page_button_terms_active_color_impact' => '#2faae0',
            'color_scheme_mobile_main_page_button_terms_text_color_impact' => '#FFFFFF',
            'color_scheme_mobile_main_page_button_border_color_impact' => '#d5dce6',
            'color_scheme_mobile_main_page_button_border_active_color_impact' => '#E1E1E1',
            'color_scheme_mobile_join_page_text_color_impact' => '#FFFFFF',
            'color_scheme_mobile_join_page_text_opacity_impact' => array('value' => '54', 'type' => 'text'),

            'color_scheme_mobile_background_color_impact' => '#254c8e',
            'color_scheme_mobile_header_color_impact' => '#142d69',
            'color_scheme_mobile_header_icons_color_impact' => '#8ba1d5',
            'color_scheme_mobile_header_counter_color_impact' => '#f15d75',
            'color_scheme_mobile_header_counter_text_color_impact' => '#ffffff',

            'color_scheme_mobile_subheader_color_impact' => '#000000',
            'color_scheme_mobile_subheader_text_color_impact' => '#f15d75',
            'color_scheme_mobile_label_text_color_impact' => '#ffffc5',
            'color_scheme_mobile_pencil_color_impact' => '#8ccd00',
            'color_scheme_mobile_text_color_impact' => '#ffffff',
            'color_scheme_mobile_upgrade_page_text_color_impact' => '#cde0ff',
            'color_scheme_mobile_footer_color_impact' => '#6f89b5',
            'color_scheme_mobile_footer_text_color_impact' => '#a1b2d9',
            'color_scheme_mobile_footer_arrow_up_color_impact' => '#40c7db',
            'color_scheme_mobile_footer_more_options_color_impact' => '#cdd1dd',

            'color_scheme_mobile_menu_background_color_impact' => '#FFFFFF',
            'color_scheme_mobile_menu_icon_color_impact' => '#FFFFFF',
            'color_scheme_mobile_menu_text_color_impact' => '#FFFFFF',
            'color_scheme_mobile_menu_text_background_color_impact' => '#142d69',
            'color_scheme_mobile_button_disabled_background_color_impact' => '#9f9f9f',
            'color_scheme_mobile_alert_background_color_impact' => '#FFFFFF',
            'color_scheme_mobile_alert_icon_color_impact' => '#6989f5',
            'color_scheme_mobile_alert_text_color_impact' => '#000000',
            'color_scheme_mobile_alert_button_ok_background_color_impact' => '#6d8fff',
            'color_scheme_mobile_alert_button_ok_text_color_impact' => '#FFFFFF',
            'color_scheme_mobile_alert_button_cancel_background_color_impact' => '#8995b3',
            'color_scheme_mobile_alert_button_cancel_text_color_impact' => '#FFFFFF',
            'color_scheme_mobile_alert_button_cancel_border_right_color_impact' => '#FFFFFF',
            'color_scheme_mobile_button_disabled_background_color_impact' => '#9f9f9f',

            'color_scheme_chat_header_background_color_impact' => '#323741',
            'color_scheme_chat_header_icon_color_impact' => '#40c7db',
            'color_scheme_chat_header_text_color_impact' => '#FFFFFF',
            'color_scheme_chat_online_header_background_color_impact' => '#6D8FFF',
            'color_scheme_chat_online_header_background_color_hover_impact' => '#6280FF',
            'color_scheme_chat_online_header_icon_color_impact' => '#40c7db',
            'color_scheme_chat_online_header_text_color_impact' => '#FFFFFF',
            'color_scheme_chat_offline_header_background_color_impact' => '#888888',
            'color_scheme_chat_offline_header_background_color_hover_impact' => '#7A7A7A',
            'color_scheme_chat_offline_header_icon_color_impact' => '#b2b2b2',
            'color_scheme_chat_offline_header_text_color_impact' => '#FFFFFF',

            'color_scheme_pagination_active_item_text_color_impact' => '#FFFFFF',
            'color_scheme_pagination_active_item_background_color_impact' => '#142d69',
            'color_scheme_pagination_inactive_item_text_color_impact' => '#2c3e50',
            'color_scheme_pagination_disabled_item_color_impact' => '#BFBFBF',
        ),
        'navyblue' => array(
            'title' => 'Navy Blue',
            'color_scheme_background_color_impact' => '#386a73',
            'color_scheme_header_text_color_impact' => '#FFFFFF',
            'color_scheme_header_text_color_hover_impact' => '#6ffff7',
            'color_scheme_menu_icons_impact' => array('value' => 'icons_nav_navyblue.png', 'type' => 'select'),
            'color_scheme_menu_selected_item_background_color_impact' => '#163841',
            'color_scheme_menu_text_color_impact' => '#95b7c0',
            'color_scheme_menu_text_hover_color_impact' => '#c8fffe',
            'color_scheme_menu_inactive_text_color_impact' => '#4B6A73',
            'color_scheme_menu_counter_color_impact' => '#FFFFFF',
            'color_scheme_menu_counter_background_color_impact' => '#eb6077',
            'color_scheme_menu_item_border_top_color_impact' => '#FFFFFF',
            'color_scheme_menu_item_border_top_opacity_impact' => array('value' => '10', 'type' => 'text'),
            'color_scheme_menu_item_border_bottom_color_impact' => '#000000',
            'color_scheme_menu_item_border_bottom_opacity_impact' => array('value' => '40', 'type' => 'text'),
            'color_scheme_column_background_color_impact' => '#23454e',
            'color_scheme_column_text_color_impact' => '#FFFFFF',
            'color_scheme_remove_ads_color_impact' => '#f3f5f9',
            'color_scheme_remove_ads_color_hover_impact' => '#95b7c0',
            'color_scheme_footer_menu_color_impact' => '#FFFFFF',
            'color_scheme_footer_menu_color_hover_impact' => '#6ffff7',
            'color_scheme_footer_copyright_color_impact' => '#95b7c0',
            'color_scheme_3dcity_page_background_color_impact' => '#163841',
            'color_scheme_3dcity_background_color_impact' => '#23454e',

            'color_scheme_mobile_main_page_text_color_impact' => '#FFFFFF',
            'color_scheme_mobile_main_page_text_shadow_color_impact' => '#000000',
            'color_scheme_mobile_main_page_button_color_impact' => '#ff6d85',
            'color_scheme_mobile_main_page_button_active_color_impact' => '#e7495c',
            'color_scheme_mobile_main_page_button_text_color_impact' => '#FFFFFF',
            'color_scheme_mobile_main_page_button_terms_color_impact' => '#6dc9ff',
            'color_scheme_mobile_main_page_button_terms_active_color_impact' => '#2faae0',
            'color_scheme_mobile_main_page_button_terms_text_color_impact' => '#FFFFFF',
            'color_scheme_mobile_main_page_button_border_color_impact' => '#d5dce6',
            'color_scheme_mobile_main_page_button_border_active_color_impact' => '#E1E1E1',
            'color_scheme_mobile_join_page_text_color_impact' => '#FFFFFF',
            'color_scheme_mobile_join_page_text_opacity_impact' => array('value' => '54', 'type' => 'text'),
            'color_scheme_mobile_background_color_impact' => '#386a73',
            'color_scheme_mobile_header_color_impact' => '#23454e',
            'color_scheme_mobile_header_icons_color_impact' => '#95b7c0',
            'color_scheme_mobile_header_counter_color_impact' => '#f15d75',
            'color_scheme_mobile_header_counter_text_color_impact' => '#ffffff',
            'color_scheme_mobile_subheader_color_impact' => '#000000',
            'color_scheme_mobile_subheader_text_color_impact' => '#f15d75',
            'color_scheme_mobile_label_text_color_impact' => '#ffffc5',
            'color_scheme_mobile_pencil_color_impact' => '#8ccd00',
            'color_scheme_mobile_text_color_impact' => '#ffffff',
            'color_scheme_mobile_upgrade_page_text_color_impact' => '#FFFFFF',
            'color_scheme_mobile_footer_color_impact' => '#95b7c0',
            'color_scheme_mobile_footer_text_color_impact' => '#f3f5f9',
            'color_scheme_mobile_footer_arrow_up_color_impact' => '#23454e',
            'color_scheme_mobile_footer_more_options_color_impact' => '#f3f5f9',
            'color_scheme_mobile_menu_background_color_impact' => '#FFFFFF',
            'color_scheme_mobile_menu_icon_color_impact' => '#FFFFFF',
            'color_scheme_mobile_menu_text_color_impact' => '#FFFFFF',
            'color_scheme_mobile_menu_text_background_color_impact' => '#142d69',
            'color_scheme_mobile_button_disabled_background_color_impact' => '#9f9f9f',
            'color_scheme_mobile_alert_background_color_impact' => '#FFFFFF',
            'color_scheme_mobile_alert_icon_color_impact' => '#6989f5',
            'color_scheme_mobile_alert_text_color_impact' => '#000000',
            'color_scheme_mobile_alert_button_ok_background_color_impact' => '#6d8fff',
            'color_scheme_mobile_alert_button_ok_text_color_impact' => '#FFFFFF',
            'color_scheme_mobile_alert_button_cancel_background_color_impact' => '#8995b3',
            'color_scheme_mobile_alert_button_cancel_text_color_impact' => '#FFFFFF',
            'color_scheme_mobile_alert_button_cancel_border_right_color_impact' => '#FFFFFF',
            'color_scheme_mobile_button_disabled_background_color_impact' => '#9f9f9f',

            'color_scheme_chat_header_background_color_impact' => '#163841',
            'color_scheme_chat_header_icon_color_impact' => '#D7F6FF',
            'color_scheme_chat_header_text_color_impact' => '#FFFFFF',
            'color_scheme_chat_online_header_background_color_impact' => '#64838c',
            'color_scheme_chat_online_header_background_color_hover_impact' => '#3E5D66',
            'color_scheme_chat_online_header_icon_color_impact' => '#D7F6FF',
            'color_scheme_chat_online_header_text_color_impact' => '#FFFFFF',
            'color_scheme_chat_offline_header_background_color_impact' => '#888888',
            'color_scheme_chat_offline_header_background_color_hover_impact' => '#7A7A7A',
            'color_scheme_chat_offline_header_icon_color_impact' => '#b2b2b2',
            'color_scheme_chat_offline_header_text_color_impact' => '#FFFFFF',

            'color_scheme_pagination_active_item_text_color_impact' => '#FFFFFF',
            'color_scheme_pagination_active_item_background_color_impact' => '#23454e',
            'color_scheme_pagination_inactive_item_text_color_impact' => '#23454e',
            'color_scheme_pagination_disabled_item_color_impact' => '#BFBFBF',
        ),
        'violet'=> array(
            'title' => 'Violet',
            'color_scheme_background_color_impact' => '#643681',
            'color_scheme_header_text_color_impact' => '#FFFFFF',
            'color_scheme_header_text_color_hover_impact' => '#ff9bfe',
            'color_scheme_menu_icons_impact' => array('value' => 'icons_nav_violet.png', 'type' => 'select'),
            'color_scheme_menu_selected_item_background_color_impact' => '#3F1652',
            'color_scheme_menu_text_color_impact' => '#b78ec8',
            'color_scheme_menu_text_hover_color_impact' => '#fcc8ff',
            'color_scheme_menu_inactive_text_color_impact' => '#845b95',
            'color_scheme_menu_counter_color_impact' => '#FFFFFF',
            'color_scheme_menu_counter_background_color_impact' => '#eb6077',
            'color_scheme_menu_item_border_top_color_impact' => '#FFFFFF',
            'color_scheme_menu_item_border_top_opacity_impact' => array('value' => '10', 'type' => 'text'),
            'color_scheme_menu_item_border_bottom_color_impact' => '#000000',
            'color_scheme_menu_item_border_bottom_opacity_impact' => array('value' => '40', 'type' => 'text'),
            'color_scheme_column_background_color_impact' => '#4c235f',
            'color_scheme_column_text_color_impact' => '#FFFFFF',
            'color_scheme_remove_ads_color_impact' => '#f3f5f9',
            'color_scheme_remove_ads_color_hover_impact' => '#b78ec8',
            'color_scheme_footer_menu_color_impact' => '#FFFFFF',
            'color_scheme_footer_menu_color_hover_impact' => '#ff9bfe',
            'color_scheme_footer_copyright_color_impact' => '#b78ec8',
            'color_scheme_3dcity_page_background_color_impact' => '#3F1652',
            'color_scheme_3dcity_background_color_impact' => '#4c235f',

            'color_scheme_mobile_main_page_text_color_impact' => '#FFFFFF',
            'color_scheme_mobile_main_page_text_shadow_color_impact' => '#000000',
            'color_scheme_mobile_main_page_button_color_impact' => '#ff6d85',
            'color_scheme_mobile_main_page_button_active_color_impact' => '#e7495c',
            'color_scheme_mobile_main_page_button_text_color_impact' => '#FFFFFF',
            'color_scheme_mobile_main_page_button_terms_color_impact' => '#6dc9ff',
            'color_scheme_mobile_main_page_button_terms_active_color_impact' => '#2faae0',
            'color_scheme_mobile_main_page_button_terms_text_color_impact' => '#FFFFFF',
            'color_scheme_mobile_main_page_button_border_color_impact' => '#d5dce6',
            'color_scheme_mobile_main_page_button_border_active_color_impact' => '#E1E1E1',
            'color_scheme_mobile_join_page_text_color_impact' => '#FFFFFF',
            'color_scheme_mobile_join_page_text_opacity_impact' => array('value' => '54', 'type' => 'text'),
            'color_scheme_mobile_background_color_impact' => '#643681',
            'color_scheme_mobile_header_color_impact' => '#4c235f',
            'color_scheme_mobile_header_icons_color_impact' => '#b78ec8',
            'color_scheme_mobile_header_counter_color_impact' => '#f15d75',
            'color_scheme_mobile_header_counter_text_color_impact' => '#ffffff',
            'color_scheme_mobile_subheader_color_impact' => '#000000',
            'color_scheme_mobile_subheader_text_color_impact' => '#f15d75',
            'color_scheme_mobile_label_text_color_impact' => '#ffffc5',
            'color_scheme_mobile_pencil_color_impact' => '#8ccd00',
            'color_scheme_mobile_text_color_impact' => '#ffffff',
            'color_scheme_mobile_upgrade_page_text_color_impact' => '#FFFFFF',
            'color_scheme_mobile_footer_color_impact' => '#b78ec8',
            'color_scheme_mobile_footer_text_color_impact' => '#f3f5f9',
            'color_scheme_mobile_footer_arrow_up_color_impact' => '#4c235f',
            'color_scheme_mobile_footer_more_options_color_impact' => '#f3f5f9',
            'color_scheme_mobile_menu_background_color_impact' => '#FFFFFF',
            'color_scheme_mobile_menu_icon_color_impact' => '#FFFFFF',
            'color_scheme_mobile_menu_text_color_impact' => '#FFFFFF',
            'color_scheme_mobile_menu_text_background_color_impact' => '#142d69',
            'color_scheme_mobile_button_disabled_background_color_impact' => '#9f9f9f',
            'color_scheme_mobile_alert_background_color_impact' => '#FFFFFF',
            'color_scheme_mobile_alert_icon_color_impact' => '#6989f5',
            'color_scheme_mobile_alert_text_color_impact' => '#000000',
            'color_scheme_mobile_alert_button_ok_background_color_impact' => '#6d8fff',
            'color_scheme_mobile_alert_button_ok_text_color_impact' => '#FFFFFF',
            'color_scheme_mobile_alert_button_cancel_background_color_impact' => '#8995b3',
            'color_scheme_mobile_alert_button_cancel_text_color_impact' => '#FFFFFF',
            'color_scheme_mobile_alert_button_cancel_border_right_color_impact' => '#FFFFFF',
            'color_scheme_mobile_button_disabled_background_color_impact' => '#9f9f9f',

            'color_scheme_chat_header_background_color_impact' => '#3F1652',
            'color_scheme_chat_header_icon_color_impact' => '#ff9bfe',
            'color_scheme_chat_header_text_color_impact' => '#FFFFFF',
            'color_scheme_chat_online_header_background_color_impact' => '#774E88',
            'color_scheme_chat_online_header_background_color_hover_impact' => '#5E356F',
            'color_scheme_chat_online_header_icon_color_impact' => '#ff9bfe',
            'color_scheme_chat_online_header_text_color_impact' => '#FFFFFF',
            'color_scheme_chat_offline_header_background_color_impact' => '#888888',
            'color_scheme_chat_offline_header_background_color_hover_impact' => '#7A7A7A',
            'color_scheme_chat_offline_header_icon_color_impact' => '#b2b2b2',
            'color_scheme_chat_offline_header_text_color_impact' => '#FFFFFF',

            'color_scheme_pagination_active_item_text_color_impact' => '#FFFFFF',
            'color_scheme_pagination_active_item_background_color_impact' => '#4c235f',
            'color_scheme_pagination_inactive_item_text_color_impact' => '#4c235f',
            'color_scheme_pagination_disabled_item_color_impact' => '#BFBFBF',
        ),
        'red' => array(
            'title' => 'Red',
            'color_scheme_background_color_impact' => '#8d3028',
            'color_scheme_header_text_color_impact' => '#FFFFFF',
            'color_scheme_header_text_color_hover_impact' => '#ff9376',
            'color_scheme_menu_icons_impact' => array('value' => 'icons_nav_red.png', 'type' => 'select'),
            'color_scheme_menu_selected_item_background_color_impact' => '#470900',
            'color_scheme_menu_text_color_impact' => '#d6938a',
            'color_scheme_menu_text_hover_color_impact' => '#ffc4c4',
            'color_scheme_menu_inactive_text_color_impact' => '#A36057',
            'color_scheme_menu_counter_color_impact' => '#FFFFFF',
            'color_scheme_menu_counter_background_color_impact' => '#eb6077',
            'color_scheme_menu_item_border_top_color_impact' => '#FFFFFF',
            'color_scheme_menu_item_border_top_opacity_impact' => array('value' => '10', 'type' => 'text'),
            'color_scheme_menu_item_border_bottom_color_impact' => '#000000',
            'color_scheme_menu_item_border_bottom_opacity_impact' => array('value' => '40', 'type' => 'text'),
            'color_scheme_column_background_color_impact' => '#602217',
            'color_scheme_column_text_color_impact' => '#FFFFFF',
            'color_scheme_remove_ads_color_impact' => '#f3f5f9',
            'color_scheme_remove_ads_color_hover_impact' => '#d6938a',
            'color_scheme_footer_menu_color_impact' => '#FFFFFF',
            'color_scheme_footer_menu_color_hover_impact' => '#ff9376',
            'color_scheme_footer_copyright_color_impact' => '#d6938a',
            'color_scheme_3dcity_page_background_color_impact' => '#470900',
            'color_scheme_3dcity_background_color_impact' => '#602217',

            'color_scheme_mobile_main_page_text_color_impact' => '#FFFFFF',
            'color_scheme_mobile_main_page_text_shadow_color_impact' => '#000000',
            'color_scheme_mobile_main_page_button_color_impact' => '#ff6d85',
            'color_scheme_mobile_main_page_button_active_color_impact' => '#e7495c',
            'color_scheme_mobile_main_page_button_text_color_impact' => '#FFFFFF',
            'color_scheme_mobile_main_page_button_terms_color_impact' => '#6dc9ff',
            'color_scheme_mobile_main_page_button_terms_active_color_impact' => '#2faae0',
            'color_scheme_mobile_main_page_button_terms_text_color_impact' => '#FFFFFF',
            'color_scheme_mobile_main_page_button_border_color_impact' => '#d5dce6',
            'color_scheme_mobile_main_page_button_border_active_color_impact' => '#E1E1E1',
            'color_scheme_mobile_join_page_text_color_impact' => '#FFFFFF',
            'color_scheme_mobile_join_page_text_opacity_impact' => array('value' => '54', 'type' => 'text'),
            'color_scheme_mobile_background_color_impact' => '#8d3028',
            'color_scheme_mobile_header_color_impact' => '#602217',
            'color_scheme_mobile_header_icons_color_impact' => '#d6938a',
            'color_scheme_mobile_header_counter_color_impact' => '#f15d75',
            'color_scheme_mobile_header_counter_text_color_impact' => '#ffffff',
            'color_scheme_mobile_subheader_color_impact' => '#000000',
            'color_scheme_mobile_subheader_text_color_impact' => '#f15d75',
            'color_scheme_mobile_label_text_color_impact' => '#ffffc5',
            'color_scheme_mobile_pencil_color_impact' => '#f15d75',
            'color_scheme_mobile_text_color_impact' => '#ffffff',
            'color_scheme_mobile_upgrade_page_text_color_impact' => '#FFFFFF',
            'color_scheme_mobile_footer_color_impact' => '#d6938a',
            'color_scheme_mobile_footer_text_color_impact' => '#f3f5f9',
            'color_scheme_mobile_footer_arrow_up_color_impact' => '#602217',
            'color_scheme_mobile_footer_more_options_color_impact' => '#f3f5f9',
            'color_scheme_mobile_menu_background_color_impact' => '#FFFFFF',
            'color_scheme_mobile_menu_icon_color_impact' => '#FFFFFF',
            'color_scheme_mobile_menu_text_color_impact' => '#FFFFFF',
            'color_scheme_mobile_menu_text_background_color_impact' => '#142d69',
            'color_scheme_mobile_button_disabled_background_color_impact' => '#9f9f9f',
            'color_scheme_mobile_alert_background_color_impact' => '#FFFFFF',
            'color_scheme_mobile_alert_icon_color_impact' => '#6989f5',
            'color_scheme_mobile_alert_text_color_impact' => '#000000',
            'color_scheme_mobile_alert_button_ok_background_color_impact' => '#6d8fff',
            'color_scheme_mobile_alert_button_ok_text_color_impact' => '#FFFFFF',
            'color_scheme_mobile_alert_button_cancel_background_color_impact' => '#8995b3',
            'color_scheme_mobile_alert_button_cancel_text_color_impact' => '#FFFFFF',
            'color_scheme_mobile_alert_button_cancel_border_right_color_impact' => '#FFFFFF',
            'color_scheme_mobile_button_disabled_background_color_impact' => '#9f9f9f',

            'color_scheme_chat_header_background_color_impact' => '#470900',
            'color_scheme_chat_header_icon_color_impact' => '#ffc4c4',
            'color_scheme_chat_header_text_color_impact' => '#FFFFFF',
            'color_scheme_chat_online_header_background_color_impact' => '#A74A42',
            'color_scheme_chat_online_header_background_color_hover_impact' => '#8E3129',
            'color_scheme_chat_online_header_icon_color_impact' => '#ffc4c4',
            'color_scheme_chat_online_header_text_color_impact' => '#FFFFFF',
            'color_scheme_chat_offline_header_background_color_impact' => '#888888',
            'color_scheme_chat_offline_header_background_color_hover_impact' => '#7A7A7A',
            'color_scheme_chat_offline_header_icon_color_impact' => '#b2b2b2',
            'color_scheme_chat_offline_header_text_color_impact' => '#FFFFFF',

            'color_scheme_pagination_active_item_text_color_impact' => '#FFFFFF',
            'color_scheme_pagination_active_item_background_color_impact' => '#602217',
            'color_scheme_pagination_inactive_item_text_color_impact' => '#602217',
            'color_scheme_pagination_disabled_item_color_impact' => '#BFBFBF',
        ),
        'marsh' => array(
            'title' => 'Marsh',
            'color_scheme_background_color_impact' => '#6e6046',
            'color_scheme_header_text_color_impact' => '#FFFFFF',
            'color_scheme_header_text_color_hover_impact' => '#ffe292',
            'color_scheme_menu_icons_impact' => array('value' => 'icons_nav_marsh.png', 'type' => 'select'),
            'color_scheme_menu_selected_item_background_color_impact' => '#332C15',
            'color_scheme_menu_text_color_impact' => '#bbb59f',
            'color_scheme_menu_text_hover_color_impact' => '#f8edc5',
            'color_scheme_menu_inactive_text_color_impact' => '#88826C',
            'color_scheme_menu_counter_color_impact' => '#FFFFFF',
            'color_scheme_menu_counter_background_color_impact' => '#eb6077',
            'color_scheme_menu_item_border_top_color_impact' => '#FFFFFF',
            'color_scheme_menu_item_border_top_opacity_impact' => array('value' => '10', 'type' => 'text'),
            'color_scheme_menu_item_border_bottom_color_impact' => '#000000',
            'color_scheme_menu_item_border_bottom_opacity_impact' => array('value' => '40', 'type' => 'text'),
            'color_scheme_column_background_color_impact' => '#4c452e',
            'color_scheme_column_text_color_impact' => '#FFFFFF',
            'color_scheme_remove_ads_color_impact' => '#f3f5f9',
            'color_scheme_remove_ads_color_hover_impact' => '#bbb59f',
            'color_scheme_footer_menu_color_impact' => '#FFFFFF',
            'color_scheme_footer_menu_color_hover_impact' => '#ffe292',
            'color_scheme_footer_copyright_color_impact' => '#bbb59f',
            'color_scheme_3dcity_page_background_color_impact' => '#332C15',
            'color_scheme_3dcity_background_color_impact' => '#4c452e',

            'color_scheme_mobile_main_page_text_color_impact' => '#FFFFFF',
            'color_scheme_mobile_main_page_text_shadow_color_impact' => '#000000',
            'color_scheme_mobile_main_page_button_color_impact' => '#ff6d85',
            'color_scheme_mobile_main_page_button_active_color_impact' => '#e7495c',
            'color_scheme_mobile_main_page_button_text_color_impact' => '#FFFFFF',
            'color_scheme_mobile_main_page_button_terms_color_impact' => '#6dc9ff',
            'color_scheme_mobile_main_page_button_terms_active_color_impact' => '#2faae0',
            'color_scheme_mobile_main_page_button_terms_text_color_impact' => '#FFFFFF',
            'color_scheme_mobile_main_page_button_border_color_impact' => '#d5dce6',
            'color_scheme_mobile_main_page_button_border_active_color_impact' => '#E1E1E1',
            'color_scheme_mobile_join_page_text_color_impact' => '#FFFFFF',
            'color_scheme_mobile_join_page_text_opacity_impact' => array('value' => '54', 'type' => 'text'),
            'color_scheme_mobile_background_color_impact' => '#6e6046',
            'color_scheme_mobile_header_color_impact' => '#4c452e',
            'color_scheme_mobile_header_icons_color_impact' => '#bbb59f',
            'color_scheme_mobile_header_counter_color_impact' => '#f15d75',
            'color_scheme_mobile_header_counter_text_color_impact' => '#ffffff',
            'color_scheme_mobile_subheader_color_impact' => '#000000',
            'color_scheme_mobile_subheader_text_color_impact' => '#f15d75',
            'color_scheme_mobile_label_text_color_impact' => '#ffffc5',
            'color_scheme_mobile_pencil_color_impact' => '#8ccd00',
            'color_scheme_mobile_text_color_impact' => '#ffffff',
            'color_scheme_mobile_upgrade_page_text_color_impact' => '#FFFFFF',
            'color_scheme_mobile_footer_color_impact' => '#bbb59f',
            'color_scheme_mobile_footer_text_color_impact' => '#f3f5f9',
            'color_scheme_mobile_footer_arrow_up_color_impact' => '#4c452e',
            'color_scheme_mobile_footer_more_options_color_impact' => '#f3f5f9',
            'color_scheme_mobile_menu_background_color_impact' => '#FFFFFF',
            'color_scheme_mobile_menu_icon_color_impact' => '#FFFFFF',
            'color_scheme_mobile_menu_text_color_impact' => '#FFFFFF',
            'color_scheme_mobile_menu_text_background_color_impact' => '#142d69',
            'color_scheme_mobile_button_disabled_background_color_impact' => '#9f9f9f',
            'color_scheme_mobile_alert_background_color_impact' => '#FFFFFF',
            'color_scheme_mobile_alert_icon_color_impact' => '#6989f5',
            'color_scheme_mobile_alert_text_color_impact' => '#000000',
            'color_scheme_mobile_alert_button_ok_background_color_impact' => '#6d8fff',
            'color_scheme_mobile_alert_button_ok_text_color_impact' => '#FFFFFF',
            'color_scheme_mobile_alert_button_cancel_background_color_impact' => '#8995b3',
            'color_scheme_mobile_alert_button_cancel_text_color_impact' => '#FFFFFF',
            'color_scheme_mobile_alert_button_cancel_border_right_color_impact' => '#FFFFFF',
            'color_scheme_mobile_button_disabled_background_color_impact' => '#9f9f9f',

            'color_scheme_chat_header_background_color_impact' => '#332C15',
            'color_scheme_chat_header_icon_color_impact' => '#f8edc5',
            'color_scheme_chat_header_text_color_impact' => '#FFFFFF',
            'color_scheme_chat_online_header_background_color_impact' => '#88826C',
            'color_scheme_chat_online_header_background_color_hover_impact' => '#6F6953',
            'color_scheme_chat_online_header_icon_color_impact' => '#f8edc5',
            'color_scheme_chat_online_header_text_color_impact' => '#FFFFFF',
            'color_scheme_chat_offline_header_background_color_impact' => '#888888',
            'color_scheme_chat_offline_header_background_color_hover_impact' => '#7A7A7A',
            'color_scheme_chat_offline_header_icon_color_impact' => '#b2b2b2',
            'color_scheme_chat_offline_header_text_color_impact' => '#FFFFFF',

            'color_scheme_pagination_active_item_text_color_impact' => '#FFFFFF',
            'color_scheme_pagination_active_item_background_color_impact' => '#4c452e',
            'color_scheme_pagination_inactive_item_text_color_impact' => '#4c452e',
            'color_scheme_pagination_disabled_item_color_impact' => '#BFBFBF',
        ),
        'custom' => array('title' => 'Custom'),
    ),

    'color_scheme_json' => 'Y',

	'main_page_image_default' => '1.jpg',
	'color_scheme_background_image' => 'no_image',
	'register_page_template' => 'register.html',
    'custom_user_registration' => 'Y',
    'profile_settings_popup' => 'Y',

    'hide_profile_settings' => array('set_can_comment_photos', 'color_scheme',
                                     'albums_to_see', 'default_online_view', 'autologin', 'smart_profile',
                                     'sound', 'framework_version', 'set_email_mail', 'set_notif_push_notifications',
                                     'wall_like_comment_alert', 'set_notif_gifts', 'set_email_interest',
                                     'wall_only_post', 'set_who_view_profile'),
    'area_login' => array('search_results.php'),
    'pofile_status_visitor' => 'Y',
    'pofile_status_empty_title' => 'Y',
    'menu_narrow_icon_upload' => 'Y',
    'profile_edit_main_location' => 'Y',
    'main_page_header_background_color' => 'Y',
    'feature_super_powers_allowed' => array('message_read_receipts'),

    'app_btn_position' => 'top',
    'redirect_wait_approval' => 'profile_view.php',
    'column_narrow_menu' => 'Y',

    'forgot_password_redirect_login' => 'Y',
    'not_allowed_chat_with_popular_users' => 'Y',
    'allow_like_profile_without_photos' => 'Y',
    'captcha_contact_only_visitor' => 'Y',
    'add_name_system_msg_general_chat' => 'Y',
    'gifts_disabled' => 'Y',


    'im_send_image' => 'Y',
    'im_send_image_width' => array('default' => 170,
                                   'one_chat' => 504),
    'verified_account_title_list' => 'Y',

    'profile_status_max_length' => 30,

	'live_enabled' => 'Y',
	'live_list_filter_disabled' => 'Y',
	'list_live_number_items' => 8,
	'gallery_tags_template' => 'Y',
	'gallery_comment_like_template' => 'Y',
	'gallery_comment_time_ago' => 'Y',
	'gallery_comment_parse_media' => 'Y',
	'show_comments_live_template' => 10,
	'get_text_tags_to_br_no_parse_br' => 'Y',

    //'rtl_style' => 'Y'

);

Common::setOptionRuntime('none', 'home_page_mode');
Common::setOptionRuntime('', 'set_home_page_urban');

Common::setOptionRuntime('N', 'wall_like_comment_alert');
Common::setOptionRuntime('N', 'im_audio_messages');

/*if(!Common::isOptionActive('hide_site_from_guests')) {

    if (!City::isCityInTab()) {
        Common::setOptionRuntime('Y', 'hide_site_from_guests');
    }

}*/