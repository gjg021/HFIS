@extends('admin-layouts.modal-content',['form_id'=> 'add_payment_form', 'slug' => $enrollee->id])

@section('modal-header')
    {{$enrollee->student->last_name}}, {{$enrollee->student->first_name}} | Add Payment
@endsection

@section('modal-body')
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#form_tab" data-toggle="tab">Add Payment Form</a></li>
            <li><a href="#payables_tab" data-toggle="tab">Accounts Payable</a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="form_tab">
                <div    style="display: none">
                    {!! __form::a_textbox( 6,'Student ID','student_id', 'number', $enrollee->student->id,$enrollee->student->id, 'readonly')!!}
                    {!! __form::a_textbox( 6,'Student ID','enrollee_id', 'number', $enrollee->id,$enrollee->id, 'readonly')!!}
                </div>
                <div class="row">
                    {!! __form::a_textbox( 6,'OR Number','or_number', 'number', 'OR #','', '')!!}

                    {!! __form::a_textbox( 6,'Date','date', 'date', '',\Carbon\Carbon::now()->format('Y-m-d'), '')!!}
                </div>
                <div class="row">
                    {!! __form::a_textbox( 8,'Payee','payee', 'text', 'Received from','', '')!!}
                    {!! __form::a_textbox( 4,'TIN','tin', 'number', 'TIN #','', '')!!}
                </div>
                <div class="row">
                    {!! __form::a_select(4, 'Type', 'type', ['Cash' => 'cash', 'Check' => 'check'], 'cash', '') !!}
                    {!! __form::a_textbox( 8,'Check Number','check_number', 'text', 'Check #','', 'disabled','')!!}
                </div>
                <table class="table table-condensed" id="payment_for_table">
                    <button type="button" class="btn btn-xs btn-success pull-right add_payment_for_btn"><i class="fa fa-plus"></i> Add</button>
                    <thead>
                    <tr>
                        <th>As Payment For:</th>
                        <th>Amount</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input class="form-control input-sm" type="text" value="" name="payment_for[]" placeholder="As payment for"> </td>
                            <td><input class="form-control input-sm for_amount" type="text" value="" name="amount[]" placeholder="Amount"> </td>
                            <td>
                                <button class="btn btn-sm btn-danger remove_row" type="button"><i class="fa fa-times"></i> </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- /.tab-pane -->
            <div class="tab-pane" id="payables_tab">
                <table class="table table-striped table-condensed">
                    <thead>
                        <tr>
                            <th>Payable</th>
                            <th class="text-right">Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($enrollee->account_payables->count()>0)
                            @php
                                $total_amt = 0;
                            @endphp
                            @foreach($enrollee->account_payables as $payable)
                                <tr>
                                    <td>{{$payable->payable}}</td>
                                    <td class="text-right">{{number_format($payable->amount,2)}}</td>
                                </tr>
                                @php($total_amt = $total_amt+$payable->amount)
                            @endforeach
                        @endif
                        <tr>
                            <td class="text-strong">Total</td>
                            <td class="text-strong text-right">{{number_format($total_amt,2)}}</td>
                        </tr>

                    </tbody>
                </table>
            </div>

        </div>

    </div>
@endsection

@section('modal-footer')
    <div class="row">
        <div class="col-md-6">
            <label class="pull-left">Total: <span class="for_total">0.00</span></label>
        </div>
        <div class="col-md-6">
            <button class="btn btn-primary" type="submit">
                <i class="fa fa-check"></i> Save
            </button>
        </div>
    </div>
@endsection


<script>
    tr = $("#payment_for_table tbody tr").eq(0).html();
    $(".add_payment_for_btn").click(function() {
        console.log(tr);
        temp_id = Math.floor(Math.random() * 26) + Date.now();
        $("#payment_for_table tbody").append('<tr id="'+temp_id+'">'+tr+'</tr>');
        $("#"+temp_id).find('input').val('');
    })

    $("body").on('change','.select_payable',function () {
        t = $(this);
        amt = payables[t.val()];

        t.parents('tr').find('input').val(amt);
    })

    $("body").on('click','.remove_row',function () {
        t = $(this);
        no_trs = $("#payment_for_table tr").length;
        if(no_trs < 3){
            notify_custom('Needs at least one (1) item','warning');
        }else{
            t.parents('tr').remove();
            getTotal();
        }
    });
</script>