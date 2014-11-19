<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		//$this->call('UserTableSeeder');
        //$this->command->info('User table seeded!');

        $this->call('BrandsTableSeeder');
        $this->command->info('Brands table seeded!');

        $this->call('ProductsTableSeeder');
        $this->command->info('Products table seeded!');     

        $this->call('NgosTableSeeder');
        $this->command->info('Ngos table seeded!');

        $this->call('CodesTableSeeder');
        $this->command->info('Codes table seeded!');
	}

}



//~ class UserTableSeeder extends Seeder {
//~ 
    //~ public function run()
    //~ {
        //~ DB::table('users')->delete();
        //~ 
        //~ Eloquent::unguard();  #this is for MassAssignmentException
        //~ 
        //~ User::create(array('email' => 'edoardo.venturini@gmail.com', 
						   //~ 'name' => 'edoardo',
						   //~ 'password' => Hash::make('password'),
						   //~ 'oboli_count' => 200),
						   //~ 'confirmed' => 1,
						   //~ 'confirmation_code' => 'aabbcc'));
						   //~ 
        //~ User::create(array('email' => 'aldodelbo@gmail.com', 
						   //~ 'name' => 'aldo', 
						   //~ 'password' => Hash::make('password'),
						   //~ 'oboli_count' => 200),
						   //~ 'confirmed' => 1,
						   //~ 'confirmation_code' => 'aabbcc'));
						   //~ 
        //~ User::create(array('email' => 'd.mauriello@gmail.com', 
						   //~ 'name' => 'davide', 
						   //~ 'password' => Hash::make('password'),
						   //~ 'oboli_count' => 200),
						   //~ 'confirmed' => 1,
						   //~ 'confirmation_code' => 'aabbcc'));
    //~ }
    //~ 
//~ }



class NgosTableSeeder extends Seeder {

