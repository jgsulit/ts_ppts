<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\oqcVIR;
use App\Model\oqcVIRTS;
use App\Model\AssemblyLine;
use App\Model\MaterialIssuanceSubSystem;
use App\Model\ProductionRuncard;
use App\Model\PackingInspector;

use App\User;

class ShipmentSummary extends Model
{
    protected $table = 'tspts_finalpackinginspection_qc_shipment_summary';
    protected $connection = 'mysql';

    public $timestamps = false;
}
