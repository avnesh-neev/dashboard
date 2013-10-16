<!--here this page is used for dashboard, which will fatched data from loggly -->

<!-- here this php code for checking login-->
<?php
    require_once('auth.php');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="shortcut icon" href="/dashboard/assets/ico/favicon.png">
        <link href="/dashboard/dist/css/sticky-footer-navbar.css" rel="stylesheet">
        
        <title>Avnesh-Dashboard</title>
        <link href="/dashboard/dist/css/bootstrap.css" rel="stylesheet">
        <link href="/dashboard/eternicode-bootstrap/css/datepicker.css" rel="stylesheet">
        
<!--        <link href="/dashboard/diQuery-collapsiblePanel.css" rel="stylesheet">-->
<!--        <link href="/dashboard/bootstrap-select/bootstrap-select.css" rel="stylesheet">-->
        <link href="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.3.1/css/bootstrap-combined.min.css" rel="stylesheet">
            <link rel="stylesheet" type="text/css" media="screen" href="http://silviomoreto.github.io/bootstrap-select/stylesheets/bootstrap-select.css">
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
<!--        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.9/jquery-ui.min.js"></script>-->
        
        <style type="text/css">
            .glyphicon{}
            .menu12
            {
                border-left: 1px solid #180000;
            }
            .ulBullet
            {
              list-style-type: none;
              padding:0;
              margin:0;
            }
            #hrLine{color: #6B8E23;
                    background-color: #6B8E23;
                    height: 2px;
            }
            
            div.list > span > ul{
              display: none;
            } 
            a {
                 color: red;
              }
           .floatLeft{float: left;}
        </style>
        
        
        
    </head>
    <body>
        
        <div id="wrap">

      <!-- Fixed navbar -->
      <div class="navbar navbar-default navbar-fixed-top" style="background-color:#444444">
        <div class="container">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Log management</a>
          </div>
          <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="#"><span class="glyphicon glyphicon-dashboard" style="margin-right: 8px;"></span><span>Dashboard</span></a></li>
                <li><a href="search.php"><span class="glyphicon glyphicon-search" style="margin-right: 8px;"></span><span>Search</span></a></li>
                <li><a href="#alert"><span class="glyphicon glyphicon-bell "style="margin-right: 8px;"></span><span>Alerts</span></a></li>
            </ul>
              <ul class="nav navbar-nav navbar-right">
<!--            <li><a href="../navbar/">Default</a></li>
            <li><a href="../navbar-static-top/">Static top</a></li>-->
            <li class="active"><a href="logout.php">LogOut</a></li>
          </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
     
        

          
            
    <div class ="navbar navbar-default navbar-fixed-top" style="background-color:#E6E4D1; height: 40px; margin-top: 50px;">
        <div class="container" >
            <div class="row" >
                <div class="col-md-4" >
                    
                </div>
                <div class="col-md-8" style="margin-top: 10px;">
                    <form class="form-signin" method="POST" action="dash.php" name="myForm">
                        <span class="floatLeft" style="margin-left: 5px;">
                            <select id="selId" name="selName">
                                <option value="-2d">Last 2 days</option>
                                <option value="-1d">last 1 day</option>
                                <option value="-12h">last 12 haurs</option>
                            </select>
                        </span>
                     <span class="floatLeft" style="margin-left: 5px;">   
                            <select id="selId12" name="sizeValue">
                                <option value="10">10 logs record</option>
                                <option value="20">20 logs record</option>
                                <option value="50">50 logs record</option>
                            </select>
                     </span>
                    <span class="floatLeft" style="margin-left: 5px;">
                        <button class="btn btn-primary" type="submit" style="margin-right: 5px; margin-top: -5px;" type="submit">search</button>
                    </span>
                    </form>
                </div>
            </div>
        </div>
      
    </div>
                        
                
           
              
        
        
      <div class="container " style="margin-top: <?php if($_POST['selName'] && $_POST['sizeValue']){echo "45px";} else{
        echo '45px';} ?>;">
          <div class="row">
              <div class="col-md-2">
                  
              </div>
              <div class="col-md-10 menu12" id="serverData">
