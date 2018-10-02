@extends('layouts.app')

@section('title', 'Collection')

@push('header-script')

@endpush

@push('footer-script')

@endpush

@section('content')
    <div class="row">
        @foreach($accounts as $account)
            <div class="col-md-3">
                <div class="card mb-3">
                    <div class="card-header">
                        @if($account->user->getFirstMediaUrl('avatar', 'small'))
                            <img class="img-circle m-r-10 pull-left" src={{ asset($account->user->getFirstMediaUrl('avatar', 'small')) }} style="width:28px;">
                        @else
                            <img class="img-circle m-r-10 pull-left" src="./assets/img/users/u2.jpg" style="width:28px;">
                        @endif

                        <h6 class="m-0">{{ $account->user->name }}</h6><small class="text-muted"><span class="badge badge-default m-r-5 m-b-5">{{ \App\Classes\Helper::collectionLastDate($account->id) }}</span>  {!! html_entity_decode(\App\Classes\Helper::packageType($account->package->type)) !!} </small>
                        <div class="pull-right text-danger" style="margin-top: -8px;">TK: {{ $account->package->end_amount - $account->collections->sum('amount') }}</div>
                    </div>
                    <div class="card-body">
                        <div class="ibox-body">
                            <div class="row text-center m-b-20">
                                <div class="col-4">
                                    <div class="font-24 profile-stat-count">{{ $account->package->installment }}</div>
                                    <div class="text-muted">মোট কিস্তি</div>
                                </div>
                                <div class="col-4">
                                    <div class="font-24 profile-stat-count">{{ $account->collections->count('amount') - 1 }}</div>
                                    <div class="text-muted">জমা কিস্তি</div>
                                </div>
                                <div class="col-4">
                                    <div class="font-24 profile-stat-count">{{ $account->package->installment - ($account->collections->count('amount') - 1) }}</div>
                                    <div class="text-muted">বাকি কিস্তি</div>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center">
                            <form id="status-change" method="post" action="{{ route('status-change') }}" style="display: none">
                            @csrf
                            <input type="hidden" name="table" value="accounts">
                            <input type="hidden" name="id" value="{{ $account->id }}">
                            <input type="hidden" name="column" value="status">
                            <input type="hidden" name="value" value="{{ $account->status }}">
                            <input type="hidden" name="message" value="Account Done">
                            </form>
                            <a class='' href="" onclick="
                                     if(confirm('এই একাউন্টটির সকল লেনদেন কি সম্পূর্ণ হয়েছে? আপনি কি নিশ্চিত?'))
                              {
                                event.preventDefault();
                                document.getElementById('status-change').submit();
                              }
                              else{
                                event.preventDefault();
                              }" ><i class="fa fa-heart"></i></a>

                            <form action="{{ route('collection.store') }}" method="POST">
                                @csrf
                                <input type="hidden" value="{{ $account->id }}" name="account_id">
                                <button class="btn btn-default btn-sm" type="submit">
                                        জমাঃ {{ $account->amount }} টাকা
                                </button>
                            </form>
                            <a class="" href="{{ route('collection.show', $account->id) }}"><i class="fa fa-bars"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection