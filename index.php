<?php
include 'dataBaseConn.php';
$office_error = "";
$organization_error = "";
$question_1error = "";
$question_2error = "";
$question_3error = "";
$question_4error = "";
$question_5error = "";


if($_SERVER['REQUEST_METHOD'] == "POST"){
    if(($_POST['office']) == "none"){
        $office_error = "Please select office";
    }else if(($_POST['organization']) == "none"){
        $organization_error = "Please select organization";
    }else if(empty($_POST['question_1'])){
        $question_1error = "Please answer question number 1";
    }else if(empty($_POST['question_2'])){
        $question_2error = "Please answer question number 2";
    }else if(empty($_POST['question_3'])){
        $question_3error = "Please answer question number 3";
    }else if(empty($_POST['question_4'])){
        $question_4error = "Please answer question number 4";
    }else if(empty($_POST['question_5'])){
        $question_5error = "Please answer question number 5";
    }else{
        //Declaration of varialbles
        $office = $_POST['office'];
        $organization = $_POST['organization'];
        $question_1 = $_POST['question_1'];
        $question_2 = $_POST['question_2'];
        $question_3 = $_POST['question_3'];
        $question_4 = $_POST['question_4'];
        $question_5 = $_POST['question_5'];
        $question_6 = $_POST['question_6'];
        $question_7 = $_POST['question_7'];
        $device_id = md5($_SERVER['HTTP_USER_AGENT']);
        $date = date('m-d-y');

        // Verify device id for 1 at a time submit event

        $deviceID = mysqli_query($conn, "SELECT office, date_submit FROM feedbacks WHERE device_id='$device_id'");
        $row = mysqli_fetch_array($deviceID);
        if ($row){
            if($row['office'] == $office && $row['date_submit'] == $date){
                echo "<script>alert('Multiple feedback detected!')</script>";
            }else{
                $sql = "INSERT INTO feedbacks (office, organization, question_1, question_2, question_3, question_4, question_5, question_6, question_7, device_id, date_submit)
                        VALUES ('$office', '$organization', '$question_1', '$question_2', '$question_3', '$question_4', '$question_5', '$question_6', '$question_7', '$device_id', '$date')";
                $results = mysqli_query($conn, $sql);
                if($results){
                    echo "<script>alert('Feedback submitted, Thank you !.')</script>";
                }else{
                    echo "<script>alert('Please try again.')</script>";
                }
            }
        }else{
            $sql = "INSERT INTO feedbacks (office, organization, question_1, question_2, question_3, question_4, question_5, question_6, question_7, device_id, date_submit)
                    VALUES ('$office', '$organization', '$question_1', '$question_2', '$question_3', '$question_4', '$question_5', '$question_6', '$question_7', '$device_id', '$date')";
            $results = mysqli_query($conn, $sql);
            if($results){
                echo "<script>alert('Feedback submitted, Thank you !.')</script>";
            }else{
                echo "<script>alert('Please try again.')</script>";
            }
    }

        }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NISU Feedpulse</title>
    <link rel="shortcut icon" href="/images/favicon_io/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="css/bootstrap.css">
<style>
    body{
        height: 100vh;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }
    form *{
        font-size: 12px;
    }
    form h3{
        font-size: 18px;
    }
    input[type="radio"] {
        height: 20px;
        width: 20px;
    }
    .label-radio{
        font-size: 14px;
    }
    #tagalog_1,#tagalog_2,#tagalog_3,#tagalog_4,#tagalog_5,#tagalog_6,#tagalog_7{
        display: none;
    }

    @media screen and (min-width:768px){
        form *{
            font-size: 14px;
        }
    }

