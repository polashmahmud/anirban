<!DOCTYPE html>
<html>
<title>W3.CSS Template</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link href="https://fonts.googleapis.com/css?family=Galada|Hind+Siliguri:400,700" rel="stylesheet">
<style>
    body {font-family: 'Hind Siliguri', sans-serif;}
    header,h1,h2,h3,h4,h5 {font-family: 'Galada', cursive;}
    .w3-third img{margin-bottom: -6px; opacity: 0.8; cursor: pointer}
    .w3-third img:hover{opacity: 1}
</style>
<body class="w3-light-grey w3-content">

<!-- Sidebar/menu -->
<nav class="w3-sidebar w3-bar-block w3-white w3-animate-left w3-text-grey w3-collapse w3-top w3-center" style="z-index:3;width:300px;font-weight:bold" id="mySidebar"><br>
    <h3 class="w3-padding-64 w3-center"><b>Anir<br>Ban</b></h3>
    <a href="javascript:void(0)" onclick="w3_close()" class="w3-bar-item w3-button w3-padding w3-hide-large">CLOSE</a>
    <a href="#" onclick="w3_close()" class="w3-bar-item w3-button">PORTFOLIO</a>
    <a href="#about" onclick="w3_close()" class="w3-bar-item w3-button">ABOUT ME</a>
    <a href="#contact" onclick="w3_close()" class="w3-bar-item w3-button">CONTACT</a>
</nav>

<!-- Top menu on small screens -->
<header class="w3-container w3-top w3-hide-large w3-white w3-large w3-padding-16" style="border-bottom: 1px solid #e91e631a;">
    <span class="w3-left w3-padding">অনির্বাণ সঞ্চয় ও ঋণদান সমিতি</span>
    <a href="javascript:void(0)" class="w3-right w3-button w3-white" onclick="w3_open()">☰</a>
</header>

<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px">

    <!-- Push down content on small screens -->
    <div class="w3-hide-large" style="margin-top:83px"></div>

    <h2 class="w3-center">ইনভেস্টমেন্ট একাউন্ট সমূহ</h2>
    <p class="w3-center">সবর্মোট একাউন্টঃ {{ $accounts->count() }} টি</p>
    <div style="margin: 3%;">
        <ul class="w3-ul w3-card-4">
            @foreach($accounts as $account)
            <li class="w3-bar">
              <span class="w3-bar-item w3-button w3-white w3-xlarge w3-right">
                {{--<a class="w3-button w3-blue w3-small" href="">জমা</a>--}}
                <a class="w3-button w3-teal w3-small" href="{{ route('mobile.investment.show', $account->id) }}">+</a>
              </span>
                @if($account->user->getFirstMediaUrl('avatar', 'small'))
                    <img class="w3-bar-item" style="width:85px" src={{ asset($account->user->getFirstMediaUrl('avatar', 'small')) }} style="width:28px;">
                @else
                    <img class="w3-bar-item" style="width:85px" src="./assets/img/users/u2.jpg" style="width:28px;">
                @endif
                <div class="w3-bar-item">
                    <span class="w3-large">{{ $account->user->name }}</span><br>
                    <span class="w3-tag w3-blue" style="margin-right: 2px">{{ \App\Classes\Helper::collectionLastDate($account->id) }}</span><span class="w3-tag w3-teal">৳: {{ $account->collections->sum('amount') }}</span><br>
                    <span class="w3-tag" style="margin-right: 2px; margin-top: 2px;">AnirBan-{{ $account->user->id }}</span><span class="w3-tag">AAN-{{ $account->id }}</span>
                </div>
            </li>
            @endforeach
        </ul>
    </div>


    <div class="w3-black w3-center w3-padding-24">Develop By: <a href="https://www.w3schools.com/w3css/default.asp" title="W3.CSS" target="_blank" class="w3-hover-opacity">Polash Mahmud</a></div>

    <!-- End page content -->
</div>

<script>
    // Script to open and close sidebar
    function w3_open() {
        document.getElementById("mySidebar").style.display = "block";
        document.getElementById("myOverlay").style.display = "block";
    }

    function w3_close() {
        document.getElementById("mySidebar").style.display = "none";
        document.getElementById("myOverlay").style.display = "none";
    }

    // Modal Image Gallery
    function onClick(element) {
        document.getElementById("img01").src = element.src;
        document.getElementById("modal01").style.display = "block";
        var captionText = document.getElementById("caption");
        captionText.innerHTML = element.alt;
    }

</script>


</body>
</html>