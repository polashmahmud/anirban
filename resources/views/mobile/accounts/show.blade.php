@include('mobile.header')

<div class="w3-container w3-light-grey">
    <div class="w3-content">
        <form action="{{ route('mobile.accounts.store') }}" method="POST">
            @csrf
            <input type="hidden" name="account_id" value="{{ $id }}">
            <div class="w3-section">
                <label>টাকার পরিমান</label>
                <input class="w3-input w3-border" type="number" name="amount">
            </div>
            <button type="submit" class="w3-button w3-block w3-black w3-margin-bottom">জমাঃ {{ $account->amount }}</button>
        </form>
        <a href="{{ route('mobile.accounts') }}?branch={{ $account->branch }}&type={{ $account->type }}" class="w3-btn w3-block w3-teal">Back</a>
    </div>
</div>
<hr>
<div class="w3-container">
    <h2>জমা সমূহ</h2>
    <div class="w3-responsive">
        <table class="w3-table-all">
            <tr>
                <th>তারিখ</th>
                <th>টাকা</th>
            </tr>
            @foreach($collections as $collection)
                <tr>
                    <td>{{ $collection->date }}</td>
                    <td>{{ $collection->amount }}</td>
                </tr>
            @endforeach
        </table>
    </div>
    {{ $collections->links() }}
</div>
<br>


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
