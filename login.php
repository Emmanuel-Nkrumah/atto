<html>

<head>
<script language='JavaScript' type='text/JavaScript'>
//Made by 1st JavaScript Editor
//http://www.yaldex.com
function fifteenth(form) {
if (form.sixteenth.value=='atto') { 
if (form.pass.value=='atto12') {              location='admin.php' ;} 
else {alert('Wrong Password')}} 
else {  alert('Wrong UserID')}}
</script>



<title></title>

</head>

<body>


<center>

<center><h2><i><b>Login Area</b></i></h2></center>

<form name='login'>
    <label for="">User Name</label>
    <input name='sixteenth' type='text'><br>
    <label for="">Password:</label>
    <input name='pass' type='password'><br>
    <input type='button' value='Login' onClick='fifteenth(this.form)'>
    <input type='Reset'>
</form>
</center>
</body>

</html>