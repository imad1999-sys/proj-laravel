<?php

namespace App\Http\Controllers\Relation;

use App\Http\Controllers\Controller;
use App\Models\Mobile;
use App\User;
use Illuminate\Http\Request;

class RelationsController extends Controller
{
    public function hasOneRelation(){
        $user = \App\User::with(['phone' => function($q){
            $q -> select('code','phone','user_id');
        }])->find(9);
        return $user -> phone -> code;
        return response() -> json($user);
    }
    public function hasOneRelationReverse(){
        $phone = Mobile::find(1);
        $phone -> makeVisible(['user_id']);
        $phone -> user;
        return $phone;
    }
    public function getUsersHasPhone(){
        return User::whereHas('phone')->get();
    }
    public function getUsersNotHasPhone(){
        return User::whereDoesntHave('phone')->get();
    }
}
