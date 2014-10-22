<?php

return array(

	/*
	|--------------------------------------------------------------------------
	| Validation Language Lines
	|--------------------------------------------------------------------------
	|
	| The following language lines contain the default error messages used by
	| the validator class. Some of these rules have multiple versions such
	| as the size rules. Feel free to tweak each of these messages here.
	|
	*/

	"accepted"             => ":attribute deve essere accettato.",
	"active_url"           => ":attribute non è un link valido.",
	"after"                => ":attribute deve essere una data successiva a :date.",
	"alpha"                => ":attribute può contenere solo lettere.",
	"alpha_dash"           => ":attribute può contenere solo lettere, numeri o trattini.",
	"alpha_num"            => ":attribute può contenere solo lettere e numeri.",
	"array"                => ":attribute devee essere un array.",
	"before"               => ":attribute deve essere una data precedente a :date.",
	"between"              => array(
		"numeric" => ":attribute deve essere tra :min e :max.",
		"file"    => "The :attribute deve essere tra :min e :max kilobytes.",
		"string"  => "The :attribute deve essere lungo tra :min e :max caratteri.",
		"array"   => "The :attribute deve avere tra :min e :max elementi.",
	),
	"confirmed"            => ":attribute conferma non corrisponde.",
	"date"                 => ":attribute non è una data valida.",
	"date_format"          => ":attribute non corrisponde a questo formato :format.",
	"different"            => ":attribute e :other devono essere differenti.",
	"digits"               => ":attribute deve essere di :digits cifre.",
	"digits_between"       => ":attribute deve essere tra :min e :max cifre.",
	"email"                => ":attribute deve essere un indirizzo di email valido.",
	"exists"               => "Il :attribute selezionato non è valido.",
	"image"                => ":attribute deve essere un'immagine.",
	"in"                   => ":attribute non è valido.",
	"integer"              => ":attribute deve essere un intero.",
	"ip"                   => ":attribute deve essere un indirizzo IP valido.",
	"max"                  => array(
		"numeric" => ":attribute non può essere maggiore di :max.",
		"file"    => ":attribute non può essere maggiore di :max kilobytes.",
		"string"  => ":attribute non può essere più lungo di :max caratteri.",
		"array"   => ":attribute non può avere più di :max elementi.",
	),
	"mimes"                => ":attribute deve essere un file di tipo: :values.",
	"min"                  => array(
		"numeric" => ":attribute deve essere almeno :min.",
		"file"    => ":attribute deve essere almeno :min kilobytes.",
		"string"  => ":attribute deve essere lungo almeno :min characters.",
		"array"   => ":attribute deve avere almeno :min items.",
	),
	"not_in"               => "Il :attribute selezionato is invalid.",
	"numeric"              => ":attribute deve essere un numero.",
	"regex"                => "Il formato di :attribute non è valido.",
	"required"             => "Il campo :attribute è necessario.",
	"required_if"          => "Il campo :attribute quando :other è uguale a :value.",
	"required_with"        => "Il campo :attribute è richiesto quando :values è presente.",
	"required_with_all"    => "Il campo :attribute è richiesto quando :values è presente.",
	"required_without"     => "Il campo :attribute è richiesto quando :values non è presente.",
	"required_without_all" => "Il campo :attribute è richiesto quando nessuno dei :values sono presenti.",
	"same"                 => ":attribute e :other devono essere uguali.",
	"size"                 => array(
		"numeric" => ":attribute deve essere :size.",
		"file"    => ":attribute deve essere di :size kilobytes.",
		"string"  => ":attribute deve essere lungo :size caratteri.",
		"array"   => ":attribute deve contenere :size elementi.",
	),
	"unique"               => ":attribute è giò stato assegnato.",
	"url"                  => "Il formato di :attribute non è valido.",

	/*
	|--------------------------------------------------------------------------
	| Custom Validation Language Lines
	|--------------------------------------------------------------------------
	|
	| Here you may specify custom validation messages for attributes using the
	| convention "attribute.rule" to name the lines. This makes it quick to
	| specify a specific custom language line for a given attribute rule.
	|
	*/

	'custom' => array(
		'attribute-name' => array(
			'rule-name' => 'custom-message',
		),
	),

	/*
	|--------------------------------------------------------------------------
	| Custom Validation Attributes
	|--------------------------------------------------------------------------
	|
	| The following language lines are used to swap attribute place-holders
	| with something more reader friendly such as E-Mail Address instead
	| of "email". This simply helps us make messages a little cleaner.
	|
	*/

	'attributes' => array(),

);
