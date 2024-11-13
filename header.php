<style>
    .header_main{
        background-color: darkblue;
        color: white;
    }
    #nisu_logo{
            width: 50px;
            height: 50px;
        }
        .banner_nisu h2{
            font-size: 16px;
            font-weight: bold;
        }
        .banner_nisu h5{
            font-size: 12px;
        }
        .user{
            font-size: 10px;
            display: flex;
            align-items: end;
            padding-right: 10px;
            flex-direction: column;
            justify-content: center;
            font-style: italic;
            text-transform: capitalize;
            background-color: white;
            color: black;
        }
        .bi-box-arrow-right{
            width: 10px;
            height: 10px;
        }

    @media screen and (min-width:768px){
        #nisu_logo{
            width: 100px;
            height: 100px;
        }
        .banner_nisu h2{
            font-size: 28px;
            font-weight: bold;
        }
        .banner_nisu h5{
            font-size: 18px;
        }
        .user{
            font-size: 16px;
            display: flex;
            align-items: end;
            padding-right: 10px;
            flex-direction: column;
            justify-content: center;
            font-style: italic;
            text-transform: capitalize;
            background-color: darkblue;
            color: lightcyan;
        }
        .bi-box-arrow-right{
            width: 20px;
            height: 20px;
        }
    }
</style>
    <div class="row header_main">
        <div class="col-12 col-md-10 p-2">
            <div class="d-flex align-items-center p-2 m-auto">
                <img src="/images/nisu_logo.png" id="nisu_logo" alt="logo" class="my-auto">
                <div class="banner_nisu d-flex flex-column justify-content-center p-1 p-md-3">
                    <h2 class="m-auto">NORTHERN ILOILO STATE UNIVERSITY</h2>
                    <h5 class="my-auto"><?php if(isset($_SESSION['id'])){ echo "Client Feedback"; }else{echo "Client feedback";}  ?></h5>
                </div>
            </div>
        </div>
        <?php
            if(isset($_SESSION['name'])){
                echo '
                    <div class="col user">
                        <span class="">'.$_SESSION['name'].'</span>
                        <a href="logout.php" class="text-danger">
                        <svg xmlns="http://www.w3.org/2000/svg"  fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0z"/>
                            <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708z"/>
                        </svg>
                        </a>
                    </div>             
                ';
            }else{
                echo '
                    <div class="col user">
                        <span id="date_time"></span>
                        <span id="time_date"></span>
                    </div>             
                ';
            }
        ?>
        <script>
            document.getElementById('date_time').innerHTML = new Date().toDateString();
            function oras(){
                setInterval(() => {
                    document.getElementById('time_date').innerHTML = new Date().toLocaleTimeString();
                }, 1000);
            }
            oras();
        </script>
    </div>
