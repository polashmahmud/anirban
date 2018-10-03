@include('mobile.header')

<!-- Photo grid -->
<div class="w3-container w3-light-grey w3-padding-32 w3-padding-large" id="contact">
    <div class="w3-content" style="max-width:600px">
        <h4 class="w3-center"><b>নতুন জমা/খরচ যুক্ত করুন</b></h4>
        <form action="{{ route('debit-credit.store') }}" method="POST">
            @csrf

            <div class="w3-section">
                <input class="w3-radio" type="radio" name="type" value="0" checked>
                <label>খরচ</label>

                <input class="w3-radio" type="radio" name="type" value="1">
                <label>জমা</label>
            </div>
            <div class="w3-section">
                <label>টাকার পরিমান</label>
                <input class="w3-input w3-border" type="number" name="amount">
            </div>
            <div class="w3-section">
                <label>বর্ণনা</label>
                <textarea class="w3-input w3-border" type="text" name="description"></textarea>
            </div>
            <input type="hidden" value="{{ date('Y/m/d') }}" name="date">
            <button type="submit" class="w3-button w3-block w3-black w3-margin-bottom">যুক্ত করুন</button>
        </form>
    </div>
</div>

<hr>
<div class="w3-container">
    <h2>জমা খরচ সমূহ</h2>
    <div class="w3-responsive">
        <table class="w3-table-all">
            <tr>
                <th>তারিখ</th>
                <th>টাকা</th>
                <th>বর্ণনা</th>
            </tr>
            @foreach($collections as $collection)
                <tr>
                    <td>{{ $collection->date }}</td>
                    <td>{{ $collection->amount }}</td>
                    <td>{{ $collection->description }}</td>
                </tr>
            @endforeach
        </table>
    </div>
    {{ $collections->links() }}
</div>
<br>