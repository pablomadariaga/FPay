<div>
    <div class="row no-gutters">
        <div class="col-12 mb-2 text-center">
            <button class="btn btn-sm btn-primary" wire:click="switchCreate"
                wire:loading.attr="disabled" wire:target="switchCreate,search,save"
                wire:loading.class="disabled">
                {{!$create ? __('New user') : __('List')}}
            </button>
        </div>
        <div class="col-md-8 col-12 mb-2">
            <h5 class="fw-bold">{{$create?__('Create user'):__('User list')}}</h5>
        </div>
        @if (!$create)
        <div class="col-md-4 col-12 mb-2">
            <input type="search" class="form-control form-control-sm"
            wire:model.debounce.700ms="search" id="search"
            wire:loading.attr="disabled" wire:target="switchCreate,search"
            wire:loading.class="disabled"
            placeholder="{{__('Search by name')}}">
        </div>
        @endif
    </div>
    @if ($create)
    <form class="row no-gutters" wire:submit.prevent="save">
        <div class="mb-3 col-12 col-md-6">
            <label for="names" class="form-label">{{__('Name')}}</label>
            <input wire:model.defer="name" type="text" class="form-control form-control-sm @error('name') is-invalid @enderror" id="name" aria-describedby="name">
            @error('name')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>
        <div class="mb-3 col-12 col-md-6">
            <label for="avatar" class="form-label">{{__('Image link')}}</label>
            <input wire:model.defer="avatar" type="text" class="form-control form-control-sm @error('avatar') is-invalid @enderror" id="avatar">
            @error('avatar')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
            <div id="avatar" class="form-text">{{__('URL where the image is saved')}}</div>
        </div>
        <div class="col-sm-6 col-12">
            <span id="saved" class="fs-6 text-success" style="display: none;">
                {{__('User created successfully')}}
            </span>
        </div>
        <div class="text-end col-sm-6 col-12">
            <button type="submit" class="btn btn-success btn-sm"
                wire:loading.attr="disabled" wire:target="switchCreate,save"
                wire:loading.class="disabled">{{__('Create')}}</button>
        </div>
    </form>
    @else
    <table class="table table-dark table-striped" aria-describedat="user-list" aria-describedby="user-list">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">{{__('Image')}}</th>
                <th scope="col">{{__('Name')}}</th>
                <th scope="col">{{__('Created at')}}</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($users as $user)
            <tr>
                <th scope="row">{{$user->id}}</th>
                <td><img class="img-avatar rounded-circle" src="{{$user->avatar}}" alt="{{$user->name}}" class="w-"></td>
                <td>{{$user->name}}</td>
                <td>{{$user->createdAt->translatedFormat('M j, Y g:i A')}}</td>
            </tr>
            @empty
            <tr>
                <td>{{__('No records found')}}</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    @empty(!$users)
    {{$users->links()}}
    @endempty
    @endif
</div>
