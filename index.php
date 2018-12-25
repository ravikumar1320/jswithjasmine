<html>
<head>
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="js/chatbot.js"></script>
    <script src="js/lightslider.js"></script>
    <link rel="stylesheet" href="css/chatbot.css" type="text/css">
    <link rel="stylesheet" href="css/lightslider.css" type="text/css">
    <base target="_blank">
    <script type="text/javascript">
        $(document).ready(function () {
            $("#lightSlider").lightSlider();
            window.submitForm("form")
        });
    </script>
</head>
<body class="fontStyle">

<div class="topstrip" id="topstrip">Powered by <a href="https://www.miningbusinessdata.com" style="color:#d3d3d3">
        MiningBusinessData</a>&nbsp;&nbsp;&nbsp;</div>
<div class="topbar container-fluid" id="chat-text" style="background-color: #fafafa">
</div>
<form>
    <span style="width:100%;" id="inputSpan">
        <input class="inputbox"
               placeholder="Write something and press Enter..." id="message" name="date" value="">
    </span>
    <input name="submit" type="hidden" value="Submit">
</form>
<?php
$sessionID = uniqid('', true);
//sha1
?>
<span style="display: none;" id="sessionId">
        <?php
        echo $sessionID;
        ?>
</span>

</body>
</html>