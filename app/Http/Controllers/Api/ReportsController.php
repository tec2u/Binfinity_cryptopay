<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\NodeOrders;
use App\Traits\ApiUser;
use DB;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    use ApiUser;
    public function reportsHome(Request $request)
    {
        try {
            $user = $this->getUser($request);
            if ($user == false) {
                return response()->json(['error' => "Invalid token"]);
            }

            $totalRecords = NodeOrders::where('id_user', $user->id)
                ->where('type', 1)
                ->count();

            $recordsByStatus = NodeOrders::where('id_user', $user->id)
                ->where('type', 1)
                ->select('status', DB::raw('count(*) as count'))
                ->groupBy('status')
                ->get();

            $percentageByStatus = $recordsByStatus->map(function ($item) use ($totalRecords) {
                $item->percentage = ($item->count / $totalRecords) * 100;
                return $item;
            });


            $transactions = NodeOrders::where('id_user', $user->id)
                ->where('type', 1)
                ->where(function ($query) {
                    $query->whereRaw('LOWER(status) = ?', ['paid'])
                        ->orWhereRaw('LOWER(status) = ?', ['underpaid'])
                        ->orWhereRaw('LOWER(status) = ?', ['overpaid']);
                })
                ->selectRaw('YEAR(createdAt) as year, MONTH(createdAt) as month, SUM(price) as total_price')
                ->groupBy(DB::raw('YEAR(createdAt)'), DB::raw('MONTH(createdAt)'))
                ->get();

            return response()->json([
                'per_status' => $percentageByStatus,
                'per_month' => $transactions
            ]);

        } catch (\Throwable $th) {
            // return response()->json(['error' => $th->getMessage()]);
            return response()->json(['error' => "Failed in get data"]);
        }

    }
}
