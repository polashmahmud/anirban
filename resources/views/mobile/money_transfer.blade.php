@include('mobile.header')

<!-- Photo grid -->
<div class="w3-container w3-light-grey w3-padding-32 w3-padding-large" id="contact">
    <div class="w3-content" style="max-width:600px">
        <h4 class="w3-center"><b>মানি ট্রান্সফার</b></h4>
        <form action="{{ route('transfer-amount.store') }}" method="POST">
            @csrf
            <div class="w3-section">
                <label>টাকা দিবেন</label>
                <select class="w3-select" name="user_from">
                    <option value="" disabled selected>সদস্য নির্বাচন করো</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }} (M: {{$user->phone}})</option>
                    @endforeach
                </select>
            </div>
            <div class="w3-section">
                <label>টাকা পাবেন</label>
                <select class="w3-select" name="user_to">
                    <option value="" disabled selected>সদস্য নির্বাচন করো</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }} (M: {{$user->phone}})</option>
                    @endforeach
                </select>
            </div>
            <div class="w3-section">
                <label>টাকার পরিমান</label>
                <input class="w3-input w3-border" type="number" name="amount">
            </div>
            <input type="hidden" value="{{ date('Y/m/d') }}" name="date">
            <button type="submit" class="w3-button w3-block w3-black w3-margin-bottom">টাকা ট্রান্সফার</button>
        </form>
    </div>
</div>

<hr>
<div class="w3-container">
    <h2>একাউন্টস সমূহ</h2>
    <div class="w3-responsive">
        <table class="w3-table-all">
            <tr>
                <th>তারিখ</th>
                <th>নাম</th>
                <th>টাকা</th>
                <th>বর্ণনা</th>
            </tr>
            @foreach($transferAmounts as $amount)
                <tr>
                    <td>{{ $amount->date }}</td>
                    <td>{{ $amount->user->name }}</td>
                    <td>{{ $amount->amount }}</td>
                    <td>{{ $amount->description }}</td>
                </tr>
            @endforeach
        </table>
    </div>
    {{ $transferAmounts->links() }}
</div>
<br>