    public function run()
    {
        DB::table('ngos')->delete();
        
        Eloquent::unguard();  #this is for MassAssignmentException

        //id=1
        Ngo::create(array(
                'name' => 'Amici dei Bambini',
                'name_short' => 'aibi',
							  'short_description' => 'Contro l\'abbandono dei minori',
							  'long_description' => 'Amici dei Bambini interviene laddove si manifesta l\'abbandono: negli orfanotrofi, nei centri di assistenza, nelle strade, nelle famiglie. La nostra missione è tentare di dare ad ogni bambino abbandonato una famiglia, per garantire il suo diritto di essere figlio. L’abbandono minorile è la quarta emergenza umanitaria del XXI secolo e Amici dei Bambini lotta ogni giorno per combattere questa emergenza. Gli obiettivi della nostra lotta sono: prevenire l’abbandono; sospendere l’abbandono; superare l’abbandono; l’inserimento nella società post-abbandono e ppromuovere la cultura dell’accoglienza.',
							  'oboli_count' => 0,
							  'donations_count' => 0,
							  'donors' => 0,
							  'cover_image' => 'aibi.jpg',
                'area' => 'children',
                'website' => 'www.amnesty.com',
                'phone' => '+39060606',
                'email' => 'info@amnesty.com'));	
        //id=2				   
        Ngo::create(array(
                'name' => 'Associazione Italiana Donne per lo Sviluppo',
                'name_short' => 'aidos',
							  'short_description' => 'Per i diritti, la dignità e la libertà di scelta di tutte le donne',
							  'long_description' => 'Fin dalla sua fondazione, AIDOS lavora - nei paesi in via di sviluppo, in Italia e nelle sedi internazionali - per costruire, promuovere e difendere i diritti, la dignità e la libertà di scelta di tutte le donne. Di progetto in progetto e di campagna in campagna, AIDOS lavora in partenariato con organizzazioni e istituzioni locali, per fornire strumenti alle donne e alle loro organizzazioni, soprattutto nei settori in cui l\'esperienza del movimento femminile in Italia ha dato i frutti più significativi. L\'approccio di AIDOS nasce quindi dal dialogo ininterrotto e paritario con le organizzazioni femminili e non governative di tutto il mondo e dalle radici nel movimento femminista italiano.',
							  'oboli_count' => 0,
							  'donations_count' => 0,
							  'donors' => 0,
							  'cover_image' => 'aidos.jpg',
                'area' => 'women',
                'website' => 'www.msf.com',
                'phone' => '+39060606',
                'email' => 'info@msf.com'));
        //id=3
		Ngo::create(array(
                'name' => 'Associazione Nazionale Protezione Ambiente Natura e Animali',
                'name_short' => 'anpana',
							  'short_description' => 'Per la protezione degli animali, della natura e dell’ambiente',
							  'long_description' => 'L’Associazione Nazionale Protezione Animali, Natura e Ambiente è iscritta su tutto il territorio Nazionale agli Albi Regionali per il Volontariato, per la Protezione Animali, Ambiente e per la Protezione Civile. Le finalità dell’Associazione sono: proteggere gli animali, la natura e l’ambiente in generale. Oltre a questo effettua un’idonea vigilanza sull\'osservanza delle leggi e dei regolamenti generali e locali, relativi alla salvaguardia della natura, dell’ambiente e degli animali. Provvede alla difesa del patrimonio zootecnico ittico e di qualsiasi altra forma di vita del pianeta, avvalendosi di proprie Guardie adeguatamente preparate che agiscono di concerto e a sostegno delle Istituzioni e Corpi di Vigilanza dello Stato (Carabinieri, Polizia, C.F.S., G.d.F., Polizia Municipale etc.).',
							  'oboli_count' => 0,
							  'donations_count' => 0,
							  'donors' => 0,
                'area' => 'animals',
							  'cover_image' => 'anpana.jpg',
                'website' => 'www.libera.com',
                'phone' => '+39060606',
                'email' => 'info@libera.com'));	
        //id=4
		Ngo::create(array(
                'name' => 'Comitato Europero per la Formazione e l\'Agricoltura',
                'name_short' => 'cefa',
							  'short_description' => 'Per lo sviluppo di comunità e istituzioni nei paesi poveri',
							  'long_description' => 'Il CEFA fonda la propria missione sullo sviluppo delle comunità e delle istituzioni locali in paesi tra i più poveri del mondo, attraverso il miglioramento delle economie familiari e comunitarie, la valorizzazione delle risorse umane, azioni di formazione e di riconoscimento dei diritti fondamentali dell\'uomo. Desiderio e volontà del CEFA è che ogni uomo nel mondo sia protagonista dello sviluppo, non solo economico ma di tutta la persona, per essere soggetto attivo di democrazia e di pace. Il CEFA fonda la propria missione sullo sviluppo delle comunità e delle istituzioni locali in paesi tra i più poveri del mondo, attraverso il miglioramento delle economie familiari e comunitarie, la valorizzazione delle risorse umane, azioni di formazione e di riconoscimento dei diritti fondamentali dell\'uomo. Accorda priorità al raggiungimento dell\'autosufficienza alimentare e all\'effettivo rispetto dei diritti primari.',
							  'oboli_count' => 0,
							  'donations_count' => 0,
							  'donors' => 0,
                'area' => 'environment',
							  'cover_image' => 'cefa.jpg',
                'website' => 'www.wwf.com',
                'phone' => '+39060606',
                'email' => 'info@wwf.com'));
        //id=5
        Ngo::create(array(
                'name' => 'Armadilla Cooperativa Sociale',
                'name_short' => 'armadilla',
                'short_description' => 'Per l\'integrazione di minori immigrati',
                'long_description' => 'Dal 1996 Armadilla gestisce, all’interno del Centro “Armadillo”, un progetto di sostegno all’integrazione di minori immigrati, in convenzione con l’Ufficio Immigrazione del Comune di Roma.',
                'oboli_count' => 0,
                'donations_count' => 0,
                'donors' => 0,
                'area' => 'children',
                'cover_image' => 'armadilla.jpg',
                'website' => 'www.wwf.com',
                'phone' => '+39060606',
                'email' => 'info@wwf.com'));

        Ngo::create(array(
                'name' => 'Fondazione Umberto Veronesi',
                'name_short' => 'veronesi',
                'short_description' => 'Fondazione per il sostegno alla ricerca scientifica',
                'long_description' => 'La Fondazione Umberto Veronesi nasce nel 2003 allo scopo di sostenere la ricerca scientifica, attraverso l’erogazione di borse di ricerca per medici e ricercatori e il sostegno a progetti di altissimo profilo. Ne sono promotori scienziati (tra i quali ben 11 premi Nobel che ne costituiscono il  Comitato d’onore) il cui operato è riconosciuto a livello internazionale.',
                'oboli_count' => 0,
                'donations_count' => 0,
                'donors' => 0,
                'area' => 'health',
                'cover_image' => 'veronesi.jpg',
                'website' => 'https://www.fondazioneveronesi.it/',
                'phone' => '+39060606',
                'email' => 'info@fondazioneveronesi.it'));


	}
    
    
}



