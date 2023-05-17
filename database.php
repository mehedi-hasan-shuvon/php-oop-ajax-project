<?php

class Database{

    //Database credentials
    private $db_host="localhost";
    private $db_user="root";
    private $db_pass="";
    private $db_name="ooptest";

    private $mysqli="";
    private $result=array();
    private $conn=false;

    public function __construct(){
        if(!$this->conn){
            $this->mysqli=new mysqli($this->db_host,$this->db_user,$this->db_pass,$this->db_name);
            $this->conn=true;
        
            if($this->mysqli->connect_error){
                array_push($this->result,$this->mysqli->connect_error);
                return false;
            }
        }else{
            return true;
        }

    }

    //Function to insert into the database
    public function insert($table, $params=array()){

        if($this->tableExists($table)){
          
            $table_columns=implode(', ',array_keys($params));


            $table_value=implode("', '", $params);
           
            $sql="INSERT INTO $table ($table_columns) VALUES ('$table_value')";

         
            
            if($this->mysqli->query($sql)){
                array_push($this->result,$this->mysqli->insert_id);
                return true;
            }else{
                array_push($this->result,$this->mysqli->error);
                return false;
            }
        }else{
            return false;
        }
        

    }

    //Function to update the database
    public function update($table, $params=array(),$where=null){
        if($this->tableExists($table)){
            $args=array();
            foreach($params as $key=>$value){
                $args[]="$key='$value'";
            }
          

            //make array to string format
            $sql= "UPDATE $table SET ".implode(', ',$args);
            if($where!=null){
                $sql.=" WHERE $where";
            }
            

            if($this->mysqli->query($sql)){
                array_push($this->result,$this->mysqli->affected_rows);
                return true;
            }else{
                array_push($this->result,$this->mysqli->error);
                return false;
            }
            
        }else{
            return false;
        }

    }

    

    //Function to delete from the database
    public function delete($table, $where=null){
        if($this->tableExists($table)){
            $sql="DELETE FROM $table";
            if($where!=null){
                $sql.=" WHERE $where";
            }

            if($this->mysqli->query($sql)){
                array_push($this->result,$this->mysqli->affected_rows);
                if($this->mysqli->affected_rows>0){
                    return true;
                }else{
                    array_push($this->result,"No rows deleted");
                    return false;
                }
              
            }else{
                array_push($this->result,$this->mysqli->error);
                return false;
            }

        }else{
            return false;
        }

    }

    //Function to select from the database
    public function select($table, $rows="*",$join=null,$where=null,$order=null,$limit=null) {
        if($this->tableExists($table)){
            $sql="SELECT $rows FROM $table";
            if($join!=null){
                $sql.=" JOIN $join";
            }
            if($where!=null){
                $sql.=" WHERE $where";
            }
            if($order!=null){
                $sql.=" ORDER BY $order";
            }
            if($limit!=null){
                if(isset($_GET['page'])){
                    $page=$_GET['page'];
                }else{
                    $page=1;
                }
                $start=($page-1)*$limit;
                $sql.=" LIMIT $start,$limit";
            }
         

            $query=$this->mysqli->query($sql);
            if($query){
                $this->result=$query->fetch_all(MYSQLI_ASSOC);
                return true;
            }else{
                array_push($this->result,$this->mysqli->error);
                return false;
            }
            
        }else{
            return false;
        }

    }

    public function pagination($table,$join=null,$where=null,$limit=null){
        if($this->tableExists($table)){
            if($limit !=null){
                $sql="SELECT COUNT(*) FROM $table";
                if($join!=null){
                $sql.=" JOIN $join";
                }
                if($where!=null){
                    $sql.=" WHERE $where";
                }
           
                $query=$this->mysqli->query($sql);
                $total_record= $query->fetch_row();
                $total_record=$total_record[0];
                $total_pages=ceil($total_record/$limit);

                $url=basename($_SERVER['PHP_SELF']); //basename() function returns the filename from a path like index.php

                if(isset($_GET['page'])){
                    $page=$_GET['page'];
                }else{
                    $page=1;
                }

                $output= "<ul class='horizontal-list'>";

                    if($page>1){
                        $output .="<li><a href='$url?page=".($page-1)."'>Prev</a></li>";
                    }

                    if($total_record > $limit){
                        for($i =1;$i<=$total_pages;$i++){
                            // $output .="<li class='".($page==$i ? 'active' : '')."'><a href='$url?page=$i'>$i</a></li>";
                            if($i==$page){
                                $cls= "class='active'";
                            }else{
                                $cls="";
                            }
                            $output .="<li><a $cls text-decoration:'none' href='$url?page=$i'>$i</a></li>";
                        }
                    }

                    if($page<$total_pages){
                        $output .="<li><a href='$url?page=".($page+1)."'>Next</a></li>";
                    }

                $output .="</ul>";

            
                return $output;

            }else{
                return false;
            }
         
        
        }else{
            return false;
        }

    }

    public function sql($sql){
        $query=$this->mysqli->query($sql);
        if($query){
            $this->result=$query->fetch_all(MYSQLI_ASSOC);
            return true;
        }else{
            array_push($this->result,$this->mysqli->error);
            return false;
        }

    }


    //check if table exists
    private function tableExists($table){
        $sql= "SHOW TABLES FROM $this->db_name LIKE '$table'";

        $tableInDb=$this->mysqli->query($sql);
        if($tableInDb){
                if($tableInDb->num_rows==1){
                    return true;
            }else{
                array_push($this->result,$table." does not exist in this database");
                return false;
            }
         }
    }

    public function getResult(){
        $val=$this->result;
        $this->result=array();
        return $val;
    }

    //get the last id inserted over the current db connection
    public function getInsertId(){
        $insertedRowId= $this->mysqli->insert_id;
        $where="id=$insertedRowId";
        $this->select($this->lastTable,'*',$where);
        return $this->getResult();
    
    }


    //close the database connection
    public function close(){
        if($this->conn){
            if($this->mysqli->close()){
                $this->conn=false;
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }

    }

}


?>