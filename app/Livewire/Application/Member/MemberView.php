<?php

namespace App\Livewire\Application\Member;

use Livewire\Component;

class MemberView extends Component
{
    public function render()
    {
        return view('livewire.application.member.member-view')->layout('layouts.app');
    }
}
