//Retrieve OQC Lot App Reel Lot Numbers from Packing Code
function RetrieveReelLotNumFromPackingCode(po_num, pack_code)
{
	 toastr.options = {
      "closeButton": false,
      "debug": false,
      "newestOnTop": true,
      "progressBar": true,
      "positionClass": "toast-top-right",
      "preventDuplicates": false,
      "onclick": null,
      "showDuration": "300",
      "hideDuration": "3000",
      "timeOut": "3000",
      "extendedTimeOut": "3000",
      "showEasing": "swing",
      "hideEasing": "linear",
      "showMethod": "fadeIn",
      "hideMethod": "fadeOut",
    };


	$.ajax({
		url: 'retrieve_reel_lot_no_from_packing_code',
		method: 'get',
		data: {
			po_num: po_num,
			pack_code: pack_code
		},
		dataType: 'json',
		beforeSend: function()
		{

		},  
		success: function(JsonObject)
		{
			if(JsonObject['reellots'].length > 0)
			{
				for(var i = 0; i < JsonObject['reellots'].length; i++)
				{
					arrPackCodeReelLots.push(JsonObject['reellots'][i].oqclotapp_details.reel_lot);
				}

        console.log(arrPackCodeReelLots);


				    var html = '';

			        for (var i = 0; i < arrPackCodeReelLots.length; i++)
			        {
			          html += '<tr>';
			            html += '<td align="center">';
			            html += arrPackCodeReelLots[i];
			            html += '</td>';
			            html += '<td>';
			            html += '</td>';
			          html += '</tr>';
			        }

			        $('#tblReelLotsForPackingCode tbody').html(html);
			}
		},
		error: function(data, xhr, status)
		{
			toastr.error('Error Loading Data! Please Reload Page or contact ISS local 205/207.');
		}
	});
}

function CheckExistPackingCode(po_num,pack_code)
{
	 toastr.options = {
              "closeButton": false,
              "debug": false,
              "newestOnTop": true,
              "progressBar": true,
              "positionClass": "toast-top-right",
              "preventDuplicates": false,
              "onclick": null,
              "showDuration": "300",
              "hideDuration": "3000",
              "timeOut": "3000",
              "extendedTimeOut": "3000",
              "showEasing": "swing",
              "hideEasing": "linear",
              "showMethod": "fadeIn",
              "hideMethod": "fadeOut",
     };

     $.ajax({
     	url: "check_exist_pack_code",
     	method: "get",
     	data:
     	{
     		po_num: po_num,
     		pack_code: pack_code
     	},

     	dataType: 'json',

     	beforeSend: function()
     	{

     	},
     	success: function(JsonObject)
     	{
     		if(JsonObject['result'] == '1')
     		{
     			let total_lot_qty = parseInt(JsonObject['lotcount']);

     			let device_name = $('#id_device_name').val();

     			$('#id_modal_po_num').val(po_num);
     			$('#id_modal_pack_code').val(pack_code);
     			$('#id_modal_device').val(device_name);
     			$('#id_modal_box_qty').val(total_lot_qty);

            RetrieveReelLotNumFromPackingCode(po_num,pack_code);
            $('#modalProdPrelimInspection').modal('show');
          
     		}
        else if(JsonObject['result'] == '3')
        {
          toastr.error('Packing Code already inspected!');
        }
     		else
     		{
     			toastr.error('Packing Code is not in P.O. Number!');
     		}
     	},
      error: function(data, xhr, status){
            toastr.error('An error occured!\n' + 'Data: ' + data + "\n" + "XHR: " + xhr + "\n" + "Status: " + status);

     	}

     });
}

function CheckC3LabelExists(barcode)
{
	toastr.options = {
      "closeButton": false,
      "debug": false,
      "newestOnTop": true,
      "progressBar": true,
      "positionClass": "toast-top-right",
      "preventDuplicates": false,
      "onclick": null,
      "showDuration": "300",
      "hideDuration": "3000",
      "timeOut": "3000",
      "extendedTimeOut": "3000",
      "showEasing": "swing",
      "hideEasing": "linear",
      "showMethod": "fadeIn",
      "hideMethod": "fadeOut",
    };

    var matched = 0;
    var text_scanned_c3 = barcode.substring(2);

    $('#tblReelLotsForPackingCode tbody tr').each(function(){

    	if($(this).find('td:eq(0)').text() == text_scanned_c3)
    	{ 
        for(var x = 0; x < arrUserScanReelLots.length; x++)
        {
          if(text_scanned_c3 == arrUserScanReelLots[x])
          {
            matched++;
          }
        }

        if(matched > 0)
          {
              toastr.error('Reel Lot Number Already Scanned!');
          }
          else
          {
              $(this).find('td:eq(1)').text(text_scanned_c3);
              $(this).addClass('table-success');
              arrUserScanReelLots.push(text_scanned_c3);

              matched = 0;

              setTimeout(function () 
              {
                $('#btn_search_c3_label').trigger('click');
              },400);
          }
    	}



    });

    if(arrUserScanReelLots.length == arrPackCodeReelLots.length)
    {
    	$('.btn_search_c3_label').attr('disabled','disabled');
    	$('#btn_check_reel_lots').removeAttr('disabled');	
    }

    console.log(barcode);
    console.log(arrUserScanReelLots);
}

