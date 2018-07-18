var validation_error_placement=
	function(label, element) {
			label.addClass('text-danger');
			label.insertAfter(element);
	}
;

var validation_user_rules=
	{
		username: {
			required: true
		},
		password: {
			required: true,
			minlength: 6
		},
		c_password: {
			required: true,
			minlength: 6,
			equalTo: "#password"
		},
		nome: {
			required: true
		},
		email: {
			email: true
		}
	};

var validation_userupdate_rules=
	{
		password: {
			minlength: 6
		},
		c_password: {
			minlength: 6,
			equalTo: "#password"
		},
		nome: {
			required: true
		},
		email: {
			email: true
		}
	};
	
var validation_user_messages=
	{
		username: "Campo obbligatorio",
		password: {
		  required: "Campo obbligatorio",
		  minlength: "Lunghezza minima 6 caratteri",			  
		},
		c_password: {
		  required: "Campo obbligatorio",
		  minlength: "Lunghezza minima 6 caratteri",	
		  equalTo: "Le due password non corrispondono"		  
		},
		nome: "Campo obbligatorio",
		email: {
			email: "Formato email non valido"
		}
	};
	
var validation_calendar_rules=
	{
		"giornata[][descr]": {
			required: true
		}
	};
	
var validation_calendar_messages=
	{
		"giornata[][descr]": "Campo obbligatorio"
	};
