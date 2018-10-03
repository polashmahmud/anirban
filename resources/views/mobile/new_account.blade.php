@include('mobile.header')

<!-- Photo grid -->
<div class="w3-container w3-light-grey w3-padding-32 w3-padding-large" id="contact">
    <div class="w3-content" style="max-width:600px">
        <h4 class="w3-center"><b>নতুন একাউন্ট যুক্ত করুন</b></h4>
        <form action="{{ route('account.store') }}" method="POST">
            @csrf
            <div class="w3-section">
                <label>সদস্য নাম</label>
                <select class="w3-select" name="user_id">
                    <option value="" disabled selected>সদস্য নির্বাচন করো</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }} (M: {{$user->phone}})</option>
                    @endforeach
                </select>
            </div>
            <div class="w3-section">
                <label>প্যাকেজ</label>
                <select class="w3-select" name="package_id">
                    <option value="" disabled selected>প্যাকেজ নির্বাচন করো</option>
                    @foreach($packages as $package)
                        <option value="{{ $package->id }}">{{ $package->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="w3-section">
                <input class="w3-radio" type="radio" name="branch" value="1" checked>
                <label>শরিফুল ব্রাঞ্চ</label>

                <input class="w3-radio" type="radio" name="branch" value="0">
                <label>পলাশ ব্রাঞ্চ</label>
            </div>
            <div class="w3-section">
                <label>কিস্তির টাকার পরিমান</label>
                <input class="w3-input w3-border" type="number" name="amount">
            </div>
            <input type="hidden" value="{{ date('Y/m/d') }}" name="date">
            <button type="submit" class="w3-button w3-block w3-black w3-margin-bottom">নতুন একাউন্ট</button>
        </form>
    </div>
</div>

<hr>
<div class="w3-container">
    <h2>একাউন্টস সমূহ</h2>
    <div class="w3-responsive">
        <table class="w3-table-all">
            <tr>
                <th>হিসাব নং</th>
                <th>নাম</th>
                <th>প্যাকেজ নাম</th>
            </tr>
            @foreach($accounts as $account)
                <tr>
                    <td>AAN-{{ $account->id }}</td>
                    <td>{{ $account->user->name }}(AnirBan-{{$account->user->id}})</td>
                    <td>{{ $account->package->name }}</td>
                </tr>
            @endforeach
        </table>
    </div>
    {{ $accounts->links() }}
</div>
<br>