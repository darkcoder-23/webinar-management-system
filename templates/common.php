<?php



    function sanitize_input($data, $type='') {
        global $conn;  
        
        switch($type) {
            case 'email' :
                $data = filter_var($data,FILTER_SANITIZE_EMAIL);
                break;
            case 'int' :
                $data = filter_var($data,FILTER_SANITIZE_NUMBER_INT);
                break;
            case 'url' :
                $data = filter_var($data,FILTER_SANITIZE_URL);
                break;
            case 'int[]' : 
                $data = filter_var($data,FILTER_SANITIZE_NUMBER_INT);
                break;
            default :
                $data = trim($data,' ');
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                $data = mysqli_real_escape_string($conn,$data);
                
        }
        return $data;
    }

    

    // Paginatiom
    // const global_var  = [
    //     page => $_GET['Page_No'],



    // ] 



?>