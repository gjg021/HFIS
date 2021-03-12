@extends('admin-layouts.main-layout')

@section('content')

    <section class="content">
        <div class="login-box">
            <div class="login-logo">
                Search for student
            </div>
            <div class="login-box-body">
                <div class="row">
                    {!! __form::a_select('6', 'Grade level:*', 'g', [7=>7,8=>8,9=>9,10=>10], '' , '') !!}
                    {!! __form::a_select_sy('6', 'School Year:*', 'sy', [], '' , '') !!}
                </div>
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab_1" data-toggle="tab">Seach by ID</a></li>
                        <li><a href="#tab_2" data-toggle="tab">Search by Name</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_1">
                            <form id="search_by_id_form">
                                <label>Student's ID Number:</label>
                                <div class="input-group">
                                    <input type="number" name="id" class="form-control search" placeholder="ID #">
                                    <div class="input-group-btn">
                                        <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                                    </div>
                                </div>

                            </form>
                        </div>
                        <div class="tab-pane" id="tab_2">
                            <label>Student's Name:</label>
                            <input name="name" id="inp_name" autocomplete="off" class="form-control search" type="text" placeholder="Type name here">
                        </div>

                    </div>
                    <!-- /.tab-content -->
                </div>


            </div>
            <!-- /.login-box-body -->
        </div>
    </section>
@endsection

@section('scripts')
    <script type="text/javascript">
        $("#search_by_id_form").submit(function (e) {
            e.preventDefault();
            form = $(this);
            formdata = form.serialize();
            ser = form.serializeArray();
            $.ajax({
               url: "{{route('admin.enrollees.create')}}?type=search_by_id",
               type: "GET",
               data: form.serialize(),
                success:function (res) {
                    if(res == 1){
                        proceed(res,ser[0]['value']);
                    }
                },
                error:function (res) {
                    console.log(res);
                    errored(form,res);
                }
           })
        })

        $('#inp_name').typeahead({
            ajax : "{{ route('admin.enrollees.create') }}",
            onSelect:function (result) {
                s_id = result.value;
                $.ajax({
                    url: "{{route('admin.enrollees.create')}}?type=search_by_id",
                    type: "GET",
                    data: {id : s_id},
                    success:function (res) {
                        if(res == 1){
                            proceed(res,s_id);
                        }
                    },
                    error:function (res) {
                        console.log(res);
                        errored(form,res);
                    }
                })
            },
        });

        $('.search').click(function () {
            select = $('select[name="g"]');
            t = $(this);
            if(select.val()==""){
                t.val('');
                $(this).focusout();

                select.focus();
                select.parents('.form-group').addClass('has-error');
                setTimeout(function () {
                    select.parents('.form-group').removeClass('has-error');
                },3000)
                notify_custom('Select for Grade Level First','warning');
            }
        })

        function proceed(res, id){
            var g = $("select[name='g']").val();
            var sy = $("select[name='sy']").val();
            if(res == 1){
                window.location = "{{route('admin.enrollees.create')}}?s="+id+"&g="+g+"&sy="+sy;
            }
        }
    </script>
@endsection
