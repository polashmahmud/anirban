<!DOCTYPE html>
<html>
<title>AnirBan</title>
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
    <a href="{{ route('mobile.dashboard') }}" onclick="w3_close()" class="w3-bar-item w3-button">ডেসবোর্ড</a>
    <a href="{{ route('logout') }}" class="w3-bar-item w3-button"
       onclick="event.preventDefault();
                       document.getElementById('logout-form').submit();">
       লগ আউট
    </a>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
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