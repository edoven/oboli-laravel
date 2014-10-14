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


        Ngo::create(array('name' => 'Amnesty International',
							  'short_description' => 'ONLUS attiva nel mondo della lotta al precariato',
							  'long_description' => 'ONLUS attiva nel mondo della lotta al precariato. Nasce nel 1999 ad opera di Guastiero De Rossi e Giacomo Minei. Ha sedi in oltre 45 paesi tra cui Inghilterra e Isole Mauritius.',
							  'oboli_count' => 0,
							  'donations_count' => 0,
							  'donors' => 0));					   
        Ngo::create(array('name' => 'Medici Senza Frontiere',
							  'short_description' => 'ONLUS attiva nel mondo della lotta al precariato',
							  'long_description' => 'ONLUS attiva nel mondo della lotta al precariato. Nasce nel 1999 ad opera di Guastiero De Rossi e Giacomo Minei. Ha sedi in oltre 45 paesi tra cui Inghilterra e Isole Mauritius.',
							  'oboli_count' => 0,
							  'donations_count' => 0,
							  'donors' => 0));	
		Ngo::create(array('name' => 'Libera',
							  'short_description' => 'ONLUS attiva nel mondo della lotta al precariato',
							  'long_description' => 'ONLUS attiva nel mondo della lotta al precariato. Nasce nel 1999 ad opera di Guastiero De Rossi e Giacomo Minei. Ha sedi in oltre 45 paesi tra cui Inghilterra e Isole Mauritius.',
							  'oboli_count' => 0,
							  'donations_count' => 0,
							  'donors' => 0));	
		Ngo::create(array('name' => 'WWF',
							  'short_description' => 'ONLUS attiva nel mondo della lotta al precariato',
							  'long_description' => 'ONLUS attiva nel mondo della lotta al precariato. Nasce nel 1999 ad opera di Guastiero De Rossi e Giacomo Minei. Ha sedi in oltre 45 paesi tra cui Inghilterra e Isole Mauritius.',
							  'oboli_count' => 0,
							  'donations_count' => 0,
							  'donors' => 0));	
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


class CodesTableSeeder extends Seeder {

    public function run()
    {
        DB::table('codes')->delete();
        
        Eloquent::unguard();  #this is for MassAssignmentException
        
        Code::create(array('id' => '54657IUedfi', 'product' => '1', 'oboli' => '12'));
        Code::create(array('id' => '775fgfgUedf', 'product' => '1', 'oboli' => '100'));
        Code::create(array('id' => 'dghncedfifd', 'product' => '2', 'oboli' => '152'));
        Code::create(array('id' => '5ytgffdfijh', 'product' => '2', 'oboli' => '23'));
        Code::create(array('id' => 'erwrtdfifdj', 'product' => '3', 'oboli' => '76'));
        Code::create(array('id' => 'reyhjdfhg67', 'product' => '4', 'oboli' => '654'));
        Code::create(array('id' => 'eqrth453fs0', 'product' => '3', 'oboli' => '8876'));

    }
    
}
