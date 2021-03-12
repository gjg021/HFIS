@extends('admin-layouts.main-layout')

@section('content')

<section class="content-header">
    <h1> Students <small>Master List</small></h1>
</section>

<section class="content">
	<div class="panel panel-default">
		<div class="panel-heading">
			<div class="row">
				<div class="col-md-6">
					List of Students
				</div>
				<div class="col-md-6">
					<button class="btn btn-primary btn-sm pull-right" data-toggle="modal" data-target="#add_student_modal">Add</button>
				</div>
			</div>
		</div>

		<div class="panel-body">
			<div id="tbl_loader" class="loader" style="padding-top: 10%; padding-bottom: 10%">
				<img src="{{ asset('images/load_anim.gif') }}">
			</div>

			<div id="students_table_container" hidden="">
				<table class="table table-bordered table-condensed table-striped" id = "students_table" style="width: 100%">
					<thead>
						<tr>
							<th>Fullname</th>
							<th>Student ID</th>
							<th>Barangay, City</th>
							<th>Phone & Email</th>
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



<!-- Modal -->
<div class="modal fade" id="add_student_modal" tabindex="-1" role="dialog" >
	<div class="modal-dialog modal-xl" role="document">
		<div class="modal-content">
			<form id="add_student_form">
				@csrf
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Add student</h4>
				</div>
				<div class="modal-body">
					<ul class="nav nav-tabs" id="add_student_tab" role="tablist">
						<li role="presentation" class="active"><a href="#personal" id="personal-tab" role="tab" data-toggle="tab" aria-controls="personal" aria-expanded="true">Personal Information</a></li>
						<li role="presentation" class=""><a href="#family_members" role="tab" id="family_members-tab" data-toggle="tab" aria-controls="family_members" aria-expanded="false">Family Members</a></li>
					</ul>

					<div class="tab-content" id="myTabContent">
					   <div class="tab-pane fade active in" role="tabpanel" id="personal" aria-labelledby="personal-tab">
					      <br>
					      <div class="row">
					      	
								{!! __form::a_textbox( 4,'First Name','first_name', 'text', 'First Name','', '')!!}
								{!! __form::a_textbox( 4,'Middle Name','middle_name', 'text', 'Middle Name','', '')!!}
								{!! __form::a_textbox( 4,'Last Name','last_name', 'text', 'Last Name','', '')!!}
							</div>
							<div class="row">
								{!! __form::a_textbox( 3,'Birthday','birthday', 'date', '','', '')!!}
								{!! __form::a_textbox( 3,'Email','email', 'email', '','', '')!!}
								{!! __form::a_textbox( 3,'Grade level applied to:','grade_level_applied', 'text', 'Grade level applied to:','', '')!!}
								{!! __form::a_select_sy('3', 'School Year:*', 'sy', [], '' , '') !!}
							</div>

							<div class="well well-sm">
								<div class="row">
									{!! __form::a_select('4', 'Region:*', 'region', [], '' , '') !!}
						        	{!! __form::a_select('4', 'Province:*', 'province', ['NEGROS OCCIDENTAL'=>'NEGROS OCCIDENTAL'], '' , '') !!}
						        	{!! __form::a_select('4', 'Municipality/City:*', 'municipality', [], '' , '') !!}
						        </div>
						        <div class="row">
						        	{!! __form::a_select('4', 'Barangay:*', 'barangay', [], '' , '') !!}
						        	{!! __form::a_textbox( 8,'Detailed address:*','address', 'text', 'Lot, Block, Street','', '')!!}
								</div>
							</div>


					   </div>
					   <div class="tab-pane fade" role="tabpanel" id="family_members" aria-labelledby="family_members-tab">
					      <div class="row">
					      	<br>
								<div class="col-md-12">
									<button type="button" class="btn btn-success btn-xs pull-right add_row_btn"><i class="fa fa-plus"></i> Add row</button>
									<table id="add_family_table" class="table table-condensed table-striped">
										<thead>
											<tr>
												<th>Relationship</th>
												<th>Name</th>
												<th>Contact</th>
												<th>Other</th>
												<th>Educ. Att.</th>
												<th>Occupation</th>
												<th></th>
											</tr>
										</thead>
										<tbody>
									        <tr >
									          <td style="vertical-align: middle;">
									          	{!! __form::s_select_sm('family_relationship[]',[
									          		'Father'=>'Father',
									          		'Mother'=>'Mother',
									          		'Guardian (Male)'=>'Male Guardian',
									          		'Guardian (Female)'=>'Female Guardian',
									          		'Brother'=>'Brother',
									          		'Sister'=>'Sister',
									          	],'','') !!}
									          </td>
									          <td  style="vertical-align: middle;">	{!! __form::s_input_sm('family_last_name[]', 'text','','Last name', 'style="margin-bottom:3px"') !!}
									          		{!! __form::s_input_sm('family_first_name[]', 'text','','First name', 'style="margin-bottom:3px"') !!}
									          		{!! __form::s_input_sm('family_middle_name[]', 'text','','Middle name', 'style="margin-bottom:3px"') !!}
									          </td>
									          <td style="vertical-align: middle;">
									          	
									          		{!! __form::s_input_sm('family_phone[]', 'text','','Phone number','style="margin-bottom:3px"') !!}
									          		{!! __form::s_input_sm('family_email[]', 'text','','Email address') !!}
									          	
									          </td>
									          <td  style="vertical-align: middle;">
									          	{!! __form::s_input_sm('family_birthday[]', 'date','','') !!}</td>
									          <td  style="vertical-align: middle;">
									          	{!! __form::s_select_sm('family_educ_att[]',[
									          		'Elementary Level'=>'Elementary Level',
									          		'Elementary Graduate'=>'Elementary Graduate',
									          		'High School Level'=>'High School Level',
									          		'High School Graduate'=>'High School Graduate',
									          		'College Level'=>'College Level',
									          		'College Graduate'=>'College Graduate',
									          		'Post Graduate'=>'Post Graduate',
									          	],'','') !!}
									          </td>
									          <td  style="vertical-align: middle;">
									          	{!! __form::s_input_sm('family_occupation[]', 'text','','Occupation','style="margin-bottom:3px"','') !!}
									          	{!! __form::s_input_sm('family_salary[]', 'number','','Salary','') !!}
									          </td>
									          <td  style="vertical-align: middle;">
									          	<button type="button" class="btn btn-sm btn-danger remove_family_btn"><i class="fa fa-times"></i></button>
									          </td>
									        </tr>
									      </tbody>
									</table>
								</div>
							</div>
					   </div>
					</div>


					
					
					
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Save</button>
				</div>
			</form>
		</div>
	</div>
