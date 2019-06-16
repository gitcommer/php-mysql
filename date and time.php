<?php
echo "Today is " . date("Y/m/d") . "<br>";          //Today is 2018/06/25
echo "Today is " . date("Y.m.d") . "<br>";          //Today is 2018.06.25
echo "Today is " . date("Y-m-d") . "<br>";          //Today is 2018-06-25
echo "Today is " . date("l");                       //Today is Monday
&copy; 2010-<?php echo date("Y");                   //© 2010-2018
echo "The time is " . date("h:i:sa");               //The time is 11:33:55pm

date_default_timezone_set("America/New_York");      //The time is 11:34:27pm
echo "The time is " . date("h:i:sa");

$d=mktime(11, 14, 54, 8, 12, 2014);                 //Created date is 2014-08-12 11:14:54am
echo "Created date is " . date("Y-m-d h:i:sa", $d);

$d=strtotime("10:30pm April 15 2014");
echo "Created date is " . date("Y-m-d h:i:sa", $d); //Created date is 2014-04-15 10:30:00pm

$d=strtotime("tomorrow");                           //2018-06-26 12:00:00am
echo date("Y-m-d h:i:sa", $d) . "<br>";

$d=strtotime("next Saturday");                      //2018-06-30 12:00:00am
echo date("Y-m-d h:i:sa", $d) . "<br>";

$d=strtotime("+3 Months");                          //2018-09-25 11:37:11pm
echo date("Y-m-d h:i:sa", $d) . "<br>";

$startdate=strtotime("Saturday");                   //Jun 30, Jul 07, Jul 07, Jul 21 Jul 28, Aug 04
$enddate=strtotime("+6 weeks", $startdate);

while ($startdate < $enddate) {
  echo date("M d", $startdate) . "<br>";
  $startdate = strtotime("+1 week", $startdate);
}

$d1=strtotime("July 04");                           //There are 9 days until 4th of July.
$d2=ceil(($d1-time())/60/60/24);
echo "There are " . $d2 ." days until 4th of July.";


//DISPLAY DATABASE DATE AND TIME
<?php if(mysqli_num_rows($result)):
        while($row = mysqli_fetch_assoc($result)):?>
<tr>
    <td><?php echo strtoupper($row['order_id']); ?></td>  <!--strtoupper in big letter niya ang character-->
    <td><?php echo date('M d, Y', strtotime($row['order_date'])); ?></td>  <!--strtotime kong siya gi book mao sd iyang i display-->
	<td><?php echo date('h:m:s A', strtotime($row['order_date'])); ?></td>  <!--M d, Y and h:m:s A is only a format-->

<?php
//output: date: Aug 27, 2018 08:08:48 PM
date: <?php echo date('M d, Y h:m:s A', strtotime($row['date_time'])); ?>
<!--output: Aug 30, 2018-->
<td><?php echo date('M d, Y', strtotime($row['order_date'])); ?></td>
<!--output: 01:08:03 AM-->
<td><?php echo date('h:m:s A', strtotime($row['order_date'])); ?></td>
?>