</style>
</head>
<body>
    <div class="container-fluid">
        <!-- HEADER -->
         <div class="row">
            <div class="col-12">
                <?php include 'header.php'; ?>
            </div> 
         </div>
         <!-- SECTION -->
          <div class="row p-1">
            <div class="col-12 col-md-6 mt-5 mx-auto border border-secondary rounded p-3">
                        <form action="index.php" method="POST">
                        <center> <div class="shadow-lg p-3 mb-5 bg-body-tertiary rounded"><h2>Client Feedback Form</h2></div></center>
                            <div class="d-flex">
                                <div class="d-flex align-items-center">
                                    <input type="radio" name="languange" id="English" class="p-0" checked>
                                    <label for="languange" class="p-0 px-1 m-0 label-radio">English</label>  
                                </div>
                                <div class="d-flex align-items-center mx-4">
                                    <input type="radio" name="languange" id="Tagalog" class="p-0">
                                    <label for="languange" class="p-0 px-1 m-0 label-radio">Tagalog</label>  
                                </div>
                            </div>
                            
                            <select name="office" class="form-control mt-5">
                                <option value="none">Select Office</option>
                                <option value="OSAS(OFFICE OF STUDENT AND ACADEMIC AFFAIRS)">OSAS(Office of Student and Acamedic Affairs)</option>
                                <option value="CASHIER OFFICE">Cashier Office</option>
                                <option value="REGISTRAR OFFICE">Registrar Office</option>
                                <option value="RECORDS OFFICE">Records Office</option>
                                <option value="PROCUREMENT OFFICE">Procurement Office</option>
                                <option value="LIBRARY">Library</option>
                                <option value="CLINIC OR HEALTH SERVICES">Clinic Office / Health Services</option>
                                <option value="RESEARCH AND DEVELOPMENT OFFICE">Research and Development Office</option>
                                <option value="RESEARCH EXTENSION AND SCIENTIFIC PUBLICATION">Research Eextension and Scientific Publication</option>
                                <option value="VPAF(VICE PRESIDENT FOR ADMINISTRATION AND FINANCE)">VPAF(Vice President for Administration and Finance)</option>
                                <option value="VPRE(VICE PRESIDENT FOR RESEARCH AND EXTENSION)">VPRE(Vice President for Research and Extension)</option>
                                <option value="KMITT">KMITT</option>
                            </select>
                            <span class="text-danger"><?php echo $office_error; ?></span>
                            <select name="organization" class="form-control mt-5">
                                <option value="none">Client Type</option>
                                <option value="Citizen">Citizen</option>
                                <option value="Student">Student</option>
                                <option value="Alumni">Alumni</option>
                            </select>
                            <span class="text-danger"><?php echo $organization_error; ?></span>
                            <!-- Question number 1 -->
                            <p class="p-0 m-0 mt-5 " id="english_1">1. How would you rate your overall experience with our school office?</p>
                            <p class="p-0 m-0 mt-5 " id="tagalog_1">1. Paano mo irerate ang iyong kabuuang karanasan sa aming opisina ng paaralan?</p>
                            <div class="row">
                                <div class="col-1 d-flex flex-column align-items-center mt-1 m-auto">
                                    <label for="1" class="p-0 m-0 label-radio">1</label>
                                    <input type="radio" name="question_1" value="1" class="p-0">
                                </div>
                                <div class="col-1 d-flex flex-column align-items-center mt-1 m-auto">
                                    <label for="2" class="p-0 m-0 label-radio">2</label>
                                    <input type="radio" name="question_1" value="2" class="p-0">
                                </div>
                                <div class="col-1 d-flex flex-column align-items-center mt-1 m-auto">
                                    <label for="3" class="p-0 m-0 label-radio">3</label>
                                    <input type="radio" name="question_1" value="3" class="p-0">
                                </div>
                                <div class="col-1 d-flex flex-column align-items-center mt-1 m-auto">
                                    <label for="4" class="p-0 m-0 label-radio">4</label>
                                    <input type="radio" name="question_1" value="4" class="p-0">
                                </div>
                                <div class="col-1 d-flex flex-column align-items-center mt-1 m-auto">
                                    <label for="5" class="p-0 m-0 label-radio">5</label>
                                    <input type="radio" name="question_1" value="5" class="p-0">
                                </div>
                            </div>
                            <span class="text-danger"><?php echo $question_1error; ?></span>

                            <!-- Question number 2 -->
                            <p class="p-0 m-0 mt-5" id="english_2">2. How would you rate the professionalism of the school office staff?</p>
                            <p class="p-0 m-0 mt-5" id="tagalog_2">2. Paano mo irerate ang propesyonalismo ng mga kawani sa opisina ng paaralan?</p>
                            <div class="row">
                                <div class="col-1 d-flex flex-column align-items-center mt-1 m-auto">
                                    <label for="1" class="p-0 m-0 label-radio">1</label>
                                    <input type="radio" name="question_2" value="1" class="p-0">
                                </div>
                                <div class="col-1 d-flex flex-column align-items-center mt-1 m-auto">
                                    <label for="2" class="p-0 m-0 label-radio">2</label>
                                    <input type="radio" name="question_2" value="2" class="p-0">
                                </div>
                                <div class="col-1 d-flex flex-column align-items-center mt-1 m-auto">
                                    <label for="3" class="p-0 m-0 label-radio">3</label>
                                    <input type="radio" name="question_2" value="3" class="p-0">
                                </div>
                                <div class="col-1 d-flex flex-column align-items-center mt-1 m-auto">
                                    <label for="4" class="p-0 m-0 label-radio">4</label>
                                    <input type="radio" name="question_2" value="4" class="p-0">
                                </div>
                                <div class="col-1 d-flex flex-column align-items-center mt-1 m-auto">
                                    <label for="5" class="p-0 m-0 label-radio">5</label>
                                    <input type="radio" name="question_2" value="5" class="p-0">
                                </div>
                            </div>
                            <span class="text-danger"><?php echo $question_2error; ?></span>

                            <!-- Question number 3 -->
                            <p class="p-0 m-0 mt-5" id="english_3">3. How satisfied are you  with the level of support and guidance offered by the office staff?</p>
                            <p class="p-0 m-0 mt-5" id="tagalog_3">3. Gaano ka nasisiyahan sa kalinawan ng impormasyong ibinibigay ng opisina?</p>
                            <div class="row">
                                <div class="col-1 d-flex flex-column align-items-center mt-1 m-auto">
                                    <label for="1" class="p-0 m-0 label-radio">1</label>
                                    <input type="radio" name="question_3" value="1" class="p-0">
                                </div>
                                <div class="col-1 d-flex flex-column align-items-center mt-1 m-auto">
                                    <label for="2" class="p-0 m-0 label-radio">2</label>
                                    <input type="radio" name="question_3" value="2" class="p-0">
                                </div>
                                <div class="col-1 d-flex flex-column align-items-center mt-1 m-auto">
                                    <label for="3" class="p-0 m-0 label-radio">3</label>
                                    <input type="radio" name="question_3" value="3" class="p-0">
                                </div>
                                <div class="col-1 d-flex flex-column align-items-center mt-1 m-auto">
                                    <label for="4" class="p-0 m-0 label-radio">4</label>
                                    <input type="radio" name="question_3" value="4" class="p-0">
                                </div>
                                <div class="col-1 d-flex flex-column align-items-center mt-1 m-auto">
                                    <label for="5" class="p-0 m-0 label-radio">5</label>
                                    <input type="radio" name="question_3" value="5" class="p-0">
                                </div>
                            </div>
                            <span class="text-danger"><?php echo $question_3error; ?></span>

                            <!-- Question number 4 -->
                            <p class="p-0 m-0 mt-5" id="english_4">4. How would you rate the comfort and cleanliness of the office environment?</p>
                            <p class="p-0 m-0 mt-5" id="tagalog_4">4. Paano mo irerate ang kaginhawaan at kalinisan ng opisina?</p>
                            <div class="row">
                                <div class="col-1 d-flex flex-column align-items-center mt-1 m-auto">
                                    <label for="1" class="p-0 m-0 label-radio">1</label>
                                    <input type="radio" name="question_4" value="1" class="p-0">
                                </div>
                                <div class="col-1 d-flex flex-column align-items-center mt-1 m-auto">
                                    <label for="2" class="p-0 m-0 label-radio">2</label>
                                    <input type="radio" name="question_4" value="2" class="p-0">
                                </div>
                                <div class="col-1 d-flex flex-column align-items-center mt-1 m-auto">
                                    <label for="3" class="p-0 m-0 label-radio">3</label>
                                    <input type="radio" name="question_4" value="3" class="p-0">
                                </div>
                                <div class="col-1 d-flex flex-column align-items-center mt-1 m-auto">
                                    <label for="4" class="p-0 m-0 label-radio">4</label>
                                    <input type="radio" name="question_4" value="4" class="p-0">
                                </div>
                                <div class="col-1 d-flex flex-column align-items-center mt-1 m-auto">
                                    <label for="5" class="p-0 m-0 label-radio">5</label>
                                    <input type="radio" name="question_4" value="5" class="p-0">
                                </div>
                            </div>
                            <span class="text-danger"><?php echo $question_4error; ?></span>

                            <!-- Question number 5 -->
                            <p class="p-0 m-0 mt-5" id="english_5">5. How satisfied are you with the clarity of the information provided by the office?</p>
                            <p class="p-0 m-0 mt-5" id="tagalog_5">5. Gaano ka nasisiyahan sa kalinawan ng impormasyong ibinibigay ng opisina?</p>
                            <div class="row">
                                <div class="col-1 d-flex flex-column align-items-center mt-1 m-auto">
                                    <label for="1" class="p-0 m-0 label-radio">1</label>
                                    <input type="radio" name="question_5" value="1" class="p-0">
                                </div>
                                <div class="col-1 d-flex flex-column align-items-center mt-1 m-auto">
                                    <label for="2" class="p-0 m-0 label-radio">2</label>
                                    <input type="radio" name="question_5" value="2" class="p-0">
                                </div>
                                <div class="col-1 d-flex flex-column align-items-center mt-1 m-auto">
                                    <label for="3" class="p-0 m-0 label-radio">3</label>
                                    <input type="radio" name="question_5" value="3" class="p-0">
                                </div>
                                <div class="col-1 d-flex flex-column align-items-center mt-1 m-auto">
                                    <label for="4" class="p-0 m-0 label-radio">4</label>
                                    <input type="radio" name="question_5" value="4" class="p-0">
                                </div>
                                <div class="col-1 d-flex flex-column align-items-center mt-1 m-auto">
                                    <label for="5" class="p-0 m-0 label-radio">5</label>
                                    <input type="radio" name="question_5" value="5" class="p-0">
                                </div>
                            </div>
                            <span class="text-danger"><?php echo $question_5error; ?></span>

                            <h6 class="mt-5">Additional Comments:</h6>
                            <p class="p-0 mt-2" id="english_6">What could the school office do to improve your experience?</p>
                            <p class="p-0 mt-2" id="tagalog_6">Ano ang maaaring gawin ng opisina ng paaralan upang mapabuti ang iyong karanasan?</p>
                            <textarea name="question_6" class="form-control" placeholder="Enter your answer here"></textarea>
                            <p class="p-0 mt-2" id="english_7">Do you have any additional comments or suggestions regarding your interaction with the school office?</p>
                            <p class="p-0 mt-2" id="tagalog_7">Mayroon ka bang karagdagang mga komento o mungkahi ukol sa iyong pakikipag-ugnayan sa opisina ng paaralan?</p>
                            <textarea name="question_7" class="form-control" placeholder="Enter your answer here"></textarea>
                            <input type="submit" value="Submit" name="submit" class="form-control mt-3 mb-3 btn-primary">
                        </form>
                    </div>
            </div>
          
        <!-- FOOTER -->
        <div class="row">
            <div class="col-12">
                <?php include 'footer.php'; ?>
            </div>
        </div>
    </div>
    <script>
        var english = document.getElementById('English');
        var tagalog = document.getElementById('Tagalog');

        var langEng_1 = document.getElementById("english_1");
        var langTag_1 = document.getElementById("tagalog_1");
        var langEng_2 = document.getElementById("english_2");
        var langTag_2 = document.getElementById("tagalog_2");
        var langEng_3 = document.getElementById("english_3");
        var langTag_3 = document.getElementById("tagalog_3");
        var langEng_4 = document.getElementById("english_4");
        var langTag_4 = document.getElementById("tagalog_4");
        var langEng_5 = document.getElementById("english_5");
        var langTag_5 = document.getElementById("tagalog_5");
        var langEng_6 = document.getElementById("english_6");
        var langTag_6 = document.getElementById("tagalog_6");
        var langEng_7 = document.getElementById("english_7");
        var langTag_7 = document.getElementById("tagalog_7");

        tagalog.addEventListener("change", function(){
            langEng_1.style.display = "none";
            langEng_2.style.display = "none";
            langEng_3.style.display = "none";
            langEng_4.style.display = "none";
            langEng_5.style.display = "none";
            langEng_6.style.display = "none";
            langEng_7.style.display = "none";

            langTag_1.style.display = "block";
            langTag_2.style.display = "block";
            langTag_3.style.display = "block";
            langTag_4.style.display = "block";
            langTag_5.style.display = "block";
            langTag_6.style.display = "block";
            langTag_7.style.display = "block";
        });
        english.addEventListener("change", function(){
            langEng_1.style.display = "block";
            langEng_2.style.display = "block";
            langEng_3.style.display = "block";
            langEng_4.style.display = "block";
            langEng_5.style.display = "block";
            langEng_6.style.display = "block";
            langEng_7.style.display = "block";

            langTag_1.style.display = "none";
            langTag_2.style.display = "none";
            langTag_3.style.display = "none";
            langTag_4.style.display = "none";
            langTag_5.style.display = "none";
            langTag_6.style.display = "none";
            langTag_7.style.display = "none";
        });
    </script>
</body>
</html>