<?php
mb_internal_encoding('utf-8');
include_once  'functions.php';
include_once  'classes/Database.php';
include_once   'header.php';
include   'config.php';
include_once   'classes/calendar.php';

$form = new Calendar;
$db=new Database();


$errors=[];

switch(getenv('REQUEST_METHOD'))
{
	case 'GET':
		if(isset($_GET['submit']))
		{
			include 'templates/answer.php';	//форма отправлена
			exit;
		}
		include 'templates/request.php' ;
		break;
	
	
	case 'POST' :
	if(isset($_POST['submit']))
	{
		if(!empty(get_post()))
		{
			$form->fill(get_from_request(['topic','type_n','place','date_reserv','time_reserv','length','comment']));

			$insertRow=$db->insertRow("INSERT INTO `task` (topic,type_n,place,date_reserv,time_reserv,length) VALUE(?,?,?,?,?,?)",
			["er","vdfvdd","dsvfv","2019-04-04","12:08","1"]);
			
			die_r($insertRow);
		
		
			if($form->validate())
			{
				echo 'Ваша форма отправлена';
				$form->save();
				//header('Location: /index.php?success');
				exit;
			}
			else
			{
				echo '<div class="errors">'.'ЗАПИСЬ НЕ ОТПРАВЛЕНА. ИСПРАВЬТЕ ОШИБКИ! </div>';
				include 'admin.php';
				//$errors=$form->getErrors();
			}
		}
	}
		
}



?>
