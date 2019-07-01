<?php 

include_once '/../functions.php';
include  '/../config.php';
include  '/../classes/Calendar.php';
include  '/../classes/Database.php';

switch(getenv('REQUEST_METHOD'))
{
	
	case 'GET':
		if(!empty($_GET['success']))
		{	//сообщаем о обновлении заявки
			include 'templates/admin-answer.php';
		}
		else if(!empty($_GET['id']))
		{
			$form=Calendar::loadById($_GET['id']);
			include 'templates/admin-edit.php';
		}
		else
		{
			$requests=Calendar::getAll();
			include 'admin.php';
			
		}
		break;
	case 'POST' :
		if(!empty($_POST['id']))
		{
				$form=Calendar::loadById($_POST['id']);
				//include 'templates/admin-edit.php';
		}
		else
		{
			$form=new Calendar;
		}
	
		
		//if(!empty(get_post()))
		//{
			$form->fill(get_from_request(['topic','type','place','date','time','length','comment']));
			
			//if($form->validate())
			//{
			//	echo 'Ваша форма отправлена';
				$form->save();
				//header('Location: /admin.php?success');
				exit;
			}
			else
			{
				echo '<div class="errors">'.'ФОРМА НЕ ОТПРАВЛЕНА. ИСПРАВЬТЕ ОШИБКИ! </div>';
				include 'templates/task.php';
			}
		//}
		break;
}