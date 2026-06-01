<? require "admin/login_check.php"; 
$connect=db_conn();


// 받는 변수 초기화
if( $select_linkfile == '') $select_linkfile=-1;
if( $select_category == '') $select_category=0;
if( $select_page_num == '') $select_page_num=10;
if( $select_use == '') $select_use=-1;

function show_category()
{
	global $table, $connect, $select_category;

	$data = mysql_query( "select * from sarangbi_category_".$table, $connect) or error(mysql_error());
	
	echo "<select name=select_category class=input1 onchange='page_change(-1);'>";
	echo "<option value=0>All Category</option>";
	while($db_data=mysql_fetch_array($data)){
		$ca_name=stripslashes($db_data[name]);
		$ca_name = del_html($ca_name);
		$ca_no=$db_data[no];
		if( $select_category == $ca_no)	$ca_selected = "selected";
		else $ca_selected = "";
		echo "<option value=$ca_no $ca_selected>$ca_name</option>";
	}
	echo "</select>";
}

$query="select count(*) from sarangbi_music_".$table;

if( $select_linkfile != -1 || $select_category != 0 || $search_string != '' || $select_use != -1)
	$query = $query." where ";

if( $select_linkfile != -1)
	$query = $query." linkfile=".$select_linkfile;

if( $select_category != 0){
	if( $select_linkfile != -1) $query=$query." and";
	$query = $query." category=".$select_category;
}

if( $search_string != ''){
	if( $select_linkfile != -1 || $select_category != 0) $query=$query." and";
	$query = $query." subject like '%".$search_string."%'";
}

if( $select_use != -1){
	if( $select_linkfile != -1 || $select_category != 0 || $search_string != '') $query=$query." and";
	$query = $query." use_this=".$select_use;
}

$db_data = mysql_fetch_array( mysql_query($query, $connect));
$total = $db_data["count(*)"];		// 전체 리스트 수
$page_num = $select_page_num;		// 한페이지 출력될 리스트 수
$show_page_num=10;			// 아래줄에 출력될 페이지 링크 수
$total_page =(int)(($total-1)/$page_num)+1;	// 전체 페이지 수
if( $page == '') $page=1;			// 현재 페이지
if( $total_page < $page) $page=$total_page;

$start_num = ($page-1)*$page_num;	// 출력 시작 페이지
$start_page = (int)(($page-1)/$show_page_num)*$show_page_num;	// 아래에 출력할 페이지 리스트 시작 번호


$query="select * from sarangbi_music_".$table;

if( $select_linkfile != -1 || $select_category != 0 || $search_string != '' || $select_use != -1)
	$query = $query." where ";

if( $select_linkfile != -1)
	$query = $query." linkfile=".$select_linkfile;

if( $select_category != 0){
	if( $select_linkfile != -1) $query=$query." and";
	$query = $query." category=".$select_category;
}

if( $search_string != ''){
	if( $select_linkfile != -1 || $select_category != 0) $query=$query." and";
	$query = $query." subject like '%".$search_string."%'";
}

if( $select_use != -1){
	if( $select_linkfile != -1 || $select_category != 0 || $search_string != '') $query=$query." and";
	$query = $query." use_this=".$select_use;
}

$query=$query." order by no desc limit $start_num, $page_num";

$data = mysql_query( $query, $connect) or error(mysql_error());
?>

