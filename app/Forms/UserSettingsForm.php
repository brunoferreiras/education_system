<?php

/*
 * This file is part of PHP CS Fixer.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *     Dariusz Rumiński <dariusz.ruminski@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;
use App\Models\User;

class UserSettingsForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('password', 'password', [
                'label' => 'Senha',
                'rules' => 'required|min:6|max:16|confirmed',
            ])
            ->add('password_confirmation', 'password', [
                'label' => 'Confirmar Senha'
            ]);
    }
}
