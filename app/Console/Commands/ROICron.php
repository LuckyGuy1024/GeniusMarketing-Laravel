<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ROICron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'demo:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        \Log::info("Cron is working fine!");
     
        /*
           Write your database logic we bellow:
           Item::create(['name'=>'hello new']);
        */
      
       $reccords = DB::select( DB::raw("SELECT * from users"));
            // DB::table('recent_users')->selectRaw($col);
    foreach($reccords as $r){

// plan start here
         \DB::statement("SET SQL_MODE=''");
$plans = DB::select( DB::raw("select p.*,ps.user_id,ps.plan_id from plans as p , purchase_plans as ps where p.id=ps.plan_id  and ps.user_id=:user_id  "), array(
      'user_id' => $r->id
 ));
$totalAmount=$r->balance;
$percent=0;
foreach($plans as $p){
//Convert our percentage value into a decimal.
$percentInDecimal = $p->roi / 100;
$percent = $percentInDecimal * $p->price;
// echo $percent."   ";
$totalAmount=$totalAmount+$percent;
// $percent=$percent+$percent;
// $totalPlanPrice=$totalPlanPrice+$p->price;
// adding roi
        if($percent!=0){
        DB::table('r_o_i_s')->insert(
        array(
            'user_id'     =>   $r->id, 
            'plan_id'     =>   $p->id, 
            'amount'   =>   $percent
              )  );
            }
        // roi ends here
}

        // plan ends
// updated user balance
      // $oldBalance=$r->balance;
      DB::table('users')
        ->where('id', $r->id)  // find your user by their email
        ->limit(1)  // optional - to ensure only one record is updated.
        ->update(array('balance' => $totalAmount));  // update the record in the DB. 

    }
        $this->info('Demo:Cron Cummand Run successfully!');
        //
    }
}
