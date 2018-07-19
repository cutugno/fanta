jQuery.extend(jQuery.validator.messages, {
    required: "Campo obbligatorio",
    remote: "Campo non valido",
    email: "Formato email non valido",
    url: "Formato URL non valido",
    date: "Formato data non valido",
    dateISO: "Formato data (ISO) non valido",
    number: "Inserisci un numero decimale",
    digits: "Inserisci un numero intero",
    creditcard: "Inserisci un numero di carta di credito valido",
    equalTo: "I due valori non corrispondono",
    accept: "Inserisci un valore con la corretta estensione",
    maxlength: jQuery.validator.format("Lunghezza massima {0} caratteri"),
    minlength: jQuery.validator.format("Lunghezza minima {0} caratteri"),
    rangelength: jQuery.validator.format("Inserisci un valore lungo fra {0} e {1} caratteri"),
    range: jQuery.validator.format("Inserisci un numero fra {0} e {1}."),
    max: jQuery.validator.format("Inserisci un valore più piccolo o uguale a {0}."),
    min: jQuery.validator.format("Inserisci un valore più grande o uguale a {0}.")
});

$.validator.addMethod(
        "regex",
        function(value, element, regexp) {
            var re = new RegExp(regexp);
            return this.optional(element) || re.test(value);
        },
        "Formato non valido"
);

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
	
var validation_calendar_rules={};
var validation_matches_rules={};
var validation_calendar_messages={};
var validation_matches_messages={};

	
