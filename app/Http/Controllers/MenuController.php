<?php

namespace App\Http\Controllers;

use App\Models\MenuItem;
use Illuminate\Http\Request;

class MenuController extends Controller
{

    public function getAllItems()
    {
        // Retrieve all menu items from the database
        $menuItems = MenuItem::all();

        return response()->json(['menu_items' => $menuItems], 200);
    }

    public function getItemById($id)
    {
        // Retrieve the menu item by its ID from the database
        $menuItem = MenuItem::find($id);

        if (!$menuItem) {
            return response()->json(['message' => 'Menu item not found'], 404);
        }

        return response()->json(['menu_item' => $menuItem], 200);
    }

    public function addItem(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required|string',
            'description' => 'string',
            'price' => 'numeric',
        ]);

        // Create a new menu item
        $menuItem = MenuItem::create($validatedData);

        return response()->json(['message' => 'Menu item added successfully'], 201);
    }
}