<div style="position:absolute;z-index:1;visibility:hide" id="overDiv"></div>
<script language=javascript>
function page_change( jump)
{
	if( jump==-1){	// select 에서 선택 되었을 때 실행
		self.location.href='<?=$PHP_SELF?>?mode=list&page=<?=$page?>&select_page_num=' + select_page_num.options[select_page_num.selectedIndex].value + '&select_linkfile=' + select_linkfile.options[select_linkfile.selectedIndex].value + '&select_category=' + select_category.options[select_category.selectedIndex].value + '&search_string=<?=$search_string?>&select_use=' + select_use.options[select_use.selectedIndex].value;
	}else if( jump==-2){ // 검색어 지우고 리로딩 할 때 실행
		self.location.href='<?=$PHP_SELF?>?mode=list&page=<?=$page?>&select_page_num=' + select_page_num.options[select_page_num.selectedIndex].value + '&select_linkfile=' + select_linkfile.options[select_linkfile.selectedIndex].value + '&select_category=' + select_category.options[select_category.selectedIndex].value + '&select_use=' + select_use.options[select_use.selectedIndex].value;
	}else{ // 페이지 버튼 눌렀을 때 실행
		self.location.href='<?=$PHP_SELF?>?mode=list&page=' + jump + '&select_page_num=' + select_page_num.options[select_page_num.selectedIndex].value + '&select_linkfile=' + select_linkfile.options[select_linkfile.selectedIndex].value + '&select_category=' + select_category.options[select_category.selectedIndex].value + '&search_string=<?=$search_string?>&select_use=' + select_use.options[select_use.selectedIndex].value;
	}
}

function check_submit()
{
	if( !search.search_string.value){
		alert('검색어를 입력하세요.');
		search.search_string.focus();
		return false;
	}
}

function pre_listen(source){
	var w = 300;
	var h = 60;
	var sw = window.screen.availWidth;
	var sh = window.screen.availHeight;

	pre_listen_window = window.open("", "", "width=300,height=60");
	pre_listen_window.moveTo((sw - w) / 2, (sh - h) / 2);

	pre_listen_window.document.write("<html><head><title>SARANGBI BGM 미리 듣기</title>");
	pre_listen_window.document.write("<STYLE type=text/css>body{font-size:9pt; font-family:돋움; FONT-WEIGHT: 200}</style></head>");
	pre_listen_window.document.write("<body bgcolor=black><center>");

	pre_listen_window.document.write("<embed src='"+source+"' ShowStatusBar=true autostart=true width=260 height=70 loop=1>");

	pre_listen_window.document.write("</body></html>");
}
	

ns4 = (document.layers)? true:false
ie4 = (document.all)? true:false
if (ie4) {
	if (navigator.userAgent.indexOf('MSIE 5')>0) {
		ie5 = true;
	}else {
		ie5 = false;
	}
}else {
	ie5 = false;
}
var x = 0;
var y = 0;
var snow = 0;
var sw = 0;
var cnt = 0;
var dir = 1;
var submenu_show = 0;

if ( (ns4) || (ie4) ) {
	if (ns4) over = document.overDiv
	if (ie4) over = overDiv.style
	document.onmousemove = mouseMove
	if (ns4) document.captureEvents(Event.MOUSEMOVE)
}

function dcc(text, title, osy) {
	dtc(2, text, title, osy);
}

function click_submenu(){
	var i;
	var chk=false;
	for(i=0;i<document.search.length;i++)
		if(document.search[i].type=='checkbox')
			if(document.search[i].checked) chk=true;

	if( chk == true)
		submenu();
	else
		alert("항목을 선택하여 주세요.");
}

