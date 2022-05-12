<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
        @foreach ($gajis as $item)

		<title>Slip Gaji {{ $item->kehadiran->karyawan->nama_karyawan }}</title>
		<style>
			.invoice-box {
				max-width: 800px;
				margin: auto;
				padding: 30px;
				/* border: 1px solid #eee;
				box-shadow: 0 0 10px rgba(0, 0, 0, 0.15); */
				font-size: 16px;
				line-height: 24px;
				font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
				color: #555;
			}

			.invoice-box table {
				width: 100%;
				line-height: inherit;
				text-align: left;
			}

			.invoice-box table td {
				padding: 5px;
				vertical-align: top;
			}

			.invoice-box table tr td:nth-child(2) {
				text-align: right;
			}

			.invoice-box table tr.top table td {
				padding-bottom: 20px;
			}

			.invoice-box table tr.top table td.title {
				font-size: 45px;
				line-height: 45px;
				color: #333;
			}

			.invoice-box table tr.information table td {
				padding-bottom: 40px;
			}

			.invoice-box table tr.heading td {
				background: #eee;
				border-bottom: 1px solid #ddd;
				font-weight: bold;
			}

			.invoice-box table tr.details td {
				padding-bottom: 20px;
			}

			.invoice-box table tr.item td {
				border-bottom: 1px solid #eee;
			}

			.invoice-box table tr.item.last td {
				border-bottom: none;
			}

			.invoice-box table tr.total td:nth-child(3) {
				/* border-top: 2px solid #eee; */
				font-weight: bold;
			}

			@media only screen and (max-width: 600px) {
				.invoice-box table tr.top table td {
					width: 100%;
					display: block;
					text-align: center;
				}

				.invoice-box table tr.information table td {
					width: 100%;
					display: block;
					text-align: center;
				}
			}

			/** RTL **/
			.invoice-box.rtl {
				direction: rtl;
				font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
			}

			.invoice-box.rtl table {
				text-align: right;
			}

			.invoice-box.rtl table tr td:nth-child(2) {
				text-align: left;
			}
		</style>
	</head>

	<body>
		<div class="invoice-box">
			<table cellpadding="0" cellspacing="0">
				<tr class="top">
					<td colspan="6">
						<table>
							<tr>
								<td style="text-align: center">
									<img src="{{ asset('kanas.png') }}" style="width: 100%; max-width: 100px" />
								</td>
							</tr>
                            <tr>
								<td style="text-align: center">
									Slip Gaji {{ $item->kehadiran->karyawan->nama_karyawan }}
								</td>
                            </tr>
						</table>
					</td>
				</tr>
				<tr class="heading">
					<td style="text-align: center">Masuk</td>
					<td style="text-align: center">Lembur</td>
					<td style="text-align: right">Uang Lembur</td>
					<td style="text-align: right">BPJS</td>
					<td style="text-align: right">Bonus</td>
					<td style="text-align: right">Tunjangan</td>
				</tr>
                <tr class="item">
                    <td style="text-align: center">{{ $item->kehadiran->masuk }}</td>
                    <td style="text-align: center">{{ $item->kehadiran->lembur }}</td>
                    <td style="text-align: right">@currency($item->uang_lembur)</td>
                    <td style="text-align: right">@currency($item->kehadiran->karyawan->bpjs)</td>
                    <td style="text-align: right">@currency($item->bonus)</td>
                    <td style="text-align: right">@currency($item->kehadiran->karyawan->tunjangan)</td>
                </tr>
				<tr class="total">
					<td></td>
                    <td colspan="4" style="font-weight: bold">Gaji Harian</td>
					<td style="text-align: right">@currency($item->gaji_harian)</td>
				</tr>
				<tr class="total">
					<td ></td>
                    <td colspan="4" style="font-weight: bold">Potongan</td>
					<td style="text-align: right">@currency($item->potongan)</td>
				</tr>
				<tr class="total">
                    <td></td>
					<td colspan="4" style="font-weight: bold">TOTAL Gaji</td>
					<td style="text-align: right">@currency($item->total_gaji)</td>
				</tr>
			</table>
		</div>
	</body>
    @endforeach
</html>
<script>
    window.addEventListener("load", window.print());
</script>
