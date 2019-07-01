<?php include_once   '/../classes/calendar.php';?>

<?php if($form->hasErrors):?>
<p>В форме есть ошибки!</p>
<!--<ul>
<?php foreach ($form->getErrors() as $key=>$error):?>
	<li><?=$error ?></li>
	<?php endforeach; ?>
</ul>-->
<?php endif;?>

<form action='/' accept-charset="utf-8" method="POST" >
<div class="content">
	<div class="child">
	<h1 class="divider">Новая задача</h1>
		<!--со звкздочкой обязательные поля-->
		<div class="text"> <label> *Тема:</label></div>
			<input type="text" name ="topic" value="<?= e($form->topic)?>">
			<span><?=e($form->getError('topic'))?></span>
			<br>
			<br>
				<div class="text"> <label> Тип: </label>
				<select name="type_n"> 
					<optgroup label="Тип"> 
						<option value="vstr" name="vstr">Встреча</option>
						<option value="zvonok" name="zvonok">Звонок</option>				
						<option value="soveshan" name="soveshan">Совещание</option>
						<option value="delo" name="delo">Дело</option>
					</optgroup> 
				</select> 
		</div>
		<br>
		<br>
		
		<div class="text"> <label> Место: </label>
			<input type="text" name ="place" value="<?e($form->place)?>"></div>
		<br>
		<br>
		<div class="text"> <label> *Дата: </label>
			<input type="date" name='date_reserv' value="<?=e($form->date_reserv)?>" max="2100-01-01" min="2019-01-01"> 
			<span><?=e($form->getError('date_reserv'))?></span>
		</div>
		
		<br><br>
		<div class="text"> <label> *Время:</label>
		<input type="time" name="time_reserv" value="<?=e($form->time_reserv)?>" min="00:00" max="23:59"></div>
		<span><?=e($form->getError('time_reserv'))?></span>
		<br>
		<br>
		<div class="text"> <label> Длительность: </label>
			<select name="length">
				<option value="1h">1 час</option>
				<option value="2h">2 часа</option>
				<option value="3h">3 часа</option>
				<option value="4h">4 часа</option>
				<option value=">=5h">5 и более часов</option>
				<option value="1day">1 день</option>
		</select> 
		</div>
		<br>
		<br>
		<div class="text"> <label> Комментарий: </label></div>
		<br>
		<textarea name="comment" cols="60" rows="4" value="<?=e($form->comment)?>"></textarea></p>

		<br>
		<br>
		
	
	</div>
	<button type="submit">Добавить</button></div>
	<br>
	
</form>
</div>



<form action="/templates/task.php">
		<p><input type="submit2" value="Перейти к заданиям"></p>
</form>