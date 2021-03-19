@extends('admin-layouts.modal-content')

@section('modal-header')
    {{$enrollment->student->last_name}}, {{$enrollment->student->first_name}} {{$enrollment->student->middle_name}} | GRADE <b>{{$enrollment->grade}} </b> SY <b>{{$enrollment->sy}}-{{($enrollment->sy+1)}}</b>
@endsection


@section('modal-body')
    <div class="row">
        <div class="col-md-3">
            <div class="well well-sm">
                <form id="edit_enrollment_form">
                    <div class="row">
                        {!! __form::a_select(12, 'Grade:', 'grade', [
                        'Grade 7' => 7,
                        'Grade 8' => 8,
                        'Grade 9' => 9,
                        'Grade 10' => 10,
                        ], $enrollment->grade, '') !!}

                        {!! __form::a_select_sy(12, 'School Year:*', 'sy', [], $enrollment->sy , '') !!}
                        <div class="col-md-12">
                            <button class="btn btn-primary pull-right btn-sm"><i class="fa fa-check"></i> Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-9">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#tab_1" data-toggle="tab">Accounts</a></li>
                    <li><a href="#tab_2" data-toggle="tab">Subjects</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="tab_1">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Accounts Payable
                                <button class="btn btn-success btn-xs pull-right"><i class="fa fa-plus"></i> Add</button>
                            </div>
                            <div class="panel-body">
                                <div id="accounts_payable_table_container">
                                    <table class="table table-bordered table-condensed table-striped" id ="accounts_payable_table" style="width: 100%">
                                        <thead>
                                        <tr>
                                            <th>Payable</th>
                                            <th>Amount</th>
                                            <th style="width: 100px">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>


                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.tab-pane -->
                    <div class="tab-pane" id="tab_2">
                        The European languages are members of the same family. Their separate existence is a myth.
                        For science, music, sport, etc, Europe uses the same vocabulary. The languages only differ
                        in their grammar, their pronunciation and their most common words. Everyone realizes why a
                        new common language would be desirable: one could refuse to pay expensive translators. To
                        achieve this, it would be necessary to have uniform grammar, pronunciation and more common
                        words. If several languages coalesce, the grammar of the resulting language is more simple
                        and regular than that of the individual languages.
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection


@section('modal-footer')
    a
@endsection

<script type="text/javascript">
    active = '';
    accounts_payable_tbl =  $("#accounts_payable_table").DataTable({
        "processing": true,
        "serverSide": true,
        "ajax" : '{{ route("admin.enrollees.accounts_payable_table") }}?enrollment_id={{$enrollment->id}}',
        "columns": [
            { "data": "payable" },
            { "data": "amount" },
            { "data": "action" }
        ],
        // buttons: [
        //     'copy', 'excel', 'pdf'
        // ],
        "columnDefs":[
            {
                "targets" : 0,
                "visible" : true
            },
            {
                "targets" : 2,
                "orderable" : false,
                "class" : 'action'
            },
            {
                "targets": 0,
                // "render" : $.fn.dataTable.render.moment( 'MMMM D, YYYY' )
            }
        ],
        "order" : [[0, 'asc']],
        "responsive": false,
        "initComplete": function( settings, json ) {
            $('#tbl_loader').fadeOut(function(){
                $("#accounts_payable_table_container").fadeIn();
            });
            dt_press_enter('#menus_table_filter',accounts_payable_tbl);
        },
        "language":
            {
                "processing": "<center><img style='width: 70px' src=''></center>",
            },
        "drawCallback": function(settings){
            $('[data-toggle="tooltip"]').tooltip();
            $('[data-toggle="modal"]').tooltip();
            if(active != ''){
                $("#accounts_payable_table #"+active).addClass('success');
            }
        }
    });
</script>