@extends('admin-layouts.main-layout')

@section('content')
    <section class="content-header">
        <h1>
            Assessed
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Users</li>
        </ol>
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


                <div id="assessed_table_container" hidden="">
                    <table class="table table-bordered table-condensed table-striped" id ="assessed_table" style="width: 100%">
                        <thead>
                        <tr>
                            <th>Fullname</th>
                            <th>Date of Application</th>
                            <th>Date of Assessment</th>
                            <th>Grade</th>
                            <th>SY</th>
                            <th>Total Payables</th>
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
    {!! __html::blank_modal('add_payment_modal','') !!}}
@endsection

@section('scripts')
    <script type="text/javascript">
        function getTotal(){
            var total = 0;
            $(".for_amount").each(function () {
                if($(this).val() == ""){
                    this_val = parseInt(0);
                }else{
                    this_val = parseInt($(this).val());
                }
                total = (total + this_val);
            })

            $(".for_total").html(currencyFormat(parseInt(total)));
        }
        $(document).ready(function(){
            active = '';
            menus_tbl =  $("#assessed_table").DataTable({
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
                        $("#assessed_table_container").fadeIn();
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
                        $("#assessed_table #"+active).addClass('success');
                    }
                }
            });
        });

        $("body").on('click',".add_payment_btn", function () {
            btn = $(this);
            loading_modal(btn);

            $.ajax({
                url: "{{route('admin.payments.assessed.add_payment_show')}}",
                data: {'enrollment_id':btn.attr('data')},
                type: 'GET',
                success: function (res) {
                    populate_modal(btn, res);
                },
                error: function (res) {
                    console.log(res);
                }
            })
        })


        $("body").on('keyup','.for_amount',function () {
            getTotal();
        })

        $("body").on('submit','#add_payment_form',function (e) {
            e.preventDefault();
            form = $(this);
            formdata = form.serialize();
            $.ajax({
                url : "{{route('admin.payments.store')}}",
                data : formdata,
                type: 'POST',
                success: function(res){
                    console.log(res);
                },
                error:function (res) {
                    console.log(res);
                }
            })
        })

        $("body").on("change","select[name='type']",function () {
            if($(this).val()=="check"){
                $(this).parent('div').next('div').children("input[name='check_number']").removeAttr('disabled');
            }else{
                $(this).parent('div').next('div').children("input[name='check_number']").attr('disabled','disabled');
            }
        })
    </script>
@endsection