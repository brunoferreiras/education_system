@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Listagem de usuários</h3>
            {!! Button::primary("Novo usuário")->asLinkTo(route('admin.users.create')) !!}
        </div>
        <div class="row">
            {!!
            Table::withContents($users->items())
            ->striped()
            ->callback('Ações', function($field, $model) {
                $linkShow = route('admin.users.show', ['user' => $model->id]);
                $linkEdit = route('admin.users.edit', ['user' => $model->id]);
                return Button::link('Ver')->asLinkTo($linkShow).'|'.
                       Button::link('Editar')->asLinkTo($linkEdit);
            })
            !!}
        </div>

        {!! $users->links() !!}
    </div>
@endsection
