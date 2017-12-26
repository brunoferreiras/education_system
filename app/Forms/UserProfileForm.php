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

class UserProfileForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('address', 'text', [
                'label' => 'Endereço',
                'rules' => 'required|max:255',
            ])
            ->add('cep', 'text', [
                'label' => 'CEP',
                'rules' => 'required|max:8',
            ])
            ->add('number', 'text', [
                'label' => 'Número',
                'rules' => 'required|max:255',
            ])
            ->add('complement', 'text', [
                'label' => 'Complemento',
                'rules' => 'max:255',
            ])
            ->add('city', 'text', [
                'label' => 'Cidade',
                'rules' => 'required|max:255',
            ])
            ->add('neighborhood', 'text', [
                'label' => 'Bairro',
                'rules' => 'required|max:255',
            ])
            ->add('state', 'text', [
                'label' => 'Estado',
                'rules' => 'required|max:2',
            ]);
    }
}
