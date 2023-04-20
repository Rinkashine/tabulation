<?php

namespace App\Exports;

use Analytics;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Spatie\Analytics\Period;

class BrowserTypeExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    protected $startdate;

    protected $enddate;

    public function __construct($startdate, $enddate)
    {
        $this->startdate = $startdate;
        $this->enddate = $enddate;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $st = new Carbon($this->startdate);
        $ed = new Carbon($this->enddate);
        $period = Period::create($st, $ed);

        return Analytics::fetchTopBrowsers($period, 20);
    }

    public function headings(): array
    {
        return [
            'Browser Name',
            'Sessions',
        ];
    }
}
