<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			<i class="fa fa-users"></i> Supplier Management
			<small>Add, Edit, Delete</small>
		</h1>
		
		<?php
				$flmsg = $this->session->flashdata();
				foreach ($flmsg as $key => $flm) {

					echo '<br> <div class="alert alert-'.$key.' alert-dismissable">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>' . $flm . '
							</div>';
				} ?>
	</section>

	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-body table-responsive no-padding">
				
					<style>
						table {
							width: 100%;
							border-collapse: collapse;
							border-spacing: 0;
						}

						th,
						td {
							padding: 4px;
							border: 1px solid #dddddd;
							text-align: center;
							font-size: 12px;
						}
					</style>

					<table>
						<tr>
							<th colspan="11">
								<table>

									<tr>
										<th colspan="10">
											<br>
											<h4>Supplier Info</h4>
											<br>
										</th>
									</tr>

									<tr>
										<td>Supplier Name: </td>
										<td><?= $supplier->name ?></td>
										<td>Supplier Contact: </td>
										<td> <?= $supplier->mobile ?></td>
									</tr>
									<tr>
										<td>Supplier Email: </td>
										<td><?= $supplier->email ?></td>
										<td>Date: </td>
										<td> <?= date('d-M-Y') ?></td>
									</tr>

								</table>
							</th>
						</tr>

						<tr>
							<th colspan="11"><br>
								<h4>Booking Info</h4><br>
							</th>
						</tr>

						<tr>
							<th scope="col">Ref #</th>
							<th scope="col">Booking Date</th>
							<th scope="col">Guest Name</th>
							<th scope="col">Guest Contact</th>
							<th scope="col">Adult</th>
							<th scope="col">Child</th>
							<th scope="col">Pickup Date</th>
							<th scope="col">Pickup Time</th>
							<th scope="col">Pick Location</th>
							<th scope="col">Drop Location</th>
							<th scope="col">Vehicle</th>
						</tr>
						<?php
						if (!empty($records)) {
							array_multisort($records, SORT_ASC);
							$count = 1;
							foreach ($records as $record) {
						?>
								<tr>
									<td style="width:10px;"><?php echo $record->bRefNo ?></td>
									<td><?php echo $record->bDate ?></td>
									<td><?php echo $record->bGuestName ?></td>
									<td><?php echo $record->bGuestContact ?></td>
									<td><?php echo $record->bAdult ?></td>
									<td><?php echo $record->bChild ?></td>
									<td><?php echo $record->bPickupDate ?></td>
									<td><?php echo $record->bPickupTime ?></td>
									<td><?php echo $record->bPickLoc ?></td>
									<td><?php echo $record->bDropLoc ?></td>
									<td><?php echo $record->bVehicle ?></td>

								</tr>
							<?php }
						} else { ?>
							<tr class="py-5">
								<td colspan="11">
									<br>
									<center>no bookings available...</center>
									<br>
								</td>

							</tr>
						<?php }  ?>

						<footer>
							<tr>
								<td colspan="11">
									<br><br>
									<?php
									if (!empty($records)) { ?>
										<!-- <a href=" echo base_url() . 'booking/confirm-booking?bid=' . $record->bookingId . "&spId=" . $supplier->userId; ?>" class="btn btn-success">
										<img width="24px" src="data:image/png;base64,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">
										Send Booking Info</a> -->
										<a href="<?php echo base_url() . 'DataExport/saveAsPdf?id=' . $supplier->userId; ?>" class="btn btn-success">
										<img height="35px" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADwAAAA8CAYAAAA6/NlyAAAACXBIWXMAAAsTAAALEwEAmpwYAAAEqUlEQVR4nO2ae0xbVRzHvwxdcGmhZXG4B4bFuZDFuGQGpzEhI7CQReJjE5aNWDZhZgvGGGZlOhEyzVA3gsORoaKyVav4x+aLyMJUUIMOp04RM3nI3IDyGDAopYOVfs29dLdcaMEHyC233+T7R8/53ZP7Oeee8zvnpIBffvnll19zSAwFZ8x7Ms4yO3seVANsNpHPZTYyJSUIqgE2m8jnn7UwNTEUqgE2m8jcfb00JC5VD7DZRObl2piyMVI9wGYTRw4dHGJa0l2qAaYAXXR4hNu2blQNMM0mOt444mRqcppqgCmMdEkxHTsNz6gGmAL0sbdp35nyimqAaTbR+c5R9ux6pFQ1wBT87jG2pKdV+TSwWTO1P9CAX2jBuhDwsh6cc8DvacByLXg2BLTowJFxz8wJ4I+1YE0w+KcOHJ7iGZ8GbtaBg/p/9oxPA/Nf2A883aICRtU/wjMphqp9hLcnyp0QTd6slccIv8fGPPwgGX83edN8zyBb7yN3bPHsWQf2pEEb+eoBMuz60Zi1kR7DaO0nC14ml9wgb7PlAr1KKcDDPd20t7bQOTLifrniQjHGdqcb+Eq7hcO9PXKIH2vIcI3Upv3iKLDDNsArljaZFQP8016juEs6vnwRO76pcvXCMLlcR+sY4KqHEsS4EyuXsvFosRv6tUNSm4Mu4N+PFEzYaioGuDnLyPoQ8EwwWG1IcoNEr5YBNyQl8FwIeDoYLNWAreWfiuVO2wC5OEgGfLGogA0hkFkxwB1ZRqmsK2//aKHTSevKMBnwpc0JUly/HqxJTXZ3TswdMuDeso/IpA1ux0YpB9h6sox8YS95opR0OMQyy6mT4hHOG7Dg8/fHSXX2e6NlwBNUWaEc4PG6XFfLsluXiMe5yYD7s550190eIQMe6r5Ea12t5K6S15UD3N9Yz9byMjaZ3mJ1ajLfD50vzTmvwLcto6OrUyzv/fUXdusnX7SEg7/iVmmzBvxEC57XuWPGAvfn55KPbScL88j+PrFMSGVVD8TTMW6Vbikq4AUdJHe6OuTLVeuYHZcjGkbmSN7Ndf8bcEuWURwhm4fz7Fjg8XLYbPz2UQO/D3bHXwPuKCrwuBNzgXpyzowDW5ubRLc9vsPrfte65hYpbkBwUwM7vq5k7f4cMR9/ppXfbPScOc3B1ha2vbRPecBm12f8m4ccec19es/3VUIeFvL21XHxH7rqhTrFATe4NgS9k1zNDI2JEyxc5bTrJoJKqUoHNurALr0CgTkL9gMb/SM8faL/k4Z/DtO/aOE/dUJDxAq+GJMpOS65wltaqoCRmZL3cIVPzuGRhfMYm3zKG6Q3VyGRgT4JLFwUfLU4jAvT2/8e7O6rfYjKiAWg9UlgZyj4uRZ8atUGBhidUwE7EZN/EIAAHOCTwILtevC4BkxYf2By4OTvygBsArAA06Qts+hdCJxfiLR6i0fY9M4/EBRqALBsumBnG1jw01i0ugRPDNhlsBnDdkRuzgCwBnNMAQDWI/Zwvgw4/s1CAPEAlPV/62mSMD83wfCDkHeJlJ8rASQCCMYcVjgW3GhA6rlqaMO3AYiAChTlmtdroRIFArgHwHWz/SJQqv4C4t1h2lzR9noAAAAASUVORK5CYII=">
											save As PDF</a>
									<?php } ?>
									<br><br>
								</td>
							</tr>
						</footer>
					</table>
				</div><!-- /.box-body -->
			</div><!-- /.box -->
		</div>
	</div>
	</section>
</div>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/admin/js/common.js" charset="utf-8"></script>