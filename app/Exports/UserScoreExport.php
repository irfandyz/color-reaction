<?php

namespace App\Exports;

use App\Models\User;
use App\Models\Score;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UserScoreExport implements FromCollection,WithHeadings
{
    protected $id;

    function __construct($id) {
            $this->id = $id;
    }
    public function collection()
    {
        return Score::where('user_id',$this->id)->select('score','average','created_at')->get();
        // return $this->data;
    }
    public function headings(): array
    {
        return [
            'Score',
            'Average',
            'Time',
        ];
    }
}