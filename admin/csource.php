<?php
$query=mysql_connect("localhost","root","");
mysql_select_db("freeze",$query);
if(isset($_POST['name']))
{
$name=trim($_POST['name']);
$query2=mysql_query("SELECT * FROM product WHERE name LIKE '%$name%' OR descr LIKE '%$name%'");
echo "<ul>";
while($query3=mysql_fetch_array($query2))
{
?>

<li onclick='fill("<?php echo $query3['name']; ?>")'><?php echo $query3['name']; ?></li>
<?php
}
}
?>
</ul>