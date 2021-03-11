@extends('admin-layouts.modal-content',['form_id'=>'edit_student_form','slug'=> $student->id])

@section('modal-header')
{{$student->last_name}}, {{$student->first_name}} | <span class="label label-primary">EDIT</span>
@endsection

@section('modal-body')
<ul class="nav nav-tabs" id="add_student_tab" role="tablist">
	<li role="presentation" class="active"><a href="#e_personal" id="e_personal-tab" role="tab" data-toggle="tab" aria-controls="e_personal" aria-expanded="true">e_Personal Information</a></li>
	<li role="presentation" class=""><a href="#e_family_members" role="tab" id="e_family_members-tab" data-toggle="tab" aria-controls="e_family_members" aria-expanded="false">Family Members</a></li>
</ul>

<div class="tab-content" id="myTabContent">
   <div class="tab-pane fade active in" role="tabpanel" id="e_personal" aria-labelledby="e_personal-tab">
      <br>
      <div class="row">
      	
			{!! __form::a_textbox( 3,'First Name','first_name', 'text', 'First Name', $student->first_name, '')!!}
			{!! __form::a_textbox( 3,'Middle Name','middle_name', 'text', 'Middle Name',$student->middle_name, '')!!}
			{!! __form::a_textbox( 3,'Last Name','last_name', 'text', 'Last Name',$student->last_name, '')!!}
			{!! __form::a_textbox( 3,'Birthday','birthday', 'date','', $student->birthday, '')!!}
		</div>
		<div class="row">
			{!! __form::a_textbox( 3,'Phone','phone', 'phone', 'Phone', $student->phone, '')!!}
			{!! __form::a_textbox( 3,'Email','email', 'email', 'Email', $student->email, '')!!}
			{!! __form::a_textbox( 3,'Grade level applied to:','grade_level_applied', 'text', 'Grade level applied to:',$student->grade_level_applied, '')!!}
			{!! __form::a_select_sy('3', 'School Year:*', 'sy', [], $student->sy , '') !!}
		</div>

		<div class="well well-sm">
			<div class="row">
				{!! __form::a_select('4', 'Region:*', 'region', [], $student->region, "for='region'" , "", '' ) !!}
	        	{!! __form::a_select('4', 'Province:*', 'province', [$student->province => $student->province], '' , "for='province'") !!}
	        	{!! __form::a_select('4', 'Municipality/City:*', 'municipality', [$student->municipality => $student->municipality], '' , "for='municipality'") !!}
	        </div>
	        <div class="row">
	        	{!! __form::a_select('4', 'Barangay:*', 'barangay', [$student->barangay => $student->barangay], '' , "for='barangay'") !!}
	        	{!! __form::a_textbox( 8,'Detailed address:*','address', 'text', 'Lot, Block, Street',$student->address, '')!!}
			</div>
		</div>


   </div>
   <div class="tab-pane fade" role="tabpanel" id="e_family_members" aria-labelledby="e_family_members-tab">
      <div class="row">
      	<br>
			<div class="col-md-12">
				<button type="button" class="btn btn-success btn-xs pull-right add_row_btn"><i class="fa fa-plus"></i> Add row</button>

				<table id="e_add_family_table" class="table table-condensed table-striped">
					<thead>
						<tr>
							<th>Relationship</th>
							<th>Name</th>
							<th>Contact</th>
							<th>Birthday</th>
							<th>Educ. Att.</th>
							<th>Occupation</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
                        @if($student->families->count() > 0)
                            @foreach($student->families as $family_member)
                                <tr>
                                  <td style="vertical-align: middle;">
                                    {!! __form::s_select_sm('family_relationship[]',[
                                        'Father'=>'Father',
                                        'Mother'=>'Mother',
                                        'Guardian (Male)'=>'Male_Guardian',
                                        'Guardian (Female)'=>'Female_Guardian',
                                        'Brother'=>'Brother',
                                        'Sister'=>'Sister',
                                    ],$family_member->relationship,'') !!}
                                  </td>
                                  <td  style="vertical-align: middle;">	{!! __form::s_input_sm('family_last_name[]', 'text',$family_member->last_name,'Last name', 'style="margin-bottom:3px"') !!}
                                        {!! __form::s_input_sm('family_first_name[]', 'text',$family_member->first_name,'First name', 'style="margin-bottom:3px"') !!}
                                        {!! __form::s_input_sm('family_middle_name[]', 'text',$family_member->middle_name,'Middle name', 'style="margin-bottom:3px"') !!}
                                  </td>
                                  <td style="vertical-align: middle;">

                                        {!! __form::s_input_sm('family_phone[]', 'text',$family_member->phone,'Phone number','style="margin-bottom:3px"') !!}
                                        {!! __form::s_input_sm('family_email[]', 'text',$family_member->email,'Email address') !!}

                                  </td>
                                  <td  style="vertical-align: middle;">
                                    {!! __form::s_input_sm('family_birthday[]', 'date',$family_member->birthday,'') !!}</td>
                                  <td  style="vertical-align: middle;">
                                    {!! __form::s_select_sm('family_educ_att[]',[
                                        'Elementary Level'=>'Elementary Level',
                                        'Elementary Graduate'=>'Elementary Graduate',
                                        'High School Level'=>'High School Level',
                                        'High School Graduate'=>'High School Graduate',
                                        'College Level'=>'College Level',
                                        'College Graduate'=>'College Graduate',
                                        'Post Graduate'=>'Post Graduate',
                                    ],$family_member->educ_att,'') !!}
                                  </td>
                                  <td  style="vertical-align: middle;">
                                    {!! __form::s_input_sm('family_occupation[]', 'text',$family_member->occupation,'Occupation','style="margin-bottom:3px"','') !!}
                                    {!! __form::s_input_sm('family_salary[]', 'number',$family_member->salary,'Salary','') !!}
                                  </td>
                                  <td  style="vertical-align: middle;">
                                    <button type="button" class="btn btn-sm btn-danger remove_family_btn"><i class="fa fa-times"></i></button>
                                  </td>
                                </tr>
                            @endforeach
                        @endif
				      </tbody>
				</table>
			</div>
		</div>
   </div>
</div>
@endsection


@section('modal-footer')
<button class="btn btn-primary" type="submit"><i class="fa fa-check"></i> Save</button>
@endsection


<script type="text/javascript">
	var regions;
	$.getJSON('{{asset("regions.json")}}', function(data){
		regions = data;
		$.each(data, function(i, item){
			if(i == {{$student->region}}){
				$("select[name='region']").append('<option value="'+i+'" selected>'+item.region_name+'</option>');
			}else{
				$("select[name='region']").append('<option value="'+i+'">'+item.region_name+'</option>');
			}
			
		})
	});

	html_region = $("select[for='region']");
	html_province = $("select[for='province']");
	html_municipality = $("select[for='municipality']");
	html_barangay = $("select[for='barangay']");

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


	html_province.find('option[value="{{$student->province}}"]').attr('selected','');
	html_municipality.find('option[value="{{$student->municipality}}"]').attr('selected','');
	html_barangay.find('option[value="{{$student->barangay}}"]').attr('selected','');
</script>