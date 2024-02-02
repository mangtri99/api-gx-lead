<?php

namespace App\Repository\Probability;

use App\Interface\CrudInterface;
use App\Models\Probability;
use Illuminate\Http\Request;

class ProbabilityRepository implements CrudInterface
{
    public function getAll(Request $request)
    {
        return Probability::all();
    }

    public function getById(int $id)
    {
        return Probability::findOrfail($id);
    }

    public function create(Request $request)
    {
        $probability = Probability::create([
            'name' => $request->name,
            'description' => $request->description ?? null,
        ]);
        return $probability;
    }

    public function update(Request $request, int $id)
    {
        $probability = Probability::findOrfail($id);
        $probability->name = $request->name;
        $probability->description = $request->description ?? null;
        $probability->save();

        return $probability;
    }

    public function delete(int $id)
    {
        $probability = Probability::findOrfail($id);
        $probability->delete();
        return $probability;
    }
}
