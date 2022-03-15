<html>
<head>
<style>


th,td {
  padding: 10px;
}

td {
	padding: 5px;
}

</style>
</head>
<body>
	<table>

		<thead>
			<tr>
			<!--FIRST HEADER ROW-->
			<th colspan="13" style="text-align: left; font-family:'Arial'; font-size: 18pt; background-color:#b7d8ff; padding: 10px 10px; margin: 10px 10px;" >{{ $device_name }} Packing and Shipping Record</th>
			</tr>

			<!--SECOND HEADER ROW-->
			<tr>
			<th style="text-align: center; font-family:'Arial'; font-size:13pt; background-color:#e5ff75; padding: 10px 10px; margin: 10px 10px;" colspan="5">QC Fill-in</th>
			<th style="text-align: center; font-family:'Arial'; font-size:13pt; background-color:#e5ff75; padding: 10px 10px; margin: 10px 10px;" colspan="5">Production Fill-in</th>
			<th style="text-align: center; font-family:'Arial'; font-size:13pt; background-color:#e5ff75; padding: 10px 10px; margin: 10px 10px;" colspan="3">QC Fill-in</th>
			</tr>

			<!--THIRD HEADER ROW-->
			<tr>
			<th style="text-align: center; font-weight: bold; font-family:'Arial'; font-size:9pt; background-color:#70ecf9; padding: 10px 10px; margin: 10px 10px;" rowspan="2">Packing day</th>
			<th style="text-align: center; font-weight: bold; font-family:'Arial'; font-size:9pt; background-color:#70ecf9; padding: 10px 10px; margin: 10px 10px;" rowspan="2">Shift</th>
			<th style="text-align: center; font-weight: bold; font-family:'Arial'; font-size:9pt; background-color:#70ecf9; padding: 10px 10px; margin: 10px 10px;" rowspan="2">P.O. Number</th>
			<th style="text-align: center; font-weight: bold; font-family:'Arial'; font-size:9pt; background-color:#70ecf9; padding: 10px 10px; margin: 10px 10px;" rowspan="2">Packing Code</th>
			<th style="text-align: center; font-weight: bold; font-family:'Arial'; font-size:9pt; background-color:#70ecf9; padding: 10px 10px; margin: 10px 10px;" rowspan="2">QC</th>
			<th style="text-align: center; font-weight: bold; font-family:'Arial'; font-size:9pt; background-color:#70ecf9; padding: 10px 10px; margin: 10px 10px;" rowspan="2">Packing Lot (Reel lot no)</th>
			<th style="text-align: center; font-weight: bold; font-family:'Arial'; font-size:9pt; background-color:#70ecf9; padding: 10px 10px; margin: 10px 10px;" rowspan="2">数量 Qty</th>
			<th style="text-align: center; font-weight: bold; font-family:'Arial'; font-size:9pt; background-color:#70ecf9; padding: 10px 10px; margin: 10px 10px;" rowspan="2">刻印 Print Lot</th>
			<th style="text-align: center; font-weight: bold; font-family:'Arial'; font-size:9pt; background-color:#70ecf9; padding: 10px 10px; margin: 10px 10px;" colspan="2">In-charge (NAME)</th>
			<th style="text-align: center; font-weight: bold; font-family:'Arial'; font-size:9pt; background-color:#70ecf9; padding: 10px 10px; margin: 10px 10px;" rowspan="2">Shipment Day</th>
			<th style="text-align: center; font-weight: bold; font-family:'Arial'; font-size:9pt; background-color:#70ecf9; padding: 10px 10px; margin: 10px 10px;" rowspan="2">出荷地<br>Shipping Destination</th>
			<th style="text-align: center; font-weight: bold; font-family:'Arial'; font-size:9pt; background-color:#70ecf9; padding: 10px 10px; margin: 10px 10px;" rowspan="2">Remarks / Special Instruction / UD#</th>		
			</tr>
				<tr>
				<th style="text-align: center; font-weight: bold; font-family:'Arial'; font-size:9pt; background-color:#70ecf9; padding: 10px 10px; margin: 10px 10px;">Packing operator</th>
				<th style="text-align: center; font-weight: bold; font-family:'Arial'; font-size:9pt; background-color:#70ecf9; padding: 10px 10px; margin: 10px 10px;">QC</th>
			</tr>
		</thead>

		<tbody>

			@for($i = 0; $i < count($shipping_records); $i++)

			<tr>

				@php

					$shiftletter = '';

					$shift = \Carbon\Carbon::parse($shipping_records[0]->prod_prelim_details[0]->updated_at)->format('H:i a');

					$starttime = "7:30 am";
					$endtime = "19:30 pm";

					$date1 = DateTime::createFromFormat('H:i a', $shift);
					$date2 = DateTime::createFromFormat('H:i a', $starttime);
					$date3 = DateTime::createFromFormat('H:i a', $endtime);

					if ($date1 >= $date2 && $date1 <= $date3)
					{
					   $shiftletter = 'A';
					}
					else
					{
						$shiftletter = 'B';
					}

				@endphp


				<td style="text-align: center; font-family:'Arial'; font-size:10pt;">{{ \Carbon\Carbon::parse($shipping_records[0]->prod_prelim_details[0]->updated_at)->format('m/d/Y') }}</td>

				<td style="text-align: center; font-family:'Arial'; font-size:10pt;">{{ $shiftletter }}</td>

				<td style="text-align: center; font-family:'Arial'; font-size:10pt;">&nbsp;{{ $shipping_records[$i]->po_num }}</td>
				<td style="text-align: center; font-family:'Arial'; font-size:10pt;">{{ $shipping_records[$i]->pack_code_no }}</td>
				<td style="text-align: center; font-family:'Arial'; font-size:10pt;">{{ $shipping_records[$i]->pack_code_no }}</td>

				<td style="text-align: center; font-family:'Arial'; font-size:10pt;">{{ $shipping_records[$i]->oqcvir_details[0]->oqclotapp_details->reel_lot }}</td>
				<td style="text-align: center; font-family:'Arial'; font-size:10pt;">{{ $shipping_records[$i]->oqcvir_details[0]->oqclotapp_details->output_qty }}</td>
				<td style="text-align: center; font-family:'Arial'; font-size:10pt;">{{ $shipping_records[$i]->oqcvir_details[0]->oqclotapp_details->print_lot }}</td>
				<td style="text-align: center; font-family:'Arial'; font-size:10pt;">{{ $shipping_records[$i]->pack_code_no }}</td>
				<td style="text-align: center; font-family:'Arial'; font-size:10pt;">{{ $shipping_records[$i]->pack_code_no }}</td>

				<td style="text-align: center; font-family:'Arial'; font-size:10pt;">{{ $shipping_records[$i]->shipping_date }}</td>
				<td style="text-align: center; font-family:'Arial'; font-size:10pt;">{{ $shipping_records[$i]->shipping_destination }}</td>
				<td style="text-align: left; font-family:'Arial'; font-size:10pt;">{{ $shipping_records[$i]->shipping_remarks }}</td>				
			</tr>


			@for($x = 1; $x < count($shipping_records[$i]->oqcvir_details); $x++)

				<tr>
					<td style="text-align: center; font-family:'Arial'; font-size:10pt;"></td>
					<td style="text-align: center; font-family:'Arial'; font-size:10pt;"></td>
					<td style="text-align: center; font-family:'Arial'; font-size:10pt;"></td>
					<td style="text-align: center; font-family:'Arial'; font-size:10pt;"></td>
					<td style="text-align: center; font-family:'Arial'; font-size:10pt;"></td>
					<td style="text-align: center; font-family:'Arial'; font-size:10pt;">{{ $shipping_records[$i]->oqcvir_details[$x]->oqclotapp_details->reel_lot }}</td>
					<td style="text-align: center; font-family:'Arial'; font-size:10pt;">{{ $shipping_records[$i]->oqcvir_details[$x]->oqclotapp_details->output_qty }}</td>
					<td style="text-align: center; font-family:'Arial'; font-size:10pt;">{{ $shipping_records[$i]->oqcvir_details[$x]->oqclotapp_details->print_lot }}</td>
					<td style="text-align: center; font-family:'Arial'; font-size:10pt;"></td>
					<td style="text-align: center; font-family:'Arial'; font-size:10pt;"></td>
					<td style="text-align: center; font-family:'Arial'; font-size:10pt;"></td>
					<td style="text-align: center; font-family:'Arial'; font-size:10pt;"></td>
					<td style="text-align: center; font-family:'Arial'; font-size:10pt;"></td>

				</tr> 	

			@endfor

			<tr></tr>

		@endfor

		</tbody>
	</table>
</body>
</html>

