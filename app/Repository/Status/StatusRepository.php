<?php

namespace App\Repository\Status;

use App\Interface\CrudInterface;

use App\Models\Status;

use Illuminate\Http\Request;

class StatusRepository implements CrudInterface
{
    public function getAll(Request $request)
    {
        return Status::all();
    }

    public function getById(int $id)
    {
        return Status::findOrfail($id);
    }

    public function create(Request $request)
    {
        $status = Status::create([
            'name' => $request->name,
            'description' => $request->description ?? null,
        ]);
        return $status;
    }

    public function update(Request $request, int $id)
    {
        $status = Status::findOrfail($id);
        $status->name = $request->name;
        $status->description = $request->description ?? null;
        $status->save();

        return $status;
    }

    public function delete(int $id)
    {
        $status = Status::findOrfail($id);
        $status->delete();
        return $status;
    }
}
