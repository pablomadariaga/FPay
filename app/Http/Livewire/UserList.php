<?php

namespace App\Http\Livewire;

use App\Http\Traits\WithUserService;
use Illuminate\Support\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class UserList extends Component
{
    use WithPagination, WithUserService;

    public $search = '';
    public $page = 1;
    public $create = false;
    public $name='';
    public $avatar='';

    /**
     * Remove properties from query string when values are equal to defined below
     *
     * @var array
     */
    protected $queryString = [
        'create' => ['except' => false],
        'search' => ['except' => ''],
        'page' => ['except' => 1],
    ];

    /**
     * Property to set validation rules per component
     *
     * @var array
     */
    protected $rules = [
        'name' => 'required|min:3',
        'avatar' => 'required|url',
    ];

    protected $paginationTheme = 'bootstrap';

    /**
     * when the search is being updated the pagination is restarted
     *
     * @return void
     */
    public function updatingSearch()
    {
        $this->resetPage();
    }

    /**
     * Switch between list and user creation
     *
     * @return void
     */
    public function switchCreate()
    {
        $this->create = !$this->create;
    }


    /**
     * Save a new user consuming the api
     *
     * @return void
     */
    public function save()
    {
        $this->validate();
        $this->createUser($this->name,$this->avatar);
        $this->name='';
        $this->avatar='';
        $this->emit('saved');
    }

    /**
     * A Livewire component's render method gets called on the initial page load
     * AND every subsequent component update.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function render()
    {
        if (!$this->create) {
            $users = collect($this->getUserList())->map(function($user){
                $user->createdAt = new Carbon($user->createdAt);
                return $user;
            });
            if (trim($this->search)!='') {
                $users = $users->filter(function($user) {
                    return stripos($user->name,$this->search) !== false;
                });
            }
        }
        return view('livewire.user-list', [
            'users' => !$this->create ? $users->sortBy('id')->paginate(5) : []
        ]);
    }
}
