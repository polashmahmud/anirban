@include('mobile.header')

<!-- Photo grid -->
<div class="w3-row w3-margin-bottom" style="border-bottom: 1px solid #ff000066;padding-top: 6px;">
    <div class="w3-col s3">
        @if( ! \Illuminate\Support\Facades\Auth::user()->getFirstMediaUrl('avatar', 'small'))
            <img src="/img/blank-profile.jpg" alt="" class="w3-circle" style="width:50px; height: 50px; margin: 5px;" />
        @else
            <img src="{{ asset(\Illuminate\Support\Facades\Auth::user()->getFirstMediaUrl('avatar', 'small')) }}" alt="" class="w3-circle" style="width:50px; height: 50px; margin: 5px;" />
        @endif
    </div>
    <div class="w3-col s9">
        <h5 style="padding: 0; margin: 0;">{{ \Illuminate\Support\Facades\Auth::user()->name }} <span style="display: block;background: #e91e6312;border-radius: 5px;padding: 2px;padding-left: 8px;width: 50%;font-size: 12px;color: #e91e63; font-family: 'Hind Siliguri', sans-serif;">৳: {{ $cash_in_hands }}</span></h5>
    </div>
</div>
<div class="w3-row w3-center">
    <div class="w3-col s6" style="border-right: 1px solid #33333321; border-bottom: 1px solid #33333321;">
        <a href="{{ route('mobile.new.account') }}">
            <img src="img/user-tie-solid.svg" style="width:60%; height: 120px; padding: 10px;">
            <p>নতুন একাউন্ট</p>
        </a>
    </div>
    <div class="w3-col s6" style="border-bottom: 1px solid #33333321;">
        <a href="{{ route('mobile.accounts.branch') }}">
            <img src="img/people-carry-solid.svg" style="width:60%; height: 120px; padding: 10px;">
            <p>টাকা কালেকশন</p>
        </a>
    </div>
</div>
<div class="w3-row w3-center">
    <div class="w3-col s6" style="border-right: 1px solid #33333321;">
        <a href="{{ route('mobile.money.transfer') }}">
            <img src="img/shuttle-van-solid.svg" style="width:60%; height: 120px; padding: 10px;">
            <p>মানি ট্রান্সফার</p>
        </a>
    </div>
    <div class="w3-col s6">
        <a href="{{ route('mobile.debit.credit') }}">
            <img src="img/book-solid.svg" style="width:60%; height: 120px; padding: 10px;">
            <p>জমা / খরচ</p>
        </a>
    </div>
</div>

