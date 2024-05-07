<!DOCTYPE html>
<html>

    <head>
        <link rel="stylesheet" href="style.css">
    </head>

    <body>
        <div id="nav"><img src="images/uol logo.webp"> telecomms robot site draft</div>
        <div id="nav2">test</div>

        <div id="image" style="background-image: linear-gradient(rgba(0, 0, 0, 0),
                       rgba(0, 0, 0, 1)), url('images/inbcrop.jpg');"><h1>Remote Open Days</h1></div>
        <div id="content">

            <p>Visiting a university is an important step in deciding where and what to study. Our Undergraduate Open Days are a chance to get a sense of what it’s like to be a student at the University of Lincoln and discover why thousands of students fall in love with Lincoln each year.

            </p>

            <div id="flex">
                <img src="images/img1.jpg" style="height:200px; background-color: pink;">
                <div class="flextext"><h2>What's included?

                </h2>
            Using Double 3 technology, it is now possible to experience everything our open days have to offer from the comfort of your home! Simply fill in the booking form below to choose a time slot that suits you
            and read the instructions below????????????<br>
            This includes 45 minute access to the robot at your chosen time, which can be controlled from your browser to look around our campus. This robot also features camera + mic so you can interact as if you're here in person!
        </div>
            </div>

            <div id="flex">
                <div class="flextext"><h2>How does it work?</h2>
                Using this couldn't be easier! After booking a chosen slot, you will receive an email with a Code required to access the robot at your chosen time. Please see the other page to input this
                code and gain access to the robot.<br>
                The robot is controlled simply by using the directional buttons available on screen.
            </div>
                <i style="width:400px; height:200px; background-color: pink;">video maybe</i>

            </div>

            <div id="flex">
                
                <div class= "flextext"><h2>Register here!</h2><b style="color: var(--magenta)">Few steps:</b><br>
                1. Fill in your information<br> 2. Select a time slot<br> 3. Submit your booking<br>
                You will receive an email with all the details required for your tour, usable at your chosen date and time! We look forward to seeing you there!
                <br> <i>Email should be sent immediately, please check your spam folder first then contact us if it still hasn't arrived.</i>
                
            </div>

                <form action="booking.php" method="post" class="shape"  return="false";>
                    <label for="name">Name: </label><input type="text" id="name" name="name">
                    <hr>

                        <div class="dates">
                <?php
                include("config.php"); 
                
                $dates = mysqli_query($conn, "select date_format(date, '%d/%m/%Y') as date, time_format(time, '%H:%i') as time, datetime from bookings where name is null order by datetime");
                
                
                $currentDate = null;

while ($c = mysqli_fetch_array($dates)) {
    if ($c['date'] !== $currentDate) {
        ?> <br> <?php
        // Display the date if it's different from the current one
        echo $c['date'] . "<br>";
        $currentDate = $c['date'];
    }

    ?>
    <input type="radio" id="<?php echo $c['datetime']?>" name="datetime" value="<?php echo $c['datetime']?>">
    <label for="<?php echo $c['datetime']?>"><?php echo $c['time']?></label>
    <?php
}
?>

                </div>

                    <hr>
                    <label for="email">Email: </label><input type="text" id="email" name="email"><hr>
                        <label><input type="checkbox" name="check"> checkbox</label>
                        
                        <hr>
                        <button onclick="alert('Details sent in email!')">Submit</button>
                </form>
            </div>
            
        </div>
    </body>

</html>