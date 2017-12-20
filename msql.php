<?
class DB {
    function db()   {    
        $user = "if17";
        $pass = "if17";
        $server = "localhost";
        $dbase = "";

           $conn = mysqli_connect('localhost','if17','if17');
           if(!$conn)
        {
            $this->error("Connection attempt failed");
        }
        if(!mysqli_select_db($dbase,$conn))
        {
            $this->error("Dbase Select failed");
        }
        $this->CONN = $conn;
        return true;
    }
    function close()   {   
        $conn = $this->CONN ;
        $close = mysqli_close($conn);
        if(!$close)
        {
            $this->error("Connection close failed");
        }
        return true;
    }       function sql_query($sql="")   {    
        if(empty($sql))
        {
            return false;
        }
        if(empty($this->CONN))
        {
            return false;
        }
        $conn = $this->CONN;
        $results = mysqli_query($sql,$conn) or die("Query Failed..<hr>" . mysqli_error());
        if(!$results)
        {   
            $message = "Bad Query !";
            $this->error($message);
            return false;
        }
        if(!(eregi("^select",$sql) || eregi("^show",$sql)))
        {
            return true;
        }
        else
        {
            $count = 0;
            $data = array();
            while($row = mysqli_fetch_array($results))
            {
                $data[$count] = $row;
                $count++;
            }
            mysqli_free_result($results);
            return $data;
         }
    }      
} 
$obj = new myclass();
$obj->sql_query("");
?>