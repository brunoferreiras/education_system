@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Listagem de turmas</h3>
            {!! Button::primary("Nova turma")->asLinkTo(route('admin.class_informations.create')) !!}
        </div>
        <div class="row">
            {!!
            Table::withContents($class_informations->items())
            ->striped()
            ->callback('Ações', function($field, $model) {
                $linkShow = route('admin.class_informations.show', ['subject' => $model->id]);
                $linkEdit = route('admin.class_informations.edit', ['subject' => $model->id]);
                return Button::link(Icon::create('folder-open').'&nbsp;&nbsp;Ver')->asLinkTo($linkShow).'|'.
                       Button::link(Icon::create('pencil').' Editar')->asLinkTo($linkEdit);
            })
            !!}
        </div>

        {!! $class_informations->links() !!}
    </div>
@endsection
