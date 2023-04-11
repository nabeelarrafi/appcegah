function alokasiChart(data) {
	// console.log(data);
	/*----Echart2----*/
	var chartdata = [{
		name: 'Alokasi',
		type: 'bar',
		barMaxWidth: 20,
		data: [data.data.alokasi[0].nilai_alokasi*0.3, data.data.alokasi[1].nilai_alokasi*0.4, data.data.alokasi[2].nilai_alokasi*0.3]
	},  {
		name: 'Penyaluran',
		type: 'bar',
		barMaxWidth: 20,
		data: [data.data.salur[0].nilai_salur, data.data.salur[1].nilai_salur, data.data.salur[2].nilai_salur]
	}];
	var chart = document.getElementById('echart1');
	var barChart = echarts.init(chart);
	var option = {
		valueAxis: {
			axisLine: {
				lineStyle: {
					color: 'rgba(171, 167, 167,0.2)'
				}
			},
			splitArea: {
				show: true,
				areaStyle: {
					color: ['rgba(171, 167, 167,0.2)']
				}
			},
			splitLine: {
				lineStyle: {
					color: ['rgba(171, 167, 167,0.2)']
				}
			}
		},
		grid: {
			top: '6',
			right: '0',
			bottom: '17',
			left: '25',
		},
		xAxis: {
			data: ['Tahap 1', 'Tahap 2', 'Tahap 3'],
			axisLine: {
				lineStyle: {
					color: 'rgba(171, 167, 167,0.2)'
				}
			},
			splitLine: {
				lineStyle: {
					color: 'rgba(171, 167, 167,0.2)'
				}
			},
			axisLabel: {
				fontSize: 10,
				color: '#5f6d7a'
			}
		},
		tooltip: {
			trigger: 'axis',
			position: ['35%', '32%'],
		},
		yAxis: {
			splitLine: {
				lineStyle: {
					color: 'rgba(171, 167, 167,0.2)'
				}
			},
			axisLine: {
				lineStyle: {
					color: 'rgba(171, 167, 167,0.2)'
				}
			},
			axisLabel: {
				fontSize: 10,
				color: '#5f6d7a'
			}
		},
		series: chartdata,
		color: ['#5066e0', '#ff8c00']
	};
	barChart.setOption(option);
}