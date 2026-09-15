<?php

namespace App\Http\Controllers;

use App\Models\Business;
use App\Models\BusinessCategory;
use App\Helpers\ActivityLogger;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BusinessController extends Controller
{
    private function treasurer()
    {
        abort_unless(
            auth()->user()->isTreasurer(),
            403,
            'Treasurer access required.'
        );
    }

    public function index(Request $r)
    {
        $q = Business::query();

        if ($r->filled('search')) {

            $s = trim($r->search);

            $q->where(function ($x) use ($s) {

                $x->where(
                    'business_name',
                    'like',
                    "%{$s}%"
                )

                ->orWhere(
                    'owner_name',
                    'like',
                    "%{$s}%"
                )

                ->orWhere(
                    'permit_number',
                    'like',
                    "%{$s}%"
                )

                ->orWhere(
                    'category',
                    'like',
                    "%{$s}%"
                )

                ->orWhere(
                    'landmark',
                    'like',
                    "%{$s}%"
                )

                ->orWhere(
                    'address',
                    'like',
                    "%{$s}%"
                )

                ->orWhere(
                    'contact_number',
                    'like',
                    "%{$s}%"
                )

                ->orWhere(
                    'email',
                    'like',
                    "%{$s}%"
                )

                ->orWhere(
                    'location_description',
                    'like',
                    "%{$s}%"
                )

                ->orWhere(
                    'payment_status',
                    'like',
                    "%{$s}%"
                )

                ->orWhere(
                    'registration_status',
                    'like',
                    "%{$s}%"
                )

                ->orWhere(
                    'closure_status',
                    'like',
                    "%{$s}%"
                );

            });
        }

        $businesses = $q
            ->latest()
            ->paginate(12)
            ->withQueryString();


        return view(
            'businesses.index',
            compact('businesses')
        );
    }

    public function create()
    {
        $this->treasurer();

        $categories = BusinessCategory::orderBy('name')->get();

        $landmarks = [
            'Barangay Hall',
            'Church',
            'Public Market',
            'School',
            'Health Center',
            'Main Street',
            'Other',
        ];


        return view(
            'businesses.create',
            compact(
                'categories',
                'landmarks'
            )
        );
    }

    public function store(Request $r)
    {
        $this->treasurer();


        $d = $r->validate([

            'business_name' =>
                'required|max:255',

            'owner_name' =>
                'required|max:255',

            'address' =>
                'required',

            'contact_number' =>
                'nullable|max:30',

            'email' =>
                'nullable|email',

            'valid_id_type' =>
                'required|string|max:100',

            'valid_id_number' =>
                'required|string|max:100',

            'category' =>
                'required|string|max:255',

            'landmark' =>
                'nullable|max:255',

            'location_description' =>
                'nullable',

            'latitude' =>
                'nullable|numeric',

            'longitude' =>
                'nullable|numeric',

            'owner_photo' =>
                'required|image|mimes:jpg,jpeg,png|max:2048',

            'valid_id_file' =>
                'required|image|mimes:jpg,jpeg,png|max:5120',

            'business_exterior' =>
                'required|image|mimes:jpg,jpeg,png|max:5120',
        ]);


        $d['permit_number'] =
            'SB-' .
            now()->format('Y') .
            '-' .
            strtoupper(Str::random(6));


        $d['registration_status'] = 'Pending';
        $d['payment_status'] = 'Unpaid';
        $d['closure_status'] = 'Active';

        $b = Business::create($d);

        $attachmentPath = public_path(
            'businesses-attachments'
        );

        if (!file_exists($attachmentPath)) {

            mkdir(
                $attachmentPath,
                0755,
                true
            );
        }

        if ($r->hasFile('owner_photo')) {

            $file = $r->file('owner_photo');

            $extension =
                $file->getClientOriginalExtension();

            $filename =
                'owner_' .
                $b->id .
                '_' .
                time() .
                '.' .
                $extension;

            $file->move(
                $attachmentPath,
                $filename
            );

            $b->owner_photo =
                'businesses-attachments/' .
                $filename;
        }

        if ($r->hasFile('valid_id_file')) {

            $file = $r->file('valid_id_file');

            $extension =
                $file->getClientOriginalExtension();

            $filename =
                'valid_id_' .
                $b->id .
                '_' .
                time() .
                '.' .
                $extension;

            $file->move(
                $attachmentPath,
                $filename
            );

            $b->valid_id_file =
                'businesses-attachments/' .
                $filename;
        }

        if ($r->hasFile('business_exterior')) {

            $file = $r->file('business_exterior');

            $extension =
                $file->getClientOriginalExtension();

            $filename =
                'business_' .
                $b->id .
                '_' .
                time() .
                '.' .
                $extension;


            $file->move(
                $attachmentPath,
                $filename
            );

            $b->business_exterior =
                'businesses-attachments/' .
                $filename;
        }

        $b->save();

        ActivityLogger::log(
            'Business Registered',
            "Business '{$b->business_name}' owned by '{$b->owner_name}' was registered successfully. Permit No: {$b->permit_number}.",
            'Businesses',
            $b->id
        );

        return redirect()
            ->route(
                'businesses.show',
                $b
            )
            ->with(
                'success',
                'Business profile created successfully.'
            );
    }

    public function show(Business $business)
    {
        $business->load([
            'assessments.payments',
            'documents',
            'closures'
        ]);


        return view(
            'businesses.show',
            compact('business')
        );
    }

    public function edit(Business $business)
    {
        $this->treasurer();

        $categories =
            BusinessCategory::orderBy('name')
                ->get();

        $landmarks = [
            'Barangay Hall',
            'Church',
            'Public Market',
            'School',
            'Health Center',
            'Main Street',
            'Other'
        ];


        return view(
            'businesses.edit',
            compact(
                'business',
                'categories',
                'landmarks'
            )
        );
    }

    public function update(
        Request $r,
        Business $business
    ) {

        $this->treasurer();


        $d = $r->validate([

            'business_name' =>
                'required|max:255',

            'owner_name' =>
                'required|max:255',

            'address' =>
                'required',

            'contact_number' =>
                'nullable|max:30',

            'email' =>
                'nullable|email',

            'valid_id_type' =>
                'required|string|max:100',

            'valid_id_number' =>
                'required|string|max:100',

            'category' =>
                'required|string|max:255',

            'landmark' =>
                'nullable|max:255',

            'location_description' =>
                'nullable',

            'latitude' =>
                'nullable|numeric',

            'longitude' =>
                'nullable|numeric',
                
            'owner_photo' =>
            'required|image|mimes:jpg,jpeg,png|max:2048',

            'valid_id_file' =>
                'required|image|mimes:jpg,jpeg,png|max:5120',

            'business_exterior' =>
                'required|image|mimes:jpg,jpeg,png|max:5120',
        ]);
        $business->update($d);


        ActivityLogger::log(
            'Business Updated',
            "Business '{$business->business_name}' owned by '{$business->owner_name}' was updated successfully.",
            'Businesses',
            $business->id
        );

        return back()->with(
            'success',
            'Business profile updated.'
        );
    }
}