function submenu() {
	txt = "<div style=margin-left:10;margin-top:10'>";
	txt = txt + "<table cellspacing=0 cellpadding=0 width=90 bgcolor=#ffffff class=tooltable>";
	txt = txt + "<tr><td>";
	txt = txt + "<table cellspacing=0 cellpadding=3 width=100% bgcolor=#ffffff>";
	txt = txt + "<tr><td bgcolor='#D4D3D3' align=center>MENU</td></tr>";
	txt = txt + "<tr><td style='cursor:hand;' onclick=submenu_call('d') onmouseover=this.style.backgroundColor='#F5F5F5' onmouseout=this.style.backgroundColor=''>&nbsp;삭제</td></tr>";
	txt = txt + "<tr><td style='cursor:hand;' onclick=submenu_call('c') onmouseover=this.style.backgroundColor='#F5F5F5' onmouseout=this.style.backgroundColor=''>&nbsp;카테고리 변경</td></tr>";
	txt = txt + "<tr><td style='cursor:hand;' onclick=submenu_call('u') onmouseover=this.style.backgroundColor='#F5F5F5' onmouseout=this.style.backgroundColor=''>&nbsp;가장 위로</td></tr>";
	txt = txt + "<tr><td style='cursor:hand;' onclick=submenu_call('o') onmouseover=this.style.backgroundColor='#F5F5F5' onmouseout=this.style.backgroundColor=''>&nbsp;USE (O)</td></tr>";
	txt = txt + "<tr><td style='cursor:hand;' onclick=submenu_call('x') onmouseover=this.style.backgroundColor='#F5F5F5' onmouseout=this.style.backgroundColor=''>&nbsp;USE (X)</td></tr>";
	txt = txt + "</table></tr></td></table>";
	txt = txt + "</div>";
	layerWrite(txt);
	dir = 2;
	offsety = 20;
 	over.left = x;
	over.top = y
	showObject(over);
	snow = 0;
	submenu_show=1;
}

function hide_submenu()
{
	if( submenu_show != 0){
		if( submenu_show==2){
			submenu_show=false;
			nd();
			submenu_show=0;
		}else
			submenu_show=2
	}
}

function nd() {
	if ( cnt >= 1 ) { sw = 0 };
	if ( (ns4) || (ie4) ) {
		if ( sw == 0 ) {
		snow = 0;
		hideObject(over);
		}else {
			cnt++;
		}
	}
}
function dtc(d, text, title, osy) {
	txt = text
	layerWrite(txt);
	dir = d;
	offsety = osy;
	disp();
}
function disp() {
	if ( (ns4) || (ie4) ) {
		if (snow == 0) {
			if (dir == 2) {
				moveTo(over,x,y+10);
			}
			if (dir == 1) {
				moveTo(over,x,y+10);
			}
			if (dir == 0) {
				moveTo(over,x,y+10);
			}
			showObject(over);
			snow = 1;
		}
	}
}
function mouseMove(e) {
	if (ns4) {x=e.pageX; y=e.pageY;}
	if (ie4) {x=event.x; y=event.y;}
	if (ie5) {x=event.x+document.body.scrollLeft; y=event.y+document.body.scrollTop;}
	if (snow) {
		if (dir == 2) {
			moveTo(over,x,y+10);
		}
		if (dir == 1) {
			moveTo(over,x,y+10);
		}
		if (dir == 0) {
			moveTo(over,x,y+10);
		}
	}
}
function cClick() {
	hideObject(over);
	sw=0;
}
function layerWrite(txt) {
	if (ns4) {
		var lyr = document.overDiv.document
		lyr.write(txt)
		lyr.close()
	}else if (ie4) document.all["overDiv"].innerHTML = txt
}
function showObject(obj) {
	if (ns4) obj.visibility = "show"
	else if (ie4) obj.visibility = "visible"
}
function hideObject(obj) {
	if (ns4) obj.visibility = "hide"
	else if (ie4) obj.visibility = "hidden"
}
function moveTo(obj,xL,yL) {
	obj.left = xL-175;
	obj.top = yL
}

function haha()
{
	alert("haha");
}

function reverse() {
	var i;
	for(i=0;i<document.search.length;i++){
		if(document.search[i].type=='checkbox'){
			if(document.search[i].checked) {
				document.search[i].checked=false;
			}else{ 
				document.search[i].checked=true; 
			}
		}
	}
}

