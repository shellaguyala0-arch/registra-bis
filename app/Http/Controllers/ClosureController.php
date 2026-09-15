<?php

namespace App\Http\Controllers;

use App\Models\Business;
use App\Models\ClosureApplication;
use Illuminate\Http\Request;
use App\Helpers\ActivityLogger;

class ClosureController extends Controller
{
    public function index()
    {
        $businesses = Business::where(
            'registration_status',
            'Active'
        )
        ->where(
            'closure_status',
            'Active'
        )
        ->orderBy('business_name')
        ->get();

        $applications = ClosureApplication::latest()->get();

        return view(
            'closures.index',
            compact(
                'businesses',
                'applications'
            )
        );
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'business_id' => [
                'nullable',
                'exists:businesses,id'
            ],

            'business_name' => [
                'required',
                'string',
                'max:255'
            ],

            'owner_name' => [
                'required',
                'string',
                'max:255'
            ],

            'permit_number' => [
                'required',
                'string',
                'max:255'
            ],

            'reason' => [
                'required',
                'file',
                'mimes:pdf,jpg,jpeg,png',
                'max:5120'
            ],
        ]);

       
        $business = null;

        if (!empty($validated['business_id'])) {
            $business = Business::find(
                $validated['business_id']
            );

            if (!$business) {
                return redirect()
                    ->back()
                    ->withInput()
                    ->with(
                        'error',
                        'Business not found.'
                    );
            }
        }

        
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

        $reasonPath = null;

        if ($request->hasFile('reason')) {
            $file = $request->file('reason');

            $extension = strtolower(
                $file->getClientOriginalExtension()
            );

            $filename =
                'closure_reason_' .
                ($validated['business_id'] ?? 'unknown') .
                '_' .
                time() .
                '_' .
                uniqid() .
                '.' .
                $extension;

            $file->move(
                $attachmentPath,
                $filename
            );

            $reasonPath =
                'businesses-attachments/' .
                $filename;
        }

        $closure = ClosureApplication::create([
            'business_id' => $validated['business_id'] ?? null,
            'business_name' => $validated['business_name'],
            'owner_name' => $validated['owner_name'],
            'permit_number' => $validated['permit_number'],

        
            'reason' => $reasonPath,

            'status' => 'Approved',

            'decision' =>
                'Business closure automatically approved upon submission.',

            'reviewed_at' => now(),
        ]);

        
        if ($business) {
            $business->update([
                'registration_status' => 'Inactive',
                'closure_status' => 'Closed',
            ]);
        }

        ActivityLogger::log(
            'Business Closure Approved',
            "Business '{$closure->business_name}' owned by '{$closure->owner_name}' was closed successfully. Permit No: {$closure->permit_number}. Closure document uploaded.",
            'Business Closure',
            $closure->id
        );

        return redirect()
            ->route('closures.index')
            ->with(
                'success',
                'Business closure approved successfully. The business has been moved to the history/archive.'
            );
    }

    public function update(
        Request $request,
        ClosureApplication $closure
    ) {
        return redirect()
            ->route('closures.index')
            ->with(
                'info',
                'Closure applications are automatically approved upon submission.'
            );
    }
}