<!doctype html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="Generator" content="EditPlus®">
		<meta name="Author" content="">
		<meta name="Keywords" content="">
		<meta name="Description" content="">
		<title>Document</title>
		<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js" crossorigin="anonymous"></script>
	</head>
	<style>
		body {
		   margin: 0;
		   padding: 0;
		}
	</style>
 <body>
	<div id="pdfView"></div>
	<script>
		//const urlHost = 'http://localhost:56869'
		const urlHost = 'https://apicon-rkas.kemdikbud.go.id'
		const userAPI = 'itjen@kemdikbud.go.id'
		const passAPI = 'A0889E7BBA8A43249261C51B2AABAAA5'
		const endPoint = '/api/itjen/pengunaan'
		const dataNPSN = "{{ $data['npsn'] }}"
		// const dataRevisi = '0'
		const dataPeriode = '2'
		
		let getToken = ''
		
		let details = {
			'userName': userAPI,
			'password': passAPI,
			'grant_type': 'password'
		};

		let formBody = [];
		for (let property in details) {
			let encodedKey = encodeURIComponent(property);
			let encodedValue = encodeURIComponent(details[property]);
			formBody.push(encodedKey + "=" + encodedValue);
		}
		formBody = formBody.join("&");

		async function downloadPDFAPI(url = '', data = {}) {
		  const response = await fetch(url, {
			method: 'POST', 
			mode: 'cors', // no-cors, *cors, same-origin
			cache: 'no-cache', // *default, no-cache, reload, force-cache, only-if-cached
			credentials: 'same-origin', // include, *same-origin, omit
			headers: {
			  'Content-Type': 'application/json',
			   'Authorization': 'Bearer ' + getToken
			},
			redirect: 'follow', // manual, *follow, error
			referrerPolicy: 'no-referrer', // no-referrer, *no-referrer-when-downgrade, origin, origin-when-cross-origin, same-origin, strict-origin, strict-origin-when-cross-origin, unsafe-url
			body: JSON.stringify(data) // body data type must match "Content-Type" header
		  });
		  return response.blob(); // parses JSON response into native JavaScript objects
		}

		$.LoadingOverlay("show");

		fetch(urlHost+'/token', {
			method: 'POST', mode: 'cors', cache: 'no-cache', credentials: 'same-origin', headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
			redirect: 'follow', referrerPolicy: 'no-referrer', body: formBody
		})
			.then(response => response.json())
            .then(result => {
                getToken = result.access_token
				downloadPDFAPI(urlHost+endPoint, {npsn:dataNPSN,id_periode:dataPeriode})
				// downloadPDFAPI(urlHost+endPoint, {npsn:dataNPSN})
					.then(blobResp => {
						let windowH = $(window).height();
						let windowW = $(window).width();
						let wrapperH = $('#pdfView').height();
						if(windowH > wrapperH) {                            
							$('#pdfView').css({'height':windowH+'px', 'width' : windowW+'px'});
						} 
					
						let blob = new Blob([blobResp], {type: 'application/pdf'}),
						url = URL.createObjectURL(blob),
						_iFrame = document.createElement('iframe');

						_iFrame.setAttribute('src', url);
						_iFrame.setAttribute('height', windowH+'px');
						_iFrame.setAttribute('width', windowW+'px');
						_iFrame.setAttribute('border','0');
						_iFrame.setAttribute('style','border:none');
						$('#pdfView').append(_iFrame);
						$.LoadingOverlay("hide");
					})
					.catch(err => {
						console.error(err); $.LoadingOverlay("hide");
					})
            })
			.catch(err => {
				console.error(err); $.LoadingOverlay("hide");
			})
		
	  
	</script>
 </body>
</html>