function submenu_call( mode)
{
	var i;
	var location_string;
	for(i=0;i<document.search.length;i++)
		if(document.search[i].type=='checkbox')
			if(document.search[i].checked)
				document.search.selected_no.value=document.search[i].value+';'+document.search.selected_no.value;

	location_string = "<?=$PHP_SELF?>";

	switch( mode){
		case 'd'	:	location_string = location_string + "?mode=list_del";
						break;
		case 'c'	:	location_string = location_string + "?mode=list_mc";
						break;
		case 'o'	:	location_string = location_string + "?mode=list_use_o";
						break;
		case 'x'	:	location_string = location_string + "?mode=list_use_x";
						break;
		case 'u'	:	location_string = location_string + "?mode=list_up";
						break;
	}

	location_string = location_string + "&page=<?=$page?>&select_page_num=";
	location_string = location_string + select_page_num.options[select_page_num.selectedIndex].value;
	location_string = location_string + "&select_linkfile=";
	location_string = location_string + select_linkfile.options[select_linkfile.selectedIndex].value;
	location_string = location_string + "&select_category=";
	location_string = location_string + select_category.options[select_category.selectedIndex].value;
	location_string = location_string + "&select_use=";
	location_string = location_string + select_use.options[select_use.selectedIndex].value;
	location_string = location_string + "&search_string=<?=$search_string?>";
	location_string = location_string + "&selected_no=";
	location_string = location_string + document.search.selected_no.value;

	window.location=location_string;
}

function one_data_command(del_no, command)
{
	location_string = "<?=$PHP_SELF?>";

	switch( command){
		case 'del'	: 	location_string = location_string + "?mode=list_del";
						break;
		case 'o'	:	location_string = location_string + "?mode=list_use_o";
						break;
		case 'x'	:	location_string = location_string + "?mode=list_use_x";
						break;
		case 'mod'	: 	location_string = location_string + "?mode=list_mod";
						break;
		case 'up'		:	location_string = location_string + "?mode=list_up";
	}
	location_string = location_string + "&page=<?=$page?>&select_page_num=";
	location_string = location_string + select_page_num.options[select_page_num.selectedIndex].value;
	location_string = location_string + "&select_linkfile=";
	location_string = location_string + select_linkfile.options[select_linkfile.selectedIndex].value;
	location_string = location_string + "&select_category=";
	location_string = location_string + select_category.options[select_category.selectedIndex].value;
	location_string = location_string + "&select_use=";
	location_string = location_string + select_use.options[select_use.selectedIndex].value;
	location_string = location_string + "&search_string=<?=$search_string?>";
	location_string = location_string + "&selected_no=";
	location_string = location_string + del_no + ";";

	window.location=location_string;
}

</script>

<br>
<TABLE cellspacing=0 cellpadding=0 border=0 bgcolor='#ffffff' width=550>
<tr>
	<td>
		<select name=select_linkfile class=input1 onchange='page_change(-1);'>
		<option value=-1>ALL</option>
		<option value=0 <? if( $select_linkfile == 0) echo "selected" ?>>Link</option>
		<option value=1 <? if( $select_linkfile == 1) echo "selected" ?>>File</option>
		<option value=2 <? if( $select_linkfile == 2) echo "selected" ?>>Ftp</option>
		</select>
		&nbsp;<? show_category(); ?>
	</td>
	<td width=96 align=left valign=bottom>
		<select name=select_use class=input1 onchange='page_change(-1);'>
		<option value=-1 <? if( $select_use == -1) echo "selected" ?>>ALL</option>
		<option value=1 <? if( $select_use == 1) echo "selected" ?>>O</option>
		<option value=0 <? if( $select_use == 0) echo "selected" ?>>X</option>
		</select>&nbsp;
		<select name=select_page_num class=input1 onchange='page_change(-1);'>
		<option value=5 <? if( $select_page_num == 5) echo "selected" ?>>5</option>
		<option value=10 <? if( $select_page_num == 10) echo "selected" ?>>10</option>
		<option value=15 <? if( $select_page_num == 15) echo "selected" ?>>15</option>
		<option value=20 <? if( $select_page_num == 20) echo "selected" ?>>20</option>
		</select>
	</td>
	<td width=57 align=right valign=bottom>
		<?=$total?> 개
	</td>
</tr>
</table>

