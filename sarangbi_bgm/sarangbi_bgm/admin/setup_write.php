<? require "admin/login_check.php"; 

$connect=db_conn();

// 작은 따옴표 제거
$new_bgm_frame=str_replace("\'","",$new_bgm_frame);
$new_list_frame=str_replace("\'","",$new_list_frame);

$new_play_alt=str_replace("\'","",$new_play_alt);
$new_stop_alt=str_replace("\'","",$new_stop_alt);
$new_pause_alt=str_replace("\'","",$new_pause_alt);
$new_back_alt=str_replace("\'","",$new_back_alt);
$new_forward_alt=str_replace("\'","",$new_forward_alt);
$new_vol_up_alt=str_replace("\'","",$new_vol_up_alt);
$new_vol_down_alt=str_replace("\'","",$new_vol_down_alt);
$new_one_alt=str_replace("\'","",$new_one_alt);
$new_loop_alt=str_replace("\'","",$new_loop_alt);
$new_sound_on_alt=str_replace("\'","",$new_sound_on_alt);
$new_sound_off_alt=str_replace("\'","",$new_sound_off_alt);
$new_sequence_alt=str_replace("\'","",$new_sequence_alt);
$new_random_alt=str_replace("\'","",$new_random_alt);
$new_list_alt=str_replace("\'","",$new_list_alt);
$new_admin_alt=str_replace("\'","",$new_admin_alt);

// 큰 따옴표 제거
$new_bgm_frame=str_replace("\\\"","",$new_bgm_frame);
$new_list_frame=str_replace("\\\"","",$new_list_frame);

$new_play_alt=str_replace("\\\"","",$new_play_alt);
$new_stop_alt=str_replace("\\\"","",$new_stop_alt);
$new_pause_alt=str_replace("\\\"","",$new_pause_alt);
$new_back_alt=str_replace("\\\"","",$new_back_alt);
$new_forward_alt=str_replace("\\\"","",$new_forward_alt);
$new_vol_up_alt=str_replace("\\\"","",$new_vol_up_alt);
$new_vol_down_alt=str_replace("\\\"","",$new_vol_down_alt);
$new_one_alt=str_replace("\\\"","",$new_one_alt);
$new_loop_alt=str_replace("\\\"","",$new_loop_alt);
$new_sound_on_alt=str_replace("\\\"","",$new_sound_on_alt);
$new_sound_off_alt=str_replace("\\\"","",$new_sound_off_alt);
$new_sequence_alt=str_replace("\\\"","",$new_sequence_alt);
$new_random_alt=str_replace("\\\"","",$new_random_alt);
$new_list_alt=str_replace("\\\"","",$new_list_alt);
$new_admin_alt=str_replace("\\\"","",$new_admin_alt);

// 슬래쉬 추가
$new_bgm_frame=addslashes(del_html($new_bgm_frame));
$new_list_frame=addslashes(del_html($new_list_frame));

$new_play_alt=addslashes(del_html($new_play_alt));
$new_stop_alt=addslashes(del_html($new_stop_alt));
$new_pause_alt=addslashes(del_html($new_pause_alt));
$new_back_alt=addslashes(del_html($new_back_alt));
$new_forward_alt=addslashes(del_html($new_forward_alt));
$new_vol_up_alt=addslashes(del_html($new_vol_up_alt));
$new_vol_down_alt=addslashes(del_html($new_vol_down_alt));
$new_one_alt=addslashes(del_html($new_one_alt));
$new_loop_alt=addslashes(del_html($new_loop_alt));
$new_sound_on_alt=addslashes(del_html($new_sound_on_alt));
$new_sound_off_alt=addslashes(del_html($new_sound_off_alt));
$new_sequence_alt=addslashes(del_html($new_sequence_alt));
$new_random_alt=addslashes(del_html($new_random_alt));
$new_list_alt=addslashes(del_html($new_list_alt));
$new_admin_alt=addslashes(del_html($new_admin_alt));

$update_query="update sarangbi_setup_".$table." set 
 use_start='$new_start',
 use_random='$new_random',
 use_context='$new_context',
 use_category='$new_category',
 use_status='$new_status',
 use_user='$new_user',
 use_sort='$new_sort',
 use_frame='$new_frame',
 init_volume='$new_init_volume',
 bgm_frame='$new_bgm_frame',
 list_frame='$new_list_frame',
 skin_dir='$new_skin_dir',
 play_alt='$new_play_alt',
 stop_alt='$new_stop_alt',
 back_alt='$new_back_alt',
 forward_alt='$new_forward_alt',
 pause_alt='$new_pause_alt',
 vol_up_alt='$new_vol_up_alt',
 vol_down_alt='$new_vol_down_alt',
 one_alt='$new_one_alt',
 loop_alt='$new_loop_alt',
 sound_on_alt='$new_sound_on_alt',
 sound_off_alt='$new_sound_off_alt',
 sequence_alt='$new_sequence_alt',
 random_alt='$new_random_alt',
 list_alt='$new_list_alt',
 admin_alt='$new_admin_alt',
 num_list='$new_num_list'
 where no=1";

mysql_query( $update_query, $connect) or error(mysql_error());
db_close();
?>
<br><br><br><br><br><br><br><br><br><br><br>
<font color=red>저장 되었습니다.</font><br><br>
<a href='<?=$PHP_SELF?>?mode=setup'><img src='admin/img/ok.gif' border=0></a>
