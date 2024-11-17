<?php 
session_start();
// If Session id and name are present proceed to dashboard
if(isset($_SESSION['id']) && isset($_SESSION['name'])){   
    include '../dataBaseConn.php';
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo ucwords($_SESSION['name'])?> Dashboard</title>
        <link rel="stylesheet" href="../css/bootstrap.css">
        <style>
            body{
                height: 100vh;
                display: flex;
                flex-direction: column;
                justify-content: space-between;
            }
            .datas{
                text-align: center;
                align-content: center;
            }

            @media screen and (max-width:500px){
                table{
                font-size: 10px;
            }
            }
            
            
        </style>
    </head>
    <body>
        
            <div class="container-fluid">
                <!-- HEADER -->
                <div class="row">
                    <div class="col-12">
                        <?php include '../header.php'; ?>
                    </div>
                    
                </div>
                <!-- SECTION -->
                 
                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive p-3 my-3" style="height: 100%;">
                            <table class="table table-bordered table-hover text-nowrap table-sm">
                                <caption>List of all feedbacks</caption>
                                <tr> 
                                    <th><center>OFFICE</th></center>
                                    <th><center>ORGANIZATION</th></center>
                                    <th><center>FEEDBACK SENTIMENT</th></center>
                                    <th><center>Feedback Score  Q - 1</th></center>
                                    <th><center>Feedback Score  Q - 2</th></center>
                                    <th><center>Feedback Score  Q - 3</th></center>
                                    <th><center>Feedback Score  Q - 4</th></center>
                                    <th><center>Feedback Score  Q - 5</th></center>
                                    <th><center>DATE</th></center>
                                    <th><center>Additional Comment 1</th></center>
                                    <th><center>Additional Comment 2</th></center>
                                </tr>
                                <?php
                                        if($_SESSION['usertype'] == 'Superadmin'){
                                            $query = "SELECT * FROM feedbacks";
                                            $results = mysqli_query($conn, $query);

                                            while($row = $results->fetch_assoc()){
                                                $feedback_sentiments;
                                                $bg;
                                                $average = ($row['question_1']+$row['question_2']+$row['question_3']+$row['question_4']+$row['question_5'])/5;
                                                if($average <= 2.5){
                                                    $feedback_sentiments = "Negative";
                                                    $bg = "bg-danger text-light datas";
                                                }else if($average > 2.5 && $average <= 3.5){
                                                    $feedback_sentiments = "Neutral";
                                                    $bg = "bg-warning text-dark datas";
                                                }else{
                                                    $feedback_sentiments = "Positive";
                                                    $bg = "bg-success text-light datas";
                                                }
                                                echo '<tr>
                                                        <td style="text-wrap:wrap !important">'.$row['office'].'</td> 
                                                        <td class="datas">'.$row['organization'].'</td> 
                                                        <td class="'.$bg.'">'.$feedback_sentiments.'</td>
                                                        <td class="datas">'.$row['question_1'].'</td> 
                                                        <td class="datas">'.$row['question_2'].'</td> 
                                                        <td class="datas">'.$row['question_3'].'</td>
                                                        <td class="datas">'.$row['question_4'].'</td> 
                                                        <td class="datas">'.$row['question_5'].'</td>
                                                        <td class="datas">'.$row['date_submit'].'</td> 
                                                        <td style="text-wrap:wrap !important">'.$row['question_6'].'</td> 
                                                        <td style="text-wrap:wrap !important">'.$row['question_7'].'</td> 
                                                    </tr>';
                                                }
                                        }else{
                                            $department = $_SESSION['department'];
                                            $query = "SELECT * FROM feedbacks WHERE office='$department'";
                                            $result = mysqli_query($conn, $query);

                                            while($row = $result->fetch_assoc()){
                                                $feedback_sentiments;
                                                $bg;
                                                $average = ($row['question_1']+$row['question_2']+$row['question_3']+$row['question_4']+$row['question_5'])/5;
                                                if($average <= 2.5){
                                                    $feedback_sentiments = "Negative";
                                                    $bg = "bg-danger text-light datas";
                                                }else if($average > 2.5 && $average <= 3.5){
                                                    $feedback_sentiments = "Neutral";
                                                    $bg = "bg-warning text-dark datas";
                                                }else{
                                                    $feedback_sentiments = "Positive";
                                                    $bg = "bg-success text-light datas";
                                                }
                                                echo '<tr>
                                                        <td style="text-wrap:wrap !important">'.$row['office'].'</td> 
                                                        <td class="datas">'.$row['organization'].'</td> 
                                                        <td class="'.$bg.'">'.$feedback_sentiments.'</td>
                                                        <td class="datas">'.$row['question_1'].'</td> 
                                                        <td class="datas">'.$row['question_2'].'</td> 
                                                        <td class="datas">'.$row['question_3'].'</td>
                                                        <td class="datas">'.$row['question_4'].'</td> 
                                                        <td class="datas">'.$row['question_5'].'</td>
                                                        <td class="datas">'.$row['date_submit'].'</td> 
                                                        <td style="text-wrap:wrap !important">'.$row['question_6'].'</td> 
                                                        <td style="text-wrap:wrap !important">'.$row['question_7'].'</td> 
                                                    </tr>';
                                                }
                                            
                                        }
                                    ?>
                            </table>
                        </div>

                    </div>
                </div>
                <!-- FOOTER -->
                <div class="row">
                    <div class="col-12">
                        <?php include '../footer.php'; ?>
                    </div>
                </div>
            </div>

 

    </body>
    </html>
    

<?php
// If Session id and name are not present, go back to login page
}else{ 
    header("Location: index.php");
    exit();
}


?>