</div>

{!! __html::blank_modal('edit_student_modal','xl') !!}


@endsection

@section('scripts')
<script type="text/javascript">
	$(document).ready(function(){
		var regions;
		$.getJSON('{{asset("regions.json")}}', function(data){
			regions = data;
			$.each(data, function(i, item){
				if(i == 6){
					$("select[name='region']").append('<option value="'+i+'" selected>'+item.region_name+'</option>');
				}else{
					$("select[name='region']").append('<option value="'+i+'">'+item.region_name+'</option>');
				}
				
			})
		});

	
		html_region = $("select[name='region']");
		html_province = $("select[name='province']");
		html_municipality = $("select[name='municipality']");
		html_barangay = $("select[name='barangay']");

		html_region.change(function(){
			selected = $(this).val();
			html_province.html('<option value="">Select</option>');
			html_municipality.html('<option value="">Select</option>');
			html_barangay.html('<option value="">Select</option>');

			$.each(regions[selected]['province_list'], function(i,item){
				html_province.append('<option value="'+i+'">'+i+'</option>');
			})
		})

		html_province.change(function(){
			selected = $(this).val();
			html_municipality.html('<option value="">Select</option>');
			html_barangay.html('<option value="">Select</option>');

			$.each(regions[html_region.val()]['province_list'][selected]['municipality_list'], function(i,item){
				html_municipality.append('<option value="'+i+'">'+i+'</option>');
			});

		});

		html_municipality.change(function(){
			selected = $(this).val();
			html_barangay.html('<option value="">Select</option>');
			$.each(regions[html_region.val()]['province_list'][html_province.val()]['municipality_list'][selected]['barangay_list'], function(i,item){
				html_barangay.append('<option value="'+item+'">'+item+'</option>');
			})
		})


		tr=$("#add_family_table tbody").html();
		
		active = '';
		students_tbl =  $("#students_table").DataTable({
			"processing": true,
			"serverSide": true,
			"ajax" : '{{ route("admin.students.index") }}',
			"columns": [
			  	{ "data": "fullname" },
				{ "data": "id" },
			  	{ "data": "barangay_municipality" },
			  	{ "data": "phone_email" },
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
			  "targets" : [3,4],
			  "orderable" : false,
			  "class" : 'action'
			},
			{
			  "targets": 3, 
			  // "render" : $.fn.dataTable.render.moment( 'MMMM D, YYYY' )
			}
			],
			"order" : [[0, 'asc']],
			"responsive": false,
			"initComplete": function( settings, json ) {
			  $('#tbl_loader').fadeOut(function(){
			    $("#students_table_container").fadeIn();
			  });
			  dt_press_enter('#students_table_filter',students_tbl);
			},
			"language": 
			{          
			  "processing": "<center><img style='width: 70px' src=''></center>",
			},
			"drawCallback": function(settings){
			$('[data-toggle="tooltip"]').tooltip({delay:3000});
			$('[data-toggle="modal"]').tooltip();
			if(active != ''){
			   $("#students_table #"+active).addClass('success');
			}
			}
		});



	})

	$('body').on('click','.add_row_btn',function(e){
		t = $(this);
		tbl = t.siblings('table');
		tbl.find('tbody').append(tr);
	})

	$("body").on('click','.remove_family_btn',function(){
		t = $(this);
		no_trs = $("#"+t.parents('table').attr('id') +" tr").length;
		if(no_trs < 3){
			notify_custom('Must have at least one family member','warning');
		}else{
			t.parents('tr').remove();
		}
	});

	$("#add_student_form").submit(function(e){
		e.preventDefault();
		form = $(this);
		formdata = form.serialize();
		loading_btn(form);
		$.ajax({
			url : '{{route("admin.students.store")}}',
			type : 'POST',
			data : formdata,
			success: function(res){
				succeed(form,true);
				active = res.id;
				students_tbl.draw();
			},
			error: function(res){
				errored(form,res);
			}
		})
	});

	$("body").on("click",".edit_student_btn",function(){
		btn = $(this);
		loading_modal(btn);
		id = btn.attr('data');
		uri = '{{route("admin.students.edit","ids")}}';
		uri = uri.replace('ids', id);
		$.ajax({
			url: uri,
			type:'GET',
			success:function(res){
				populate_modal(btn,res);
			},	
			error: function(res){
				console.log(res);
			}

		})
	})

	$("body").on('submit','#edit_student_form',function(e){
		e.preventDefault();
		form = $(this);
		loading_btn(form);
		uri = "{{route('admin.students.update','ids')}}";
		uri = uri.replace('ids',form.attr('data'));
		$.ajax({
			url: uri,
			data: form.serialize(),
			type: 'PATCH',
			success: function (res) {
				succeed(form,true,true);
				console.log(res);
			},
			error: function (res) {
				errored(form,res)
			}
		})
	})
	$("body").on('click','.delete_student_btn', function () {
		btn = $(this);
		uri = "{{route('admin.students.destroy','slugg')}}";
		delete_item(uri,btn,students_tbl);
	})
</script>
@endsection