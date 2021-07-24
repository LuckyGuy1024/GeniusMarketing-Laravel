<?php
namespace App\Http\Traits;


use App\GeneralSetting;
use App\Plan;
use App\User;


trait Matrix{

    function get_position($user_id){
        $user = User::find($user_id);
             if ($user->ref_id != 0){
                return $this->assign_position($user->id);
             }
         
    }
    
// khali_ache_naki
    function assign_position($user_id){

        $user = User::find($user_id);
        $refer = User::find($user->ref_id);
  
         $stststs = 0;
       
       
        if($this->khali_ache_naki($refer->id)!=0){
            $user->position_id = $refer->id;
            $user->position =$this->khali_ache_naki($refer->id);
            $user->save();
            
        }else{
        
             for ($level=1; $level < 100 ; $level++) {
            
                    $myref = $this->showPositionBelow($refer->id);
                         $nxt =   $myref;
                    for ($i=1; $i < $level ; $i++) {
                        $nxt = array();
                        foreach($myref as $uu){
                            $n = $this->showPositionBelow($uu);
                            $nxt = array_merge($nxt, $n);
                        }
                        $myref = $nxt;
                    }
            
            
                foreach($nxt as $uu){
                    
                    if($this->khali_ache_naki($uu)!=0){
                        $user->position_id = $uu;
                        $user->position =$this->khali_ache_naki($uu);
                        $user->save();
                       $stststs = 1;
                    }
                    
                    if($stststs == 1){
                        break;
                    }
          
                }
                
                 if($stststs == 1){
                    break;
                }
             }
            
        }
    
    }






function showPositionBelow($id){
    $arr = array();
    $under_ref = \App\User::where('position_id',$id)->get();
    foreach($under_ref as $u){
        array_push($arr,$u->id);
    }
    return $arr;
}



    function khali_ache_naki($user_id){
        $count = User::where('position_id',$user_id)->count();
        
        if($count < $this->matrix_width()){
            return $count+1;
        }else{
            return 0;
        }
        
    }




    function give_referral_commission($user_id, $plan_id){

        $user = User::find($user_id);
        $plan = Plan::whereId($plan_id)->first();
        if($user){
            if ($user->ref_id != 0){
                $refer = $this->user_valid($user->ref_id);
                $refer->update(['balance' => $refer->balance + $plan->ref_bonus]);

                $refer->transactions()->create([
                    'amount' => $plan->ref_bonus,
                    'user_id' => $refer->id,
                    'main_amo' => $plan->ref_bonus,
                    'balance' => $refer->balance,
                    'type' => 4,
                    'title' => 'Referral Bonus from ' .$user->username,
                    'trx' => getTrx(),
                ]);

                $gnl = GeneralSetting::first();
                send_email($refer, 'referral_commission', [

                    'amount' => $plan->ref_bonus . ' ' . $gnl->cur_text,
                    'username' => $user->username,


                ]);

                send_sms($refer, 'referral_commission', [

                    'amount' => $plan->ref_bonus . ' ' . $gnl->cur_text,
                    'username' => $user->username,

                ]);
            }

        }
    }



    function give_level_commission($user_id, $plan_id){

        $fromUser = User::find($user_id);
        $usr = $user_id;
        $plan = Plan::whereId($plan_id)->with('plan_level')->first();
        $i = 1;
        while($usr !="" || $usr != "0" || $i <= $this->matrix_height()){
            $me = User::find($usr);
            if($this->user_valid($me->position_id) === false){ break; }
            $refer = $this->user_valid($me->position_id);

            if ($i <= $this->matrix_height()){


                // echo $refer->id.'<br>';

                $commission = $plan->plan_level->where('level',$i)->first();
                if (!$commission){ break; }
                $refer->update(['balance' => $refer->balance + $commission->amount]);
                $refer->transactions()->create([
                    'amount' => $commission->amount,
                    'user_id' => $refer->id,
                    'main_amo' => $commission->amount,
                    'balance' => $refer->balance,
                    'type' => 11,
                    'title' => 'Level '.$i.' Commission From '. $fromUser->username,
                    'trx' => getTrx(),
                ]);


                $gnl = GeneralSetting::first();
                send_email($refer, 'level_commission', [

                    'amount' => $commission->amount . ' ' . $gnl->cur_text,
                    'level_number' => $i,
                    'username' => $fromUser->username,


                ]);

                send_sms($refer, 'level_commission', [

                    'amount' => $commission->amount . ' ' . $gnl->cur_text,
                    'level_number' => $i,
                    'username' => $fromUser->username,

                ]);

            }

            $usr = $refer->id;
            $i++;
        }
        return 0;
    }





    function user_valid($user_id){
        $user = User::find($user_id);
        return $user ? $user:false;
    }

    function matrix_width(){
       return GeneralSetting::first()->matrix_width;
    }

    function matrix_height(){
        return GeneralSetting::first()->matrix_height;
    }

}