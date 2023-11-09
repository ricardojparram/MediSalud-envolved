$(document).ready(function(){

	const url_param = (window.location.search === "?url=pago") ? "pago" : "";
	console.log(url_param);
	const comprobarLimitePago = () => {
		$.ajax({ url: '?url=pago', dataType:'JSON', method:'POST', data: {comprobarLimitePago:'', url_param}
		}).done((asd) => {
			console.log(asd);
		})
	}
})