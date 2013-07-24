<?php
	//include_once("lib/analyticstracking.php");

	$noOfUserInEventA = 0;
	$noOfUserInEventB = 0;
	$noOfUserInEventC = 0;
	$noOfUserInEventD = 0;
	
	$dbhost = 'jasonpromotion.db.10017492.hostedresource.com';
    $dbuser = 'jasonpromotion';
    $dbpass = 'zaq1@wsxC';
    $dbname = 'jasonpromotion';
	
	$result = DB::select("select e_id, count(1) as users from act_log where e_id IN (?,?,?,?) Group By e_id", array(10,11,12,13));
	
	/*try{
	$conn = mysql_connect($dbhost, $dbuser, $dbpass) or die('Error with MySQL connection');
	} catch (Exception $e){
		echo "ex: ".$e; 
	};
	$db_sel = mysql_select_db($dbname) or die('Error with open MySQL'); 
	$sql = "select e_id, count(1) as users from act_log where e_id IN (10,11,12,13) Group By e_id";
	$result = mysql_query($sql);*/
	
	/*while($row = mysql_fetch_array($result,MYSQL_BOTH)){
		if ($row['e_id'] == 10){ //Freya
			$noOfUserInEventA = $row['users'];
		}elseif ($row['e_id'] == 11){ //Hoby
			$noOfUserInEventB = $row['users'];
		}elseif ($row['e_id'] == 12){ //Mega Will Wine
			$noOfUserInEventC = $row['users'];
		}elseif ($row['e_id'] == 13){ //Hk Wine Blog
			$noOfUserInEventD = $row['users']; 
		}
    }*/
	
	/*mysql_close();
	
	$compatBwr = true;
	function browser() {
		$ua = strtolower($_SERVER['HTTP_USER_AGENT']);
		// you can add different browsers with the same way ..
		if(preg_match('/(chromium)[ \/]([\w.]+)/', $ua))
				$browser = 'chromium';
		elseif(preg_match('/(chrome)[ \/]([\w.]+)/', $ua))
				$browser = 'chrome';
		elseif(preg_match('/(safari)[ \/]([\w.]+)/', $ua))
				$browser = 'safari';
		elseif(preg_match('/(opera)[ \/]([\w.]+)/', $ua))
				$browser = 'opera';
		elseif(preg_match('/(msie)[ \/]([\w.]+)/', $ua))
				$browser = 'msie';
		elseif(preg_match('/(mozilla)[ \/]([\w.]+)/', $ua))
				$browser = 'mozilla';

		preg_match('/('.$browser.')[ \/]([\w]+)/', $ua, $version);

		return array($browser,$version[2], 'name'=>$browser,'version'=>$version[2]);
	}
	
	$bwr = browser();
	if ($bwr[0] == "msie" and $bwr[1] < 9){
		$compatBwr = false;
	}*/
	$compatBwr = true;
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/DTD/strict.dtd">
<html>
  <head> 
    <title>Free Promotion</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<style>
		.fb-like{
			height: 20px;
			overflow: hidden;
		}
	</style>
	  
    <!-- Bootstrap -->
    <link href="css/bootstrap.css" rel="stylesheet" media="screen">

  </head>
  
  <body onLoad=Init()>
	 <script>
	 var page;
	 var url;
	 var uID;
	 var uName;
	 
	  // Additional JS functions here
	  window.fbAsyncInit = function() {
		FB.init({ 
		  appId      : '625779757441110', // App ID
		  channelUrl : '//www.carkeyli.com/jasonpro', // Channel File
		  status     : true, // check login status
		  cookie     : true, // enable cookies to allow the server to access the session
		  xfbml      : true  // parse XFBML
		});

		// Additional init code here
		FB.getLoginStatus(function(response) {
		  if (response.status === 'connected') {
			// connected
			//alert("connected");
		  } else if (response.status === 'not_authorized') {
			// not_authorized
			//alert("not_authorized");
			//login();
		  } else {
			// not_logged_in
			//login();
		  }
		 });
		 
		 FB.Event.subscribe('edge.create', function(response) {
			 var val;
			 FB.XFBML.parse(); 
			  
			 $(page).modal('hide');
			 if (page=='#RedWine'){
				val = 318825084825132;
			 }else if(page=='#HBModal'){
				val = 156470744450018;
			 }else if(page=='#Freya'){
				val = 338640206247980;
			 }else if(page=='#WineBlog'){
				val = 134472930089968;
			 }
			 FB.api('/me', function(response) {
				uName = response.name;
				redirect(val);
			 });
		});
	  };

	  function login(val) {
			FB.login(function(response) {
				if (response.authResponse) {
					// connected 
					uID = response.authResponse.userID;

					// call the graph api
					var url = '/me/likes/'+ val + '?access_token=' + response.authResponse.accessToken;
					FB.api(url,function(response){					
						if (response.data.length == 0){ 
							FB.XFBML.parse();
							if (val == 318825084825132){
								page = '#RedWine'
							}else if(val == 156470744450018){
								page = '#HBModal'
							}else if(val == 338640206247980){
								page = '#Freya'
							}else if(val == 134472930089968){
								page = '#WineBlog'
							}   
							
							$(page).modal({keyboard:false})
						}else{
							FB.api('/me', function(response) {
							  uName = response.name;
							  redirect(val);
							});
						}
					}); 
				} else {
					// cancelled
				}
			}, {scope: 'user_likes'}); 
			//}); 
		}
	  
	  function logout() {
		FB.logout(function(response) {
			location.reload();
		  // user is now logged out
		});
	  }
	  
	  // Load the SDK Asynchronously
	  (function(d){
		 var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
		 if (d.getElementById(id)) {return;}
		 js = d.createElement('script'); js.id = id; js.async = true;
		 js.src = "//connect.facebook.net/en_US/all.js";
		 ref.parentNode.insertBefore(js, ref);
	   }(document)); 


		function Init(){
			$(function () {
				$('body').tooltip({
					selector: 'a[rel="tooltip"], [data-toggle="tooltip"]'
				});
				
				$('body').popover({
					selector: '[data-toggle="popover"]'
				});
				
				$('a[rel=popovercall]').popover({
					html : true,
					placement : 'right',
					title: function() {
					  return $("#popover-head").html();
					},
					content: function() {
					  return $("#popover-content").html();
					}
				});
			});
		}
		
		function redirect(val)
		{
			if (val == 318825084825132){
				url = "https://www.carkeyli.com/jasonpro/redwine_pro.php?id=" + uID + "&name=" + uName;
			}else if (val == 156470744450018){ 
				url = "https://www.carkeyli.com/jasonpro/hoby_pro.php?id=" + uID + "&name=" + uName;
			}else if (val == 338640206247980){
				url = "https://www.carkeyli.com/jasonpro/freya_pro.php?id=" + uID + "&name=" + uName;
			}else if (val == 134472930089968){
				url = "https://www.carkeyli.com/jasonpro/wineblog_pro.php?id=" + uID + "&name=" + uName;
			} 
			 
			window.location.href = url
		}
	</script>
	<div class="container">
	<!--<div class="row">
	<div class="span6 offset2">-->
			<?php if ($compatBwr == false){ ?>
				<div class="alert">
				  <button type="button" class="close" data-dismiss="alert">&times;</button>
				  <strong>Warning!</strong> 你使用的瀏覽器為Internet Explorer 8或以下版本，此版本不支援此頁面。請使用Chrome, FireFox或Intenet Explorer 9。
				</div>
			<?php } ?>
			<ul class="thumbnails">
			  <li class="span6 offset2">
				<div class="thumbnail">
				  <img width="80%" height="80%" src="img/201306_freya/freya.jpg" alt="" class="img-rounded"/>
				  <h5><span class="badge badge-info"><?php echo $noOfUserInEventA ?></span> 名參加者已登記</h5>
				  <div align="center">
					  <button class="btn btn-large btn-block btn-danger" value=338640206247980 onclick=login(this.value) <?php echo ($compatBwr==false? "disabled":"") ?> ><strong>了解詳情</strong></button>
				  </div>
				</div>
			  </li>
			   
			  <li class="span6 offset2">
				<div class="thumbnail">
				  <img width="80%" height="80%" src="img/201306_wineblog/hkwineblog.jpg" alt="" class="img-rounded"/>
				  <h5><span class="badge badge-info"><?php echo $noOfUserInEventD ?></span> 名參加者已登記</h5>
				  <div align="center">
					  <button class="btn btn-large btn-block btn-danger" value=134472930089968 onclick=login(this.value) <?php echo ($compatBwr==false? "disabled":"") ?> ><strong>了解詳情</strong></button>
				  </div>
				</div>	
			  </li> 
	 
			  <li class="span6 offset2">
				<div class="thumbnail"> 
				  <img width="80%" height="80%" src="img/201306_hoby/hoby.jpg" alt="" class="img-rounded"/>
				  <h5><span class="badge badge-info"><?php echo $noOfUserInEventB ?></span> 名參加者已登記</h5>
				  <div align="center">
					  <button class="btn btn-large btn-block btn-danger" type="button" value=156470744450018 onclick=login(this.value) <?php echo ($compatBwr==false? "disabled":"") ?> ><strong>了解詳情</strong></button>
				  </div>
				</div>
			  </li>
			  
			  <li class="span6 offset2">
				<div class="thumbnail">
				  <img width="80%" height="80%" src="img/201306_willwine/megawillwine.jpg" alt="" class="img-rounded"/>
				  <h5><span class="badge badge-info"><?php echo $noOfUserInEventC ?></span> 名參加者已登記</h5>
				  <div align="center">
					  <button class="btn btn-large btn-block btn-danger" value=318825084825132 onclick=login(this.value) <?php echo ($compatBwr==false? "disabled":"") ?> ><strong>了解詳情</strong></button>
				  </div>
				</div>
			  </li>
			</ul>
		 
			<div id="RedWine" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			  <div class="modal-body">
				<Table width="100%">
				<tr>
				<td align="center">
					<div class="fb-like" data-href="https://www.facebook.com/megawillwine" data-send="false" data-layout="button_count" data-width="450" data-show-faces="false"></div>
				</td>
				<td align="center"><h5>先請按左方like,對MegaWill Wine讚好</h5></td>
				</tr> 
				</Table>
			  </div>
			</div>
		
			<div id="HBModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			  <div class="modal-body">
				<Table width="100%">
				<tr>
				<td align="center">
					<div class="fb-like" data-href="https://www.facebook.com/pages/Hoby-Wong-MakeUp/156470744450018" data-send="false" data-width="450" data-layout="button_count" data-show-faces="false"></div>
				</td>
				<td align="center"><h5>先請按左方like,對Hoby Wong MakeUp讚好</h5></td>
				</tr>
				</Table>
			  </div>
			</div>
			
			<div id="Freya" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			  <div class="modal-body">
				<Table width="100%">
				<tr>
				<td align="center">
					<div class="fb-like" data-href="https://www.facebook.com/freyaphotography.hk" data-send="false" data-width="450" data-layout="button_count" data-show-faces="false"></div>
				</td>
				<td align="center"><h5>先請按左方like,對Freya Photography讚好</h5></td>
				</tr>
				</Table>
			  </div>
			</div>
			
			<div id="WineBlog" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			  <div class="modal-body">
				<Table width="100%">
				<tr> 
				<td align="center">
					<div class="fb-like" data-href="https://www.facebook.com/hkwineblog" data-send="false" data-width="450" data-layout="button_count" data-show-faces="false"></div>
				</td>
				<td align="center"><h5>先請按左方like,對HK Wine Blog讚好</h5></td>
				</tr>
				</Table>
			  </div>
			</div>
				
			<div>
				<p align="center">
					<small>請以Google Chrome或Mozilla Firefox以獲得最佳瀏覽效果。<br>
						   <a  href="#" rel="popovercall">條款及聲明</a><br>
					</small>
				</p>
			</div>
			
			<!-- Pop Over Content -->
			<div id="popover">
				<div id="popover-head" class="hide" align="center">條款及聲明</div>
				<div id="popover-content" class="hide">
				  <ul>
					<li>如有任何爭議，優惠提供者保留本活動所有最終決定權。</li>
					<li>是次活動得獎者所提供的個人資料只作聯絡用途，將不會被用於任何市場營銷目的。</li>
					<li>是次推廣活動與 Facebook 無關，並沒有由 Facebook 贊助、支持或管理。</li>
				  </ul>
				</div>
			</div>
	<!--</div>
	</div>-->
	</div>
	
	<script src="js/jquery.js"></script>
	<script src="js/bootstrap.js"></script>
  </body>