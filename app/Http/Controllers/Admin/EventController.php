<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EventController extends Controller
{

    public function index(){
        $events = Event::get();
        return view('pages.event.index',compact('events'));
    }
     public function createEventForm()
    {
        return view('pages.event.create');
    }
  public function createEvent(Request $request)
{
    $validator = Validator::make($request->all(), [
        'title' => 'required|string|max:50',
        'banner' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        'start' => 'required|date',
        'end' => 'required|date|after:start',
    ]);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    $imagePath = Cloudinary::upload($request->file('banner')->getRealPath())->getSecurePath();

    $event = Event::create([
        'title' => $request->input('title'),
        'banner' => $imagePath,
        'start' => $request->input('start'),
        'end' => $request->input('end'),
    ]);

    return redirect('/admin/event-manage')->with(['success' => 'Event created successfully']);
}
}
