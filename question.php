<?php
require('connect.php');
if(isset($_POST['ans']) && isset($_POST['submit'])){
	$ans =	$_POST['ans'];
	$qno = $_POST['qno'];
	$username = $_SESSION['username'];
	
	$str = "SELECT ans, points FROM questionbank WHERE qno = '$qno'";
	$result = mysqli_query($con, $str);
	$row = mysqli_fetch_array($result);
	
	if($ans == $row['ans'])
	{
		$s2 = "SELECT * FROM quizuser WHERE username = '$username'";
		$r2 = mysqli_query($con,$s2);
		$row1 = mysqli_fetch_array($r2);
		$scr = $row1['score'] + $row['points'];
		
		/*
$i=1;
		$flag = 0;
		$qnum= 'q'.$i;
		$count=1;
		while($flag!=1)
		{
			if($row[$qnum]=='0' || $row[$qnum]=='1')
			{
				$i++;
				$count++;
			}
			if($row[$qnum]=='2')
			{
				$flag=1;
				
			}
			
		}
		$qup='q'.$count;
		echo $qup;die();
*/
		$s1 = "UPDATE quizuser SET score='$scr', q$qno='1',$qup='0' WHERE username='$username'";
		echo $s1;die();
		mysqli_query($con,$s1);
	}
}
?>
<form action="home.php" method="POST" style="margin : 100px 0px;">
<?php

$q=$_GET['q'];
require('connect.php');
$q21="SELECT * FROM questionbank WHERE qno='$q'";
$r21=mysqli_query($con, $q21);
$row=mysqli_fetch_array($r21);
$ques=$row['ques'];
echo '<p>'.$ques;
echo '<br/>
			<label for="ans">Key (Answer):</label>
			<input type="hidden" value='.$q.' name = "qno" />
			<input type="text" maxlength="50" name="ans" id="ans" required="required"/>
			<input type="submit" value="Submit" name="submit"/>
			</p>';
			


?>
</form>