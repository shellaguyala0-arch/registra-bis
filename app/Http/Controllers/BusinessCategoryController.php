<?php

namespace App\Http\Controllers;

use App\Models\BusinessCategory;
use Illuminate\Http\Request;
use App\Helpers\ActivityLogger;

class BusinessCategoryController extends Controller
{
    public function index()
    {
        $categories = BusinessCategory::orderBy('name')->get();

        return view('settings.business-categories', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'max:100',
                'unique:business_categories,name',
            ],
        ]);

        $category = BusinessCategory::create([
            'name' => trim($request->name),
        ]);

        ActivityLogger::log(
            'Category Added',
            "Business category '{$category->name}' was added successfully.",
            'Business Categories',
            $category->id
        );

        return redirect()
            ->route('settings.business-categories.index')
            ->with(
                'category_success',
                'Business category added successfully.'
            );
    }


        public function destroy(BusinessCategory $businessCategory)
        {
            $used = \App\Models\Business::where(
                'category',
                $businessCategory->name
            )->exists();

            if ($used) {
                ActivityLogger::log(
                    'Category Delete Blocked',
                    "Attempted to remove business category '{$businessCategory->name}', but it is currently assigned to an existing business.",
                    'Business Categories',
                    $businessCategory->id
                );
                return redirect()
                    ->route('settings.business-categories.index')
                    ->with(
                        'category_error',
                        'This category cannot be removed because it is currently assigned to an existing business.'
                    );
            }

        $categoryName = $businessCategory->name;
        $categoryId = $businessCategory->id;

        $businessCategory->delete();

        ActivityLogger::log(
            'Category Deleted',
            "Business category '{$categoryName}' was removed successfully.",
            'Business Categories',
            $categoryId
        );

        return redirect()
            ->route('settings.business-categories.index')
            ->with(
                'category_success',
                'Business category removed successfully.'
            );
    }
}