<div class="container">
    <h2 class="pt-5">Create a contact</h2>
    @if(session()->has('message'))
        <div class="alert alert-success">
            {{session()->get('message')}}
        </div>
    @endif
    <div>
        <form class="" method="post" wire:submit.prevent="save">
            <div class="form-group">
                <label for="name" class="col">Nome</label>
                <input class="form-control  @if($errors->has('name')) is-invalid @endif" type="text" name="nome"
                       wire:model="name">
                <div class="text-danger">
                    @error('name')
                    {{$message}}
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input class="form-control @if($errors->has('email')) is-invalid @endif" type="email" name="email"
                       wire:model="email">
                <div class="text-danger">
                    @error('email')
                    {{$message}}
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="phone">Phone Number</label>
                <input type="text" name="phone" class="form-control @if($errors->has('phone')) is-invalid @endif"
                       wire:model="phone">
                <div class="text-danger">
                    @error('phone')
                    {{$message}}
                    @enderror
                </div>
            </div>
            <br>
            <div class="float-right">
                <button class="btn btn-primary float-end" type="submit">
                    Save Contact
                </button>
            </div>
        </form>
    </div>

    <br><br><br>
    <hr>

    <table class="table table-striped table-hover">
        <theader>
            <th>Nome</th>
            <th>Email</th>
            <th>Phone Number</th>
            <th>Action</th>
        </theader>
        <tbody>
        @foreach($contacts as $contact)
            <tr>
                <td>{{$contact->name}}</td>
                <td>{{$contact->email}}</td>
                <td>{{$contact->phone}}</td>
                <td>
                    <a href="#" wire:click.prevent="setValues({{ $contact }})"> <i class="fa-solid fa-pen"></i></a>
                    <a href="#" wire:click.prevent="delete({{ $contact }})"> <i class="fa-solid fa-trash-can"></i></a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $contacts->links() }}
</div>


