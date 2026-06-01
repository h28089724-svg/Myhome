<? 
if( $HTTP_COOKIE_VARS['sarangbi_bgm_chk_'.$table] != "ok"){
	echo "<br><br><br><br><br><br><br><br><br><br><br>";
	include "admin/login.php";
	include "admin/tail.php";
	exit;
}
?>
<TABLE cellspacing=0 cellpadding=0 border=0 height=19>
<tr>
	<td height=19>
		<?
			$btn_1="admin/img/btn_1.gif"; 
			$btn_2="admin/img/btn_1_over.gif";
			if( $mode== 'setup') $btn_1=$btn_2
		?>
		<a href="<?=$PHP_SELF?>?mode=setup">
		<img src=<?=$btn_1?> border=0
			onmouseout=this.src="<?=$btn_1?>"
			onmouseover=this.src="<?=$btn_2?>">
		</a>
	</td>
	<td height=19>
		<?
			$btn_1="admin/img/btn_2.gif"; 
			$btn_2="admin/img/btn_2_over.gif";
			if( $mode== 'list') $btn_1=$btn_2
		?>
		<a href="<?=$PHP_SELF?>?mode=list">
		<img src=<?=$btn_1?> border=0
			onmouseout=this.src="<?=$btn_1?>"
			onmouseover=this.src="<?=$btn_2?>">
		</a>
	</td>
	<td height=19>
		<?
			$btn_1="admin/img/btn_3.gif"; 
			$btn_2="admin/img/btn_3_over.gif";
			if( $mode== 'upload') $btn_1=$btn_2
		?>
		<a href="<?=$PHP_SELF?>?mode=upload">
		<img src=<?=$btn_1?> border=0
			onmouseout=this.src="<?=$btn_1?>"
			onmouseover=this.src="<?=$btn_2?>">
		</a>
	</td>
	<td height=19>
		<?
			$btn_1="admin/img/btn_4.gif"; 
			$btn_2="admin/img/btn_4_over.gif";
			if( $mode== 'link') $btn_1=$btn_2
		?>
		<a href="<?=$PHP_SELF?>?mode=link">
		<img src=<?=$btn_1?> border=0
			onmouseout=this.src="<?=$btn_1?>"
			onmouseover=this.src="<?=$btn_2?>">
		</a>
	</td>
	<td height=19>
		<?
			$btn_1="admin/img/btn_5.gif"; 
			$btn_2="admin/img/btn_5_over.gif";
			if( $mode== 'ftp_upload') $btn_1=$btn_2
		?>
		<a href="<?=$PHP_SELF?>?mode=ftp_upload">
		<img src=<?=$btn_1?> border=0
			onmouseout=this.src="<?=$btn_1?>"
			onmouseover=this.src="<?=$btn_2?>">
		</a>
	</td>
	<td height=19>
		<?
			$btn_1="admin/img/btn_6.gif"; 
			$btn_2="admin/img/btn_6_over.gif";
			if( $mode== 'category') $btn_1=$btn_2
		?>
		<a href="<?=$PHP_SELF?>?mode=category">
		<img src=<?=$btn_1?> border=0
			onmouseout=this.src="<?=$btn_1?>"
			onmouseover=this.src="<?=$btn_2?>">
		</a>
	</td>
	<td height=19>
		<?
			$btn_1="admin/img/btn_7.gif"; 
			$btn_2="admin/img/btn_7_over.gif";
			if( $mode== 'ftp_set') $btn_1=$btn_2
		?>
		<a href="<?=$PHP_SELF?>?mode=ftp_set">
		<img src=<?=$btn_1?> border=0
			onmouseout=this.src="<?=$btn_1?>"
			onmouseover=this.src="<?=$btn_2?>">
		</a>
	</td>
	<td height=19>
		<?
			$btn_1="admin/img/btn_8.gif"; 
			$btn_2="admin/img/btn_8_over.gif";
		?>
		<a href="http://www.sarangbi.net/index-manual.php" target=_blank>
		<img src=<?=$btn_1?> border=0
			onmouseout=this.src="<?=$btn_1?>"
			onmouseover=this.src="<?=$btn_2?>">
		</a>
	</td>
</tr>
</table>