<TABLE cellspacing=1 cellpadding=1 border=0 bgcolor='#E5E5E5' width=550>
<tr>
	<td align=center bgcolor='#00A2F7' height=18 width=40>
		<form method=post action=<?=$PHP_SELF?> name=search>
		<input type=hidden name=mode value='list'>
		<input type=hidden name=page value='<?=$page?>'>
		<input type=hidden name=select_page_num value='<?=$select_page_num?>'>
		<input type=hidden name=select_linkfile value='<?=$select_linkfile?>'>
		<input type=hidden name=select_category value='<?=$select_category?>'>
		<input type=hidden name=select_use value='<?=$select_use?>'>
		<input type=hidden name=selected_no>
			<font color=white>TYPE</font>
	</td>
	<td align=center bgcolor='#00A2F7' height=18 width=23>
			<a href="javascript:reverse()"><img src="admin/img/c.gif" border=0></a>
	</td>
	<td align=center bgcolor='#00A2F7' height=18>
			<font color=white>SUBJECT</font>
	</td>
	<td align=center bgcolor='#00A2F7' height=18 width=30>
			<font color=white>USE</font>
	</td>
	<td align=center bgcolor='#00A2F7' height=18 width=30>
			<font color=white>MOD</font>
	</td>
	<td align=center bgcolor='#00A2F7' height=18 width=30>
			<font color=white>DEL</font>
	</td>
	<td align=center bgcolor='#00A2F7' height=18 width=70>
			<font color=white>ETC</font>
	</td>
</tr>
<?
while($db_data=mysql_fetch_array($data))
{
	$print_no = $db_data[no];
	$print_subject = $db_data[subject];		// stripslashes 함
	$print_linkfile = $db_data[linkfile];	// stripslashes 함
	$print_subject2 = $db_data[subject];	// 풍선 도움말 출력용 stripslashes 안함 del_html 함
	$print_use_this = $db_data[use_this];

	$print_context = $db_data[context];
	$print_context = del_html($print_context);
	$print_context = str_replace("\r\n","<br>", $print_context);

	if( $print_linkfile == 1)
		$print_prelisten = $db_data[filename];
	else
		$print_prelisten = $db_data[link];

	$print_msg_link=$print_prelisten;
	
	$print_subject = stripslashes($print_subject);
	$print_link = stripslashes($print_link);

	$print_subject = del_html($print_subject);
	$print_msg_link = del_html($print_msg_link);

	$print_subject2 = del_html($print_subject2);

	// 풍선 도움말 작성
	$output_msg="제목 : ".$print_subject2."<br>";

	if( $print_linkfile == 0){
		$output_msg=$output_msg."주소 : ".$print_msg_link."<br>";
		if( $db_data[use_caption] == 1)
			$output_msg=$output_msg."가사 : ".del_html($db_data[caption_url])."<br>";
	}

	if( $print_linkfile == 1){
		$output_msg=$output_msg."파일 : ".$db_data[s_filename]."<br>";
		if( $db_data[use_caption] == 1)
			$output_msg=$output_msg."가사 : ".$db_data[caption_s_filename]."<br>";
	}

	if( $print_linkfile == 2){
		$output_msg=$output_msg."파일 : ".$db_data[s_filename]."<br>";
		$output_msg=$output_msg."주소 : ".$print_msg_link."<br>";
		if( $db_data[use_caption] == 1){
			$output_msg=$output_msg."가사 : ".$db_data[caption_s_filename]."<br>";
			$output_msg=$output_msg."주소 : ".del_html($db_data[caption_url])."<br>";
		}
	}


	$output_msg=$output_msg."메모<br>";
	$output_msg=$output_msg."====<br>";
	$output_msg=$output_msg.$print_context;
	
	
?>
<tr>
	<td align=center bgcolor='white' height=18 width=40>
		<?
		switch( $print_linkfile){
			case 0 : echo "<font color=red>LINK</font>"; break;
			case 1 : echo "<font color=blue>FILE</font>"; break;
			case 2 : echo "<font color=green>FTP</font>"; break;
		}
		?>
	</td>
	<td align=center bgcolor='white' height=18 width=23>
			<input type=checkbox name=cart value="<?=$print_no?>">
	</td>
	<td align=left bgcolor='white' height=18 onMouseOver="dcc('<div style=margin-left:10;margin-top:10><table cellspacing=0 cellpadding=3 width=350 bgcolor=#ffffff class=tooltable><tr><td><?=$output_msg?></td></tr></table></div>','','20')" onMouseOut="nd()">
		<?=$print_subject?>
	</td>
	<td align=center bgcolor='white' height=18 width=30>
		<?
			if( $print_use_this == 0){
				echo "<a href=\"javascript:one_data_command($print_no,'o')\" title='사용 하지 않음'><font color=red>X</font></a>";
			}else{
				echo "<a href=\"javascript:one_data_command($print_no,'x')\" title='사용'><font color=blue>O</font></a>";
			}
		?>
	</td>
	<td align=center bgcolor='white' height=18 width=30>
		<a href="javascript:one_data_command(<?=$print_no?>,'mod')" title="수정"><font color=blue>수정</font></a>
	</td>
	<td align=center bgcolor='white' height=18 width=30>
		<a href="javascript:one_data_command(<?=$print_no?>,'del')" title="삭제"><font color=blue>삭제</font></a>
	</td>
	<td align=center bgcolor='white' height=18 width=70>
		<a href="javascript:pre_listen('<?=$print_prelisten?>')"><img src="admin/img/speak.gif" border=0 alt="미리 듣기"></a>&nbsp;
		<a href="<?=$print_prelisten?>" target=_blank><img src="admin/img/disk.gif" border=0 alt="저장"></a>&nbsp;
		<a href="javascript:one_data_command(<?=$print_no?>,'up')"><img src="admin/img/up.gif" border=0 alt="가장 위로"></a>
	</td>
</tr>
<? } ?>
</table>
<table cellspacing=0 cellpadding=0 border=0><tr><td height=3></td></tr></table>
<table cellspacing=0 cellpadding=0 border=0 width=550>
<tr>
	<td width=55 align=left>
		<a href="#" onclick="click_submenu()"><img src="admin/img/menu.gif" border=0>
	</td></a>
	<td align=center>
