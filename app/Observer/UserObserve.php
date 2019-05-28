<?php


namespace App\Observer;


use App\Models\User;
use Blankphp\Event\Observer;

class UserObserve extends Observer
{

    public function saving(User $user){

    }

    public function saved(User $user){

    }

    public function deleting(User $user){

    }

    public function deleted(User $user){

    }
}