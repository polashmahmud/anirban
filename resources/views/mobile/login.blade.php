<!DOCTYPE html>
<html>
<title>অনির্বাণ সঞ্চয় ও ঋণদান সমিতি</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link href="https://fonts.googleapis.com/css?family=Galada|Hind+Siliguri:400,700" rel="stylesheet">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
<style>
    body {font-family: 'Hind Siliguri', sans-serif;}
    header,h1,h2,h3,h4,h5 {font-family: 'Galada', cursive;}
    .w3-third img{margin-bottom: -6px; opacity: 0.8; cursor: pointer}
    .w3-third img:hover{opacity: 1}
</style>
<body class="w3-light-grey w3-content">

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px">

    <!-- Contact section -->
    <div class="w3-container w3-light-grey w3-padding-32 w3-padding-large" id="contact">
        <div class="w3-content" style="max-width:600px">
            <h4 class="w3-center"><b>অনির্বাণ সঞ্চয় ও ঋণদান সমিতি</b></h4>
            <p class="w3-center"><img src="img/logo.jpg" alt="" width="30%"></p>
            <form action="{{ route('mobile.login') }}" method="POST">
                @csrf
                <div class="w3-section">
                    <label>মোবাইল নম্বর</label>
                    <input class="w3-input w3-border" type="number" name="phone" required>
                </div>
                <div class="w3-section">
                    <label>পাসওয়ার্ড</label>
                    <input class="w3-input w3-border" type="password" name="password" required>
                </div>
                <button type="submit" class="w3-button w3-block w3-black w3-margin-bottom">প্রবেশ</button>
            </form>
        </div>
    </div>

    <!-- End page content -->
</div>
</body>
</html>
