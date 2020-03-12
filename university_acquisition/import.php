<?php
	session_start();
	 ini_set('max_execution_time', 300); // sets maximume time in seconds a script allowed to run before it is terminated
   	$conn = mysqli_connect('localhost', 'root', '', 'university_acquisition');
    $output = '';

    $sql = "SELECT * FROM univ_acquisition";
    $result = mysqli_query($conn, $sql);

    if(isset($_POST['btn_import']))
    {
        $filename = $_FILES['file']['tmp_name'];
        if($_FILES['file']['size'] > 0)
        {
                        
                $file = fopen($filename, 'r');
                while(($data = fgetcsv($file, 1000, ",")) !== FALSE)    {
                    $csv_query = "INSERT INTO univ_acquisition(Author, Title, Copyright, Price, RequestedBy, Department, Dealer, DeliveryReceiptNo)
                    VALUES('".$data[0]."', '".$data[1]."', '".$data[2]."', '".$data[3]."', '".$data[4]."', '".$data[5]."', 
                    '".$data[6]."', '".$data[7]."')";
                    $csv_res = mysqli_query($conn, $csv_query);
                }
                if(isset($csv_res)){
                    echo "<script>
                        alert('Import Sucessfull');
                    </script>
                    <meta http-equiv='refresh' content='0; url=index.php'>
                    ";
                }
                else 
                {
                    echo "<script>
                    alert('Failure in importing');
                    </script>";
                }
        }
    }
?>