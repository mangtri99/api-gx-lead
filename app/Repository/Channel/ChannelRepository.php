<?php

namespace App\Repository\Channel;

use App\Interface\CrudInterface;

use App\Models\Channel;
use Illuminate\Http\Request;

class ChannelRepository implements CrudInterface
{
    public function getAll(Request $request)
    {
        return Channel::all();
    }

    public function getById(int $id)
    {
        return Channel::findOrfail($id);
    }

    public function create(Request $request)
    {
        $channel = Channel::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);
        return $channel;
    }

    public function update(Request $request, int $id)
    {
        $channel = Channel::findOrfail($id);
        $channel->name = $request->name;
        $channel->description = $request->description;
        $channel->save();

        return $channel;
    }

    public function delete(int $id)
    {
        $channel = Channel::findOrfail($id);
        $channel->delete();
        return $channel;
    }
}