function OpenRDrawing(device)
{
	$.ajax({
		url: 'ppo_retrieve_r_drawing',
		method: 'get',
		data: {
			device: device
		},

		dataType: 'json',

		beforeSend: function()
		{

		},
		success: function(JsonObject)
		{
			var fkid_doc_no = JsonObject['documents'][0].fkid_document;

			window.open("http://192.168.3.235/ACDCS/pdf_viewer_dquick_document.php?pkid_doc_stat="+fkid_doc_no+'_1', '_blank');    
		},
		error: function()
		{

		}

	});
}

function SubmitPrelimInspection()
{
   toastr.options = {
      "closeButton": false,
      "debug": false,
      "newestOnTop": true,
      "progressBar": true,
      "positionClass": "toast-top-right",
      "preventDuplicates": false,
      "onclick": null,
      "showDuration": "300",
      "hideDuration": "3000",
      "timeOut": "3000",
      "extendedTimeOut": "3000",
      "showEasing": "swing",
      "hideEasing": "linear",
      "showMethod": "fadeIn",
      "hideMethod": "fadeOut",
    };

    $.ajax({

        url: 'submit_prelim_inspection',
        method: 'post',
        data: $("#formProdPrelimInspection").serialize(),
        dataType: 'json',
        beforeSend: function()
        {

        },
        success: function(JsonObject)
        {
          if(JsonObject['result'] == 1)
          {
            $("#modalProdPrelimInspection").modal('hide');
            $("#formProdPrelimInspection")[0].reset();

            dt_prodpreliminspection.draw();

            toastr.success('Packing Inspection was successfully saved!');
          }
          else if(JsonObject['result'] == 2)
          {
            toastr.error('User ID does not exist!');
          }
          else
          {
            toastr.error('Saving Packing Inspection Failed!');
          }
        },
         error: function(data, xhr, status){
            toastr.error('An error occured!\n' + 'Data: ' + data + "\n" + "XHR: " + xhr + "\n" + "Status: " + status);
        }

    });
}

function SubmitPrelimInspectionSupervisor()
{
   toastr.options = {
      "closeButton": false,
      "debug": false,
      "newestOnTop": true,
      "progressBar": true,
      "positionClass": "toast-top-right",
      "preventDuplicates": false,
      "onclick": null,
      "showDuration": "300",
      "hideDuration": "3000",
      "timeOut": "3000",
      "extendedTimeOut": "3000",
      "showEasing": "swing",
      "hideEasing": "linear",
      "showMethod": "fadeIn",
      "hideMethod": "fadeOut",
    };

    $.ajax({

        url: 'submit_prelim_inspection_supervisor',
        method: 'post',
        data: $("#formProdPrelimInspectionSupervisor").serialize(),
        dataType: 'json',
        beforeSend: function()
        {

        },
        success: function(JsonObject)
        {
          if(JsonObject['result'] == 1)
          {
            $("#modalProdPrelimInspectionSupervisor").modal('hide');
            $("#formProdPrelimInspectionSupervisor")[0].reset();

            dt_prodpreliminspection.draw();

            toastr.success('Packing Inspection was successfully saved!');
          }
          else if(JsonObject['result'] == 2)
          {
            toastr.error('User is not Supervisor!');
          }
          else
          {
            toastr.error('Saving Packing Inspection Failed!');
          }
        },
         error: function(data, xhr, status){
            toastr.error('An error occured!\n' + 'Data: ' + data + "\n" + "XHR: " + xhr + "\n" + "Status: " + status);
        }

    });
}

function CheckIfSupervisor(employee,po_num,pack_code,lot_count)
{
     toastr.options = {
      "closeButton": false,
      "debug": false,
      "newestOnTop": true,
      "progressBar": true,
      "positionClass": "toast-top-right",
      "preventDuplicates": false,
      "onclick": null,
      "showDuration": "300",
      "hideDuration": "3000",
      "timeOut": "3000",
      "extendedTimeOut": "3000",
      "showEasing": "swing",
      "hideEasing": "linear",
      "showMethod": "fadeIn",
      "hideMethod": "fadeOut",
    };

    $.ajax({

        url: 'check_if_supervisor',
        method: 'get',
        data: {
          lot_count: lot_count,
          po_num: po_num,
          pack_code: pack_code,
          employee: employee
        },
        dataType: 'json',

          beforeSend: function()
          {

          },
          success: function(JsonObject)
          {
            if(JsonObject['result'] == '1')
            {
                let device = $('#id_device_name').val();

                $('#id_modal_supervisor_device').val(device);
                $('#id_modal_supervisor_box_qty').val(lot_count);
                $('#id_modal_supervisor_pack_code').val(pack_code);
                $('#id_modal_supervisor_po_num').val(po_num);

                OpenRDrawing(device);

              $('#modalProdPrelimInspectionSupervisor').modal('show');
            }
            else if(JsonObject['result'] == '2')
            {
              toastr.error('User is not supervisor!');
            }
            else
            {
              toastr.error('User ID not found!');
            }
          },
          error: function()
          {

          }

    })
}

