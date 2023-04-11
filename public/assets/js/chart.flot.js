function labelFormatter1(label, series) {
	return '<div style="font-size:8pt; text-align:center; padding:2px; color:white;">' + label + '<br/>' + Math.round(series.percent) + '%</div>';
}

function pelaporanChart(data) {
	const lapor = +data.data.lapor[0].nilai_penggunaan + +data.data.lapor[1].nilai_penggunaan + +data.data.lapor[2].nilai_penggunaan
	const salur = +data.data.salur[0].nilai_salur + +data.data.salur[1].nilai_salur + +data.data.salur[2].nilai_salur
	const sisaDana = salur - lapor;
	var piedata1 = [{
		label: 'Sisa Dana',
		data: [
			[1, sisaDana]
		],
		color: '#ff8c00'
	}, {
		label: 'Pencairan',
		data: [
			[1, salur]
		],
		color: '#5066e0'
	},];
	$.plot('#flotPie1', piedata1, {
		series: {
			pie: {
				show: true,
				radius: 1,
				label: {
					show: true,
					radius: 2 / 3,
					formatter: labelFormatter1,
					threshold: 0.1
				}
			}
		},
		grid: {
			hoverable: true,
			clickable: true
		},
		legend : {
			show: false,
		},
	});
}

function rkasChart(data) {
	total_kirim = 0;
	total_sisa  = 100;

	if(data) {	
		total_kirim = data.total_kirim;
		total_sisa  = data.total_sisa;
	}

	var piedata1 = [{
		label: 'Sudah',
		data: [
			[1, total_kirim]
		],
		color: '#5066e0'
	}, {
		label: 'Belum',
		data: [
			[1, total_sisa]
		],
		color: '#ff8c00'
	},];
	$.plot('#flotPie2', piedata1, {
		series: {
			pie: {
				show: true,
				radius: 1,
				label: {
					show: true,
					radius: 2 / 3,
					formatter: labelFormatter1,
					threshold: 0.1
				}
			}
		},
		grid: {
			hoverable: true,
			clickable: true
		},
		legend : {
			show: false,
		},
	});
}

function worksheetChart(data) {
	yes = 0;
	no  = 100;

	if(data) {	
		yes = data.yes;
		no  = data.no;
	}
	var piedata1 = [{
		label: 'Sudah',
		data: [
			[1, yes]
		],
		color: '#5066e0'
	}, {
		label: 'Belum',
		data: [
			[1, no]
		],
		color: '#ff8c00'
	},];
	$.plot('#flotPie3', piedata1, {
		series: {
			pie: {
				show: true,
				radius: 1,
				label: {
					show: true,
					radius: 2 / 3,
					formatter: labelFormatter1,
					threshold: 0.1
				}
			}
		},
		grid: {
			hoverable: true,
			clickable: true
		},
		legend : {
			show: false,
		},
	});
}