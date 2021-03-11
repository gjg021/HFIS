@extends('admin-layouts.main-layout')

@section('content')
    <section class="content-header">
        <h1> Enroll</h1>
    </section>
    <section class="content">

        <div class="panel panel-default">
            <div class="panel-heading">
                Enrollee details
            </div>
            <div class="panel-body">
                <h4>{{$s->last_name}}, {{$s->first_name}}  {{$s->middle_name}}</h4>
                <div class="well well-sm">
                    <div class="row">
                        <div class="col-md-2">
                            <dl class="no-margin">
                                <dt>Incoming GRADE:</dt>
                                <dd>{{$r->g}}</dd>
                            </dl>
                        </div>

                        <div class="col-md-2">
                            <dl class="no-margin">
                                <dt>School Year:</dt>
                                <dd>{{$r->sy}} - {{$r->sy + 1}}</dd>
                            </dl>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                Assesment
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    {!! __form::a_select('4', 'Enroll for GRADE:*', 'region', [7 => 7, 8 => 8, 9 => 9 , 10 => 10], '' , '') !!}
                                    {!! __form::a_select_sy('4', 'School Year:*', 'sy', [], '' , '') !!}
                                    {!! __form::a_textbox( 4,'Date of Application','date_application', 'date', '',\Carbon\Carbon::now()->format('Y-m-d'), '')!!}
                                </div>
                                <div class="nav-tabs-custom">
                                    <ul class="nav nav-tabs">
                                        <li class="active"><a href="#tab_1" data-toggle="tab">Student's Info</a></li>
                                        <li><a href="#tab_2" data-toggle="tab">Account and Subjects</a></li>
                                        <li><a href="#tab_3" data-toggle="tab">Subjects</a></li>
                                        <li class="dropdown">
                                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                                Dropdown <span class="caret"></span>
                                            </a>
                                            <ul class="dropdown-menu">
                                                <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Action</a></li>
                                                <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Another action</a></li>
                                                <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Something else here</a></li>
                                                <li role="presentation" class="divider"></li>
                                                <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Separated link</a></li>
                                            </ul>
                                        </li>
                                        <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="tab_1">
                                            <div class="row">
                                                <div class="col-md-4" style="height: auto !important;">
                                                    <div class="well well-sm">
                                                        <dl class="dl-horizontal no-margin">
                                                            <p class="page-header-sm text-center on-well text-info">
                                                                Scholar Information
                                                            </p>

                                                            <dt>Last Name:</dt>
                                                            <dd>Abale</dd>

                                                            <dt>First Name:</dt>
                                                            <dd>Jhea</dd>

                                                            <dt>Middle Name:</dt>
                                                            <dd>V</dd>

                                                            <dt>Date of Birth:</dt>
                                                            <dd>January 01, 1970</dd>

                                                            <dt>Age:</dt>
                                                            <dd>51</dd>

                                                            <dt>Sex:</dt>
                                                            <dd>FEMALE</dd>

                                                            <dt>Phone:</dt>
                                                            <dd></dd>


                                                            <dt>Email:</dt>
                                                            <dd></dd>

                                                            <p class="page-header-sm text-center on-well text-info">
                                                                Address
                                                            </p>

                                                            <dt>Address:</dt>
                                                            <dd> HPCO</dd>

                                                            <dt>Barangay:</dt>
                                                            <dd> Negros Occidental</dd>

                                                            <dt>City/Municipality:</dt>
                                                            <dd> EB Magalona</dd>

                                                            <dt>Province:</dt>
                                                            <dd> Brgy. Canlusong</dd>

                                                        </dl>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="well well-sm">
                                                        <dl class="dl-horizontal no-margin">
                                                            <p class="page-header-sm text-center on-well text-info">
                                                                Scholar Information
                                                            </p>

                                                            <dt>Last Name:</dt>
                                                            <dd>Abale</dd>

                                                            <dt>First Name:</dt>
                                                            <dd>Jhea</dd>

                                                            <dt>Middle Name:</dt>
                                                            <dd>V</dd>

                                                            <dt>Date of Birth:</dt>
                                                            <dd>January 01, 1970</dd>

                                                            <dt>Age:</dt>
                                                            <dd>51</dd>

                                                            <dt>Sex:</dt>
                                                            <dd>FEMALE</dd>

                                                            <dt>Phone:</dt>
                                                            <dd></dd>


                                                            <dt>Email:</dt>
                                                            <dd></dd>

                                                            <p class="page-header-sm text-center on-well text-info">
                                                                Address
                                                            </p>

                                                            <dt>Address:</dt>
                                                            <dd> HPCO</dd>

                                                            <dt>Barangay:</dt>
                                                            <dd> Negros Occidental</dd>

                                                            <dt>City/Municipality:</dt>
                                                            <dd> EB Magalona</dd>

                                                            <dt>Province:</dt>
                                                            <dd> Brgy. Canlusong</dd>

                                                        </dl>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="well well-sm">
                                                        <dl class="dl-horizontal no-margin">
                                                            <p class="page-header-sm text-center on-well text-info">
                                                                Scholar Information
                                                            </p>

                                                            <dt>Last Name:</dt>
                                                            <dd>Abale</dd>

                                                            <dt>First Name:</dt>
                                                            <dd>Jhea</dd>

                                                            <dt>Middle Name:</dt>
                                                            <dd>V</dd>

                                                            <dt>Date of Birth:</dt>
                                                            <dd>January 01, 1970</dd>

                                                            <dt>Age:</dt>
                                                            <dd>51</dd>

                                                            <dt>Sex:</dt>
                                                            <dd>FEMALE</dd>

                                                            <dt>Phone:</dt>
                                                            <dd></dd>


                                                            <dt>Email:</dt>
                                                            <dd></dd>

                                                            <p class="page-header-sm text-center on-well text-info">
                                                                Address
                                                            </p>

                                                            <dt>Address:</dt>
                                                            <dd> HPCO</dd>

                                                            <dt>Barangay:</dt>
                                                            <dd> Negros Occidental</dd>

                                                            <dt>City/Municipality:</dt>
                                                            <dd> EB Magalona</dd>

                                                            <dt>Province:</dt>
                                                            <dd> Brgy. Canlusong</dd>

                                                        </dl>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.tab-pane -->
                                        <div class="tab-pane" id="tab_2">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="panel panel-success">
                                                        <div class="panel-heading">
                                                            Account
                                                        </div>
                                                        <div class="panel-body">
                                                            <table class="table table-condensed">
                                                                <thead>
                                                                <tr>
                                                                    <th>Payable</th>
                                                                    <th>Amount</th>
                                                                    <th></th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @php
                                                                        use App\Models\Admin\Payables;

                                                                        $payables = Payables::where('status','=',1)->orderBy('order','asc')->get();
                                                                        $select = [];
                                                                        foreach($payables as $payable){
                                                                            $select[$payable->payable] = $payable->payable;
                                                                            //array_push($select,$payable->payable);
                                                                        }


                                                                    @endphp

                                                                    @if(!empty($payables))
                                                                        @foreach($payables as $payable)
                                                                            <tr>
                                                                                <td>{!! __form::s_select_sm('family_educ_att[]',$select,$payable->payable,'') !!}
                                                                                </td>
                                                                                <td>{!! __form::s_input_sm('family_email[]', 'text',$payable->amount,'Amount') !!} </td>
                                                                                <td>
                                                                                    <button class="btn btn-sm btn-danger" type="button"><i class="fa fa-times"></i> </button>
                                                                                </td>
                                                                            </tr>

                                                                        @endforeach
                                                                    @endif
                                                                </tbody>
                                                            </table>

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="panel panel-warning">
                                                        <div class="panel-heading">
                                                            Subjects
                                                        </div>
                                                        <div class="panel-body">

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.tab-pane -->
                                        <div class="tab-pane" id="tab_3">
                                            Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                            Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
                                            when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                                            It has survived not only five centuries, but also the leap into electronic typesetting,
                                            remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset
                                            sheets containing Lorem Ipsum passages, and more recently with desktop publishing software
                                            like Aldus PageMaker including versions of Lorem Ipsum.
                                        </div>
                                        <!-- /.tab-pane -->
                                    </div>
                                    <!-- /.tab-content -->
                                </div>
                            </div>
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
    {{--$("#search_by_id_form").submit(function (e) {--}}
    {{--    e.preventDefault();--}}
    {{--    form = $(this);--}}
    {{--    $.ajax({--}}
    {{--        url: '{{route("admin.enrollees.create")}}?type=search_by_id',--}}
    {{--        type: 'GET',--}}
    {{--        data: form.serialize(),--}}
    {{--        success: function (res) {--}}
    {{--            console.log(res);--}}
    {{--        },--}}
    {{--        error: function (res) {--}}
    {{--            console.log(res);--}}
    {{--        }--}}
    {{--    })--}}
    {{--})--}}
</script>


@endsection