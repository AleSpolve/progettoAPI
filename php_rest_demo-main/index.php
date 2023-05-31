<?php
      $method = $_SERVER['REQUEST_METHOD'];
      $uri = $_SERVER['REQUEST_URI'];

      
      $uri = ltrim($uri,'/');
      $uri = rtrim($uri,'/');
      $uri = explode('/',$uri);

      
      
      switch( count($uri) ) {
            case 2:
                  if ( $uri[1] == "classi") {
                     switch ( $method ) {
                        case 'GET':
                              require __DIR__ . "/API/classe/read.php";      
                              break;
                        case 'POST':
                              require __DIR__ . "/API/classe/create.php";      
                              break;
                        
                     }         
                  }else if ( $uri[1] == "studenti") {
                        switch ( $method ) {
                           case 'GET':
                                 require __DIR__ . "/API/studenti/read.php";      
                                 break;
                           case 'POST':
                                 require __DIR__ . "/API/studenti/create.php";      
                                 break;
                           
                        }         
                     }
                  
                  break;
            case 3:
                  $id = (int) $uri[2];                  
                  if ( $uri[1] == "classi") {
                        switch ( $method ) {
                        case 'GET':
                              require __DIR__ . "/API/classe/readOne.php";      
                              break;
                        case 'DELETE':
                              require __DIR__ . "/API/classe/delete.php";      
                              break;
                        case 'PUT':
                              require __DIR__ . "/API/classe/update.php";      
                              break;
                        }
                  } else if ( $uri[1] == "studenti") {
                        switch ( $method ) {
                        case 'GET':
                              require __DIR__ . "/API/studenti/readOne.php";      
                              break;
                        case 'DELETE':
                              require __DIR__ . "/API/studenti/delete.php";      
                              break;
                        case 'PUT':
                              require __DIR__ . "/API/studenti/update.php";      
                              break;
                        }
                  }
                  break;  
            case 4:
                  $id = (int) $uri[2];
                  if ( $uri[3] == "studenti") {
                        switch ( $method ) {
                        case 'GET':
                              require __DIR__ . "/API/classe/readstudent.php";      
                              break;
                        }
                  }else if ($uri[1] == "studenti") {
                        switch ( $method ) {
                              case 'GET':
                                    require __DIR__ . "/API/studenti/readclass.php";      
                                    break;
                              }     
                  }
                  
                  break;
                        

      }

      
?>