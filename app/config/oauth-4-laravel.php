return array( 

    /*
    |--------------------------------------------------------------------------
    | oAuth Config
    |--------------------------------------------------------------------------
    */

    /**
     * Storage
     */
    'storage' => 'Session', 

    /**
     * Consumers
     */
    'consumers' => array(

        /**
         * Facebook
         */
        'Facebook' => array(
            'client_id'     => '1431680553720896',
            'client_secret' => 'bcd659324dd0c2dce6dde856ccf4c2ca',
            'scope'         => array('email','read_friendlists','user_online_presence'),
        ),      

    )

);
