   <?php
       require_once('config.inc.php');
       function getData($sql) {
           try {
               $pdo = new PDO(DBCONNSTRING);
               $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
               $result = $pdo->query($sql);
               $data = $result->fetchAll(PDO::FETCH_ASSOC);
               $pdo = null; // close db connection
               return $data;
           } catch (PDOException $e) {
               echo "Connection failed: " . $e->getMessage();
         
           }
       }

    
       

   
   ?>