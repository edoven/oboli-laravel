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
        Ngo::create(array('name' => 'Amici dei Bambini',
                            'name_short' => 'aibi',
							  'short_description' => 'ONLUS attiva nel mondo della lotta al precariato',
							  'long_description' => 'ONLUS attiva nel mondo della lotta al precariato. Nasce nel 1999 ad opera di Guastiero De Rossi e Giacomo Minei. Ha sedi in oltre 45 paesi tra cui Inghilterra e Isole Mauritius.',
							  'oboli_count' => 0,
							  'donations_count' => 0,
							  'donors' => 0,
							  'cover_image' => 'amnesty.png',
                              'website' => 'www.amnesty.com',
                              'phone' => '+39060606',
                              'email' => 'info@amnesty.com'));	
        //id=2				   
        Ngo::create(array('name' => 'Associazione Italiana Donne per lo Sviluppo',
                            'name_short' => 'aidos',
							  'short_description' => 'ONLUS attiva nel mondo della lotta al precariato',
							  'long_description' => 'ONLUS attiva nel mondo della lotta al precariato. Nasce nel 1999 ad opera di Guastiero De Rossi e Giacomo Minei. Ha sedi in oltre 45 paesi tra cui Inghilterra e Isole Mauritius.',
							  'oboli_count' => 0,
							  'donations_count' => 0,
							  'donors' => 0,
							  'cover_image' => 'msf.png',
                              'website' => 'www.msf.com',
                              'phone' => '+39060606',
                              'email' => 'info@msf.com'));
        //id=3
		Ngo::create(array('name' => 'Associazione Nazionale Protezione Ambiente Natura e Animali',
                             'name_short' => 'anpana',
							  'short_description' => 'ONLUS attiva nel mondo della lotta al precariato',
							  'long_description' => 'ONLUS attiva nel mondo della lotta al precariato. Nasce nel 1999 ad opera di Guastiero De Rossi e Giacomo Minei. Ha sedi in oltre 45 paesi tra cui Inghilterra e Isole Mauritius.',
							  'oboli_count' => 0,
							  'donations_count' => 0,
							  'donors' => 0,
							  'cover_image' => 'libera.png',
                              'website' => 'www.libera.com',
                              'phone' => '+39060606',
                              'email' => 'info@libera.com'));	
        //id=4
		Ngo::create(array('name' => 'Comitato Europero per la Formazione e l\'Agricoltura',
                                 'name_short' => 'cefa',
							  'short_description' => 'ONLUS attiva nel mondo della lotta al precariato',
							  'long_description' => 'ONLUS attiva nel mondo della lotta al precariato. Nasce nel 1999 ad opera di Guastiero De Rossi e Giacomo Minei. Ha sedi in oltre 45 paesi tra cui Inghilterra e Isole Mauritius.',
							  'oboli_count' => 0,
							  'donations_count' => 0,
							  'donors' => 0,
							  'cover_image' => 'wwf.png',
                              'website' => 'www.wwf.com',
                              'phone' => '+39060606',
                              'email' => 'info@wwf.com'));
        //id=5
        Ngo::create(array('name' => 'Armadilla Cooperativa Sociale',
                                 'name_short' => 'armadilla',
                              'short_description' => 'ONLUS attiva nel mondo della lotta al precariato',
                              'long_description' => 'ONLUS attiva nel mondo della lotta al precariato. Nasce nel 1999 ad opera di Guastiero De Rossi e Giacomo Minei. Ha sedi in oltre 45 paesi tra cui Inghilterra e Isole Mauritius.',
                              'oboli_count' => 0,
                              'donations_count' => 0,
                              'donors' => 0,
                              'cover_image' => 'wwf.png',
                              'website' => 'www.wwf.com',
                              'phone' => '+39060606',
                              'email' => 'info@wwf.com'));


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
