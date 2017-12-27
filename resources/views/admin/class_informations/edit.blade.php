@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3>Editar turma</h3>
                {!!
                form($form->add('edit', 'submit', [
                    'attr' => ['class' => 'btn btn-primary btn-block'],
                    'label' => Icon::create('floppy-disk').'&nbsp;&nbsp;Editar'
                ]))
                !!}
            </div>
        </div>
    </div>
@endsection
