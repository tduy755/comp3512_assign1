   <?php
       require_once('config.inc.php');
       function getData($sql, $parameters) {
           try {
               
               if (!is_array($parameters)) {
                    $parameters = [$parameters];
               }
               if (count($parameters) > 0 ) {
                    $pdo = new PDO(DBCONNSTRING);
                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $statement = $pdo->prepare($sql);
               
               for ($i = 0; $i < count($parameters); $i++) {
                     $statement ->bindValue($i + 1, $parameters[$i]);
               }
               $statement -> execute();
               $pdo = null; // close db connection
               return $statement -> fetchAll();
            } else {
                    $pdo = new PDO(DBCONNSTRING);
                    $result = $pdo -> query($sql);
                    return $result -> fetchAll();
            }
           } catch (PDOException $e) {
               echo "Connection failed: " . $e->getMessage();
         
           }
       }

    
       

   
   ?>