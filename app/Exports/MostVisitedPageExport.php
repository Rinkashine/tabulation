<?php

namespace App\Exports;

use Analytics;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Spatie\Analytics\Period;

class MostVisitedPageExport implements FromCollection, WithHeadings, ShouldAutoSize, WithMapping
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

        return Analytics::fetchMostVisitedPages($period, 10);
    }

    public function map($page): array
    {
        return [
            env('APP_URL').$page['url'],
            $page['pageTitle'],
            $page['pageViews'],
        ];
    }

    public function headings(): array
    {
        return [
            'URL',
            'Page Title',
            'Views',
        ];
    }
}
