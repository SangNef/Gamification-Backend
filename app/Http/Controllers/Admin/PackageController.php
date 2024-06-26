<?php

namespace App\Http\Controllers\Admin;

use App\Helper\TimeHelper;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PackageController extends Controller
{
    public function packageManage()
    {
        $packages = Package::all();

        $orders = Order::join('users', 'orders.user_id', '=', 'users.id')
            ->join('packages', 'orders.package_id', '=', 'packages.stt')
            ->select('orders.*', 'users.name as user_name', 'packages.point as package_point')
            ->orderByDesc('created_at')->paginate(10);

        $timeHelper = new TimeHelper();
        foreach ($orders as $order) {
            $order->formatted_created_at = $timeHelper->formatTime($order->created_at);
        }

        return view('pages.package.index', compact('packages', 'orders'));
    }

    public function createPackageForm()
    {
        return view('pages.package.create');
    }

    public function createPackage(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'point' => 'required|integer',
            'price' => 'required|numeric|between:0,9999999.99',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $package = new Package([
            'point' => $request->input('point'),
            'price' => $request->input('price'),
        ]);

        $package->save();

        return redirect('/admin/package-manage')->with(['success' => 'Package created successfully']);
    }

    public function packageDetail($stt)
    {
        $package = Package::find($stt);

        return view('pages.package.detail', compact('package'));
    }

    public function updatePackageForm($stt)
    {
        $package = Package::find($stt);

        return view('pages.package.update', compact('package'));
    }

    public function updatePackage(Request $request, $stt)
    {
        $validator = Validator::make($request->all(), [
            'point' => 'required|integer',
            'price' => 'required|numeric|between:0,9999999.99',

        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $package = Package::find($stt);
        $package->point = $request->input('point');
        $package->price = $request->input('price');

        $package->save();

        return redirect('/admin/package-manage')->with(['success' => 'Package update successfully'])->withInput();
    }

    public function deletePackage($stt)
    {
        $package = Package::find($stt);

        if (!$package) {
            return redirect()->back()->with(['error' => 'Package not found']);
        }

        $orderExists = Order::where('package_id', $stt)->exists();
        if ($orderExists) {
            return redirect()->back()->with(['error' => 'Cannot delete this package!']);
        }

        $package->delete();

        return redirect()->back()->with(['success' => 'Delete successfully']);
    }
}
