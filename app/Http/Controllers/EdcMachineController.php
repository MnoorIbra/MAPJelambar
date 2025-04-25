<?php

namespace App\Http\Controllers;

use App\Models\EdcMachine;
use Illuminate\Http\Request;

class EdcMachineController extends Controller
{
     function index()
    {
        $edcMachines = EdcMachine::all();
        return view('edc-machines.index', compact('edcMachines'));
    }

     function create()
    {
        return view('edc-machines.create');
    }

     function store(Request $request)
    {
        $rules = [
            'name'      => 'required|string|max:255',
            'address'   => 'required|string',
            'serial_number' => 'nullable|string|unique:edc_machines',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'status'    => 'required|in:already exist,not exist,maintenance',
           
        ];

        $validated['user_id'] = auth()->id();

          if ($request->status == 'already exist') {
              $rules['serial_number'] = 'required|string|unique:edc_machines';
          }
          $validated = $request->validate($rules);
           $validated['user_id'] = auth()->id();

           EdcMachine::create($validated);

        return redirect()->route('edc-machines.index')
            ->with('success', 'Mesin EDC berhasil ditambahkan.');
    }


    function edit($id)
    {
          $edcMachine = EdcMachine::findOrFail($id);
        return view('edc-machines.edit', compact('edcMachine'));
     }

     function update(Request $request, EdcMachine $edcMachine)   {
        $rules = [
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'serial_number' => 'nullable|string|unique:edc_machines,serial_number,'.$edcMachine->id,
            'status' => 'required|in:already exist,not exist,maintenance',
         ];
         if ($request->status == 'already exist') {
               $rules['serial_number'] = 'required|string|unique:edc_machines,serial_number,'.$edcMachine->id;
          }
         $validated = $request->validate($rules);

       

        $edcMachine->update($validated);

        return redirect()->route('edc-machines.index')
            ->with('success', 'Mesin EDC berhasil diperbarui.');
    }

     function destroy($id)
    {
        $edcMachine = EdcMachine::findOrFail($id);
        $edcMachine->delete();
        return redirect()->route('edc-machines.index')
            ->with('success', 'Mesin EDC berhasil dihapus.');
    }
}