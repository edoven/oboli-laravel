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
                'address' => '__DA AGGIUNGERE__',
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
                'address' => '__DA AGGIUNGERE__',
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
                'address' => '__DA AGGIUNGERE__',
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
                'address' => '__DA AGGIUNGERE__',
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
                'address' => '__DA AGGIUNGERE__',
                'website' => 'https://www.fondazioneveronesi.it/',
                'phone' => '+39060606',
                'email' => 'info@fondazioneveronesi.it'));

        Ngo::create(array(
                'name' => 'Armadilla SCS',
                'name_short' => 'armadilla',
                'short_description' => 'A sostegno dei più deboli',
                'long_description' => 'Armadilla è una Cooperativa Sociale Onlus, nata nel 1984 per ideare e produrre strumenti divulgativi a sostegno delle attività di educazione allo sviluppo e svolgere iniziative a beneficio delle fasce più deboli della popolazione. Il suo lavoro si sviluppa anche nell\'ambito della cooperazione internazionale. Il nome “Armadilla” nasce dal nostro impegno in America Latina, con le popolazioni indigene locali, le quali credono che ogni persona abbia la propria esistenza legata ad un  animale, da cui ottiene le proprie capacità naturali e talenti. L\'associazione ha scelto l\'armadillo perchè è in grado di difendersi efficacemente dai nemici soprattutto grazie all\'armatura che lo ricopre.',
                'oboli_count' => 0,
                'donations_count' => 0,
                'donors' => 0,
                'area' => 'grow',
                'address' => 'Via Botero 16a - 00179 Roma (Italia)',
                'website' => 'http://www.armadilla.coop/',
                'phone' => '+390697619575',
                'email' => 'info@armadilla.coop/'));


        Ngo::create(array(
                'name' => 'Fondazione Risorsa Donna',
                'name_short' => 'risorsadonna',
                'short_description' => 'Promuovere e favorire la donna',
                'long_description' => 'La Fondazione nasce dalla volontà di promuovere e favorire la donna quale motore virtuoso della società e della famiglia. L\'attenzione è rivolta in particolare a tutte quelle donne che, per motivi economici o sociali, sono escluse dai processi di sviluppo, offrendo loro opportunità e strumenti per ottenere, nelle singole realtà in cui vivono, l\'accesso al capitale, alle informazioni, alle tecnologie, ai mercati. La Fondazione pertanto si propone come soggetto per lo sviluppo della cultura del risparmio, della finanza, dell\'imprenditoria delle donne, nonché per la promozione del valore della solidarietà femminile, principalmente attraverso azioni specifiche nel settore del microcredito e della finanza etica.',
                'oboli_count' => 0,
                'donations_count' => 0,
                'donors' => 0,
                'area' => 'women',
                 'address' => 'Viale Aventino, 36 - 00153 Roma (Italia)',
                'website' => 'http://www.fondazionerisorsadonna.it/',
                'phone' => '+390657289655',
                'email' => 'info@fondazionerisorsadonna.it/'));


        Ngo::create(array(
                'name' => 'Murialdo World Onlus',
                'name_short' => 'murialdo',
                'short_description' => 'Progetti umanitari nel mondo',
                'long_description' => 'Murialdo World è un\'associazione senza scopo di lucro nata per coordinare i progetti umanitari del Consiglio Generale dei Giuseppini nel mondo. Progetta e gestisce le attività di solidarietà internazionale del Consiglio Generale e coordina quelle che la Congregazione realizza attraverso le proprie strutture territoriali. Sostiene e valorizza i giovani, specie quelli in difficoltà, offrendo opportunità di gioco, apprendimento, preghiera e anche lavoro, attraverso il progetto Ekuò Impresa Sociale. Valorizza e sviluppa le realtà già esistenti e attive, come ENGIM internazionale, con la quale lavora in stretta collaborazione per un reciproco ampliamento dei settori d\'intervento. Ottimizzia le attività di comunicazione e amministrazione del Consiglio Generale della Congregazione, per renderne l\'azione più efficace e migliorare le sinergie con le Province giuseppine.',
                'oboli_count' => 0,
                'donations_count' => 0,
                'donors' => 0,
                'area' => 'humrights',
                'address' => 'Via Belvedere Montello, 77 - 00166 Roma (Italia)',
                'website' => 'http://www.murialdoworld.org/',
                'phone' => '+39066247144',
                'email' => 'info@murialdoworld.org'));


        Ngo::create(array(
                'name' => 'SAL Onlus',
                'name_short' => 'sal',
                'short_description' => 'Per l\'America Latina',
                'long_description' => 'Solidarietà con l\'America Latina Onlus è sensibile e solidale con le aspirazioni e gli impegni di giustizia e pace dei popoli dell\'America Latina e del mondo, collaborando attivamente ai processi storici di liberazione, nella cultura della non violenza; agisce sulle cause che generano sfruttamento e ingiustizia nel sud e nel nord del mondo attraverso la promozione dei valori fondamentali della solidarietà, della partecipazione e della cooperazione; Collabora con altre organizzazioni che abbiano la stessa finalità per poter più efficacemente prendere coscienza, contrastare e costruire alternative alla cultura del profitto e dell\'individualismo che produce sfruttamento e oppressione. I progetti di sviluppo e aiuto umanitario nascono dall\'incontro, dal dialogo e dalla condivisione con le realtà locali dei Paesi in cui l\'associazione è presente. Lo scambio e la condivisione sono la fonte attraverso la quale individua, insieme ai referenti locali, esigenze e necessità.',
                'oboli_count' => 0,
                'donations_count' => 0,
                'donors' => 0,
                'area' => 'humrights',
                'address' => 'Via Federico De Roberto, 33 - 00137 Roma (Italia)',
                'website' => 'http://www.saldelatierra.org/',
                'phone' => '+393491417080',
                'email' => 'info@saldelatierra.org'));


        Ngo::create(array(
                'name' => 'FVGS Onlus',
                'name_short' => 'fvgs',
                'short_description' => 'Solidarietà sociale religiosa',
                'long_description' => 'La Fondazione Volontariato Giovani e Solidarietà ONLUS, nel solco della tradizione cattolica e alla luce della dottrina sociale e dei principi della Chiesa, persegue esclusivamente finalità di solidarietà sociale e intende sostenere e favorire lo sviluppo integrale della persona. Si propone di promuovere la ricerca e le attività riguardanti i diritti della donna e dei bambini nei paesi in via di sviluppo. Inoltre promuove i programmi di educazione allo sviluppo e di volontariato sociale a favore dei giovani più emarginati e sostiene le attività di ricerca, di sperimentazione e di formazione nel campo del volontariato giovanile.',
                'oboli_count' => 0,
                'donations_count' => 0,
                'donors' => 0,
                'area' => 'humrights',
                'address' => 'Via Gregorio VII, 133 - 00165 Roma (Italia)',
                'website' => 'http://www.vides.org/',
                'phone' => '+390639379861',
                'email' => 'direzione.generale@vides.org'));


        Ngo::create(array(
                'name' => 'Intersos Onlus',
                'name_short' => 'intersos',
                'short_description' => 'Solidarietà in prima linea',
                'long_description' => 'Intersos Onlus è un\'organizzazione che opera a favore delle popolazioni in pericolo, vittime di calamità naturali e di conflitti armati. Fondata nel 1992 con il sostegno delle Confederazioni sindacali italiane, basa la sua azione sui valori della solidarietà, della giustizia, della dignità della persona, dell\'uguaglianza dei diritti e delle opportunità per tutti i popoli, del rispetto delle diversità, della convivenza, dell\'attenzione ai più deboli e indifesi. L\'associazione aderisce ai codici di condotta internazionali delle organizzazioni umanitarie e ai valori e principi in essi contenuti. Intersos è un\'associazione indipendente che, con i propri operatori umanitari, interviene per dare risposte efficaci alle popolazioni che soffrono, private dei diritti, della dignità e dei beni essenziali nelle gravi crisi che si sviluppano particolarmente nelle regioni più povere del mondo. Mantiene una struttura operativa flessibile.',
                'oboli_count' => 0,
                'donations_count' => 0,
                'donors' => 0,
                'area' => 'humrights',
                'address' => 'Via Aniene 26a - 00198 Roma (Italia)',
                'website' => 'http://intersos.org/',
                'phone' => '+39068537431',
                'email' => 'intersos@intersos.org'));

        Ngo::create(array(
                'name' => 'Progetto Continenti',
                'name_short' => 'prcontinenti',
                'short_description' => 'Diritto, giustizia e dignità',
                'long_description' => 'Progetto Continenti è una ONG di solidarietà e Cooperazione Internazionale. Associazione laica, aconfessionale, apartitica e senza fini di lucro, è stata costituita nel 1989 ed è tra i fondatori di Banca Popolare Etica. L\'Associazione si propone che il diritto, la giustizia e la dignità degli uomini di tutti i continenti siano affermati come ineludibili criteri fondativi di un mondo diverso e finalmente umano. L\'associazione intende esprimere ed operare per l\'autosviluppo dei popoli scegliendo l\'alternativa necessaria e possibile della pace, della solidarietà e della condivisione. Progetto Continenti  propone il superamento della cultura prevalente di competizione e di dominio, che ha causato fin qui l\'insostenibile divario tra i paesi poveri dell\'emisfero Sud e i paesi ricchi dell\'emisfero Nord che pure soffrono anch\'essi di crisi economiche e sociali sempre più estese.',
                'oboli_count' => 0,
                'donations_count' => 0,
                'donors' => 0,
                'area' => 'grow',
                'address' => 'via Antonino Pio, 40 - 00145 Roma (Italia)',
                'website' => 'http://www.progettocontinenti.org/',
                'phone' => '+390659600319',
                'email' => 'info@progettocontinenti.org'));


        Ngo::create(array(
                'name' => 'Semi di Pace',
                'name_short' => 'semidipace',
                'short_description' => 'La solidarietà mette radici',
                'long_description' => 'L\'Associazione Umanitaria Semi di Pace è nata a Tarquinia nel maggio del 1980 dall\'esperienza di un gruppo di giovani ed adolescenti che, attraverso la musica e il canto, riuscirono a coinvolgere, sempre più, bambini e ragazzi in attività di solidarietà. Pace, fratellanza e unità tra i singoli e i popoli furono e sono i valori che hanno ispirato il cammino in tutti questi anni. Oggi, all\'interno dell\'Associazione, persone appartenenti a diverse confessioni religiose e culture si riconoscono nella passione comune del mettersi al servizio dei più bisognosi. L\'azione di Semi di Pace non si ferma all\'Italia, ma guarda lontano, ai paesi dove povertà, mancanza di istruzione, guerre e calamità naturali sono cause di grandi sofferenze. L\'associazione ha sedi e servizi in Italia, Romania, Spagna, Repubblica Dominicana, Messico, Perù, Burundi e Repubblica Democratica del Congo, Gran Bretagna, India e sostiene questi paesi con progetti di sostegno a distanza, favorisce interventi finalizzati alla costruzione o alla ristrutturazione di case di accoglienza, scuole, ambulatori, mense e opera per garantire la tutela dei diritti umani basilari.',
                'oboli_count' => 0,
                'donations_count' => 0,
                'donors' => 0,
                'area' => 'grow',
                'address' => 'La Cittadella, loc. Vigna del Piano snc – 01016 Tarquinia (Italia)',
                'website' => 'http://www.semidipace.it/',
                'phone' => '+390766842709',
                'email' => 'segreteria@semidipace.org'));


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
