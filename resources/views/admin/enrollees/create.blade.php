@extends('admin-layouts.main-layout')

@section('content')
    <div id="cont">
        <section class="content-header">
            <h1> Assessment</h1>
        </section>
        <section class="content">
            <form id="enrollment_form">
                @csrf
                <div class="panel panel-default">
                <div class="panel-heading">
                    Enrollee details
                </div>
                <div class="panel-body">
                    <h4>{{$s->last_name}}, {{$s->first_name}}  {{$s->middle_name}}</h4>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="well well-sm">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <dl class="no-margin">
                                                <dt>Incoming GRADE:</dt>
                                                <dd>{{$r->g}}</dd>
                                            </dl>
                                        </div>

                                        <div class="col-md-6">
                                            <dl class="no-margin">
                                                <dt>School Year:</dt>
                                                <dd>{{$r->sy}} - {{$r->sy + 1}}</dd>
                                            </dl>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="well well-sm">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <dl class="no-margin">
                                                <dt>Last Name:</dt>
                                                <dd>{{$s->last_name}}</dd>
                                            </dl>
                                        </div>

                                        <div class="col-md-4">
                                            <dl class="no-margin">
                                                <dt>First Name:</dt>
                                                <dd>{{$s->first_name}}</dd>
                                            </dl>
                                        </div>
                                        <div class="col-md-4">
                                            <dl class="no-margin">
                                                <dt>Middle Name:</dt>
                                                <dd>{{$s->middle_name}}</dd>
                                            </dl>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <br>
                                        <div class="col-md-4">
                                            <dl class="no-margin">
                                                <dt>Birthday | Age:</dt>
                                                <dd>{{date('M d, Y',strtotime($s->birthday))}} | {{Carbon::parse($s->birthday)->age}}</dd>
                                            </dl>
                                        </div>
                                        <div class="col-md-4">
                                            <dl class="no-margin">
                                                <dt>Phone:</dt>
                                                <dd>{{$s->phone}}</dd>
                                            </dl>
                                        </div>
                                        <div class="col-md-4">
                                            <dl class="no-margin">
                                                <dt>Email:</dt>
                                                <dd>{{$s->email}}</dd>
                                            </dl>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-info">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-md-6">
                                            Assesment
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-inline">
                                                <div class="form-group pull-right">
                                                    <label for="exampleInputName2" class="text-danger">Date of Application: </label>
                                                    <input class="form-control " id="date_application" name="date_application" type="date" value="{{Carbon::now()->format('Y-m-d')}}" placeholder="">
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <div class="nav-tabs-custom">
                                        <ul class="nav nav-tabs">
                                            <li class="active"><a href="#tab_1" data-toggle="tab">Account and Subjects</a></li>
                                            <li><a href="#tab_2" data-toggle="tab">Address and Family Members</a></li>
                                            <li><a href="#tab_3" data-toggle="tab">Subjects</a></li>
                                        </ul>
                                        <div class="tab-content">
                                            <div class="tab-pane active" id="tab_1">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="panel panel-success">
                                                            <div class="panel-heading">
                                                                Account
                                                            </div>
                                                            <div class="panel-body">
                                                                <button type="button" class="btn btn-xs btn-success pull-right add_payable_btn"><i class="fa fa-plus"></i> Add Payable</button>
                                                                <table class="table table-condensed" id="payables_table">
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
                                                                        $payables_all = Payables::orderBy('order','asc')->get();
                                                                        $select = [];
                                                                        $payables_with_amount = [];
                                                                        foreach($payables_all as $payable_all){
                                                                            $select[$payable_all->payable] = $payable_all->payable;
                                                                            $payables_with_amount[$payable_all->payable] = $payable_all->amount;
                                                                            //array_push($select,$payable->payable);
                                                                        }
                                                                    @endphp

                                                                    @if(!empty($payables))
                                                                        @foreach($payables as $payable)
                                                                            <tr>
                                                                                <td>{!! __form::s_select_sm('payables[]',$select,$payable->payable,'','select_payable') !!}
                                                                                </td>
                                                                                <td>{!! __form::s_input_sm('amount[]', 'text',$payable->amount,'Amount') !!} </td>
                                                                                <td>
                                                                                    <button class="btn btn-sm btn-danger remove_payable_btn" type="button"><i class="fa fa-times"></i> </button>
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
                                                                @php
                                                                    use App\Models\Admin\Subjects;

                                                                    $subjects = Subjects::get();
                                                                    $subjs = [];
                                                                    if($subjects->count() > 0){
                                                                        foreach($subjects as $subject){
                                                                            $subjs[$subject->for_grade][$subject->subject_id] = $subject->subject_title;
                                                                        }
                                                                    }
                                                                @endphp
                                                                <div class="row">

                                                                    @foreach($subjs as $grade_lvl => $grade)
                                                                        <div class="col-md-6">
                                                                            <label>GRADE {{$grade_lvl}}</label>
                                                                            @foreach($grade as $subj_id => $subj_title)
                                                                                <div class="checkbox">
                                                                                    <label>
                                                                                        <input name="subjects[]" type="checkbox" value="{{$subj_id}}"
                                                                                               @if($r->g == $grade_lvl) checked @endif
                                                                                        >
                                                                                        {{$subj_title}}
                                                                                    </label>
                                                                                </div>
                                                                            @endforeach
                                                                        </div>
                                                                    @endforeach
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /.tab-pane -->
                                            <div class="tab-pane" id="tab_2">
                                                <div class="row">
                                                    <div class="col-md-12" style="height: auto !important;">
                                                        <div class="well well-sm">
                                                            <p class="page-header-sm text-center on-well text-info">
                                                                Student's address
                                                            </p>
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <dl class="no-margin">
                                                                        <dt>Address:</dt>
                                                                        <dd>{{$s->address}}</dd>
                                                                    </dl>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <dl class="no-margin">
                                                                        <dt>Barangay:</dt>
                                                                        <dd>{{$s->barangay}}</dd>
                                                                    </dl>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <dl class="no-margin">
                                                                        <dt>City/Municipality:</dt>
                                                                        <dd>{{$s->municipality}}</dd>
                                                                    </dl>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <dl class="no-margin">
                                                                        <dt>Province:</dt>
                                                                        <dd>{{$s->province}}</dd>
                                                                    </dl>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <p class="text-center"><b>Family Members</b></p>
                                                    @if($s->families->count() > 0)
                                                        @foreach($s->families as $f)
                                                            <div class="col-md-4">
                                                                <div class="well well-sm">
                                                                    <dl class="dl-horizontal no-margin">
                                                                        <p class="page-header-sm text-center on-well text-info">
                                                                            {{$f->relationship}}
                                                                        </p>

                                                                        <dt>Last Name:</dt>
                                                                        <dd>{{$f->last_name}}</dd>

                                                                        <dt>First Name:</dt>
                                                                        <dd>{{$f->first_name}}</dd>

                                                                        <dt>Middle Name:</dt>
                                                                        <dd>{{$f->middle_name}}</dd>

                                                                        <dt>Date of Birth:</dt>
                                                                        <dd>{{date('M d, Y',strtotime($f->birthday))}}</dd>

                                                                        <dt>Age:</dt>
                                                                        <dd>{{Carbon::parse($f->birthday)->age}}</dd>

                                                                        <dt>Sex:</dt>
                                                                        <dd>
                                                                            @switch($f->relationship)
                                                                                @case($f->relationship =='Father' || $f->relationship == 'Male Guardian' || $f->relationship == 'Brother')
                                                                                    Male
                                                                                @break

                                                                                @case($f->relationship == 'Mother' || $f->relationship == 'Female Guardian'  || $f->relationship == 'Sister')
                                                                                    Female
                                                                                @break
                                                                            @endswitch
                                                                        </dd>

                                                                        <dt>Phone:</dt>
                                                                        <dd>{{$f->phone}}</dd>


                                                                        <dt>Email:</dt>
                                                                        <dd>{{$f->email}}</dd>

                                                                        <dt>Educ. Att.:</dt>
                                                                        <dd>{{$f->educ_att}}</dd>

                                                                        <p class="page-header-sm text-center on-well text-info">
                                                                            Address
                                                                        </p>

                                                                        <dt>Address:</dt>
                                                                        <dd> {{$f->address}}</dd>


                                                                        <p class="page-header-sm text-center on-well text-info">
                                                                            Occupation
                                                                        </p>

                                                                        <dt>Occupation:</dt>
                                                                        <dd> {{$f->occupation}}</dd>

                                                                        <dt>Salary:</dt>
                                                                        <dd>{{number_format($f->salary,2)}}</dd>
                                                                    </dl>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @endif
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
                                <div class="panel-footer">

                                    <div class="clearfix">
                                        <button class="btn btn-primary btn-sm pull-right" type="submit"><i class="fa fa-check"></i> Submit Assessment</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            </form>
        </section>
    </div>
    <div id="confirm" hidden>
        <div style="padding-top: 100px">
            <center>
                <img src="{{asset('images/check.gif')}}" width="200">
                <h3>Enrollment data added successfully</h3>
                <h4>Student may now proceed to the Business Office</h4>
                <hr>
                <p>Student: <b> {{$s->last_name}}, {{$s->first_name}} {{$s->middle_name}} </b></p>
                <p>Incoming GRADE <b>{{$r->g}}</b> for School Year: <b>{{$r->sy}}-{{$r->sy+1}}</b> </p>
                <div class="col-md-4 col-md-offset-4">
                    <div class="progress progress-sm active">
                        <div class="progress-bar progress-bar-success progress-bar-striped success_add" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
                            <span class="sr-only">20% Complete</span>
                        </div>
                    </div>
                    <p>Redirecting in <label for="countdown">5</label> seconds.</p>
                </div>
            </center>

        </div>
    </div>

    <img src="{{asset('images/check.gif')}}" width="200" hidden>
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
    payables = @php echo json_encode($payables_with_amount) @endphp;
    tr = $("#payables_table tbody tr").eq(1).html();
    $(".add_payable_btn").click(function() {
        tr = tr.replace('selected','');
        temp_id = Math.floor(Math.random() * 26) + Date.now();
        $("#payables_table tbody").append('<tr id="'+temp_id+'">'+tr+'</tr>');
        $("#"+temp_id).find('input').val('');
    })

    $("body").on('change','.select_payable',function () {
        t = $(this);
        amt = payables[t.val()];

        t.parents('tr').find('input').val(amt);
    })

    $("body").on('click','.remove_payable_btn',function () {
        t = $(this);

        no_trs = $("#payables_table tr").length;
        if(no_trs < 3){
            notify_custom('Needs at least one (1) Payable','warning');
        }else{
            t.parents('tr').remove();
        }
    });

    $("#enrollment_form").submit(function(e){
        e.preventDefault();
        form = $(this);
        $.ajax({
            url: "{{route('admin.enrollees.store')}}?s={{$r->s}}&g={{$r->g}}&sy={{$r->sy}}",
            data: form.serialize(),
            type: 'POST',
            success: function (res) {
                console.log(res);
                if(res==1){
                    $("#cont").slideUp();
                    $("#confirm").show();
                    var counter = 0;
                    var cd = 5;
                    var interval = setInterval(function() {
                        counter++;
                        w = counter*20;
                        $(".success_add").css('width',w+'%');
                        $("label[for='countdown']").html(cd);

                        cd--;
                        if (counter == 6) {
                            window.location = "{{route('admin.enrollees.create')}}";
                            clearInterval(interval);
                        }
                    }, 1000);


                }
            },
            error: function (res) {
                errored(form,res);
            }
        })
    })

    setTimeout(function () {

    },2000)

</script>


@endsection