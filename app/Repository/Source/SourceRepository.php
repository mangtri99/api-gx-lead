<?php

namespace App\Repository\Source;

use App\Interface\CrudInterface;

use App\Models\Source;

use Illuminate\Http\Request;

class SourceRepository implements CrudInterface
{
    public function getAll(Request $request)
    {
        return Source::all();
    }

    public function getById(int $id)
    {
        return Source::findOrfail($id);
    }

    public function create(Request $request)
    {
        $source = Source::create([
            'name' => $request->name,
            'media_id' => $request->media_id,
            'description' => $request->description ?? null,
        ]);
        return $source;
    }

    public function update(Request $request, int $id)
    {
        $source = Source::findOrfail($id);
        $source->name = $request->name;
        $source->media_id = $request->media_id;
        $source->description = $request->description ?? null;
        $source->save();

        return $source;
    }

    public function delete(int $id)
    {
        $source = Source::findOrfail($id);
        $source->delete();
        return $source;
    }
}
