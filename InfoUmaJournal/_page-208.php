<?php 
/**
 *NOTA PER EVENTUALI MODIFICHE AL FORM
 *LA MODIFICA, L'ELIMINAZIONE O L'AGGIUNTA DI UN NUOVO CAMPO DOVRà SEGUIRE ANCHE UNA MODIFICA AL FILE AJAX-FUNCTION.PHP 
 *GLI ID DEGLI INPUT SONO UTILIZZATI CON INDICI DI UN ARRAY NEL FILE
 */
get_header();

?>
<main class="container my-5">

	<form class="row g-3 needs-validation" id="formJob">
		<div class="col-md-12">
			<label for="title" class="form-label">Titolo annuncio <span class="">*</span></label>
			<input type="text" class="form-control" id="title" data-required="required">
			<div class="invalid-feedback">Inserisci il tuo nome e il tuo cognome</div>
		</div>
		<div class="col-md-6">
			<label for="name" class="form-label">Nome e cognome <span class="">*</span></label>
			<input type="text" class="form-control" id="name" data-required="required">
			<div class="invalid-feedback">Inserisci il tuo nome e il tuo cognome</div>
		</div>
		<div class="col-md-6">
			<label for="name_business" class="form-label">Nome dell'azienda <span class="">*</span></label>
			<input type="text" class="form-control" id="name_business"  data-required="required">
			<div class="invalid-feedback">Inserisci il nome dell'azienda</div>
		</div>
		<div class="col-md-6">
			<label for="inputEmail4" class="form-label">Email <span class="">*</span></label>
			<input type="email" class="form-control" id="email"  data-required="required">
			<div class="invalid-feedback">Inserisci la mail</div>
		</div>
		<div class="col-md-6">
			<label for="number" class="form-label">Telefono <span class="">*</span></label>
			<input type="number" class="form-control" id="number"  data-required="required">
			<div class="invalid-feedback">Inserisci il numero dell'azienda</div>
		</div>
		<div class="col-12">
			<label for="inputAddress" class="form-label">Indirizzo <span class="">*</span></label>
			<input type="text" class="form-control" id="inputAddress" data-required="required">
			<div class="invalid-feedback">Inserisci l'indirizzo completo</div>
		</div>
		<div class="col-md-4">
			<label for="tipo-ricerca" class="form-label">Tipo di ricerca <span class="">*</span></label>
			<select id="tipo-ricerca" class="form-control form-select"  data-required="required">
				<option selected value=""></option>
				<option value="tirocinio_curriculare">Tirocinio curriculare</option>
				<option value="tirocinio_extracurriculare">Tirocinio extracurriculare</option>
				<option value="apprendistato">Apprendistato</option>
				<option value="part-time">Part time</option>
				<option value="full-time">Full time</option>
			</select>
			<div class="invalid-feedback">Specifica il tipo di ricerca</div>
		</div>
		<div class="col-md-2">
			<label for="time" class="form-label">Durata stimata</label>
			<input type="text" class="form-control" id="time">
		</div>
		<div class="col-md-6">
			<label for="tipo-figura" class="form-label">Figura ricercata <span class="">*</span></label>
			<input type="text" class="form-control" id="tipo-figura"  data-required="required">
			<div class="invalid-feedback">Specifica il tipo di figura</div>
		</div>
		<div class="col-md-12">
			<label for="descrizione" class="form-label">Descrizione del lavoro <span class="">*</span></label>
			<div class="form-floating">
				<textarea class="form-control" id="descrizione" style="height: 100px"  data-required="required"></textarea>
				<label class="small">Descrivere in modo esaustivo l'azienda ed il tipo di figura ricercata</label>
				<div class="invalid-feedback">Inserisci la tua offerta</div>
			</div>
		</div>
			
		<div class="col-12">
			<div class="form-check">
				<input class="form-check-input" type="checkbox" id="policy" >
				<label class="form-check-label" for="gridCheck">
					Inviando l'offerta di lavoro accetto la <a href="#">privacy policy</a>
				</label>
				<div class="invalid-feedback">Accetta la privacy</div>
			</div>
		</div>
		<div class="col-12">
			<button type="button" disabled id="jobOffert" class="btn btn-primary">Invio offerta</button>
		</div>
		<div id="error"></div>
	</form>
</main>


<?php get_footer(); ?>