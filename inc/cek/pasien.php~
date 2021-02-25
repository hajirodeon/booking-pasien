<?php
///cek session //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$kd14_session = nosql($_SESSION['kd14_session']);
$username14_session = nosql($_SESSION['username14_session']);
$adm_session = nosql($_SESSION['adm_session']);
$pass14_session = nosql($_SESSION['pass14_session']);
$hajirobe_session = nosql($_SESSION['hajirobe_session']);

$qbw = mysql_query("SELECT kd FROM m_koperasi ".
						"WHERE kd = '$kd14_session' ".
						"AND usernamex = '$username14_session' ".
						"AND passwordx = '$pass14_session'");
$rbw = mysql_fetch_assoc($qbw);
$tbw = mysql_num_rows($qbw);

if (($tbw == 0) OR (empty($kd14_session))
	OR (empty($username14_session))
	OR (empty($pass14_session))
	OR (empty($adm_session))
	OR (empty($hajirobe_session)))
	{
	//re-direct
	$pesan = "ANDA BELUM LOGIN. SILAHKAN LOGIN DAHULU...!!!";
	pekem($pesan, $sumber);
	exit();
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
?>