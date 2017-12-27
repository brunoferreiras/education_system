<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ClassInformation;
use Illuminate\Http\Request;
use App\Forms\ClassInformationForm;

class ClassInformationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $class_informations = ClassInformation::paginate();
        return view('admin.class_informations.index',compact('class_informations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $form = \FormBuilder::create(ClassInformationForm::class, [
            'url' => route('admin.class_informations.store'),
            'method' => 'POST',
        ]);

        return view('admin.class_informations.create', compact('form'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /** @var Form $form */
        $form = \FormBuilder::create(ClassInformationForm::class);

        if (!$form->isValid()) {
            return redirect()
                ->back()
                ->withErrors($form->getErrors())
                ->withInput();
        }

        $data = $form->getFieldValues();
        ClassInformation::create($data);

        session()->flash('message', 'Turma cadastrada com sucesso!');
        return redirect()->route('admin.class_informations.index');
    }

    /**
     * Display the specified resource.
     *
     * @param ClassInformation $class_information
     * @return \Illuminate\Http\Response
     */
    public function show(ClassInformation $class_information)
    {
        return view('admin.class_informations.show', compact('class_information'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param ClassInformation $class_information
     * @return \Illuminate\Http\Response
     */
    public function edit(ClassInformation $class_information)
    {
        $form = \FormBuilder::create(ClassInformationForm::class, [
            'url' => route('admin.class_informations.update', ['class_information' => $class_information->id]),
            'method' => 'PUT',
            'model' => $class_information,
        ]);

        return view('admin.class_informations.edit', compact('form'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ClassInformation $class_information
     * @return \Illuminate\Http\Response
     */
    public function update(ClassInformation $class_information)
    {
        /** @var Form $form */
        $form = \FormBuilder::create(ClassInformationForm::class);

        if (!$form->isValid()) {
            return redirect()
                ->back()
                ->withErrors($form->getErrors())
                ->withInput();
        }

        $data = $form->getFieldValues();
        $class_information->update($data);
        session()->flash('message','Turma editada com sucesso');
        return redirect()->route('admin.class_informations.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ClassInformation $class_information
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(ClassInformation $class_information)
    {
        $class_information->delete();

        session()->flash('message', 'Turma excluída com sucesso!');
        return redirect()->route('admin.class_informations.index');
    }
}
