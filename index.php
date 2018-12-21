<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Data Table</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    

</head>
<body>
    <div style="padding: 10px;">
        <div class="jumbotron">
            <h1 style="text-align: center;">Data Table</h1> 
        </div>
        <?php
            $s = $_GET["s"];
         
            $displayColumns = array("ID", "WHOID", "WHATID", "SUBJECT", "ACTIVITYDATE", "STATUS", "OWNERID", "DESCRIPTION", "ISCLOSED");
            $servername = "localhost";
            $username = "root";
            $password = "";
            $table_name = "`table 1`";
            $dbname = "datatable";
            $conn = new mysqli($servername, $username, $password, $dbname);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            } 

            $sql = "select ";
            $i = 0;
            foreach($displayColumns as $columname) {
                if ($i == 0) {
                    $sql = $sql. " " . $columname ;
                } else {
                    $sql = $sql. ", " . $columname ;
                }
                $i++;
            }
            
            $sql = $sql." from ". $table_name;
           
            if($s) {
                $sql = $sql. " where ";
                $i = 0;
                foreach($displayColumns as $columname) {
                    if ($i == 0) {
                        $sql = $sql . " " . $columname. " LIKE " . "'%". $s . "%'";
                    } else {
                        $sql = $sql . " OR " . $columname. " LIKE " . "'%". $s . "%'";
                    }
                    $i++;
                }
            }
            
            $result = $conn->query($sql);
            $conn->close();
        ?>
    
        <table id="example" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <?php
                        foreach($displayColumns as $columname) {
                            echo "<th>". $columname . "</th>";
                        }
                    ?>
                </tr>
            </thead>
            <tbody>
                
                <?php
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        foreach($displayColumns as $columname) {
                            echo "<td>". $row[$columname]."</td>";
                        }
                        echo "</tr>";
                    }
                ?>
               
            </tbody>
            
        </table>
    </div>

    <div style="height: 100px;"></div>

   <script src="./main.js"></script>
</body>
</html>