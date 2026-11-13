<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ComplaintController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | SHOW COMPLAINT FORM
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        return view('pages.report');
    }


    /*
    |--------------------------------------------------------------------------
    | STORE NEW COMPLAINT
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $validated = $request->validate([

            'category' => 'required|string|max:100',

            'title' => 'required|string|max:255',

            'description' => 'required|string|max:2000',

            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',

            'location' => 'required|string|max:255',

            'latitude' => 'nullable|numeric|between:-90,90',

            'longitude' => 'nullable|numeric|between:-180,180',

        ]);


        // Generate unique complaint ID

        do {

            $complaintId = 'URBIX-' .
                now()->format('Ymd') . '-' .
                strtoupper(Str::random(6));

        } while (
            Complaint::where('complaint_id', $complaintId)->exists()
        );


        // Upload complaint image

        $imagePath = null;

        if ($request->hasFile('image')) {

            $imagePath = $request->file('image')
                ->store('complaints', 'public');

        }


        // Save complaint in database

        $complaint = Complaint::create([

            'complaint_id' => $complaintId,

            'user_id' => auth()->id(),

            'category' => $validated['category'],

            'title' => $validated['title'],

            'description' => $validated['description'],

            'image' => $imagePath,

            'location' => $validated['location'],

            'latitude' => $validated['latitude'] ?? null,

            'longitude' => $validated['longitude'] ?? null,

            'status' => 'Pending',

        ]);


        return redirect()

            ->route('report')

            ->with('success', 'Complaint submitted successfully!')

            ->with('complaint_id', $complaint->complaint_id);
    }


    /*
    |--------------------------------------------------------------------------
    | CITIZEN - MY COMPLAINTS
    |--------------------------------------------------------------------------
    */

    public function index(Request $request)
    {
        // Get only logged-in user's complaints

        $query = Complaint::where('user_id', auth()->id());


        // Search by complaint ID or title

        if ($request->filled('search')) {

            $search = $request->search;

            $query->where(function ($q) use ($search) {

                $q->where('complaint_id', 'like', "%{$search}%")

                    ->orWhere('title', 'like', "%{$search}%");

            });

        }


        // Pagination with search query preserved

        $complaints = $query

            ->latest()

            ->paginate(10)

            ->withQueryString();


        return view('pages.my-complaints', compact('complaints'));
    }


    /*
    |--------------------------------------------------------------------------
    | TRACK COMPLAINT
    |--------------------------------------------------------------------------
    */

    public function track(Request $request)
    {
        $complaint = null;


        if ($request->filled('complaint_id')) {

            $complaint = Complaint::where(

                'complaint_id',

                strtoupper(trim($request->complaint_id))

            )->first();

        }


        return view('pages.track', compact('complaint'));
    }
}