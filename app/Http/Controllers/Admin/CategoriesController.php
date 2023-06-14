<?php

namespace App\Http\Controllers\Admin;

use App\Models\Meeting;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class CategoriesController extends Controller
{
    private $category;
    private $meeting;
    const ICON_FOLDER = 'image/category/';

    public function __construct(Category $category, Meeting $meeting)
    {
        $this->category = $category;
        $this->meeting = $meeting;
    }
    public function index()
    {
        $all_categories = $this->category->withTrashed()->paginate(10);
        return view('admin.chatrooms.categories.index')
            ->with('all_categories', $all_categories);
    }
    public function show($id)
    {
        // update Meetings Status
        $this->meeting->updateStatus();
        
        $category = $this->category->withTrashed()->findOrFail($id);
        $meetings = $category->meetings()->withTrashed()->latest()->paginate(10);
        return view('admin.chatrooms.categories.show')
            ->with('category', $category)
            ->with('meetings', $meetings)
            ->with('statusColor', $this->meeting->statusColor());
    }
    public function add()
    {
        return view('admin.chatrooms.categories.add');
    }
    public function edit($id)
    {
        $category = $this->category->withTrashed()->findOrFail($id);
        return view('admin.chatrooms.categories.edit')
        ->with('category', $category);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'          => 'required|min:1|max:20|unique:categories,name',
            'color'         => 'required|regex:/^#[0-9a-fA-F]{3}([0-9a-fA-F]{3})?$/', //Hex Color
            'icon'          => 'required|mimes:jpg,jpeg,png,gif',
            'description'   => 'required|min:5|max:100'
        ]);

        $this->category->name = str_replace(" ", "_", ucwords($request->name));
        $this->category->color = $request->color;
        $this->category->description = $request->description;
        $this->category->icon = $this->saveIcon($request);
        $this->category->save();
        return redirect()->route('admin.chatroom.category.index');
    }
    public function update(Request $request, $id)
    {
        $category = $this->category->withTrashed()->findOrFail($id);
        $request->validate([
            'name' => 'required|min:1|max:20|unique:categories,name,' . $category->id,
            'color'=> 'required|regex:/^#[0-9a-fA-F]{3}([0-9a-fA-F]{3})?$/',
            'icon' => 'mimes:jpg,jpeg,png,gif',
            'description' => 'required|min:5|max:100'
        ]);
        
        $category->name = str_replace(" ", "_", ucwords(strtolower($request->name)));
        $category->color = $request->color;
        $category->description = $request->description;
        if ($request->icon) {
            $this->deleteIcon($id);
            $category->icon = $this->saveIcon($request);
        }
        $category->save();
        return redirect()->route('admin.chatroom.category.index');
    }
    public function delete($id)
    {
        $category = $this->category->findOrFail($id);
        foreach ($category->meetings as $meeting) {
            $meeting->delete();
        }
        $category->delete();

        return redirect()->route('admin.chatroom.category.index');
    }
    public function restore($id)
    {
        $category = $this->category->withTrashed()->findOrFail($id);
        $category->restore();
        return redirect()->route('admin.chatroom.category.index');
    }

    public function deleteIcon($id)
    {
        $category = $this->category->withTrashed()->findOrFail($id);
        $iconPath = self::ICON_FOLDER . '/' . $category->icon;
        if (Storage::disk('public')->exists($iconPath)) {
            Storage::disk('public')->delete($iconPath);
        }
    }
    public function saveIcon(Request $request)
    {
        $iconName = str_replace(" ", "_", strtolower($request->name)) . "." . $request->icon->extension();
        $request->icon->move(public_path(self::ICON_FOLDER), $iconName);
        return $iconName;
    }
}
