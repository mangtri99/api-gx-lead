<?php

namespace App\Repository\Lead;

use App\Interface\CrudInterface;
use App\Models\Branch;
use App\Models\Channel;
use App\Models\Lead;
use App\Models\Media;
use App\Models\Probability;
use App\Models\Source;
use App\Models\Status;
use App\Models\Type;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LeadRepository implements CrudInterface
{
    public function getAll(Request $request)
    {
        $perPage = $request->per_page ? (int) $request->per_page : 10;
        $queryDateStart = $request->date_start ? Carbon::parse($request->date_start)->startOfDay() : null;
        $queryDateEnd = $request->date_end ? Carbon::parse($request->date_end)->endOfDay() : null;

        $leads = Lead::when($request->search, function ($query) use ($request) {
            // Filter by search in fullname, email and lead number
            $query->where('fullname', 'like', '%' . $request->search . '%')
                ->orWhere('email', 'like', '%' . $request->search . '%')
                ->orWhere('lead_number', 'like', '%' . $request->search . '%');
            // filter by date range
            })->when($queryDateStart && $queryDateEnd, function ($query) use ($queryDateStart, $queryDateEnd) {
                $query->whereBetween('created_at', [$queryDateStart, $queryDateEnd]);
                // if only $queryDateStart
            })->when($queryDateStart && !$queryDateEnd, function ($query) use ($queryDateStart) {
                $query->where('created_at', '>=', $queryDateStart);
                // if only $queryDateEnd
            })->when(!$queryDateStart && $queryDateEnd, function ($query) use ($queryDateEnd) {
                $query->where('created_at', '<=', $queryDateEnd);
            })
            // filter by status
            ->when($request->status, function ($query) use ($request) {
                $query->where('status_id', $request->status);
            })
            // filter by branch
            ->when($request->branch, function ($query) use ($request) {
                $query->where('branch_id', $request->branch);
            })
            // Handle sort and order query params
            ->when($request->sort, function ($query) use ($request) {
                $query->orderBy($request->sort, $request->order ?? 'asc'); // default order is asc
            }, function ($query) {
                // default sort by created_at in desc order
                $query->orderBy('created_at', 'desc');
            })->with([
                'user',
                'branch',
                'status',
                'probability',
                'type',
                'channel',
                'media',
                'source',
            ]);

        $leads = $leads->paginate($perPage);

        return $leads;
    }

    public function charts(Request $request)
    {
        $queryDateStart = $request->date_start ? Carbon::parse($request->date_start)->startOfDay() : null;
        $queryDateEnd = $request->date_end ? Carbon::parse($request->date_end)->endOfDay() : null;

        $leads = Lead::when($queryDateStart && $queryDateEnd, function ($query) use ($queryDateStart, $queryDateEnd) {
            $query->whereBetween('created_at', [$queryDateStart, $queryDateEnd]);
        })->when($queryDateStart && !$queryDateEnd, function ($query) use ($queryDateStart) {
            $query->where('created_at', '>=', $queryDateStart);
        })->when(!$queryDateStart && $queryDateEnd, function ($query) use ($queryDateEnd) {
            $query->where('created_at', '<=', $queryDateEnd);
        })->withCount(['branch', 'status', 'probability', 'type', 'channel', 'media', 'source'])->get();

        $leadsCount = count($leads);

        $dataStatuses = Status::all();
        $dataBranches = Branch::all();
        $dataProbabilities = Probability::all();
        $dataTypes = Type::all();
        $dataChannels = Channel::all();
        $dataMedias = Media::all();
        $dataSources = Source::all();

        // Group by status_id and map to get name and total
        $statuses = $leads->groupBy('status_id')->map(function ($item, $key) {
            return [
                'id' => $item->first()->status_id,
                'total' => $item->count(),
            ];
        });
        // add total to each status
        $statuses = $dataStatuses->map(function ($item, $key) use ($statuses) {
            $total = $statuses->where('id', $item->id)->first();
            return [
                'name' => $item->name,
                'total' => $total ? $total['total'] : 0,
            ];
        });

        // Group by branch_id and map to get name and total
        $branches = $leads->groupBy('branch_id')->map(function ($item, $key) {
            return [
                'id' => $item->first()->branch_id,
                'total' => $item->count(),
            ];
        });
        // add total to each branch
        $branches = $dataBranches->map(function ($item, $key) use ($branches) {
            $total = $branches->where('id', $item->id)->first();
            return [
                'name' => $item->name,
                'total' => $total ? $total['total'] : 0,
            ];
        });
        $branches = [
            'name' =>  $branches->pluck('name'),
            'total' => $branches->pluck('total')
        ];

        // Group by probability_id and map to get name and total
        $probabilities = $leads->groupBy('probability_id')->map(function ($item, $key) {
            return [
                'id' => $item->first()->probability_id,
                'total' => $item->count(),
            ];
        });
        // add total to each probability
        $probabilities = $dataProbabilities->map(function ($item, $key) use ($probabilities) {
            $total = $probabilities->where('id', $item->id)->first();
            return [
                'name' => $item->name,
                'total' => $total ? $total['total'] : 0,
            ];
        });
        $probabilities = [
            'name' =>  $probabilities->pluck('name'),
            'total' => $probabilities->pluck('total')
        ];

        // Group by type_id and map to get name and total
        $types = $leads->groupBy('type_id')->map(function ($item, $key) {
            return [
                'id' => $item->first()->type_id,
                'total' => $item->count(),
            ];
        });
        // add total to each type
        $types = $dataTypes->map(function ($item, $key) use ($types) {
            $total = $types->where('id', $item->id)->first();
            return [
                'name' => $item->name,
                'total' => $total ? $total['total'] : 0,
            ];
        });
        $types = [
            'name' =>  $types->pluck('name'),
            'total' => $types->pluck('total')
        ];

        // Group by channel_id and map to get name and total
        $channels = $leads->groupBy('channel_id')->map(function ($item, $key) {
            return [
                'id' => $item->first()->channel_id,
                'total' => $item->count(),
            ];
        });
        // add total to each channel
        $channels = $dataChannels->map(function ($item, $key) use ($channels) {
            $total = $channels->where('id', $item->id)->first();
            return [
                'name' => $item->name,
                'total' => $total ? $total['total'] : 0,
            ];
        });
        $channels = [
            'name' =>  $channels->pluck('name'),
            'total' => $channels->pluck('total')
        ];

        // Group by media_id and map to get name and total
        $medias = $leads->groupBy('media_id')->map(function ($item, $key) {
            return [
                'id' => $item->first()->media_id,
                'total' => $item->count(),
            ];
        });
        // add total to each media
        $medias = $dataMedias->map(function ($item, $key) use ($medias) {
            $total = $medias->where('id', $item->id)->first();
            return [
                'name' => $item->name,
                'total' => $total ? $total['total'] : 0,
            ];
        });
        $medias = [
            'name' =>  $medias->pluck('name'),
            'total' => $medias->pluck('total')
        ];

        // Group by source_id and map to get name and total
        $sources = $leads->groupBy('source_id')->map(function ($item, $key) {
            if($item->first()->source_id) {
                return [
                    'id' => $item->first()->source_id,
                    'total' => $item->count(),
                ];
            }
        });
        // add total to each source
        $sources = $dataSources->map(function ($item, $key) use ($sources) {
            $total = $sources->where('id', $item->id)->first();
            return [
                'name' => $item->name,
                'total' => $total ? $total['total'] : 0,
            ];
        });
        $sources = [
            'name' =>  $sources->pluck('name'),
            'total' => $sources->pluck('total')
        ];

        return [
            'statuses' => $statuses,
            'branches' => $branches,
            'probabilities' => $probabilities,
            'types' => $types,
            'channels' => $channels,
            'medias' => $medias,
            'sources' => $sources,
            'leads' => [
                'total' => $leadsCount,
            ]

        ];
    }

    public function getById(int $id)
    {
        return Lead::with([
            'branch',
            'status',
            'probability',
            'type',
            'channel',
            'media',
            'source',
        ])->findOrFail($id);
    }

    public function create(Request $request)
    {
        $data = $request->all();
        // 2 Capital Letters + Unix Timestamp
        $createLeadNumber = strtoupper(substr($data['fullname'], 0, 2)) . time();
        // apend lead number to data
        $data['lead_number'] = $createLeadNumber;
        $data['user_id'] = auth()->user()->id;
        $lead = Lead::create($data);
        return $lead;
    }

    public function update(Request $request, int $id)
    {
        $lead = Lead::findOrfail($id)->update($request->all());
        return $lead;
    }

    public function delete(int $id)
    {
        $lead = Lead::findOrfail($id);
        $lead->delete();
        return $lead;
    }
}
