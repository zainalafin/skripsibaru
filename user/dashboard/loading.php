<!DOCTYPE html>
<html>
<head>

<style>
.loader {
  position: absolute;
  left: 50%;
  top: 50%;
  z-index: 1;
  width: 150px;
  height: 150px;
  margin: -75px 0 0 -75px;
  border: 16px solid #f3f3f3;
  border-radius: 50%;
  border-top: 16px solid #3498db;
  width: 120px;
  height: 120px;
  -webkit-animation: spin 2s linear infinite;
  animation: spin 2s linear infinite;
}

/* Safari */
@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}

.posisi{
	position: absolute;
  left: 45%;
  top: 70%;
  z-index: 1;
  width: 150px;
}
</style>
</head>
<body>


<script type="text/javascript">
var timeleft = 15;
var downloadTimer = setInterval(function(){

  if(timeleft <= 0){
    clearInterval(downloadTimer);
    document.location.href="masuk.php?alert=0";
	} else {
    document.getElementById("countdown").innerHTML = timeleft + " detik lagi";
	
	
  }
  timeleft -= 1;
}, 1000);
</script>

<div align = 'center'>
<div class='loader'></div>
<div class = 'posisi'>
Ukur Suhu
<br />

<div id="countdown"></div>
</div>
</div>


</body>
</html>