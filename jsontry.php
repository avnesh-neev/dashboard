<?php
   $jsns = '{ 
    "total_events": 2491, 
    "page": 0, 
    "events": [ 
            { 
              "tags": [ "apache" ], 
              "timestamp": 1381490969990, 
              "logmsg": "[Fri Oct 11 16:59:29 2013] [error] [client 127.0.0.1] File does not exist: /home/neev/phpWWW/dashboard/angular.min.js, referer: http://localhost/dashboard/index.php", 
              "event": { 
                        "apache": { 
                                    "source": "client 127.0.0.1", 
                                    "severity": "error", 
                                    "timestamp": "Fri Oct 11 16:59:29 2013" }, 
                        "syslog": { 
                                    "priority": "13", 
                                    "timestamp": "2013-10-11T16:59:29.990+05:30", 
                                    "host": "NT-SYS", 
                                    "severity": "Notice", 
                                    "facility": "user-level messages" } 
                        }, 
              "logtypes": [ "syslog", "apache" ], 
              "id": "64c4feae-3268-11e3-8002-12a6501f9c6b" 
            }, 
            { 
              "tags": [ "apache" ], 
              "timestamp": 1381490969990, 
              "logmsg": "[Fri Oct 11 16:59:29 2013] [error] [client 127.0.0.1] File does not exist: /home/neev/phpWWW/dashboard/style.css, referer: http://localhost/dashboard/index.php", 
              "event": { 
                         "apache": { 
                                      "source": "client 127.0.0.1", 
                                      "severity": "error", 
                                      "timestamp": "Fri Oct 11 16:59:29 2013" }, 
                         "syslog": { 
                                      "priority": "13", 
                                      "timestamp": "2013-10-11T16:59:29.990+05:30", 
                                      "host": "NT-SYS", 
                                      "severity": "Notice", 
                                      "facility": "user-level messages" } 
                         }, 
               "logtypes": [ "syslog", "apache" ], 
               "id": "64c4fd79-3268-11e3-8002-12a6501f9c6b" 
              }}';
        $jsonData = json_decode($jsns,true);
        foreach ($jsonData as $key => $value) {
            echo $key."=>".$value;
}
        $as = $jsonData["events"];
        echo $as;
        
        echo 'Avnesh Shakya';
        
?>
