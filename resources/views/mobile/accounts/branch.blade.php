@include('mobile.header')

<div class="w3-row w3-center" style="margin-top: 25px;">
    <div class="w3-col s6" style="border-right: 1px solid #33333321;">
        <img src={{ asset("mobile/img/soriful.jpg") }} style="width:60%; height: 120px; padding: 10px;">
        <p>শরিফুল ব্রাঞ্চ</p>
        <div style="padding: 5px;">
            <p><a class="w3-button w3-block w3-black" href="{{ route('mobile.accounts') }}?branch=1&type=2">ইনভেস্ট একাউন্ট সমূহ</a></p>
            <p><a class="w3-button w3-block w3-red" href="{{ route('mobile.accounts') }}?branch=1&type=0">ঋণ একাউন্ট সমূহ</a></p>
            <p><a class="w3-button w3-block w3-teal" href="{{ route('mobile.accounts') }}?branch=1&type=1">সঞ্চয় একাউন্ট সমূহ</a></p>
        </div>
    </div>
    <div class="w3-col s6">
        <img src={{ asset("mobile/img/polash.jpg") }} style="width:60%; height: 120px; padding: 10px;">
        <p>পলাশ ব্রাঞ্চ</p>
        <div style="padding: 5px;">
            <p><a class="w3-button w3-block w3-black" href="{{ route('mobile.accounts') }}?branch=0&type=2">ইনভেস্ট একাউন্ট সমূহ</a></p>
            <p><a class="w3-button w3-block w3-red" href="{{ route('mobile.accounts') }}?branch=0&type=0">ঋণ একাউন্ট সমূহ</a></p>
            <p><a class="w3-button w3-block w3-teal" href="{{ route('mobile.accounts') }}?branch=0&type=1">সঞ্চয় একাউন্ট সমূহ</a></p>
        </div>
    </div>
</div>


