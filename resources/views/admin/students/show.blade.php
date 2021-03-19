@extends('admin-layouts.main-layout')

@section('content')
    <style>
        /* custom inclusion of right, left and below tabs */

        .tabs-below > .nav-tabs,
        .tabs-right > .nav-tabs,
        .tabs-left > .nav-tabs {
            border-bottom: 0;
        }

        .tab-content > .tab-pane,
        .pill-content > .pill-pane {
            display: none;
        }

        .tab-content > .active,
        .pill-content > .active {
            display: block;
        }

        .tabs-below > .nav-tabs {
            border-top: 1px solid #ddd;
        }

        .tabs-below > .nav-tabs > li {
            margin-top: -1px;
            margin-bottom: 0;
        }

        .tabs-below > .nav-tabs > li > a {
            -webkit-border-radius: 0 0 4px 4px;
            -moz-border-radius: 0 0 4px 4px;
            border-radius: 0 0 4px 4px;
        }

        .tabs-below > .nav-tabs > li > a:hover,
        .tabs-below > .nav-tabs > li > a:focus {
            border-top-color: #ddd;
            border-bottom-color: transparent;
        }

        .tabs-below > .nav-tabs > .active > a,
        .tabs-below > .nav-tabs > .active > a:hover,
        .tabs-below > .nav-tabs > .active > a:focus {
            border-color: transparent #ddd #ddd #ddd;
        }

        .tabs-left > .nav-tabs > li,
        .tabs-right > .nav-tabs > li {
            float: none;
        }

        .tabs-left > .nav-tabs > li > a,
        .tabs-right > .nav-tabs > li > a {
            min-width: 74px;
            margin-right: 0;
            margin-bottom: 3px;
        }

        .tabs-left > .nav-tabs {
            float: left;
            margin-right: 19px;
            border-right: 1px solid #ddd;
        }

        .tabs-left > .nav-tabs > li > a {
            margin-right: -1px;
            -webkit-border-radius: 4px 0 0 4px;
            -moz-border-radius: 4px 0 0 4px;
            border-radius: 4px 0 0 4px;
        }

        .tabs-left > .nav-tabs > li > a:hover,
        .tabs-left > .nav-tabs > li > a:focus {
            border-color: #eeeeee #dddddd #eeeeee #eeeeee;
        }

        .tabs-left > .nav-tabs .active > a,
        .tabs-left > .nav-tabs .active > a:hover,
        .tabs-left > .nav-tabs .active > a:focus {
            border-color: #ddd transparent #ddd #ddd;
            *border-right-color: #ffffff;
        }

        .tabs-right > .nav-tabs {
            float: right;
            margin-left: 19px;
            border-left: 1px solid #ddd;
        }

        .tabs-right > .nav-tabs > li > a {
            margin-left: -1px;
            -webkit-border-radius: 0 4px 4px 0;
            -moz-border-radius: 0 4px 4px 0;
            border-radius: 0 4px 4px 0;
        }

        .tabs-right > .nav-tabs > li > a:hover,
        .tabs-right > .nav-tabs > li > a:focus {
            border-color: #eeeeee #eeeeee #eeeeee #dddddd;
        }

        .tabs-right > .nav-tabs .active > a,
        .tabs-right > .nav-tabs .active > a:hover,
        .tabs-right > .nav-tabs .active > a:focus {
            border-color: #ddd #ddd #ddd transparent;
            *border-left-color: #ffffff;
        }
    </style>
    <section class="content-header">
        <h1> {{$s->last_name}}, {{$s->first_name}} {{$s->middle_name}}<small>Student Information</small></h1>
    </section>

    <section class="content">
        <div class="panel panel-default">
            <div class="panel-heading">
                Enrollments
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="tabbable tabs-left">
                            @if($s->enrollments()->exists())
                                <ul class="nav nav-tabs">
                               @php
                                    $enrollments = $s->enrollments()->orderBy('sy','desc');
                                    $start = 1;
                                    $labels = [
                                        7 => 'label-success',
                                        8 => 'label-warning',
                                        9 => 'label-danger',
                                        10 => 'label-primary',
                                    ];
                               @endphp
                                    @foreach($enrollments->get() as $enrollment)
                                        <li class="{{($start == 1) ? 'active':''}}">
                                            <a href="#{{$enrollment->grade}}-{{$enrollment->sy}}" data-toggle="tab">{{$enrollment->sy}}-{{($enrollment->sy+1)}}
                                                <span class="pull-right-container">
                                                    <span class="badge {{$labels[$enrollment->grade]}}">{{$enrollment->grade}}</span>
                                                </span>
                                            </a>
                                        </li>
                                        @php($start++)
                                    @endforeach

                                </ul>
                                <div class="tab-content">
                                    @php($start = 1)
                                    @foreach($enrollments->get() as $enrollment)
                                        <div class="tab-pane {{($start == 1) ? 'active':''}}" id="{{$enrollment->grade}}-{{$enrollment->sy}}">
                                            <div class="row">
                                                <div class="col-md-10">
                                                    <!-- Custom Tabs -->
                                                    <div class="nav-tabs-custom">
                                                        <ul class="nav nav-tabs">
                                                            <li class="active"><a href="#tab_1-{{$enrollment->grade}}-{{$enrollment->sy}}" data-toggle="tab">Accounts</a></li>
                                                            <li><a href="#tab_2-{{$enrollment->grade}}-{{$enrollment->sy}}" data-toggle="tab">Subjects</a></li>
                                                        </ul>
                                                        <div class="tab-content">
                                                            <div class="tab-pane active" id="tab_1-{{$enrollment->grade}}-{{$enrollment->sy}}">
                                                                <div class="row">
                                                                    <div class="col-md-4">
                                                                        <div class="panel panel-success">
                                                                            <div class="panel-heading" style="padding-top: 5px;padding-bottom: 5px">
                                                                                Accounts Payable
                                                                            </div>
                                                                            <div class="panel-body">
                                                                                <table class="table table-xtra-condensed">
                                                                                    <thead>
                                                                                        <tr>
                                                                                            <th style="">Payable</th>
                                                                                            <th style="">Amount</th>
                                                                                        </tr>
                                                                                    </thead>
                                                                                    <tbody>
                                                                                        @if($enrollment->account_payables()->exists())
                                                                                            @foreach($enrollment->account_payables as $payable)
                                                                                                <tr>
                                                                                                    <td>{{$payable->payable}}</td>
                                                                                                    <td class=" text-right">{{number_format($payable->amount,2)}}</td>
                                                                                                </tr>
                                                                                            @endforeach
                                                                                            <tr>
                                                                                                <td class="text-strong">Total</td>
                                                                                                <td class="text-strong text-right">{{number_format($enrollment->account_payables->sum('amount'),2)}}</td>
                                                                                            </tr>
                                                                                            @php($total_accounts_payable = $enrollment->account_payables->sum('amount') )
                                                                                        @endif

                                                                                    </tbody>
                                                                                </table>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-8">
                                                                        <div class="panel panel-info">
                                                                            <div class="panel-heading" style="padding-top: 5px;padding-bottom: 5px">
                                                                               Payments
                                                                            </div>
                                                                            <div class="panel-body">

                                                                                <table class="table table-xtra-condensed">
                                                                                    <thead>
                                                                                    <tr>
                                                                                        <th style="">OR</th>
                                                                                        <th style="">Date</th>
                                                                                        <th style="">As Payment For</th>
                                                                                        <th style="">Amount</th>
                                                                                    </tr>
                                                                                    </thead>
                                                                                    <tbody>
                                                                                    @if($enrollment->getPaymentDetails()->exists())
                                                                                        @php($total_payments = 0)
                                                                                        @foreach($enrollment->getPaymentDetails as $paymentDetail)
                                                                                            <tr>
                                                                                                <td>{{$paymentDetail->payment->or_number}}</td>
                                                                                                <td>{{date('M d, Y',strtotime($paymentDetail->payment->date))}}</td>
                                                                                                <td>{{$paymentDetail->as_payment_for}}</td>
                                                                                                <td class=" text-right">{{number_format($paymentDetail->amount,2)}}</td>
                                                                                                @php($total_payments = $total_payments+ $paymentDetail->amount)
                                                                                            </tr>


                                                                                        @endforeach
                                                                                        <tr>
                                                                                            <td class="text-strong" colspan="3">Total</td>
                                                                                            <td class="text-strong text-right">{{number_format($total_payments ,2)}}</td>
                                                                                        </tr>
{{--                                                                                        @php($total_accounts_payable = $enrollment->account_payables->sum('amount') )--}}
                                                                                    @endif

                                                                                    </tbody>
                                                                                </table>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                </div>

                                                            </div>
                                                            <!-- /.tab-pane -->
                                                            <div class="tab-pane" id="tab_2-{{$enrollment->grade}}-{{$enrollment->sy}}">

                                                                <table class="table table-xtra-condensed">
                                                                    <thead>
                                                                    <tr>
                                                                        <th style="">Subject</th>
                                                                        <th style="">1st Quarter</th>
                                                                        <th style="">2nd Quarter</th>
                                                                        <th style="">3rd Quarter</th>
                                                                        <th style="">4th Quarter</th>
                                                                        <th style="">Average</th>
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody>

                                                                    @if($enrollment->getSubjects()->exists())

                                                                        @foreach($enrollment->getSubjects as $subject)
                                                                            <tr>
                                                                                <td>{{$subject->subject_title}}</td>
                                                                                <td style="">{{$subject->pivot->qfirst}}</td>
                                                                                <td style="">{{$subject->pivot->qsecond}}</td>
                                                                                <td style="">{{$subject->pivot->qthird}}</td>
                                                                                <td style="">{{$subject->pivot->qfourth}}</td>
                                                                                <td>{{(($subject->pivot->qfirst + $subject->pivot->qsecond +$subject->pivot->qthird + $subject->pivot->qfourth)/4)}}</td>
                                                                            </tr>
                                                                        @endforeach
{{--                                                                        <tr>--}}
{{--                                                                            <td class="text-strong">Total</td>--}}
{{--                                                                            <td class="text-strong text-right">{{number_format($enrollment->account_payables->sum('amount'),2)}}</td>--}}
{{--                                                                        </tr>--}}
{{--                                                                        @php($total_accounts_payable = $enrollment->account_payables->sum('amount') )--}}
                                                                    @endif

                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                        <!-- /.tab-content -->
                                                    </div>
                                                    <!-- nav-tabs-custom -->
                                                </div>
                                            </div>
                                        </div>

                                        @php($start++)
                                    @endforeach
                                </div>

                            @endif






                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection



@section('modals')

@endsection

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $("div.bhoechie-tab-menu>div.list-group>a").click(function(e) {
                e.preventDefault();
                $(this).siblings('a.active').removeClass("active");
                $(this).addClass("active");
                var index = $(this).index();
                $("div.bhoechie-tab>div.bhoechie-tab-content").removeClass("active");
                $("div.bhoechie-tab>div.bhoechie-tab-content").eq(index).addClass("active");
            });
        });
    </script>
@endsection