@extends('layouts.app')

@section('title', 'Dashboard')

@push('header-script')

@endpush

@push('footer-script')
    <script>
        $(function() {
            var a = {
                    labels: ["Sunday", "Munday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
                    datasets: [{
                        label: "Data 1",
                        borderColor: 'rgba(52,152,219,1)',
                        backgroundColor: 'rgba(52,152,219,1)',
                        pointBackgroundColor: 'rgba(52,152,219,1)',
                        data: [29, 48, 40, 19, 78, 31, 85]
                    },{
                        label: "Data 2",
                        backgroundColor: "#DADDE0",
                        borderColor: "#DADDE0",
                        data: [45, 80, 58, 74, 54, 59, 40]
                    }]
                },
                t = {
                    responsive: !0,
                    maintainAspectRatio: !1
                },
                e = document.getElementById("bar_chart").getContext("2d");
            new Chart(e, {
                type: "bar",
                data: a,
                options: t
            });
        });
    </script>
@endpush

@section('content')
    <div class="row">
        <div class="col-lg-3 col-md-6">
            <div class="ibox bg-success color-white widget-stat">
                <div class="ibox-body">
                    <h2 class="m-b-5 font-strong">{{ $total_investment }}</h2>
                    <div class="m-b-5">সর্বমোট মূলধন</div><i class="ti-shopping-cart widget-stat-icon"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="ibox bg-info color-white widget-stat">
                <div class="ibox-body">
                    <h2 class="m-b-5 font-strong">{{ abs($total_lone) }}</h2>
                    <div class="m-b-5">সর্বমোট ঋণ</div><i class="ti-bar-chart widget-stat-icon"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="ibox bg-warning color-white widget-stat">
                <div class="ibox-body">
                    <h2 class="m-b-5 font-strong">{{ $total_collection }}</h2>
                    <div class="m-b-5">সবর্মোট জমা</div><i class="fa fa-money widget-stat-icon"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="ibox bg-danger color-white widget-stat">
                <div class="ibox-body">
                    <h2 class="m-b-5 font-strong">{{ $total_profit }}</h2>
                    <div class="m-b-5">মোট লাভ</div><i class="ti-user widget-stat-icon"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-8">
            <div class="ibox">
                <div class="ibox-body">
                    <div class="flexbox mb-4">
                        <div>
                            <h3 class="m-0">চার্ট</h3>
                            <div>ঋণ / সঞ্চয়</div>
                        </div>
                        <div class="d-inline-flex">
                            <div class="px-3" style="border-right: 1px solid rgba(0,0,0,.1);">
                                <div class="text-muted">সর্বমোট জমা</div>
                                <div>
                                    <span class="h2 m-0">$850</span>
                                </div>
                            </div>
                            <div class="px-3">
                                <div class="text-muted">সর্বমোট ঋণ</div>
                                <div>
                                    <span class="h2 m-0">240</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <canvas id="bar_chart" style="height:260px;"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            @if(!empty($cash_in_hands))
            <div class="ibox">
                <div class="ibox-head">
                    <div class="ibox-title">হাতে টাকা আছে</div>
                </div>
                <div class="ibox-body">
                    <ul class="media-list media-list-divider m-0">
                        @foreach($cash_in_hands as $cash_in_hand)
                            <li class="media">
                                @if($cash_in_hand->user->getFirstMediaUrl('avatar', 'medium'))
                                    <a class="media-img" href="javascript:;">
                                        <img src="{{ asset($cash_in_hand->user->getFirstMediaUrl('avatar', 'medium')) }}" width="50px;" />
                                    </a>
                                @else
                                    <a class="media-img" href="javascript:;">
                                        <img src="./assets/img/image.jpg" width="50px;" />
                                    </a>
                                @endif
                                <div class="media-body">
                                    <div class="media-heading">
                                        {{ $cash_in_hand->user->name }}
                                        <span class="font-16 float-right">টাকাঃ {{ $cash_in_hand->amount }}</span>
                                    </div>
                                    <div class="font-13">{{ $cash_in_hand->user->phone }}</div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            @endif
        </div>
    </div>
    <div class="ibox">
        <div class="ibox-head">
            <div class="ibox-title">ঋণ একাউন্ট সমূহ</div>
        </div>
        <div class="ibox-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th width="50px"></th>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Data</th>
                        <th>Last Name</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>
                            <label class="ui-checkbox">
                                <input type="checkbox">
                                <span class="input-span"></span>
                            </label>
                        </td>
                        <td>iphone case</td>
                        <td>$1200</td>
                        <td>33%</td>
                        <td>02/08/2017</td>
                        <td>
                            <button class="btn btn-default btn-xs m-r-5" data-toggle="tooltip" data-original-title="Edit"><i class="fa fa-pencil font-14"></i></button>
                            <button class="btn btn-default btn-xs" data-toggle="tooltip" data-original-title="Delete"><i class="fa fa-trash font-14"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label class="ui-checkbox">
                                <input type="checkbox">
                                <span class="input-span"></span>
                            </label>
                        </td>
                        <td>Car covers</td>
                        <td>$3280</td>
                        <td>42%</td>
                        <td>08/10/2017</td>
                        <td>
                            <button class="btn btn-default btn-xs m-r-5" data-toggle="tooltip" data-original-title="Edit"><i class="fa fa-pencil font-14"></i></button>
                            <button class="btn btn-default btn-xs" data-toggle="tooltip" data-original-title="Delete"><i class="fa fa-trash font-14"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label class="ui-checkbox">
                                <input type="checkbox">
                                <span class="input-span"></span>
                            </label>
                        </td>
                        <td>Compressors</td>
                        <td>$7400</td>
                        <td>56%</td>
                        <td>14/11/2017</td>
                        <td>
                            <button class="btn btn-default btn-xs m-r-5" data-toggle="tooltip" data-original-title="Edit"><i class="fa fa-pencil font-14"></i></button>
                            <button class="btn btn-default btn-xs" data-toggle="tooltip" data-original-title="Delete"><i class="fa fa-trash font-14"></i></button>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection