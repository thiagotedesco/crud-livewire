<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Contact as ContactModel;

class Contact extends Component
{
    public $contactId;

    public $name;
    public $email;
    public $phone;

    protected $rules = [
        'name'  => 'required|min:3',
        'email' => 'required|min:3',
        'phone' => 'required|min:3|numeric',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function render()
    {
        $contacts = ContactModel::paginate(10);
        return view('livewire.contact', ['contacts' => $contacts]);
    }

    public function save()
    {
        if (isset($this->contactId)) {
            $this->edit($this->contactId);
        } else {
            $this->create();
        }
    }

    public function edit($contact)
    {
        $contact = ContactModel::find($contact);
        $contact->update([
            'name'  => $this->name,
            'email' => $this->email,
            'phone' => $this->phone
        ]);

        $this->name = $this->email = $this->phone = $this->contactId = $contact->null;

        session()->flash('message', 'Contact edited');
    }

    public function create()
    {
        $this->validate();

        ContactModel::create([
            'name'  => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
        ]);

        $this->name = $this->email = $this->phone = null;

        session()->flash('message', 'Contact created');
    }

    public function delete(ContactModel $contact)
    {
        $contact->delete();
    }

    public function setValues(ContactModel $contact)
    {
        $this->contactId = $contact->id;
        $this->name      = $contact->name;
        $this->email     = $contact->email;
        $this->phone     = $contact->phone;
    }
}