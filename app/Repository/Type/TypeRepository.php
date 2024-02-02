<?php

namespace App\Repository\Type;

use App\Interface\CrudInterface;

use App\Models\Type;

use Illuminate\Http\Request;

class TypeRepository implements CrudInterface
{
    public function getAll(Request $request)
    {
        return Type::all();
    }

    public function getById(int $id)
    {
        return Type::findOrfail($id);
    }

    public function create(Request $request)
    {
        $type = Type::create([
            'name' => $request->name,
            'description' => $request->description ?? null,
        ]);
        return $type;
    }

    public function update(Request $request, int $id)
    {
        $type = Type::findOrfail($id);
        $type->name = $request->name;
        $type->description = $request->description ?? null;
        $type->save();

        return $type;
    }

    public function delete(int $id)
    {
        $type = Type::findOrfail($id);
        $type->delete();
        return $type;
    }
}
