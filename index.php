<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="initial-scale=.7, user-scalable=no">
<title>Current Game</title>
</head>

<style>
	body{background:#000000;}
	
	#gameImg{
		background-image:url(images/_default.jpg);
		background-position:center;
		/*background-attachment:fixed;*/
		background-size: cover;
		width:280px;
		height:436px;
	}
	
	.rotate90CCW{
		transform: rotate(-90deg);
		width: 436px;
		height: 280px;
		position: absolute;
		top: 86px;
		left: -70px;
	}
	
	.console.bottom{position:fixed;bottom:0;right:0;}
	#searchList{list-style:none;margin:0;padding:0;width: 300px;
    max-height: 294px;
    overflow-y: scroll;
    border: 1px solid #DDDDDD;}
	#searchList li{height:50px;padding:4px;    background: #F8F8F8;
    border-bottom: 1px solid #DDDDDD;cursor:pointer;}
	#searchList img{float:left;height:50px;margin-right:4px;}
	#searchList p{margin:0;}
</style>
	

<body>
	<div id="gameImg"></div>

	<div class="console bottom">
		<ul id="searchList"></ul>
		<form id="gameSearch">
		  <input class="title" type="text" placeholder="search">
		  <br><br>
		  <input class="submit" type="submit" value="Submit">
		</form> 
	</div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script>
		var apiKey="[YOUR API KEY]";
		var searchObj;
		$(document).ready(function(){
			initPage();
			//test
			//jsonRequest("flashback");
		});
		
		function initPage(){
			$("#gameSearch .submit").click(initGameSearch);
		}
		
		
		function initGameSearch(){
			var title=$("#gameSearch .title").val();
			jsonRequest(title);
			return false;
		}
		
		function jsonRequest(query){
			$.ajax({
			  url: "http://api.giantbomb.com/search/",
			  type: "get",
			  data: {
				  api_key : apiKey, 
				  query: query,
				  field_list : "name,image", 
				  format : "jsonp", 
				  resources : "game",
				  json_callback : "gamer" 
			  },
			  dataType: "jsonp"
			});
		}
		
		function gamer(data) {
			searchObj=data;
			var list="";
			for(i=0;i<data.results.length;i++){
				list+="<li class='"+i+"'><img src='"+data.results[i].image.icon_url+"'><p>'"+data.results[i].name+"'</p></li>";
			}
			$("#searchList").html(list);
			$("#searchList li").click(showFullImg);
		}	
		
		function showFullImg(){
			var id = $(this).attr("class");
			var url = searchObj.results[id].image.medium_url;
			//$("#gameImg").attr("src",url);
			$("#gameImg").css("background-image","url("+url+")");
		}
		
	</script>
</html>