//~ class DonationTableSeeder extends Seeder {
//~ 
    //~ public function run()
    //~ {
        //~ DB::table('donations')->delete();
        //~ 
        //~ Eloquent::unguard();  #this is for MassAssignmentException
        //~ 
        //~ Donation::create(array('user_id' => '1', 'project_id' => '1', 'amount' => '12'));
		//~ Donation::create(array('user_id' => '1', 'project_id' => '2', 'amount' => '5'));
		//~ Donation::create(array('user_id' => '1', 'project_id' => '2', 'amount' => '7'));
		//~ Donation::create(array('user_id' => '2', 'project_id' => '1', 'amount' => '15'));
		//~ Donation::create(array('user_id' => '2', 'project_id' => '3', 'amount' => '2'));
		//~ Donation::create(array('user_id' => '3', 'project_id' => '2', 'amount' => '4'));
    //~ }
    //~ 
//~ }


class BrandsTableSeeder extends Seeder {

    public function run()
    {
        DB::table('brands')->delete();
        
        Eloquent::unguard();  #this is for MassAssignmentException
        
        Brand::create(array('name' => 'coca cola'));     // id=1
        Brand::create(array('name' => 'mulino bianco')); // id=2
        Brand::create(array('name' => 'garnier'));       // id=3
    }
    
}


class ProductsTableSeeder extends Seeder {

    public function run()
    {
        DB::table('products')->delete();
        
        Eloquent::unguard();  #this is for MassAssignmentException

        Product::create(array('name' => 'lattina coca cola 33',         'brand' => 1));
        Product::create(array('name' => 'crostatine al cioccolato',     'brand' => 2));
        Product::create(array('name' => 'tegolini formato familiare',   'brand' => 2));
        Product::create(array('name' => 'shampoo effetto seta',         'brand' => 3));
    }
    
}


class CodesTableSeeder extends Seeder {

    public function run()
    {
        DB::table('codes')->delete();
        
        Eloquent::unguard();  #this is for MassAssignmentException
        
        Code::create(array('id' => '54657IUedfi', 'product' => 1, 'oboli' => '120'));
        Code::create(array('id' => '775fgfgUedf', 'product' => 1, 'oboli' => '100'));
        Code::create(array('id' => 'dghncedfifd', 'product' => 2, 'oboli' => '152'));
        Code::create(array('id' => '5ytgffdfijh', 'product' => 2, 'oboli' => '230'));
        Code::create(array('id' => 'erwrtdfifdj', 'product' => 3, 'oboli' => '760'));       
        Code::create(array('id' => 'eqrth453fs0', 'product' => 3, 'oboli' => '887'));
        Code::create(array('id' => '000', 		  'product' => 3, 'oboli' => '100'));
        Code::create(array('id' => 'reyhjdfhg67', 'product' => 4, 'oboli' => '654'));

    }
    
}