<?
// 페이지 출력
$i=1;

if( $page>$show_page_num)
{
	$prev_page=$start_page;
	echo "<a href=$PHP_SELF?mode=list&page=$prev_page>[prev]</a>";
}

while( ($i+$start_page <= $total_page) && ($i <= $show_page_num))
{
	$move_page = $i+$start_page;
	if( $page == $move_page) echo "$move_page ";
	else echo "<a href='javascript:page_change($move_page)'>[$move_page]</a> ";
	$i++;
}
// 전체 페이지 수가 더 클 때
if( $total_page > $move_page){
	$next_page=$move_page+1;
	echo "<a href=$PHP_SELF?mode=list&page=$next_page>[next]</a>";
}
?>
	</td>
	<td width=55></td>
</tr>
</table>
<table border=0 cellspacing=0 cellpadding=0>
<tr>
	<td>
		<input type=text name=search_string size=20 maxlength=20 class=input3 value=<?=$search_string?>>
		<table border=0 cellspacing=0 cellpadding=0><tr><td height=3></td></tr></table>
	</td>
	<td valign=bottom>
		<input type=image name='submit' src='admin/img/search.gif' onclick='return check_submit();' border=0>
	</td>
	<td valign=bottom>
		<a href='javascript:page_change(-2)'><img src='admin/img/search2.gif' border=0></a>
	</td>
</tr>
</table>
</form>

<script language="JavaScript">
if (document.all && window.print) {
	document.body.onclick = hide_submenu;
}
</script>
<?
db_close();
?>