<!--                  here this php code will fatch data from server-->
                  <?php
                  
                  if($_POST['selName'] && $_POST['sizeValue']){
                    $ch = curl_init();
                    curl_setopt_array($ch, array(
                        CURLOPT_URL => 'http://avneshshakya.loggly.com/apiv2/search?q=*&from='.$_POST['selName'].'&until=now&size='.$_POST['sizeValue'],
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_USERPWD => 'avnesh:loggly18'
                    ));

                    $output = curl_exec($ch);
                    $jsonData = json_decode($output,true);
                    $id = $jsonData["rsid"]["id"];
//                    echo "$id";
                    curl_setopt_array($ch, array(
                        CURLOPT_URL => 'http://avneshshakya.loggly.com/apiv2/events?rsid='.$id,
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_USERPWD => 'avnesh:loggly18'
                    ));
                  }
                  else{
                      $ch = curl_init();
                    curl_setopt_array($ch, array(
                        CURLOPT_URL => 'http://avneshshakya.loggly.com/apiv2/search?q=*&from=-2d&until=now&size=500',
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_USERPWD => 'avnesh:loggly18'
                    ));

                    $output = curl_exec($ch);
                    $jsonData = json_decode($output,true);
                    $id = $jsonData["rsid"]["id"];
                    curl_setopt_array($ch, array(
                        CURLOPT_URL => 'http://avneshshakya.loggly.com/apiv2/events?rsid='.$id,
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_USERPWD => 'avnesh:loggly18'
                    ));
                  }
                  
                  $_POST['selName'] = NULL;
                  $_POST['sizeValue'] = NULL;  
                  
                    $totalLogData = curl_exec($ch);
                    $jsons = json_decode($totalLogData, true);
                   
                    
                    foreach ($jsons as $key=>$value)
                    { 
                        if($key=="total_events"){
                            echo "<div style='margin-top=-100px;'><p style='font-size: 30px;'>".$value." Events</p></div>";
                        }
                        
                        if($key == "events")
                        {
                            echo "<div style='background-color:#E6E4D1; height: 30px;'><p style='margin-left:10px;'>Events:</p>"."</div>";
                            $k = json_decode($value, true);
                            foreach ($value as $arr) 
                            {
                                echo "<div style='margin-top:6px;' class='list'>";
                                echo "<span>";
                                foreach ($arr as $key1 => $value1)
                                {
                                    if($key1=="logmsg")
                                    {
                                        echo "<p class='glyphicon glyphicon-chevron-right'>&nbsp;"."\"".$value1."\""."</p>";
                                    }
                                }
                                echo "<ul class='ulBullet glyphicon glyphicon-chevron-down'>";
                                
                                foreach ($arr as $key1 => $value1) 
                                {
                                    echo "<li>";
                                    if($key1 == "tags")
                                    {
                                        echo "<p style='font-size: 15px;'>".$key1.":</p>";
                                        echo "<ul class='ulBullet' style='margin-left:9px;'>[";
                                        foreach ($value1 as $value2) 
                                        {
                                            echo "<li>\"";
                                            echo $value2;
                                            echo "\"".","."</li>";
                                        }
                                        echo "],</ul>";
                                    }
                                    
                                    if($key1=="timestamp")
                                    {
                                        echo "<p style='font-size: 15px;'  style='margin-left:9px;'>".$key1.":</p>"."<p style='margin-left:9px;'>"."\"".$value1."\""."</p>";
                                    }
                                    
                                    if($key1=="logmsg")
                                    {
                                        echo "<p style='font-size: 15px;'>".$key1.":</p>"."<p style='margin-left:9px;'>"."\"".$value1."\""."</p>";
                                    }
                                    
                                    if($key1=="event")
                                    {
                                        echo "<p style='font-size: 15px;'>".$key1.":</p>";
                                        echo "<ul class='ulBullet' style='margin-left:9px;'>{";
                                        foreach ($value1 as $key2=>$value2) 
                                        {
                                            echo "<li>".$key2.":{"."\"";
                                            echo "<ul class='ulBullet' style='margin-left:9px;'>";
                                            foreach ($value2 as $key3=>$value3)
                                            {
                                                echo "<li>".$key3.":"."\"";
                                                echo "$value3";
                                                echo "\"".","."</li>";
                                            }
                                            echo "</ul>";
                                            echo "\"".","."}</li>";
                                        }
                                        echo "}</ul>";
                                    }
                                    
                                    if($key1=="logtypes")
                                    {
                                        echo "<p style='font-size: 15px;'>".$key1.":</p>";
                                        echo "<ul class='ulBullet' style='margin-left:9px;'>";
                                        foreach ($value1 as $value3) 
                                        {
                                            echo "<li>\"";
                                            echo $value3;
                                            echo "\"".","."</li>";
                                        }
                                        echo "</ul>";
                                    }
                                    
                                    
                                    if($key1=="id")
                                    {
                                        echo "<p style='font-size: 15px;'>".$key1.":</p>"."<p>"."<p style='margin-left:9px;'>"."\"".$value1."\""."</p>";
                                    }
                                    echo "</li>";
                                }
                                echo "</ul>";
                                echo "</span>";
                                echo "<hr id='hrLine'></hr>";
                                echo "</div>";
                            }
                        }
                        
                    }
                ?>
              </div>
          </div>
      </div>
      
      
      
        
        </div>  
        
        
        
        
        <div id="footer">
      <div class="container">
          <p class="text-muted credit">Example Log Managemanent By: &nbsp; <a href="#avnesh">Avnesh Shakya</a> and <a href="#Manager">RKVS Raman</a>.</p>
      </div>
    </div>
        <script type="text/javascript">
            $("div.list span").click(function() {
               $(this).children('ul').toggle();
               $(this).children('p').toggle();
            });
        </script>
        <script type="text/javascript">
            function myCustomTime(){
                var e = document.getElementById("selId");
                var strUser = e.options[e.selectedIndex].value;
                alert(strUser);
                
            }
        </script>
        
        
        
        
        <script type="text/javascript" src="/dashboard/bootstrap-select/bootstrap-select.js"></script>
        <script type="text/javascript" src="/dashboard/assets/js/jquery.js"></script>
        <script type="text/javascript" src="/dashboard/dist/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="/dashboard/assets/js/holder.js"></script>
        <script type="text/javascript" src="/dashboard/eternicode-bootstrap/js/bootstrap-datepicker.js"></script>
        
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
      <script type="text/javascript" src="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.3.1/js/bootstrap.min.js"></script>
      <script type="text/javascript" src="http://silviomoreto.github.io/bootstrap-select/javascripts/bootstrap-select.js"></script>
    </body>
</html>

