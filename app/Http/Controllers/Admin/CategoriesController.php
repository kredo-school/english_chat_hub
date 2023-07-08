<?php

namespace App\Http\Controllers\Admin;

use App\Models\Meeting;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class CategoriesController extends Controller
{
    const ICON_FOLDER = 'image/category/';

    public function index()
    {
        $all_categories = Category::withTrashed()->paginate(10);
        return view('admin.chatrooms.categories.index')
            ->with('all_categories', $all_categories);
    }
    public function show($id)
    {
        // update Meetings Status
        Meeting::updateStatus();
        
        $category = Category::withTrashed()->findOrFail($id);
        $meetings = $category->meetings()->withTrashed()->latest()->paginate(10);
        return view('admin.chatrooms.categories.show')
            ->with('category', $category)
            ->with('meetings', $meetings)
            ->with('statusColor', Meeting::statusColor());
    }
    public function add()
    {
        return view('admin.chatrooms.categories.add');
    }
    public function edit($id)
    {
        $category = Category::withTrashed()->findOrFail($id);
        return view('admin.chatrooms.categories.edit')
        ->with('category', $category);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'          => 'required|max:20|unique:categories,name',
            'color'         => 'required|regex:/^#[0-9a-fA-F]{3}([0-9a-fA-F]{3})?$/', //Hex Color
            'icon'          => 'required|mimes:jpg,jpeg,png,gif',
            'description'   => 'required|min:5|max:100'
        ]);

        $name = ucwords(strtolower($request->name));
        $iconName = $this->saveCategoryIcon($request);
        Category::create([
            'name' => $name,
            'color' => $request->color,
            'description' => $request->description,
            'icon' => $iconName
        ]);

        return redirect()->route('admin.chatrooms.categories.index');
    }
    public function update(Request $request, $id)
    {
        $category = Category::withTrashed()->findOrFail($id);
        $request->validate([
            'name' => 'required|max:20|unique:categories,name,' . $category->id,
            'color'=> 'required|regex:/^#[0-9a-fA-F]{3}([0-9a-fA-F]{3})?$/',
            'icon' => 'mimes:jpg,jpeg,png,gif',
            'description' => 'required|min:5|max:100'
        ]);
        
        $category->name = ucwords(strtolower($request->name));
        $category->color = $request->color;
        $category->description = $request->description;
        if ($request->icon) {
            $this->deleteCategoryIcon($id);
            $category->icon = $this->saveCategoryIcon($request);
        }
        $category->save();
        return redirect()->route('admin.chatrooms.categories.index');
    }
    public function delete(Category $category)
    {
        $category->meetings()->delete();
        $category->delete();

        return redirect()->route('admin.chatrooms.categories.index');
    }
    public function restore($id)
    {
        $category = Category::withTrashed()->findOrFail($id);
        $category->restore();
        return redirect()->route('admin.chatrooms.categories.index');
    }

    public function deleteCategoryIcon($id)
    {
        $category = Category::withTrashed()->findOrFail($id);
        $iconPath = self::ICON_FOLDER . '/' . $category->icon;
        if (Storage::disk('public')->exists($iconPath)) {
            Storage::disk('public')->delete($iconPath);
        }
    }
    public function saveCategoryIcon(Request $request)
    {
        $iconName = str_replace(" ", "_", strtolower($request->name)) . "." . $request->icon->extension();
        $request->icon->move(public_path(self::ICON_FOLDER), $iconName);
        return $iconName;
    }
}
