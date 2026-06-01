<?
$table="default";
	
	$sarangbi_bgm_query1 = "CREATE TABLE sarangbi_setup_".$table."(
								no int(1) DEFAULT '0' NOT NULL auto_increment,
								pw varchar(20),
								use_start int(1) DEFAULT '0' NOT NULL,
								use_random int(1) DEFAULT '0' NOT NULL,
								use_context int(1) DEFAULT '0' NOT NULL,
								use_category int(1) DEFAULT '0' NOT NULL,
								use_status int(1) DEFAULT '0' NOT NULL,
								use_user int(1) DEFAULT '1' NOT NULL,
								use_sort int(1) DEFAULT '0' NOT NULL,
								use_frame int(1) DEFAULT '0' NOT NULL,
								init_volume int(2) DEFAULT '7' NOT NULL,
								bgm_frame varchar(255),
								list_frame varchar(255),
								skin_dir varchar(255),
								play_alt varchar(255),
								stop_alt varchar(255),
								back_alt varchar(255),
								forward_alt varchar(255),
								pause_alt varchar(255),
								vol_up_alt varchar(255),
								vol_down_alt varchar(255),
								one_alt varchar(255),
								loop_alt varchar(255),
								sound_on_alt varchar(255),
								sound_off_alt varchar(255),
								sequence_alt varchar(255),
								random_alt varchar(255),
								list_alt varchar(255),
								admin_alt varchar(255),
								num_list int(2) DEFAULT '20' NOT NULL,
								PRIMARY KEY (no))";

	$sarangbi_bgm_query2 = "CREATE TABLE sarangbi_category_".$table."(
								no int(13) DEFAULT '0' NOT NULL auto_increment,
								name varchar(255) DEFAULT '일반' NOT NULL,
								PRIMARY KEY (no))";

	$sarangbi_bgm_query3 = "CREATE TABLE sarangbi_music_".$table."(
								no int(13) DEFAULT '0' NOT NULL auto_increment,
								subject varchar(255) DEFAULT 'MUSIC' NOT NULL,
								context text,
								filename varchar(255),
								s_filename varchar(255),
								ftp int(13),
								link varchar(255),
								linkfile int(1) DEFAULT '1' NOT NULL,
								use_this int(1) DEFAULT '1' NOT NULL,
								category int(13) DEFAULT '1' NOT NULL,
								use_caption int(1) DEFAULT '0' NOT NULL,
								caption_url varchar(255) DEFAULT '',
								caption_filename varchar(255) DEFAULT '',
								caption_s_filename varchar(255) DEFAULT '',
								PRIMARY KEY(no))";

	$sarangbi_bgm_query4 = "CREATE TABLE sarangbi_ftp_".$table."(
								no int(13) DEFAULT '0' NOT NULL auto_increment,
								name varchar(255) DEFAULT '0' NOT NULL,
								address varchar(255) DEFAULT '0' NOT NULL,
								directory varchar(255),
								link varchar(255) DEFAULT '0' NOT NULL,
								id varchar(255) DEFAULT '0' NOT NULL,
								pw varchar(255) DEFAULT '0' NOT NULL,
								port varchar(10) DEFAULT '21' NOT NULL,
								PRIMARY KEY (no))";

	
	// 초기값 입력
	$sarangbi_bgm_query5 = "INSERT INTO sarangbi_setup_".$table." values('1',password('sarangbi'),'1','0','0','0','1','1','3','0','7','top.bgm','top.bgmlist','pink','Play','Stop','Previous Music Play','Next Music Play', 'Pause','Volume Up','Volume Down','No Loop','Loop','Sound On', 'Sound Off', 'Sequence', 'Random', 'Show BGM List','Administrator','20')";
	$sarangbi_bgm_query6 = "INSERT INTO sarangbi_category_".$table." values('1','일반')";
?>