<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Contact;


class ContactController extends Controller
{
    private $columns = [
        0 => 'id',
        1 => 'first_name',
        2 => 'last_name',
        3 => 'email',
        4 => 'phone',
        5 => 'dob',
        6 => 'address',
        7 => 'city',
        8 => 'state',
        9 => 'zip',
    ];

    public function index(Request $request)
    {
        $contacts = DB::table('contacts');
        $order = current($request->input('order'));
        $length = $request->input('length');
        $start = $request->input('start');
        $search = $request->input('search');
        $total_records = $contacts->count();
        $filtered_count = $total_records;

        // Add Criteria
        if (!empty($search['value']) && !is_null($search['value'])) {
            $val = app('db')->getPdo()->quote(strtolower("%{$search['value']}%"));
            $contacts->whereRaw("lower(first_name) LIKE {$val}")
                ->orWhereRaw("lower(last_name) LIKE {$val}")
                ->orWhereRaw("lower(email) LIKE {$val}")
                ->orWhereRaw("lower(phone) LIKE {$val}")
                ->orWhereRaw("lower(dob) LIKE {$val}")
                ->orWhereRaw("lower(address) LIKE {$val}")
                ->orWhereRaw("lower(city) LIKE {$val}")
                ->orWhereRaw("lower(state) LIKE {$val}")
                ->orWhereRaw("lower(zip) LIKE {$val}");
            $filtered_count = $contacts->count();
        }

        // Add Pagination & Sorting
        $contacts->orderBy($this->columns[$order['column']], $order['dir'])
            ->offset($start)
            ->limit($length);

        return [
            'recordsTotal' => $total_records,
            'recordsFiltered' => $filtered_count,
            'data' => $contacts->get(),
        ];
    }

    public function show(Contact $contact)
    {
        return $contact;
    }

    public function store(Request $request)
    {
        $contact = Contact::create($request->all());

        return response()->json($contact, 201);
    }

    public function update(Request $request, Contact $contact)
    {
        $contact->update($request->all());

        return response()->json($contact, 200);
    }

    public function delete(Contact $contact)
    {
        $contact->delete();

        return response()->json(null, 204);
    }
}
