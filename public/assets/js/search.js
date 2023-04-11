$(function() {
	'use strict'
	
	const dataList = [
	  { name: 'Orders', value: 'jQueryScript'},
	  { name: 'Earnings', value: 'jQuery' },
	  { name: 'Customers', value: 'Angular'},
	  { name: 'Total sales', value: 'React' },
	  { name: 'Profits', value: 'Vue' },
	  { name: 'Tasks', value: 'JavaScript' },
	  { name: 'New projects', value: 'CSS' },
	  { name: 'Total sellers', value: 'HTML'}
	]
	$('#search-input').inputDropdown(dataList, {
	  formatter: data => {
		return `<li language=${data.value}>${data.name}</li>`
	  },
	  valueKey: 'language'
	})
	
	//p-scroll
	const ps2 = new PerfectScrollbar('.jq-input-dropdown', {
		suppressScrollX: true
	});
	
});
	