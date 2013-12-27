<html xmlns="http://www.w3.org/1999/xhtml">


<head>
  <title>Dates</title>
  <link rel="stylesheet"
    href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/themes/hot-sneaks/jquery-ui.css"
    type="text/css" media="all" />
	
	<style type="text/css">
	
body
{


}

form
{

margin-left:75px;
margin-right:75px;
}
	
	
	</style>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"
    type="text/javascript"></script>
<script
    src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.min.js"
    type="text/javascript"></script>
<script type="text/javascript">
  $(document).ready(function(){
    $('input.date').datepicker();
  })
</script>
</head>


<body>
<h1>Reserve Calendar</h1>
<h2>Select the dates you wish to reserve.</h2>
<form method='POST' action='/users/p_reserve'>
  <p>
    Start: <input class="date" type="text" size="32" name="startdate" id="startdate" />
  </p>
  <p>
    End: <input class="date" type="text" size="32" name="enddate" id="enddate" />
  </p>
  <div><input type="submit"/></div>
</form></body>


</html>