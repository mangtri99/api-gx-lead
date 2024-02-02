<?php

namespace App\Repository\Branch;

use App\Interface\CrudInterface;
use App\Models\Branch;
use App\Models\Probability;
use Illuminate\Http\Request;

class BranchRepository implements CrudInterface
{
    public function getAll(Request $request)
    {
        return Branch::all();
    }

    public function getById($id)
    {
        return Branch::findOrFail($id);
    }

    public function create(Request $request)
    {
        $branch = Branch::create([
            'name' => $request->name,
        ]);
        return $branch;
    }

    public function update(Request $request, int $id)
    {
        $branch = Branch::findOrFail($id);

        $branch->name = $request->name;
        $branch->save();

        return $branch;
    }

    public function delete(int $id)
    {
        $branch = Branch::find($id);
        $branch->delete();
        return $branch;
    }
}
