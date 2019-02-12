<?php

namespace App\Http\Controllers;

use App\Configuration;
use Illuminate\Http\Request;

class ConfigurationController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Configuration $configuration
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        return view('configurations.edit', [
            'configuration' => Configuration::findOrFail(1),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'tax_rate'        => 'nullable|numeric|min:0|max:99',
            'tax_inclusion'   => 'nullable|numeric|min:0|max:1',
            'global_discount' => 'nullable|numeric|min:0|max:99',
        ]);

        if ($request->tax_inclusion) {
            $tax_inclusion = $request->tax_inclusion;
        } else {
            $tax_inclusion = 0;
        }

        $configuration = Configuration::findOrFail(1);

        $configuration->tax_rate = $request->tax_rate;
        $configuration->tax_inclusion = $tax_inclusion;
        $configuration->global_discount = $request->global_discount;
        $configuration->save();

        return redirect(route('products.index'));
    }
}
