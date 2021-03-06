<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
        $this->call('NgosTableSeeder');
        $this->command->info('Ngos table seeded!');
        
        $this->call('BrandsTableSeeder');
        $this->command->info('Brands table seeded!');

        $this->call('ProductsTableSeeder');
        $this->command->info('Products table seeded!');     
	}

}

class ProductsTableSeeder extends Seeder {
    public function run()
    {
        DB::table('products')->delete();
        Eloquent::unguard();  #this is for MassAssignmentException
        Product::create(array('name' => 'Oboli per testare Oboli',         'brand' => 1)); //id = 1
    }   
}


class CodesTableSeeder extends Seeder {
    public function run()
    {
        DB::table('codes')->delete();
        Eloquent::unguard();  #this is for MassAssignmentException
    }  
}


class NgosTableSeeder extends Seeder {

    public function run()
    {
        DB::table('ngos')->delete();      
        Eloquent::unguard();  #this is for MassAssignmentException
        
        Ngo::create(array(
                'name' => 'Amici dei Bambini',
                'name_short' => 'aibi',
                'short_description' => 'Contro l\'abbandono dei minori',
                'middle_description' => 'Interviene laddove si manifesta l\'abbandono: negli orfanotrofi, nei centri di assistenza, nelle strade, nelle famiglie.',
                'long_description' => 'La missione dell\'associazione è tentare di dare ad ogni bambino abbandonato una famiglia, per garantire il suo diritto di essere figlio. L\'abbandono minorile è la quarta emergenza umanitaria del XXI secolo e Amici dei Bambini lotta ogni giorno per combattere questa emergenza. Gli obiettivi di questa lotta sono: prevenire, sospendere e superare l\'abbandono; accompagnare il bambino nell\'inserimento nella società e promuovere la cultura dell\'accoglienza.',
                'oboli_count' => 0,
                'donations_count' => 0,
                'donors' => 0,
                'cover_image' => 'aibi.jpg',
                'area' => 'children',
                'address' => 'Via Marignano 18 – 20098 Mezzano di San Giuliano Milanese (Milano)',
                'website' => 'www.aibi.it',
                'phone' => '+39 02988221',
                'email' => 'aibi@aibi.it'));    
               
        Ngo::create(array(
                'name' => 'Associazione Italiana Donne per lo Sviluppo',
                'name_short' => 'aidos',
                'short_description' => 'Per i diritti e la libertà di tutte le donne',
                'middle_description' => 'Lavora a livello internazionale per costruire, promuovere e difendere i diritti, la dignità e la libertà di scelta di tutte le donne.',
                'long_description' => 'Fin dalla sua fondazione, AIDOS lavora nei paesi in via di sviluppo, in Italia e nelle sedi internazionali per costruire, promuovere e difendere i diritti, la dignità e la libertà di scelta di tutte le donne. Di progetto in progetto e di campagna in campagna, AIDOS lavora in partenariato con organizzazioni e istituzioni locali per fornire strumenti alle donne e alle loro organizzazioni, soprattutto nei settori in cui l\'esperienza del movimento femminile in Italia ha dato i frutti più significativi. L\'approccio di AIDOS nasce quindi dal dialogo ininterrotto e paritario con le organizzazioni femminili e non governative di tutto il mondo e dalle radici nel movimento femminista italiano.',
                'oboli_count' => 0,
                'donations_count' => 0,
                'donors' => 0,
                'cover_image' => 'aidos.jpg',
                'area' => 'women',
                'address' => 'Via dei Giubbonari 30  – 00186 Roma (Italia)',
                'website' => 'www.aidos.it',
                'phone' => '+39 066873214',
                'email' => 'segreteria@aidos.it'));

        Ngo::create(array(
                'name' => 'A.N. Protezione Ambiente Natura e Animali',
                'name_short' => 'anpana',
                'short_description' => 'Per la protezione degli animali, della natura e dell\'ambiente',
                'middle_description' => 'Iscritta su tutto il territorio nazionale agli albi regionali per il volontariato, per la protezione animali, ambiente e per la protezione civile.',
                'long_description' => 'Le finalità dell\'Associazione sono: proteggere gli animali, la natura e l\'ambiente in generale. Inoltre effettua un\'idonea vigilanza sull\'osservanza delle leggi e dei regolamenti generali e locali, relativi alla salvaguardia della natura, dell\'ambiente e degli animali. Provvede alla difesa del patrimonio zootecnico ittico e di qualsiasi altra forma di vita del pianeta, avvalendosi di proprio personale adeguatamente preparato che agisce di concerto e a sostegno delle Istituzioni e Corpi di Vigilanza dello Stato (Carabinieri, Polizia, Corpo Forestale dello Stato, Guardia di Finanza, Polizia Municipale etc.).',
                'oboli_count' => 0,
                'donations_count' => 0,
                'donors' => 0,
                'area' => 'animals',
                'cover_image' => 'anpana.jpg',
                'address' => 'Via Cornelio Sisenna 53 - 00169 Roma (Italia)',
                'website' => 'www.anpana.it',
                'phone' => '+39 062311036',
                'email' => 'info-anpana@anpana.it'));   

        Ngo::create(array(
                'name' => 'CEFA Onlus',
                'name_short' => 'cefa',
                'short_description' => 'Per lo sviluppo di comunità e istituzioni nei paesi poveri',
                'middle_description' => 'Fonda la propria missione sullo sviluppo delle comunità e delle istituzioni locali in paesi tra i più poveri del mondo.',
                'long_description' => 'Attraverso il miglioramento delle economie familiari e comunitarie, la valorizzazione delle risorse umane, azioni di formazione e di riconoscimento dei diritti fondamentali dell\'uomo, il CEFA aiuta lo sviluppo dei paesi più poveri. Desiderio e volontà del CEFA è che ogni uomo nel mondo sia protagonista dello sviluppo, non solo economico ma di tutta la società, per essere soggetto attivo di democrazia e di pace. Accorda priorità al raggiungimento dell\'autosufficienza alimentare e all\'effettivo rispetto dei diritti primari.',
                'oboli_count' => 0,
                'donations_count' => 0,
                'donors' => 0,
                'area' => 'environment',
                'cover_image' => 'cefa.jpg',
                'address' => 'Via Lame 118 - 40122 Bologna (Italia)',
                'website' => 'www.cefaonlus.it',
                'phone' => '+39 051520285',
                'email' => 'info@cefaonlus.it'));

        Ngo::create(array(
                'name' => 'Fondazione Hospice Seràgnoli',
                'name_short' => 'hospice',
                'short_description' => 'Contro la sofferenza inutile e per il rispetto della vita',
                'middle_description' => 'Si prendono cura gratuitamente dei pazienti inguaribili restituendo il diritto di vivere con dignità fino all\'ultimo momento.',
                'long_description' => 'La Fondazione Hospice MT. C. Seràgnoli Onlus è un ente privato senza scopo di lucro, nato nel 2002, che opera nel campo delle cure palliative con l\'obiettivo di rispondere ad un bisogno molto sentito all\'interno della società. Scopo principale della Fondazione è la creazione di un modello innovativo e di eccellenza per il supporto ai pazienti con malattie inguaribili. La Fondazione Hospice si prende cura gratuitamente del paziente e della sua famiglia. Questo è reso possibile dall\'accreditamento con il Servizio Sanitario Nazionale e dai contributi dei sostenitori. Accanto all\'attività assistenziale vera e propria, vengono avviati progetti di ricerca e formazione a livello nazionale, in collaborazione con enti e istituzioni scientifiche.',
                'oboli_count' => 0,
                'donations_count' => 0,
                'donors' => 0,
                'area' => 'health',
                'cover_image' => 'hospice.jpg',
                'address' => 'Via Guglielmo Marconi 43 - 40010 Bentivoglio, Bologna (Italia)',
                'website' => 'www.fondhs.org',
                'phone' => '+39 0518909611',
                'email' => 'info@fondazionehospiceseragnoli.org'));

        Ngo::create(array(
                'name' => 'CESVI',
                'name_short' => 'cesvi',
                'short_description' => 'Per lo sviluppo del sud del Mondo',
                'middle_description' => 'Organizzazione umanitaria laica e indipendente che opera per lo sviluppo dei paesi più poveri. Nata nel 1985, è attiva in più di 25 paesi.',
                'long_description' => 'Cesvi è un\'organizzazione umanitaria italiana, laica e indipendente, che opera per la solidarietà mondiale. Nata nel 1985, è attiva in tutti i continenti e in più di 25 paesi. Realizza progetti di cooperazione e sviluppo nei paesi più poveri del mondo, facendo della trasparenza e della valorizzazione delle risorse locali due aspetti fondamentali del suo lavoro. É impegnata soprattutto nella lotta alla fame e alle grandi pandemie, come malaria e Aids, nella difesa dei diritti dell\'infanzia, nella promozione del ruolo delle donne. Interviene inoltre nelle emergenze per portare un aiuto concreto alle popolazioni colpite da guerre e calamità.',
                'oboli_count' => 0,
                'donations_count' => 0,
                'donors' => 0,
                'area' => 'environment',
                'cover_image' => 'cesvi.jpg',
                'address' => 'via Broseta 68/a - 24128 Bergamo (Italia)',
                'website' => 'www.cesvi.org ',
                'phone' => '+39 0352058058',
                'email' => 'cesvi@cesvi.org'));

        Ngo::create(array(
                'name' => 'Fondazione Umberto Veronesi',
                'name_short' => 'veronesi',
                'short_description' => 'Sostiene la ricerca scientifica d\'eccellenza',
                'middle_description' => 'Rappresenta un punto di riferimento per la ricerca scientifica, la prevenzione e la diffusione di una cultura della salute.',
                'long_description' => 'La Fondazione Umberto Veronesi dal 2003 rappresenta un punto di riferimento di eccellenza
negli ambiti della ricerca scientifica, della prevenzione e della diffusione di una cultura della salute.
Ogni anno sostiene il lavoro di brillanti ricercatori nelle migliori università e centri di ricerca in tutta Italia, impegnati in campo oncologico, cardiologico e delle neuroscienze. Le borse di ricerca vengono assegnate ai ricercatori più meritevoli e ai progetti che offrono le applicazioni più concrete per la cura delle malattie.',
                'oboli_count' => 0,
                'donations_count' => 0,
                'donors' => 0,
                'area' => 'health',
                'cover_image' => 'veronesi.jpg',
                'address' => 'Piazza Velasca 5 - 20122 Milano (Italia)',
                'website' => 'www.fondazioneveronesi.it',
                'phone' => '+39 0276018187',
                'email' => 'info@fondazioneveronesi.it'));

        Ngo::create(array(
                'name' => 'Armadilla SCS',
                'name_short' => 'armadilla',
                'short_description' => 'A sostegno dei più deboli',
                'middle_description' => 'Nata nel 1984 per ideare e produrre strumenti divulgativi a sostegno delle attività di educazione allo sviluppo.',
                'long_description' => 'Armadilla è una cooperativa sociale ONLUS, nata nel 1984 per ideare e produrre strumenti divulgativi a sostegno delle attività di educazione allo sviluppo e svolgere iniziative a beneficio delle fasce più deboli della popolazione. Il suo lavoro si sviluppa anche nell\'ambito della cooperazione internazionale. Il nome “Armadilla” nasce dall\'impegno dell\'associazione in America Latina con le popolazioni indigene locali, le quali credono che ogni persona abbia la propria esistenza legata ad un animale, da cui ottiene le proprie capacità naturali e talenti. L\'associazione ha scelto l\'armadillo perchè è in grado di difendersi efficacemente dai nemici soprattutto grazie all\'armatura che lo ricopre.',
                'oboli_count' => 0,
                'donations_count' => 0,
                'donors' => 0,
                'area' => 'development',
                'address' => 'Via Botero 16a - 00179 Roma (Italia)',
                'website' => 'www.armadilla.coop',
                'phone' => '+39 0697619575',
                'email' => 'info@armadilla.coop'));

        Ngo::create(array(
                'name' => 'Fondazione Risorsa Donna',
                'name_short' => 'risorsadonna',
                'short_description' => 'Sostiene l\'inclusione socio-economica delle donne ',
                'middle_description' => 'Sostiene le donne escluse dai processi di sviluppo attraverso la formazione, offrendo opportunità e strumenti.',
                'long_description' => 'Costituitasi nel 2001, incoraggia le donne, attraverso lo strumento del microcredito, ad inserirsi all\'interno del contesto sociale ed economico dove vivono e per tale attività la Presidente della fondazione è stata insignita dell\'onorificenza di Commendatore della Repubblica nel 2007. Aiuta le donne, attraverso la formazione, allo sviluppo delle proprie competenze e conoscenze, offrendo loro opportunità di crescita; realizza ricerche sulla condizione delle donne e le pari opportunità in vari contesti per proporre azioni di miglioramento. Aderisce a reti quali: European Microfinance Network; Registro degli enti che svolgono attività a favore degli stranieri immigrati; Registro Nazionale degli enti e associazioni che svolgono attività nel campo della lotta alle discriminazioni razziali presso l\'UNAR.',
                'oboli_count' => 0,
                'donations_count' => 0,
                'donors' => 0,
                'area' => 'women',
                 'address' => 'Viale Aventino, 36 - 00153 Roma (Italia)',
                'website' => 'www.fondazionerisorsadonna.it',
                'phone' => '+39 0657289655',
                'email' => 'info@fondazionerisorsadonna.it'));

        Ngo::create(array(
                'name' => 'Centro Missionario Francescano',
                'name_short' => 'missfran',
                'short_description' => 'A sostegno delle missioni francescane',
                'middle_description' => 'Al servizio dei missionari e delle varie missioni sparse per i continenti, per dare sostegno e solidarietà agli ultimi.',
                'long_description' => 'Il Centro Missionario Francescano Onlus ha il compito di promuovere tutte le attività a sostegno delle missioni francescane dei frati conventuali. È prima di tutto a servizio dei missionari e le varie missioni sparse per i continenti, raccogliendo le necessità, i progetti di sostegno e solidarietà agli ultimi, portando gli aiuti raccolti in Italia. Organizza giornate, incontri e convegni missionari per animare gruppi di sostegno alle missioni.
Cura la pubblicazione di una rivista mensile per l\'informazione e la formazione di quanti amano e si impegnano per le missioni. Promuove, infine, gemellaggi tra comunità cristiane in Italia e giovani chiese delle missioni e propone il sostegno a distanza per bambini, famiglie e seminaristi sostenuti dai missionari francescani nel mondo. I Frati Minori Conventuali hanno oggi più di quaranta missioni sparse nel mondo.',
                'oboli_count' => 0,
                'donations_count' => 0,
                'donors' => 0,
                'area' => 'environment',
        'cover_image' => 'missfran.jpg',
                'address' => 'P.le Ss Pietro e Paolo, 8 – 00144 Roma (Italia)',
                'website' => 'www.missionariofrancescano.org',
                'phone' => '+39 069575214',
                'email' => 'centrmis@libero.it'));

        Ngo::create(array(
                'name' => 'Medicus Mondi Italia Onlus',
                'name_short' => 'memo',
                'short_description' => 'Per il miglioramento i servizi di salute di base',
                'middle_description' => 'Dal 1968 interviene nei Paesi più poveri del mondo per migliorare i servizi di salute di base e formare personale sanitario',
                'long_description' => 'Medicus Mundi Italia è una ONG per la cooperazione internazionale sanitaria. Fa parte di "Medicus Mundi International - Network Health for All", riconosciuto dall\'OMS. Collabora regolarmente con l\'A.O. Spedali Civili, l\'Università di Medicina e la Fondazione Poliambulanza di Brescia. Interviene in Paesi a risorse limitate per migliorare la qualità e l\'efficienza dei servizi socio-sanitari; in Burkina Faso, Burundi, Mozambico, Brasile, Ecuador, India si occupa di prevenzione ed educazione sanitaria, salute materno-infantile, lotta all\'HIV (inclusa la prevenzione della trasmissione madre-figlio), lotta alla malnutrizione infantile e formazione degli operatori socio sanitari. In Italia forma personale sanitario per la cura e il trattamentol di malattie tropicali e medicina delle migrazioni.',
                'oboli_count' => 0,
                'donations_count' => 0,
                'donors' => 0,
                'area' => 'environment',
                'cover_image' => 'memo.jpg',
                'address' => 'Via Martinengo da Barco 6/a – 25121 Brescia (Italia)',
                'website' => 'www.medicusmundi.it',
                'phone' => '+39 0303752517',
                'email' => 'promozione@medicusmundi.it'));

        Ngo::create(array(
                'name' => 'Murialdo World Onlus',
                'name_short' => 'murialdo',
                'short_description' => 'Gestisce la solidarietà dei missionari Giuseppini',
                'middle_description' => 'Coordina le attività di solidarietà che la Congregazione dei Giuseppini realizza da oltre 140 anni a favore dei più poveri.',
                'long_description' => 'Murialdo World onlus è un\'associazione senza scopo di lucro nata per coordinare e sviluppare i progetti umanitari del Consiglio Generale della Congregazione dei Giuseppini nel mondo. Progetta e gestisce le attività di solidarietà internazionale e promuove le iniziative che la Congregazione dei Giuseppini del Murialdo realizza attraverso le proprie strutture territoriali in 16 Nazioni diverse e da più di 140 anni.
Sostiene e valorizza i giovani, specie quelli più in difficoltà, offrendo opportunità di studio, gioco, apprendimento, preghiera e lavoro, anche attraverso l\'inserimento lavorativo giovanile nella nostra impresa sociale Ekuò. Cerca inoltre di ottimizzare le attività di comunicazione e di amministrazione del Governo Centrale della Congregazione, per renderne la sua azione più efficace e per migliorare le sinergie esistenti tra le diversioni missioni presenti nel mondo.',
                'oboli_count' => 0,
                'donations_count' => 0,
                'donors' => 0,
                'area' => 'humrights',
                'address' => 'Via Belvedere Montello, 77 - 00166 Roma (Italia)',
                'website' => 'www.murialdoworld.org',
                'phone' => '+39 066247144',
                'email' => 'info@murialdoworld.org'));

        Ngo::create(array(
                'name' => 'SAL Onlus',
                'name_short' => 'sal',
                'short_description' => 'Per l\'America Latina',
                'middle_description' => 'Collabora attivamente ai processi storici di liberazione, di giustizia e di pace dei popoli dell\'America Latina.',
                'long_description' => 'Solidarietà con l\'America Latina Onlus è sensibile e solidale con le aspirazioni e gli impegni di giustizia e pace dei popoli dell\'America Latina e del mondo, collaborando attivamente ai processi storici di liberazione, nella cultura della non violenza; agisce sulle cause che generano sfruttamento e ingiustizia nel sud e nel nord del mondo attraverso la promozione dei valori fondamentali della solidarietà, della partecipazione e della cooperazione. Collabora con altre organizzazioni che hanno la stessa finalità per poter più efficacemente prendere coscienza, contrastare e costruire alternative alla cultura del profitto e dell\'individualismo che produce sfruttamento e oppressione. I progetti di sviluppo e aiuto umanitario nascono dall\'incontro, dal dialogo e dalla condivisione con le realtà locali dei Paesi in cui l\'associazione è presente. Lo scambio e la condivisione sono la fonte attraverso la quale individua, insieme ai referenti locali, esigenze e necessità.',
                'oboli_count' => 0,
                'donations_count' => 0,
                'donors' => 0,
                'area' => 'humrights',
                'address' => 'Via Federico De Roberto, 33 - 00137 Roma (Italia)',
                'website' => 'www.saldelatierra.org',
                'phone' => '+39 3491417080',
                'email' => 'info@saldelatierra.org'));

        Ngo::create(array(
                'name' => 'Fondazione Maria Bonino',
                'name_short' => 'fonmabo',
                'short_description' => 'In aiuto dei bambini africani, malnutriti e bisognosi',
                'middle_description' => 'Prosegue il lavoro di Maria Bonino, per il miglioramento delle condizioni di salute e di vita dell’infanzia africana.',
                'long_description' => 'La Fondazione, voluta da familiari ed amici, nasce per proseguire in Africa il lavoro di Maria Bonino, medico pediatra, che ha impegnato gran parte della sua vita professionale come volontaria nel continente africano. In seguito alla sua scomparsa nel 2005, è nata la Fondazione, con l\’idea di sostenere diverse iniziative sul territorio. Gli interventi sono rivolti al miglioramento delle condizioni di salute e di vita dell’infanzia africana, continuando progetti iniziati molto tempo fa, con particolare attenzione alla realtà dei bambini malnutriti. Realizza altresì attività di sostegno allo studio per bisognosi e meritevoli, o per migliorare le condizioni di vita nelle case delle famiglie africane (per es. allestimento di zanzariere, allacciamento a pozzi d’acqua). Questi sono solo alcuni degli impegni sostenuti in Africa dalla Fondazione, che vanta una lunga e riconosciuta esperienza sul campo.',
                'oboli_count' => 0,
                'donations_count' => 0,
                'donors' => 0,
                'area' => 'environment',
                'cover_image' => 'fonmabo.jpg',
                'address' => 'via Mazzini 27 - 13900 Biella (Italia)',
                'website' => 'www.fondazionemariabonino.it',
                'phone' => '+39 01520722',
                'email' => 'info@fondazionemariabonino.it'));

        Ngo::create(array(
                'name' => 'FVGS Onlus',
                'name_short' => 'fvgs',
                'short_description' => 'Solidarietà sociale religiosa',
                'middle_description' => 'Nel solco della tradizione cattolica, persegue esclusivamente finalità di solidarietà sociale per lo sviluppo integrale della persona.',
                'long_description' => 'La Fondazione Volontariato Giovani e Solidarietà ONLUS, nel solco della tradizione cattolica e alla luce della dottrina sociale e dei principi della Chiesa, persegue esclusivamente finalità di solidarietà sociale e intende sostenere e favorire lo sviluppo integrale della persona. Si propone di promuovere la ricerca e le attività riguardanti i diritti della donna e dei bambini nei paesi in via di sviluppo. Inoltre promuove i programmi di educazione allo sviluppo e di volontariato sociale a favore dei giovani più emarginati e sostiene le attività di ricerca, di sperimentazione e di formazione nel campo del volontariato giovanile.',
                'oboli_count' => 0,
                'donations_count' => 0,
                'donors' => 0,
                'area' => 'humrights',
                'address' => 'Via Gregorio VII, 133 - 00165 Roma (Italia)',
                'website' => 'www.vides.org',
                'phone' => '+39 0639379861',
                'email' => 'direzione.generale@vides.org'));

        Ngo::create(array(
                'name' => 'Intersos Onlus',
                'name_short' => 'intersos',
                'short_description' => 'Organizzazione Umanitaria per le emergenze',
                'middle_description' => 'Intersos porta aiuto di prima emergenza nelle principali crisi del pianeta in favore di donne, anziani e bambini in fuga dalle guerre.',
                'long_description' => 'Intersos è in prima linea in quasi 20 paesi del mondo, teatro delle più gravi crisi umanitarie, per portare aiuti di prima necessità, riparo e protezione alle persone che scappano dalle guerre e dai disastri naturali del pianeta. Intersos opera in favore delle persone vulnerabili che non posso sopravvivere con le proprie forze in tali tragedie offrendo protezione in campi sfollati, progetti di aiuto sanitario e sostegno all\'infanzia vittima dei conflitti, in particolare ai bambini vittime di arruolamento forzato nelle milizie combattenti. Tutto questo grazie a piu di 120 operatori internazionali e migliaia di operatori nazionali che  quotidianamente sono sul campo per dare il loro aiuto.',
                'oboli_count' => 0,
                'donations_count' => 0,
                'donors' => 0,
                'area' => 'humrights',
                'address' => 'Via Aniene 26a - 00198 Roma (Italia)',
                'website' => 'intersos.org',
                'phone' => '+39 068537431',
                'email' => 'intersos@intersos.org'));

        Ngo::create(array(
                'name' => 'Progetto Continenti',
                'name_short' => 'prcontinenti',
                'short_description' => 'Diritto, giustizia e dignità',
                'middle_description' => 'Per l\'affermazione del diritto, della giustizia e della dignità degli esseri umani di tutti i continenti.',
                'long_description' => 'Progetto Continenti è una ONG di solidarietà e Cooperazione Internazionale. Associazione laica, aconfessionale, apartitica e senza fini di lucro, è stata costituita nel 1989 ed è tra i fondatori di Banca Popolare Etica. L\'Associazione si propone che il diritto, la giustizia e la dignità degli uomini di tutti i continenti siano affermati come ineludibili criteri fondativi di un mondo diverso e finalmente umano. L\'associazione intende esprimere ed operare per l\'autosviluppo dei popoli scegliendo l\'alternativa necessaria e possibile della pace, della solidarietà e della condivisione. Progetto Continenti  propone il superamento della cultura prevalente di competizione e di dominio, che ha causato fin qui l\'insostenibile divario tra i paesi poveri dell\'emisfero Sud e i paesi ricchi dell\'emisfero Nord che pure soffrono anch\'essi di crisi economiche e sociali sempre più estese.',
                'oboli_count' => 0,
                'donations_count' => 0,
                'donors' => 0,
                'area' => 'development',
                'address' => 'via Antonino Pio, 40 - 00145 Roma (Italia)',
                'website' => 'www.progettocontinenti.org',
                'phone' => '+39 0659600319',
                'email' => 'info@progettocontinenti.org'));

        Ngo::create(array(
                'name' => 'Semi di Pace',
                'name_short' => 'semidipace',
                'short_description' => 'La solidarietà mette radici',
                'middle_description' => 'Pace, fratellanza e unità tra i singoli e i popoli sono i valori che hanno ispirato un gruppo di giovani attraverso la musica e il canto.',
                'long_description' => 'L\'Associazione Umanitaria Semi di Pace è nata a Tarquinia nel maggio del 1980 dall\'esperienza di un gruppo di giovani ed adolescenti che, attraverso la musica e il canto, riuscirono a coinvolgere, sempre più, bambini e ragazzi in attività di solidarietà. Pace, fratellanza e unità tra i singoli e i popoli furono e sono i valori che hanno ispirato il cammino in tutti questi anni. Oggi, all\'interno dell\'Associazione, persone appartenenti a diverse confessioni religiose e culture si riconoscono nella passione comune del mettersi al servizio dei più bisognosi. L\'azione di Semi di Pace non si ferma all\'Italia, ma guarda lontano, ai paesi dove povertà, mancanza di istruzione, guerre e calamità naturali sono cause di grandi sofferenze. L\'associazione ha sedi e servizi in Italia, Romania, Spagna, Repubblica Dominicana, Messico, Perù, Burundi e Repubblica Democratica del Congo, Gran Bretagna, India e sostiene questi paesi con progetti di sostegno a distanza, favorisce interventi finalizzati alla costruzione o alla ristrutturazione di case di accoglienza, scuole, ambulatori, mense e opera per garantire la tutela dei diritti umani basilari.',
                'oboli_count' => 0,
                'donations_count' => 0,
                'donors' => 0,
                'area' => 'development',
                'address' => 'La Cittadella, loc. Vigna del Piano snc – 01016 Tarquinia (Italia)',
                'website' => 'www.semidipace.it',
                'phone' => '+39 0766842709',
                'email' => 'segreteria@semidipace.org'));


        Ngo::create(array(
                'name' => 'Terre des Hommes',
                'name_short' => 'terredeshommes',
                'short_description' => 'Proteggiamo i bambini insieme',
                'middle_description' => 'Terre des Hommes è in prima linea per proteggere i bambini dalla violenza, dall\'abuso e dallo sfruttamento.',
                'long_description' => 'Terre des Hommes Italia si pone come obiettivo il contrasto alla violenza, l\'abuso e lo sfruttamento minorile e l\'educazione informale, le cure mediche e il cibo per ogni bambino. Porta avanti circa 90 progetti in 23 paesi del mondo, avvalendosi sempre di proprio personale e collaborando sul campo con diversi partner locali. In Italia è impegnata in campagne di sensibilizzazione per la prevenzione degli abusi sui bambini, per il diritto universale all\'educazione, contro il traffico dei minori. La Federazione internazionale Terre des Hommes è una rete di 11 organizzazioni nazionali impegnate nella difesa dei diritti dei bambini e nella promozione di uno sviluppo equo, senza alcuna discriminazione etnica, religiosa, politica, culturale o di genere.',
                'oboli_count' => 0,
                'donations_count' => 0,
                'donors' => 0,
                'area' => 'children',
                'address' => 'Via M. Boiardo 6 – 20127 (Italia)',
                'website' => 'www.terredeshommes.it',
                'phone' => '+39 0228970418',
                'email' => 'info@tdhitaly.org'));
	}
    
    
}




class BrandsTableSeeder extends Seeder {

    public function run()
    {
        DB::table('brands')->delete();
        
        Eloquent::unguard();  #this is for MassAssignmentException
        
        Brand::create(array('name' => 'oboli'));     // id=1
    }
    
}


