<?php
namespace App\Livewire;

use App\Models\Contact;
use Livewire\Component;
use App\Models\ContactMessage;
use Illuminate\Support\Facades\Log;

class ContactForm extends Component
{
    public $name;
    public $email;
    public $message;

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'message' => 'required|string|max:1000',
    ];


public function submitForm()
{
    $this->validate();
    Contact::create([
        'name' => $this->name,
        'email' => $this->email,
        'message' => $this->message,
    ]);;
    $this->reset();

    session()->flash('message', 'Ваше сообщение успешно отправлено!');
    $this->emit('feedbackSubmitted');
    $this->emit('stopLoading');
}


    public function render()
    {
        return view('livewire.contact-form');
    }
}
