<?php
	//ѫ�»����ͳ�ƣ������
	//�����б�
	//$startday:��ʼ����
	//$endday:��������
	//����
	//array[0]:array{cao,huang,huang}
	if (!defined("MANAGE_INTERFACE")) exit;

	if (!isset($startday)){exit("param_not_exist");}
	if (!isset($endday)){exit("param_not_exist");}
	
	$ret = sql_fetch_one("select sum(case when battleid='1001' then metal else 0 end) as huang,
											sum(case when battleid='2001' and unionid=3 then metal else 0 end) as yuan,
											sum(case when battleid='2001' and unionid=4 then metal else 0 end) as cao
											from log_battle_honour 
											where starttime between  unix_timestamp('$startday') and unix_timestamp('$endday')+86400"); 
?>