<header><div class = 'tt'>TODO</div></header>
    <title>TODO</title>
 <link href='style.css' rel='stylesheet' type='text/css'> 
	
<!-- Отображение задач -->	
<div class = 'view'>
<table>
               <?php
			   include ("db.php");

$db = new DB(SERVER,USER,PASS,DBNAME);
$names = $db->select();

while ($result = mysqli_fetch_array($names)) {
    echo '<tr>
		  <td>'.$result['name'].'</td>
		  <td>'.$result['p_name'].' </td></tr>';    	  
}
?>
    </table>

<!-- Кнопка на добавление задачи-->			
<form method=get>
	   <input name="task_t" type="text" id='task_t' size="15" maxlength="15">
	   

	   <select name = "comb">
<?php
$names = $db->select_proj();
while ($result = mysqli_fetch_array($names)) {
    echo '<option value = '.$result['id'].'>'.$result['name'].'</option>';
}

?>
</select> 
	   
	   <input type=submit name=task value='Добавить'>
	
</form>	
		
</div>			




		
<!--Отображение проектов -->		
<div class = 'view_proj'>
	<table>
<?php

$names = $db->select_proj();

while ($result = mysqli_fetch_array($names)) {
    echo '<tr>
		  <td>'.$result['name'].'</td></tr>';    	  
}
?>
    </table>		

<form method=get>
	   <input name="proj" type="text" id='proj' size="10" maxlength="10">
	   <input type=submit name=btn_proj value='Добавить'>
	
</form>	
			</div>
			
	
	
			
<!--INSERT PROJ-->
<?php

if(isset($_GET['btn_proj'])) {
$names = $db->insert_proj($_GET['proj']);
header("Location: work.php");
}

?>



<!--INSERT TASK-->
<?php

if(isset($_GET['task'])) {
$names = $db->insert_task($_GET['task_t'], $_GET['comb']);
header("Location: work.php");
}

?>




			