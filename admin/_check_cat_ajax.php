<?php
include("_mysql.php");
$search = mysql_query("SELECT p_id, name, id FROM ".MySQLprefix."_categories WHERE name LIKE '%".$_POST['line']."%' GROUP BY id");
if($search)
	if(mysql_num_rows($search)>0){
		while($srch = mysql_fetch_assoc($search)){
			$tree = $srch['name'];
				$parent = $srch['p_id'];
				while($parent!=0){ 
				  unset($par_data);
				  $par_r = mysql_query("SELECT name, p_id FROM ".MySQLprefix."_categories WHERE id=".$parent." LIMIT 0, 1");
				  if($par_r)
				    if(mysql_num_rows($par_r)==1)
				      $par_data = mysql_fetch_assoc($par_r);
				  $tree = $par_data['name'].' - '.$tree;
				  $parent = $par_data['p_id'];
				}
				
			?>
<a class="res_a" rel="<?php echo $srch['id']; ?>"><?php echo $tree; ?></a>
			<?php
		}
	}
?>