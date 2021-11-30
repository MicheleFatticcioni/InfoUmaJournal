<?php
function add_job_opportunity(){

    $data = $_POST['data'];

    $title = $data['title'];
    $name = $data['name'];
    $name_business = $data['name_business'];
    $email = $data['email'];
    $number = $data['number'];
    $inputAddress = $data['inputAddress'];
    $tipo_ricerca = $data['tipo-ricerca'];
    $durata = $data['time'];
    $tipo_figura = $data['tipo-figura'];
    $descrizione = $data['descrizione'];

    //14 assunzione
    //12 tirocinio
    if($tipo_ricerca === 'apprendistato' || $tipo_ricerca === 'part-time' || $tipo_ricerca === 'full-time'){
        $category = 'assunzione';
    } else{
        $category = 'tirocini';
    }

    $post_id = wp_insert_post( array(
            'post_author' => 0,
            'post_title' => $title,
            'post_status' => 'draft',
            'post_type' => 'offerte_lavoro',
            'tax_input'    => array(
                "offerte_di_lavoro" => $category
                )
        ) );

    update_post_meta( $post_id , 'nome_e_cognome', $name );
    update_post_meta( $post_id , 'nome_azienda', $name_business );
    update_post_meta( $post_id , 'email', $email );
    update_post_meta( $post_id , 'telefono', $number );
    update_post_meta( $post_id , 'indirizzo_della_sede', $inputAddress );
    update_post_meta( $post_id , 'tipo_di_ricerca', $tipo_ricerca );
    if($data !== ''){
        update_post_meta( $post_id , 'durata_del_rapporto', $durata );
    }
    
    update_post_meta( $post_id , 'figura_ricercata', $tipo_figura );
    update_post_meta( $post_id , 'descrizione_del_lavoro', $descrizione );
    update_post_meta( $post_id , 'privacy_policy', true );
   
    $messaggio = 'Gentile '. $name . ' grazie per averci inviato la tua offerta di lavoro. Il tuo annunncio sarà presto pubblicato';
    $headers = array('Content-Type: text/html; charset=UTF-8');
    if($post_id != 0 || is_int($post_id)){
        wp_mail('michelefatticcioni@gmail.com', 'Invio offerta di lavoro', $messaggio, $headers);
    }
    return $post_id;
    exit;
}

add_action( 'wp_ajax_add_job_opportunity', 'add_job_opportunity');
add_action( 'wp_ajax_nopriv_add_job_opportunity', 'add_job_opportunity');



function handler_number_of_readings(){
    $post_ID = $_POST['post_id'];
    echo $post_ID;
    $number_of_readings_post_meta = get_post_meta($post_ID, 'number_of_readings');
    if(!$number_of_readings_post_meta){
        add_post_meta( $post_ID, 'number_of_readings', 1);
    } else{
        $reading = 1 + intval($number_of_readings_post_meta[0]);
        update_post_meta( $post_ID, 'number_of_readings', $reading );
    }
    exit();
}


add_action( 'wp_ajax_handler_number_of_readings', 'handler_number_of_readings');
add_action( 'wp_ajax_nopriv_handler_number_of_readings', 'handler_number_of_readings');