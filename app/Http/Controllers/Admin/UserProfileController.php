<?php

namespace App\Http\Controllers\Admin;

use App\Forms\UserProfileForm;
use App\Http\Controllers\Controller;
use App\Models\User;

class UserProfileController extends Controller
{
    /**
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(User $user)
    {
        $form = \FormBuilder::create(UserProfileForm::class, [
            'url' => route('admin.users.profile.update', ['user' => $user->id]),
            'method' => 'PUT',
            'model' => $user->profile,
            'data' => ['user' => $user]
        ]);
        return view('admin.users.profile.edit', compact('form'));
    }

    public function update(User $user)
    {
        $form = \FormBuilder::create(UserProfileForm::class);

        if(!$form->isValid()) {
            return redirect()
                ->back()
                ->withErrors($form->getErrors())
                ->withInput();
        }

        $data = $form->getFieldValues();
        $user->profile->address ? $user->profile->update($data) : $user->profile()->create($data);

        session()->flash('message', 'Perfil alterado com sucesso!');
        return redirect()->route('admin.users.profile.update', ['user' => $user->id]);
    }

}
