<?php

namespace App\Forms;

use Carbon\Carbon;
use Kris\LaravelFormBuilder\Form;

class ClassInformationForm extends Form
{
    public function buildForm()
    {
        $formatDate = function($value) {
            return ($value && $value instanceof Carbon) ? $value->format('Y-m-d') : $value;
        };
        $this
            ->add('date_start', 'date', [
                'label' => 'Data início',
                'rule' => 'required|date',
                'value' => $formatDate,
            ])
            ->add('date_end', 'date', [
                'label' => 'Data Final',
                'rule' => 'required|date',
                'value' => $formatDate,
            ])
            ->add('cycle', 'number', [
                'label' => 'Ciclo',
                'rule' => 'required|integer',
            ])
            ->add('subdivision', 'number', [
                'label' => 'Subdivisão',
                'rule' => 'integer',
            ])
            ->add('semester', 'number', [
                'label' => 'Semestre (1 ou 2)',
                'rule' => 'required|in:1,2',
            ])
            ->add('year', 'number', [
                'label' => 'Ano',
                'rule' => 'required|integer',
            ]);
    }
}
