<?php

define('SERVER','localhost');
define('USER','admin');
define('PASS','admin');
define('DBNAME','light_it');


class DB
{
   protected $connection;
   
public function __construct($host, $user, $password, $db_name) 
{
   $this->connection = new mysqli($host, $user, $password, $db_name);

   if( !$this->connection ) {
   throw new Exception('Could not connect to DB ');
}

}

public function select()
{ $fetched = array();
$sql = "SELECT t.id,
					            t.name,  
								p.name as p_name
						   from tasks t, 
							    project p, 
								prior pr, 
								status s 
						  where t.prior_id = pr.id 
						    and t.status_id = s.id 
							and t.project_id = p.id 
						  order by pr.id DESC";
 
$db = mysqli_connect(SERVER,USER,PASS,DBNAME);
$query = mysqli_query($db, $sql);

if($query)
{
	
	return $query;
	
}
else
{
return false;
}
}


public function select_proj()
{ $fetched = array();
$sql = "SELECT p.name, p.id from project p";
 
$db = mysqli_connect(SERVER,USER,PASS,DBNAME);
$query = mysqli_query($db, $sql);

if($query)
{
	return $query;	
}
else
{
return false;
}
}

//INSERT  TASK
public function insert_task($name,$proj) 
 { 
 $db = mysqli_connect(SERVER,USER,PASS,DBNAME);
 $dat = date("m.d.y");
  
 $ins = mysqli_query($db, "INSERT INTO TASKS (`NAME`,`PRIOR_ID`,`DATE_TIME`,`STATUS_ID`,`PROJECT_ID`) VALUES('$name',1,'$dat',5,$proj)");
 
return ($ins) ? true : false;
 }
 
//INSERT  PROJECT
public function insert_proj($name) 
 { 
 $db = mysqli_connect(SERVER,USER,PASS,DBNAME);
 $ins = mysqli_query($db, "INSERT INTO PROJECT (`name`) VALUES('$name')");

return ($ins) ? true : false;
 }
   
}

?>