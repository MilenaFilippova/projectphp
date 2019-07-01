<?php 
	include_once   '/../classes/calendar.php';
	include_once  'classes/Database.php';
	include   '/../header.php';
	mb_internal_encoding('utf-8');
	include_once  '/../functions.php';
	include  '/../config.php';
	
?>

<form action='/' accept-charset="utf-8" method="POST" >
<div class="content">
	<div class="child">
	<h1 class="divider">Список задач</h1>
		<!--со звкздочкой обязательные поля-->
		
				<p><div class="text"> <label> Задачи: </label>
				<select name="type"> 
					<optgroup label="Тип"> 
						<option value="vstr" name="vstr">текущие задачи</option>
						<option value="zvonok" name="zvonok">просроченные задачи</option>				
						<option value="soveshan" name="soveshan">выполненные задачи</option>
						<option value="delo" name="delo">задачи на конкретную дату</option>
					</optgroup> 
				</select> 
				
				<label> *Дата: </label>
					<input type="date" name='date' value="<?=e($form->date)?>" max="2100-01-01" min="2019-01-01"> 
				</div></p>
				
				<ul>
					<li><a href="/index.php">сегодня</a></li>
					<li><a href="/index.php">завтра</a></li>
				</ul>
				
				<div class="child">
					<table border=1>	
					<thead>
					<tr>
						<th>Тип</th>
						<th>Задача</th>
						<th>Место</th>
						<th>Дата и время</th>
					</tr>
				</thead>
				<tbody>
				<form action="admin.php"  accept-charset="utf-8" method="POST">
					<?php foreach ($requests as $request): ?>
						<tr>
							<td><?= e($request->getId())?></td>
							<td><?= e($request->topic) ?></td>
							<td><?= e($request->place) ?></td>
							<td><?= e($request->date) ?></td>
							<td><?= e($request->time)?></td>
							<td><?= e($request->length)?></td>
							<td> <a href ="/admin.php?id=<?e($request->getId())?>"edit</a></td>
					
						</tr>
					<?php endforeach;?>
				</tbody>
				</table>
				</div >
		
		<br><br>
		
	
	</div>
	
</form>
</div>