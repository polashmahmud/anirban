@include('mobile.header')

<h2 class="w3-center">একাউন্ট সমূহ</h2>
<p class="w3-center">সবর্মোট একাউন্টঃ {{ $accounts->count() }} টি</p>
<div style="margin: 3%;">
    <ul class="w3-ul w3-card-4">
        @foreach($accounts as $account)
            <li class="w3-bar">
              <span class="w3-bar-item w3-button w3-white w3-xlarge w3-right">
                {{--<a class="w3-button w3-blue w3-small" href="">জমা</a>--}}
                  <a class="w3-button w3-teal w3-small" href="{{ route('mobile.accounts.show', $account->id) }}">+</a>
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
