<?php

namespace App\Http\Livewire\Admin\User;

use Livewire\Component;
use App\Models\User;
use Livewire\WithPagination;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $user_id, $name, $email, $password, $role_as, $currentUser;

    //validation
    public function rules()
    {
        return [
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users,email|regex:/^[A-Za-z0-9\.]*@(globaltronics)[.](net)$/',
            'password' => 'required|string|min:8|',
            'role_as' => 'required|integer'
        ];
    }

    public function messages(){
        return [
            'email.regex' =>'domain name must be from Globaltronics'
        ];
    }

     //reset input fields
     public function resetInput()
     {
         $this->name = NULL;
         $this->email = NULL;
         $this->role_as = NULL;
         $this->password = NULL;
         $this->user_id = NULL;
     }

     //store function
    public function storeUser()
    {
        $validatedData = $this->validate();
        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'role_as' => $this->role_as,
        ]);
        session()->flash('message','User Added Successfully');
        $this->dispatchBrowserEvent('close-modal');
        $this->resetInput();
    }

    public function closeModal()
    {
        $this->resetInput();
    }

    public function openModal()
    {
        $this->resetInput();
    }

     //fetch data for edit function
     public function editUser(int $user_id)
     {
         $this->user_id = $user_id;
         $user = User::findOrFail($user_id);
         $this->name = $user->name;
         $this->email = $user->email;
         $this->password = $user->password;
         $this->role_as = $user->role_as;
     }

      //update function
    public function updateUser()
    {
        $validatedData = $this->validate();
        User::findOrFail($this->user_id)->update([
            'role_as' => $this->role_as,
        ]);
        session()->flash('message','Category Updated Successfully');
        $this->dispatchBrowserEvent('close-modal');
        $this->resetInput();
    }

    public function deleteUser($user_id)
    {
        $this->user_id = $user_id;
    }

    public function destroyUser()
    {
        $user = User::find($this->user_id);
        $user->delete();
        session()->flash('message','User Deleted Successfully');
        $this->dispatchBrowserEvent('close-modal');
    }

    public function render(Request $request)
    {
        $user = User::where([
            //['name', '!=', Null],
            [function ($query) use ($request) {
                if (($term = $request->term)) {
                    $query->orWhere('name', 'LIKE', '%' . $term . '%')
                        ->orWhere('email', 'LIKE', '%' . $term . '%')
                        ->get();
                }
            }]
        ])->paginate(10);

        return view('livewire.admin.user.index',['users' => $user]);
    }


}
