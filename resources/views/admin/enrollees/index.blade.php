@extends('admin-layouts.main-layout')

@section('content')
    <section class="content-header">
        <h1> Enrolled <small>Students</small></h1>
    </section>
    <section class="content">
        <div class="panel panel-default">
            <div class="panel-heading">

                <div class="row">
                    <div class="col-md-9">
                        Menu List
                    </div>

                    <div class="col-md-3">
                        <button id="add_btn" data-toggle="modal" data-target="#add_menu_modal" class="btn btn-primary btn-sm pull-right"><i class="fa fa-plus"></i> Create</button>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <div id="tbl_loader" class="loader" style="padding-top: 10%; padding-bottom: 10%">
                    <img src="{{ asset('images/load_anim.gif') }}">
                </div>


                <div id="enrollees_table_container" hidden="">
                    <table class="table table-bordered table-condensed table-striped" id ="enrollees_table" style="width: 100%">
                        <thead>
                        <tr>
                            <th>Fullname</th>
                            <th>Date of Application</th>
                            <th>Date of Assessment</th>
                            <th>Grade</th>
                            <th>SY</th>
                            <th>Status</th>
                            <th style="width: 100px">Action</th>
                        </tr>
                        </thead>
                        <tbody>


                        </tbody>
                    </table>
                </div>

            </div>

        </div>
    </section>
@endsection

@section('modals')

@endsection


@section('scripts')
<script type="text/javascript">
    $(document).ready(function(){
        active = '';
        menus_tbl =  $("#enrollees_table").DataTable({
            "processing": true,
            "serverSide": true,
            "ajax" : '{{ route("admin.payments.assessed") }}',
            "columns": [
                { "data": "fullname" },
                { "data": "date_application" },
                { "data": "created_at" },
                { "data": "grade" },
                { "data": "sy" },
                { "data": "total_amt" },
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
                    "targets" : 5,
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
                    $("#enrollees_table_container").fadeIn();
                });
                dt_press_enter('#menus_table_filter',menus_tbl);
            },
            "language":
                {
                    "processing": "<center><img style='width: 70px' src=''></center>",
                },
            "drawCallback": function(settings){
                $('[data-toggle="tooltip"]').tooltip();
                $('[data-toggle="modal"]').tooltip();
                if(active != ''){
                    $("#enrollees_table #"+active).addClass('success');
                }
            }
        });
    });
</script>
@endsection