<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		#$this->call('UserTableSeeder');
        #$this->command->info('User table seeded!');
        $this->call('ProjectTableSeeder');
        $this->command->info('Project table seeded!');
        #$this->call('CodeTableSeeder');
        #$this->command->info('Code table seeded!');
	}

}



class UserTableSeeder extends Seeder {

    public function run()
    {
        DB::table('users')->delete();
        
        Eloquent::unguard();  #this is for MassAssignmentException
        
        User::create(array('email' => 'edoardo.venturini@gmail.com', 
						   'name' => 'edoardo venturini', 
						   'oboli_count' => 234));
						   
        User::create(array('email' => 'marco.giannozzi@gmail.com', 
						   'name' => 'marco giannozzi', 
						   'oboli_count' => 112));
						   
        User::create(array('email' => 'francesco.senigaglia@gmail.com', 
						   'name' => 'francesco senigaglia', 
						   'oboli_count' => 0));
    }
    
}



class ProjectTableSeeder extends Seeder {

    public function run()
    {
        DB::table('projects')->delete();
        
        Eloquent::unguard();  #this is for MassAssignmentException
        
        Project::create(array('name' => 'progetto1'));						   
        Project::create(array('name' => 'progetto2'));     
        Project::create(array('name' => 'progetto3'));
    }
    
}



class DonationTableSeeder extends Seeder {

    public function run()
    {
        DB::table('donations')->delete();
        
        Eloquent::unguard();  #this is for MassAssignmentException
        
        Donation::create(array('user_id' => '1', 'project_id' => '1', 'amount' => '12'));
		Donation::create(array('user_id' => '1', 'project_id' => '2', 'amount' => '5'));
		Donation::create(array('user_id' => '1', 'project_id' => '2', 'amount' => '7'));
		Donation::create(array('user_id' => '2', 'project_id' => '1', 'amount' => '15'));
		Donation::create(array('user_id' => '2', 'project_id' => '3', 'amount' => '2'));
		Donation::create(array('user_id' => '3', 'project_id' => '2', 'amount' => '4'));
    }
    
}


class CodeTableSeeder extends Seeder {

    public function run()
    {
        DB::table('codes')->delete();
        
        Eloquent::unguard();  #this is for MassAssignmentException
        
        Code::create(array('id' => '54657IUedfifdj', 'product' => '1', 'oboli' => '12'));
        Code::create(array('id' => '775fgfgUedfifdj', 'product' => '1', 'oboli' => '100'));
        Code::create(array('id' => 'dghncedfifdj', 'product' => '2', 'oboli' => '152'));
        Code::create(array('id' => '54657IUedfifdj', 'product' => '2', 'oboli' => '23'));
        Code::create(array('id' => 'erwrtdfifdj', 'product' => '3', 'oboli' => '76'));
        Code::create(array('id' => 'reyhjdfhg67f', 'product' => '4', 'oboli' => '654'));
        Code::create(array('id' => 'eqrth453fs', 'product' => '3', 'oboli' => '8876'));

    }
    
}
