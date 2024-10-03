<?php  
 //pagination.php  
 include_once 'db_connect.php';
 $record_per_page = 5;  
 $page = '';  
 $output = '';  
 if(isset($_POST["page"]))  
 {  
      $page = $_POST["page"];  
 }  
 else  
 {  
      $page = 1;  
 }  
 $start_from = ($page - 1)*$record_per_page;  
 $query = "SELECT * FROM tbl_student ORDER BY student_id DESC LIMIT $start_from, $record_per_page";  
 $result = mysqli_query($connect, $query);  
 $output .= "  
      <table class='table table-bordered'>  
           <tr>  
                <th width='50%'>Name</th>  
                <th width='50%'>Phone</th>  
           </tr>  
 ";  
 while($row = mysqli_fetch_array($result))  
 {  
      $output .= '  
        <tr>
            <th scope="col" class="serial_width">Sr.No.</th>
            <th scope="col">Webinar Name</th>
            <th scope="col">Category</th>
            <th scope="col">Webinar Presenter</th>
            <th scope="col" style="text-align: center">Action</th>
        </tr>
      ';  
 }  
 $output .= '</table><br /><div align="center">';  
 $page_query = "SELECT * FROM webinar_details ORDER BY 1 DESC";  
 $page_result = mysqli_query($connect, $page_query);  
 $total_records = mysqli_num_rows($page_result);  
 $total_pages = ceil($total_records/$record_per_page);  
 for($i=1; $i<=$total_pages; $i++)  
 {  
      $output .= "<span class='pagination_link' style='cursor:pointer; padding:6px; border:1px solid #ccc;' id='".$i."'>".$i."</span>";  
 }  
 $output .= '</div><br /><br />';  
 echo $output;  
 ?>  